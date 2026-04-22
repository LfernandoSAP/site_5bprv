# PROJECT.md — Portal Institucional 5º BPRv
> Leia este arquivo no início de TODA sessão de desenvolvimento. Sem exceção.

---

## Identidade do Projeto

| Item | Valor |
|------|-------|
| Nome | Portal Institucional 5º BPRv |
| Tipo | Monólito Laravel — server-side rendering com Blade |
| Repositório local | `C:/Users/Telematica/Documents/erp5bprv/Site5Rv` |
| URL produção | `https://www9.intranet.policiamilitar.sp.gov.br/unidades/5bprv` |
| URL admin prod | `.../unidades/5bprv/admin` |
| Ambiente alvo | Apache + PHP 8.3+ + MySQL (CPD PMESP) |

---

## Stack Tecnológica — Versões Exatas

| Tecnologia | Versão | Papel |
|------------|--------|-------|
| Laravel | 13.x | Framework principal |
| PHP | 8.3+ | Runtime |
| Tailwind CSS | 3.4.x | Framework CSS — **ÚNICO** |
| Vite | 8.x | Bundler |
| Alpine.js | 3.4.x | JS interativo mínimo |
| MySQL | - | Banco de dados |
| Laravel Breeze | - | Autenticação (Blade) |
| Bootstrap | ❌ **REMOVIDO** | Conflitava com Tailwind |

> ⚠️ **CRÍTICO**: Bootstrap foi removido definitivamente. Nunca sugerir, importar ou usar classes Bootstrap (`btn`, `btn-primary`, `col-md-*`, `row`, etc.). O único framework CSS é Tailwind.

---

## Estrutura de Diretórios

```
Site5Rv/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # CRUDs administrativos — um controller por módulo
│   │   │   ├── Auth/           # Gerado pelo Breeze — não editar sem necessidade
│   │   │   ├── Site/           # Páginas públicas
│   │   │   └── Controller.php  # Base
│   │   ├── Middleware/
│   │   │   └── [admin]         # Middleware custom: verifica se usuário é admin
│   │   └── Requests/
│   │       └── Admin/          # Form Requests de validação — um por operação
│   ├── Models/                 # Banner, Gallery, GalleryPhoto, Page, Post, Setting, User
│   └── Providers/
├── resources/
│   ├── css/
│   │   └── app.css             # Variáveis CSS do projeto + imports Tailwind
│   ├── js/
│   │   └── app.js              # Alpine.js e scripts mínimos
│   └── views/
│       ├── admin/              # Views do painel administrativo
│       ├── auth/               # Login, reset de senha (Breeze)
│       ├── components/         # Componentes Blade reutilizáveis
│       ├── layouts/            # Layouts base: público e admin
│       └── public/             # Views da área pública
├── routes/
│   ├── web.php                 # Rotas públicas + admin
│   └── auth.php                # Rotas de autenticação (Breeze)
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   └── build/                  # Assets compilados pelo Vite
├── storage/
│   └── app/public/             # Uploads: banners/, posts/, galleries/, pages/
└── docs/                       # Documentação do projeto
```

---

## Módulos Existentes

| Módulo | Model | Tabela | Status |
|--------|-------|--------|--------|
| Usuários | `User` | `users` | ✅ Funcional |
| Publicações | `Post` | `posts` | ✅ Funcional |
| Páginas | `Page` | `pages` | ✅ Funcional |
| Banners | `Banner` | `banners` | ✅ Funcional |
| Galerias | `Gallery` | `galleries` | ✅ Funcional |
| Fotos | `GalleryPhoto` | `gallery_photos` | ✅ Funcional |
| Configurações | `Setting` | `settings` | ✅ Funcional |

---

## Rotas Públicas

| URL | Controller | Descrição |
|-----|------------|-----------|
| `/` | `Site\HomeController` | Home institucional |
| `/publicacoes` | `Site\PostController` | Lista de publicações |
| `/publicacoes/{slug}` | `Site\PostController` | Detalhe da publicação |
| `/institucional/{slug}` | `Site\PageController` | Páginas institucionais |
| `/galerias` | `Site\GalleryController` | Lista de galerias |
| `/galerias/{slug}` | `Site\GalleryController` | Detalhe da galeria |
| `/login` | Auth (Breeze) | Autenticação |

## Rotas Administrativas

| URL | Controller | Descrição |
|-----|------------|-----------|
| `/admin` | `Admin\DashboardController` | Dashboard |
| `/admin/posts` | `Admin\PostController` | CRUD publicações |
| `/admin/pages` | `Admin\PageController` | CRUD páginas |
| `/admin/banners` | `Admin\BannerController` | CRUD banners |
| `/admin/galleries` | `Admin\GalleryController` | CRUD galerias |
| `/admin/settings` | `Admin\SettingController` | Configurações |
| `/admin/users` | `Admin\UserController` | Usuários |

---

## Variáveis de Ambiente — Produção

```env
APP_NAME="Portal 5º BPRv"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://www9.intranet.policiamilitar.sp.gov.br/unidades/5bprv
ASSET_URL=/unidades/5bprv

APP_LOCALE=pt_BR
APP_TIMEZONE=America/Sao_Paulo

DB_CONNECTION=mysql
DB_HOST=mysql-svc.database.svc.cluster.local
DB_PORT=3306
DB_DATABASE=5bprv
DB_USERNAME=dba.5bprv

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
MAIL_MAILER=log
```

> ⚠️ Redis não está disponível no CPD PMESP. Manter `database` como driver de session e cache.

---

## Decisões Arquiteturais Importantes

### Por que monólito Blade e não SPA?
Simplicidade operacional no ambiente institucional. Equipes futuras sem expertise em React/Vue conseguem manter. Apache institucional não impõe restrições ao SSR.

### Por que Tailwind e não Bootstrap?
Bootstrap foi instalado inicialmente mas causou conflito de classes com Tailwind. Foi removido. Tailwind foi mantido por ser utility-first e não conflitar com customizações institucionais.

### Por que Breeze e não Jetstream?
Breeze gera código simples e editável. Jetstream adiciona complexidade desnecessária (times, API tokens) que este portal não usa.

### Por que `SESSION_DRIVER=database`?
Redis não disponível no CPD PMESP. A tabela `sessions` deve existir no banco — verificar se migration foi aplicada.

### Deploy com subpasta `/unidades/5bprv`
O portal não fica na raiz do domínio. O `ASSET_URL` deve ser configurado corretamente para que Vite gere caminhos corretos para os assets em produção.

---

## Comandos do Projeto

```bash
# Desenvolvimento local
composer dev          # Inicia servidor + Vite simultaneamente

# Build
npm run build         # Compila assets para produção

# Deploy
composer deploy       # Sequência completa de deploy

# Cache
php artisan optimize:clear    # Limpa todo cache
php artisan config:cache      # Recria cache de config
php artisan route:cache       # Recria cache de rotas
php artisan view:cache        # Recria cache de views

# Banco
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link
```

---

## Recursos Externos Utilizados

- **Google Fonts**: Barlow Condensed, Source Sans 3
- **Ícones**: Heroicons (SVG inline — sem dependência npm)
- **Logo**: `/public/imagens/logo-5bprv.png`

---

## Isolamento do Projeto

Este portal está isolado em `Site5Rv/` para não conflitar com o ERP existente na raiz do repositório `erp5bprv`. Todo desenvolvimento do portal deve ficar **dentro** de `Site5Rv/`.
