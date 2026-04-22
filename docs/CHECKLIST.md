# Checklist de Publicação - Portal 5º BPRv

Verifique tudo antes de publicar mudanças em produção.

---

## 1. Código

- [ ] Código revisado (nenhuma linha esquecida)
- [ ] Sem `dd()`, `console.log()` ou `dump()` deixados
- [ ] Sem dados sensíveis expostos (senhas, tokens)
- [ ] Comentários necessários添加
- [ ] Indentação consistente

## 2. Funcionalidade

- [ ] Testei localmente todas as funcionalidades alteradas
- [ ] Formulários validam entrada corretamente
- [ ] Mensagens de erro aparecem quando necessário
- [ ] Upload de imagens funciona
- [ ] Links internos estão funcionando
- [ ] Responsivo em mobile (testar no navegador)

## 3. Segurança

- [ ] Todos os formulários têm CSRF token
- [ ] Rotas admin têm middleware `auth`
- [ ] Rotas sensitiveis têm middleware `admin`
- [ ] Validação server-side (não confiar no JS)
- [ ] Sanitização de entrada (evitar XSS)

## 4. Banco de Dados

- [ ] Migration criada se houver mudança de estrutura
- [ ] Seeders atualizados se necessário
- [ ] Dados de produção não afetados
- [ ] Backup realizado antes de migration

## 5. Assets

- [ ] `npm run build` executado
- [ ] Imagens otimizadas (máximo 1MB cada)
- [ ] Fontes carregando corretamente
- [ ] Ícones aparecendo

## 6. Performance

- [ ] Assets minificados (build production)
- [ ] Imagens comprimidas
- [ ] Lazy loading em imagens grandes
- [ ] Cache configurado

## 7. SEO e Acessibilidade

- [ ] Title tags únicos em cada página
- [ ] Meta descriptions adicionadas
- [ ] Imagens têm alt text
- [ ] Contraste de cores adequado
- [ ] Navegação por teclado funciona

## 8. Logs e Monitoramento

- [ ] `APP_DEBUG=false` em produção
- [ ] Logs de erro configurados
- [ ] Alertas de erro ativos

## 9. Deploy

- [ ] Backup do ambiente atual
- [ ] Plano de rollback definido
- [ ] Janela de manutenção comunicada (se aplicável)
- [ ] Teste pós-deploy realizado

## 10. Pós-Publicação

- [ ] Verificar homepage carrega
- [ ] Testar fluxo crítico (login, publicação)
- [ ] Verificar mobile
- [ ] Monitorar erros por 30 minutos

---

## Comandos Rápidos de Deploy

```bash
# Pré-deploy
composer dump-autoload
npm run build

# Deploy
git pull origin main
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Pós-deploy
php artisan optimize
```

---

*Checklist adaptado para Laravel 13*
*Última atualização: 13/04/2026*
