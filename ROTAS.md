# Portal 5º BPRv — Rotas, Caminhos e Implementações

**Ambiente:** Kubernetes/Nginx · PHP sem suporte a URLs limpas  
**Base URL:** `https://www9.intranet.policiamilitar.sp.gov.br/unidades/5bprv`  
**Document root do servidor:** raiz do projeto (não `public/`)

---

## Problema de servidor e solução aplicada

O servidor Nginx **ignora `.htaccess`** e não roteia URLs limpas (sem `.php`) para o Laravel.

**Solução:** arquivos `.php` na raiz do projeto que reescrevem `REQUEST_URI` antes de inicializar o Laravel:

| Arquivo | Rota Laravel | URL pública |
|---------|-------------|-------------|
| `index.php` | `/` | `/` (home) |
| `noticias.php` | `/noticias.php` | `/noticias.php` |
| `historico.php` | `/historico.php` | `/historico.php` |
| `memorial.php` | `/memorial.php` | `/memorial.php` |
| `tor.php` | `/tor.php` | `/tor.php` |
| `galerias.php` | `/galerias.php` | `/galerias.php` |
| `redes-sociais.php` | `/redes-sociais.php` | `/redes-sociais.php` |
| `contato.php` | `/contato.php` | `/contato.php` |
| `login.php` | `/login` | `/login.php` |
| `admin.php` | `/admin` | `/admin.php` |
| `admin-go.php` | qualquer rota `/admin/*` | `/admin-go.php?path=admin/...` |

### Como criar um novo arquivo de entrada

```php
<?php
$_SERVER['REQUEST_URI'] = '/unidades/5bprv/ROTA-LARAVEL';
require __DIR__ . '/index.php';
```

---

## Roteador universal do admin — admin-go.php

Todas as páginas, formulários e ações do painel admin passam por `admin-go.php`:

```
/admin-go.php?path=admin/posts           → GET  /admin/posts
/admin-go.php?path=admin/posts/create    → GET  /admin/posts/create
/admin-go.php?path=admin/posts/meu-slug  → PUT  /admin/posts/meu-slug  (com _method=PUT no body)
```

**Regra:** `path` = tudo depois de `/unidades/5bprv/`

---

## Rotas públicas (frontend)

| URL | Controller | View |
|-----|-----------|------|
| `/` | `Site\HomeController::index` | `public.home` |
| `/noticias.php` | `Site\PostController::noticias` | `public.noticias` |
| `/publicacoes` | `Site\PostController::index` | `public.posts.index` |
| `/publicacoes/{post:slug}` | `Site\PostController::show` | `public.posts.show` |
| `/galerias` | `Site\GalleryController::index` | `public.galleries.index` |
| `/galerias/{gallery:slug}` | `Site\GalleryController::show` | `public.galleries.show` |
| `/institucional/{page:slug}` | `Site\PageController::show` | `public.pages.show` |
| `/historico.php` | — (view direta) | `public.historico` |
| `/galerias.php` | — (view direta) | `public.galerias` (Galeria de Comandantes) |
| `/memorial.php` | — (view direta) | `public.memorial` |
| `/tor.php` | — (view direta) | `public.tor` |
| `/redes-sociais.php` | — (view direta) | `public.redes-sociais` |
| `/contato.php` | — (view direta) | `public.contato` |

---

## Rotas do admin

**Acesso:** `login.php` → `admin.php` → `admin-go.php?path=...`

### Autenticação

| Ação | URL pública | Observação |
|------|------------|------------|
| Exibir login | `/login.php` | GET |
| Processar login | `/login.php` | POST — form action: `url('login.php')` |
| Logout | `/logout` | POST — ainda usa URL limpa, funciona via JS |
| Após login | `/admin.php` | Definido em `AuthenticatedSessionController` |
| Sem sessão | `/login.php` | Definido em `bootstrap/app.php` via `redirectGuestsTo` |

### Módulos do admin

#### Notícias (posts — route key: `slug`)

| Ação | Path para admin-go.php |
|------|----------------------|
| Listar | `admin/posts` |
| Criar (form) | `admin/posts/create` |
| Salvar novo | `admin/posts` (POST) |
| Editar (form) | `admin/posts/{slug}/edit` |
| Salvar edição | `admin/posts/{slug}` (PUT via `_method`) |
| Excluir | `admin/posts/{slug}` (DELETE via `_method`) |

