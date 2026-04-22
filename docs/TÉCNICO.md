# Documentação Técnica - Portal 5º BPRv

> Última atualização: 13/04/2026

## Estrutura do Projeto

```
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/        # CRUDs administrativos
│   │   │   ├── Auth/         # Autenticação (Breeze)
│   │   │   ├── Site/         # Páginas públicas
│   │   │   └── Controller.php
│   │   ├── Middleware/
│   │   └── Requests/
│   ├── Models/               # Banner, Gallery, GalleryPhoto, Page, Post, Setting, User
│   └── Providers/
├── resources/views/
│   ├── admin/                # Views do painel admin
│   ├── auth/                 # Login, password reset
│   ├── components/           # Blade components
│   ├── layouts/             # Layouts principais
│   └── public/               # Views públicas
├── routes/
│   ├── web.php              # Rotas públicas + admin
│   └── auth.php             # Rotas de autenticação
├── database/
│   ├── migrations/          # Estrutura do banco
│   └── seeders/             # Dados iniciais
└── config/                  # Configurações Laravel
```

## Rotas Principais

| URL | Descrição |
|-----|-----------|
| `/` | Página inicial |
| `/publicacoes` | Lista de publicações |
| `/publicacoes/{slug}` | Detalhe da publicação |
| `/institucional/{slug}` | Páginas institucionais |
| `/galerias` | Lista de galerias |
| `/galerias/{slug}` | Detalhe da galeria |
| `/admin` | Painel administrativo |
| `/login` | Autenticação |

## Comandos de Desenvolvimento

```bash
# Instalar dependências
composer install
npm install

# Desenvolvimento (inicia server + Vite)
composer dev

# Build produção
npm run build

# Deploy
composer deploy

# Limpar cache
php artisan optimize:clear

# Regenerar assets
php artisan view:clear
npm run build
```

## Configuração de Produção (.env)

```env
APP_NAME="Portal 5º BPRv"
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:xxxxxx
APP_URL=https://www9.intranet.policiamilitar.sp.gov.br/unidades/5bprv
ASSET_URL=/unidades/5bprv

APP_LOCALE=pt_BR
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=pt_BR

DB_CONNECTION=mysql
DB_HOST=mysql-svc.database.svc.cluster.local
DB_PORT=3306
DB_DATABASE=5bprv
DB_USERNAME=dba.5bprv
DB_PASSWORD=xxxxx

SESSION_DRIVER=database
SESSION_LIFETIME=120

CACHE_STORE=database

QUEUE_CONNECTION=database
MAIL_MAILER=log
```

## Alterações Recentes (13/04/2026)

### Alterações Realizadas

1. **Remoção do Bootstrap** - Conflitava com Tailwind CSS
2. **Tailwind CSS v3.4** - Mantido como framework CSS principal
3. **Timezone** - Alterado para `America/Sao_Paulo`

### Arquivos Modificados

| Arquivo | Alteração |
|---------|-----------|
| `package.json` | Bootstrap removido |
| `resources/css/app.css` | Import Bootstrap removido |
| `config/app.php` | timezone → America/Sao_Paulo |

## Pendências e Melhorias

### 🔴 Alta Prioridade

- [ ] Migrar classes Bootstrap para Tailwind nas views administrativas
- [ ] Verificar/criar tabela de migrations de sessão (`sessions`)

### 🟡 Média Prioridade

- [ ] Configurar Asset URL corretamente em produção (`/unidades/5bprv`)
- [ ] Adicionar validação de uploads de imagens
- [ ] Implementar cache com Redis quando disponível
- [ ] Adicionar testes unitários

### 🟢 Baixa Prioridade

- [ ] Otimizar imagens com intervenção/image
- [ ] Adicionar sitemap.xml
- [ ] Configurar SEO meta tags
- [ ] Adicionar analytics

## Problemas Conhecidos

### 1. Bootstrap vs Tailwind

**Problema**: Classes Bootstrap foram removidas do CSS. Views administrativas podem ter botões desalinhados.

**Solução**: Migrar classes como `btn btn-primary` para equivalentes Tailwind:
```html
<!-- Antes (Bootstrap) -->
<button class="btn btn-primary">Salvar</button>

<!-- Depois (Tailwind) -->
<button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Salvar</button>
```

### 2. Redis não disponível

**Problema**: SESSION_DRIVER e CACHE_STORE estão como `database`.

**Solução futura**: Quando Redis estiver disponível no servidor:
```env
SESSION_DRIVER=redis
CACHE_STORE=redis
REDIS_CLIENT=predis
```

E adicionar ao composer.json:
```json
"predis/predis": "^2.0"
```

## Recursos Externos

- **Google Fonts**: Barlow Condensed, Source Sans 3
- **Ícones**: Heroicons (via SVG inline)
- **Logo**: `/public/imagens/logo-5bprv.png`

## Models

| Model | Tabela | Descrição |
|-------|--------|-----------|
| User | users | Usuários admin |
| Post | posts | Publicações/notícias |
| Page | pages | Páginas institucionais |
| Banner | banners | Banners da home |
| Gallery | galleries | Galerias de fotos |
| GalleryPhoto | gallery_photos | Fotos das galerias |
| Setting | settings | Configurações do portal |

## Middleware Personalizados

- `admin` - Verifica se usuário é administrador
- Breeze default: `auth`, `verified`, `throttle`

---

*Para dúvidas, consultar documentação em docs/*