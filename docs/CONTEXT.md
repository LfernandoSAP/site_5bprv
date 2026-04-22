# CONTEXT.md — Estado Atual do Projeto
> Atualizar este arquivo ao final de cada sessão de desenvolvimento.
> A IA lê isso para saber exatamente onde o projeto está — não onde deveria estar.

---

## Status Geral

| Área | Status |
|------|--------|
| Estrutura base Laravel | ✅ Concluída |
| Autenticação (Breeze) | ✅ Funcional |
| Layouts público e admin | ✅ Implementados |
| Migrations principais | ✅ Aplicadas |
| Models e relacionamentos | ✅ Criados |
| Rotas iniciais | ✅ Definidas |
| CRUDs administrativos | ✅ Funcionais |
| Portal público | ✅ Funcional |
| Componentes Blade | ✅ Implementados |
| Build de assets (Vite) | ✅ Funcionando |
| Views admin (Tailwind) | ✅ Migradas (13/04/2026) |

---

## Dívidas Técnicas Abertas

### 🔴 Alta Prioridade — Resolver antes do próximo deploy

#### 1. Views admin e públicas com classes Bootstrap residuais
**Status**: ✅ CONCLUÍDO (13/04/2026) - Todas as views (admin e portal público) migradas para Tailwind CSS e Vanilla JS.

Arquivos migrados:
- `admin/admin.blade.php`
- `admin/partials/status-alert.blade.php`
- `admin/dashboard.blade.php`
- `admin/posts/*` (4 arquivos)
- `admin/banners/*` (4 arquivos)
- `admin/pages/*` (4 arquivos)
- `admin/galleries/*` (4 arquivos)
- `admin/users/*` (4 arquivos)
- `admin/settings/edit.blade.php`

---

#### 2. Tabela de sessões (`sessions`)
**Problema**: `SESSION_DRIVER=database` exige que a tabela `sessions` exista no banco. Se a migration correspondente não foi aplicada, a aplicação quebra em produção com erro de tabela inexistente.

**O que fazer**:
```bash
# Verificar se a migration existe
php artisan migrate:status

# Se não existir, criar
php artisan session:table
php artisan migrate
```

---

### 🟡 Média Prioridade

#### 3. ASSET_URL em produção
**Problema**: O portal roda em subpasta `/unidades/5bprv`. O `ASSET_URL` precisa estar configurado corretamente no `.env` de produção para que o Vite gere os caminhos corretos.

**Configuração necessária no `.env` de produção**:
```env
APP_URL=https://www9.intranet.policiamilitar.sp.gov.br/unidades/5bprv
ASSET_URL=/unidades/5bprv
```

**Verificar**: Após deploy, inspecionar se os assets (CSS, JS) estão carregando com os caminhos corretos.

---

#### 4. Validação de uploads de imagens
**Problema**: Validação de uploads pode estar incompleta em alguns módulos.

**Padrão a garantir** em todos os Form Requests que aceitam imagem:
```php
'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:1024'],
```

---

#### 5. Testes automatizados ausentes
**Problema**: Não há testes unitários ou de feature implementados.

**O que fazer**: Implementar ao menos testes de feature para os fluxos críticos:
- Login/logout
- CRUD de posts
- Acesso negado a rotas admin sem autenticação

---

### 🟢 Baixa Prioridade

- [ ] Otimização de imagens (intervention/image)
- [ ] Sitemap.xml
- [ ] SEO meta tags dinâmicas
- [ ] Analytics
- [ ] Redis quando disponível no CPD (trocar `SESSION_DRIVER` e `CACHE_STORE`)

---

## Ambiente de Deploy

### Situação atual
- Desenvolvimento: local (Windows, PowerShell)
- Produção alvo: CPD PMESP (Apache + PHP 8.3 + MySQL)
- Build de assets: feito localmente antes do deploy

### Duas estratégias de deploy documentadas

**Estratégia A (preferencial)**: Apache aponta `DocumentRoot` para `Site5Rv/public/`

**Estratégia B (contingência CPD)**: Se não houver controle do `DocumentRoot`:
- Projeto Laravel completo em pasta interna (ex: `D:\portais\site5bprv-app\`)
- Apenas `public/` copiado para a pasta compartilhada SMB
- `index.php` ajustado para apontar para a app interna
- Detalhes em `docs/publicacao-smb.md`

---

## Checklist Pré-Deploy

```bash
# 1. Garantir que não há código de debug
grep -r "dd(" resources/ app/
grep -r "dump(" resources/ app/

# 2. Build de assets
npm run build

# 3. Dependências de produção
composer install --no-dev --optimize-autoloader

# 4. No servidor
php artisan key:generate        # apenas primeira vez
php artisan migrate --force
php artisan db:seed --force     # apenas primeira vez
php artisan storage:link
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

---

## Histórico de Decisões Recentes

| Data | Decisão | Motivo |
|------|---------|--------|
| 13/04/2026 | Bootstrap removido | Conflito de classes com Tailwind CSS |
| 13/04/2026 | Timezone → `America/Sao_Paulo` | Ajuste para ambiente brasileiro |
| 13/04/2026 | `SESSION_DRIVER=database` | Redis indisponível no CPD PMESP |
| 13/04/2026 | Documentação sincronizada | `docs/` e `.opencode/skills/` unificados |
| 13/04/2026 | CSS home.blade.php corrigido | Sintaxe faltando `;` na linha 174 |
| 13/04/2026 | Fonte título PMESP +40% | Ajuste visual solicitado |
| 13/04/2026 | Fonte título 5º BPRv +30% | Ajuste visual solicitado |
| 13/04/2026 | Views admin migradas | 27 arquivos Bootstrap → Tailwind |
| 13/04/2026 | Portal Público migrado | Erradicação total do Bootstrap (Home + Layout) |
| 13/04/2026 | Rodovia Canvas Animada | Implementação de animação 2D institucional |

---

## Como Atualizar Este Arquivo

Ao final de cada sessão de desenvolvimento, atualizar:

1. **Status Geral** — marcar o que foi concluído
2. **Dívidas Técnicas** — remover o que foi resolvido, adicionar o que surgiu
3. **Histórico de Decisões** — registrar toda decisão estrutural com data e motivo

> Um contexto desatualizado é pior que nenhum contexto.
> Mantenha este arquivo como se sua própria memória dependesse dele — porque a da IA depende.

---

## Notas para a IA

- Sempre leia `PROJECT.md` → `PATTERNS.md` → `CONTEXT.md` nesta ordem
- Se receber uma tarefa que contradiz qualquer padrão destes arquivos, **questione antes de executar**
- Se identificar algo neste `CONTEXT.md` desatualizado, avise o desenvolvedor
- Nunca assuma que o que não está documentado foi implementado — pergunte