#### Banners (route key: `id`)

| Ação | Path para admin-go.php |
|------|----------------------|
| Listar | `admin/banners` |
| Criar | `admin/banners/create` |
| Salvar | `admin/banners` (POST) |
| Editar | `admin/banners/{id}/edit` |
| Atualizar | `admin/banners/{id}` (PUT) |
| Excluir | `admin/banners/{id}` (DELETE) |

> **Limite de upload:** servidor Nginx tem `client_max_body_size` baixo (~1MB).  
> Imagens de banner devem ser < 1MB até o servidor ser reconfigurado.

#### Páginas Institucionais (route key: `slug`)

Mesmo padrão de Notícias, substituindo `posts` por `pages`.

#### Galerias (route key: `slug`)

Mesmo padrão de Notícias, substituindo `posts` por `galleries`.  
Fotos dentro de uma galeria usam `id`: `admin/galleries/{slug}/photos/{id}` (DELETE).

#### Usuários (route key: `id`, middleware: `admin`)

Mesmo padrão de Banners, substituindo `banners` por `users`.

#### Configurações (middleware: `admin`)

| Ação | Path para admin-go.php |
|------|----------------------|
| Exibir | `admin/settings` (GET) |
| Salvar | `admin/settings` (POST) — sem `_method`, rota aceita GET e POST |

---

## Helpers globais (app/helpers.php)

Carregado via `AppServiceProvider::register()`.

```php
// Gera URL para navegação no admin
ag('posts')                    // → admin-go.php?path=admin%2Fposts
ag('posts/create')             // → admin-go.php?path=admin%2Fposts%2Fcreate
ag('posts/' . $post->slug . '/edit')

// Gera redirect de resposta de controller
admin_redirect('admin.posts.index', [], 'Salvo com sucesso.')
admin_redirect('admin.galleries.edit', $gallery, 'Galeria atualizada.')
```

---

## Banco de dados

**Host:** `mysql-svc.database.svc.cluster.local` (interno ao cluster — só acessível do servidor)  
**Banco:** `5bprv`  
**phpMyAdmin:** `https://www9.intranet.policiamilitar.sp.gov.br/phpmyadmin/`

### Tabelas e status

| Tabela | Migration | Status |
|--------|----------|--------|
| `users` | `0001_01_01_000000` | ✅ |
| `cache` / `cache_locks` | `0001_01_01_000001` | ✅ |
| `jobs` / `failed_jobs` / `job_batches` | `0001_01_01_000002` | ✅ |
| `pages` | `2026_04_06_100000` | ✅ |
| `posts` | `2026_04_06_100100` | ✅ |
| `banners` | `2026_04_06_100200` | ✅ |
| `galleries` | `2026_04_06_100300` | ✅ |
| `gallery_photos` | `2026_04_06_100400` | ✅ |
| `settings` | `2026_04_06_100500` | ✅ |
| `sessions` | inclusa em users | ✅ |

> Para rodar uma migration manualmente via phpMyAdmin, executar o SQL da migration  
> e inserir o registro em `migrations`: `INSERT INTO migrations (migration, batch) VALUES ('nome', MAX(batch))`

### Credenciais admin padrão

- **Email:** `admin@example.com`  
- **Senha:** `password`  
- **Role:** `admin`

---

## Como adicionar um novo módulo ao admin

1. Criar Model em `app/Models/`
2. Criar migration em `database/migrations/`
3. Criar Controller em `app/Http/Controllers/Admin/`
   - Usar `admin_redirect()` em todos os `return redirect()`
4. Criar views em `resources/views/admin/MODULO/`
   - Usar `ag('MODULO/...')` em todos os links e `action` de forms
5. Registrar rotas em `routes/web.php` dentro do grupo `auth`
6. Adicionar link no sidebar: `resources/views/layouts/admin.blade.php`
7. Rodar migration via phpMyAdmin (SQL + INSERT em `migrations`)

---

## Layout e design

- **Layout público:** `resources/views/layouts/apple.blade.php`
- **Layout admin:** `resources/views/layouts/admin.blade.php`
- **Tema público:** dark (preto/dourado), fontes Barlow Condensed + Source Sans 3
- **Tema admin:** Bootstrap/Tailwind misto, fundo claro
- **Assets:** `public/build/` (Vite compilado) + fallback manual no layout apple

---

*Última atualização: 2026-05-06*
