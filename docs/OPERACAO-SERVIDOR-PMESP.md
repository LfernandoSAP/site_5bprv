# Operação do Portal no Servidor PMESP

Atualizado em: 05/08/2026

## Ambiente oficial

- URL: `https://www9.intranet.policiamilitar.sp.gov.br/unidades/5bprv`
- Compartilhamento: `\\dados.intranet.policiamilitar.sp.gov.br\5bprv$`
- Banco: MySQL interno do ambiente PMESP
- Servidor web: Nginx/Kubernetes
- Document root: raiz do projeto, e não apenas `public/`
- Produção: `APP_ENV=production` e `APP_DEBUG=false`

Nunca publicar `.env`, senhas, dumps de banco ou credenciais no GitHub.

## Fonte de verdade e fluxo de atualização

O GitHub deve permanecer como histórico recuperável do código. Como ajustes pontuais são feitos diretamente no servidor, cada sessão de manutenção deve seguir esta ordem:

1. Registrar o estado inicial dos arquivos e do Git.
2. Fazer backup lógico de registros do MySQL que serão alterados.
3. Alterar somente os arquivos ou registros necessários.
4. Validar a URL pública, a imagem e a página de detalhes.
5. Copiar as mudanças do servidor para um clone Git disponível localmente.
6. Revisar o diff, criar commit e enviar ao GitHub.
7. Não deixar scripts de diagnóstico ou limpeza na raiz pública.

Se `.git` aparecer com os atributos `Offline`, `SparseFile` ou `ReparsePoint`, não executar commit diretamente no compartilhamento. Primeiro hidrate a pasta ou use um clone local e copie somente os arquivos revisados.

## Roteamento especial da intranet

O Nginx não encaminha URLs limpas para o Laravel. Por isso existem arquivos PHP físicos na raiz:

- `index.php`: página inicial e bootstrap do Laravel
- `noticias.php`: listagem de notícias
- `historico.php`, `memorial.php`, `tor.php`, `galerias.php`, `redes-sociais.php`, `contato.php` e `links-importantes.php`: páginas públicas
- `login.php`, `admin.php` e `admin-go.php`: autenticação e painel
- `publicacao.php`: detalhe de uma notícia por `?slug=...`

Exemplo de detalhe:

```text
publicacao.php?slug=ocorrencia-destaque-julho-2026
```

Links de notícias devem usar `publicacao.php`; não usar diretamente `/publicacoes/{slug}`, pois essa URL retorna 404 no Nginx atual.

## Notícias e destaques

As notícias são registros da tabela `posts`, não textos fixos da view. A página `noticias.php` exibe registros com:

- `status = published`
- `is_featured = true` para os dois destaques
- ordenação decrescente por `published_at`

Ao substituir uma notícia, atualizar em conjunto:

- título
- slug
- resumo (`excerpt`)
- conteúdo
- imagem
- data de publicação
- status e marcação de destaque

O formulário administrativo armazena uploads em `storage/app/public/posts`. A URL é produzida por `Storage::url()`. Não apontar manualmente `image_path` para `public/imagens`.

### Conteúdo vigente em agosto de 2026

- Ocorrência Destaque — Julho 2026
  - slug: `ocorrencia-destaque-julho-2026`
  - imagem original: `public/imagens/pm_mes_ocorrencias/Ocorrencia_Destaque_jul.jpeg`
- PM do Mês — Julho 2026: Cb PM Lindolm
  - slug: `pm-do-mes-julho-2026`
  - imagem original: `public/imagens/pm_mes_ocorrencias/Lindolm.jpeg`

Os arquivos originais permanecem em `public/imagens`; as cópias processadas pelo Laravel ficam em `storage/app/public/posts`. Ambas têm finalidades diferentes.

## Imagens de notícias

Fotos pequenas não devem ser ampliadas para ocupar o hero inteiro. Para os destaques de julho de 2026, a página de detalhes usa:

- tamanho natural e responsivo
- `height: auto`
- `object-fit: contain`
- centralização
- textos escuros sobre o fundo claro

Referência atual:

- ocorrência: 414 × 338 px
- Cb PM Lindolm: 460 × 586 px

## Galeria de comandantes

A página pública é `galerias.php` e a view é `resources/views/public/galerias.blade.php`.

O primeiro cartão deve usar a identificação `Comandante Atual` tanto no selo superior quanto no campo `rank` do array de comandantes.

Quando a foto do comandante atual estiver disponível:

1. Salvar em `public/imagens/comandantes/` com nome simples, sem acentos ou espaços.
2. Informar posto e nome completos.
3. Atualizar `slug`, `nome`, período e ajuste de escala no primeiro item do array `$comandantes`.
4. Validar enquadramento em desktop e celular.

## Cache Blade e propagação do compartilhamento

O compartilhamento pode demorar alguns segundos para propagar uma alteração ao processo PHP. Após editar uma view:

1. Atualizar o horário do arquivo-fonte.
2. Aguardar a propagação.
3. Reabrir a página com cache-buster ou `Ctrl + F5`.
4. Se necessário, executar `php artisan view:clear` no ambiente real do servidor.

Nunca criar ou manter scripts públicos de limpeza de cache. `clear-cache.php`, `ping.php` e utilitários temporários não devem permanecer na raiz.

## Imagens estáticas e uploads

- Assets estáticos versionáveis: `public/imagens/`
- Uploads administrativos: `storage/app/public/`
- URL de uploads: variável `STORAGE_URL`
- A pasta `imagens/` da raiz ainda é usada por partes legadas; não excluir sem auditoria de referências.

Antes de apagar fotos, cruzar os caminhos presentes em `posts`, `banners`, `galleries` e `gallery_photos` com os arquivos físicos.

## Validação mínima após cada ajuste

- URL alterada responde HTTP 200
- título antigo não permanece na página
- imagem responde HTTP 200
- página de detalhe abre pelo shim correto
- conteúdo completo é exibido
- login e painel continuam disponíveis
- nenhuma credencial ou script de diagnóstico foi exposto

## Marco de sincronização de 05/08/2026

Este marco registra no GitHub as mudanças que foram aplicadas e validadas diretamente no servidor:

- exclusão de `clear-cache.php`
- `config/filesystems.php` com suporte a `STORAGE_URL`
- `resources/views/public/noticias.blade.php`
- `resources/views/public/posts/show.blade.php`
- `resources/views/public/galerias.blade.php`
- novo `publicacao.php`
- novas imagens em `public/imagens/pm_mes_ocorrencias/`
- esta documentação operacional

Uploads em `storage/app/public`, backups locais e arquivos de `.env` não devem entrar no commit.
