# Como Fazer - Portal 5º BPRv

Guias práticos para tarefas comuns do dia a dia.

---

## Índice

1. [Criar nova página institucional](#1-criar-nova-página-institucional)
2. [Publicar uma notícia](#2-publicar-uma-notícia)
3. [Adicionar foto na galeria](#3-adicionar-foto-na-galeria)
4. [Alterar cor ou estilo](#4-alterar-cor-ou-estilo)
5. [Criar banner na home](#5-criar-banner-na-home)
6. [Deploy para produção](#6-deploy-para-produção)
7. [Limpar cache](#7-limpar-cache)
8. [Adicionar novo usuário admin](#8-adicionar-novo-usuário-admin)

---

## 1. Criar nova página institucional

### Passo a passo:

1. **Acesse o admin:** `/admin/pages`
2. Clique em **"+ Nova Página"**
3. Preencha:
   - **Título:** O nome da página (ex: "Histórico do 5º BPRv")
   - **Slug:** URL amigável (ex: `historico`) → URL: `/institucional/historico`
   - **Conteúdo:** Use o editor para escrever o texto
4. Clique em **Publicar**

### Se precisar criar via código:

```php
// Em resources/views/public/pages/
// Criar arquivo: historico.blade.php

@extends('layouts.apple')

@section('title', 'Histórico | 5º BPRv')

@section('content')
    <div class="container py-5">
        <h1>Histórico do 5º BPRv</h1>
        <p>Conteúdo aqui...</p>
    </div>
@endsection
```

---

## 2. Publicar uma notícia

1. **Acesse:** `/admin/posts`
2. Clique em **"+ Novo Post"**
3. Preencha:
   - **Título:** Título da notícia
   - **Slug:** URL única (ex: `operacao-natal-2026`)
   - **Conteúdo:** Texto completo da notícia
   - **Imagem:** Capa da notícia
   - **Publicado:** Toggle para ativar
4. Salvar

---

## 3. Adicionar foto na galeria

1. **Acesse:** `/admin/galleries`
2. Selecione uma galeria existente ou crie nova
3. Clique em **"Adicionar Fotos"**
4. Selecione múltiplas imagens
5. As fotos aparecem na galeria pública em `/galerias/nome-da-galeria`

---

## 4. Alterar cor ou estilo

### Cores principais do site:

**Arquivo:** `resources/css/app.css`

```css
:root {
    --bprv-black: #101010;    /* Cor principal */
    --bprv-gold: #d5aa32;     /* Cor destaque/dourado */
    --bprv-gold-soft: #f2df9c;
    --bprv-text: #202020;
    --bprv-muted: #6e6e6e;
}
```

Para mudar uma cor, edite o valor hex.

### Classes Tailwind úteis:

| Efeito | Classe |
|--------|--------|
| Fundo preto | `bg-black` |
| Fundo dourado | `bg-[#d5aa32]` |
| Texto branco | `text-white` |
| Texto dourado | `text-[#d5aa32]` |
| Borda dourada | `border-[#d5aa32]` |

---

## 5. Criar banner na home

1. **Acesse:** `/admin/banners`
2. Clique em **"+ Novo Banner"**
3. Preencha:
   - **Título:** Nome interno
   - **Imagem:** Upload da imagem (sugestão: 1920x600px)
   - **Link:** URL de destino (opcional)
   - **Ordem:** Posição na rotação
4. Ative o toggle **"Ativo"**

---

## 6. Deploy para produção

### No servidor (via SSH):

```bash
cd /var/www/html/unidades/5bprv

# Baixar/atualizar código (git pull ou upload)

# Instalar dependências
composer install --no-dev --optimize-autoloader

# Rodar migrations
php artisan migrate --force

# Limpar e recriar cache
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Rebuild assets
npm install
npm run build
```

### Usando o script do composer:

```bash
composer deploy
```

---

## 7. Limpar cache

```bash
# Limpar tudo
php artisan optimize:clear

# Específicos
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## 8. Adicionar novo usuário admin

1. **Acesse:** `/admin/users`
2. Clique em **"+ Novo Usuário"**
3. Preencha:
   - **Nome:** Nome completo
   - **Email:** Email institucional
   - **Senha:** Mínimo 8 caracteres
   - **Tipo:** Selecione "Administrador" para dar acesso total

---

## Dúvidas Frequentes

### "O site não atualiza após mudança"

```bash
php artisan optimize:clear
npm run build
```

### "Erro 500 após deploy"

1. Verificar logs: `storage/logs/laravel.log`
2. Limpar cache: `php artisan optimize:clear`
3. Verificar conexão com banco

### "Imagens não aparecem"

1. Verificar `storage/app/public/` via SSH
2. Rodar: `php artisan storage:link`

---

*Última atualização: 13/04/2026*
