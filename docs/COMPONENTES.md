# Componentes Blade - Portal 5º BPRv

Componentes reutilizáveis para padronizar o desenvolvimento.

---

## Índice de Componentes

| Componente | Arquivo | Descrição |
|------------|---------|-----------|
| Button | `button.blade.php` | Botões padronizados |
| Alert | `alert.blade.php` | Mensagens de feedback |
| Card Post | `card-post.blade.php` | Cards de notícias/publicações |
| Input | `input.blade.php` | Campos de formulário |
| Textarea | `textarea.blade.php` | Campos de texto longo |

---

## Como Usar

Todos os componentes estão disponíveis automaticamente no diretório `resources/views/components/`.

### 1. Button (x-button)

```html
<!-- Botão primário -->
<x-button>Salvar</x-button>

<!-- Botão outline (borda) -->
<x-button variant="outline">Cancelar</x-button>

<!-- Botão pequeno -->
<x-button size="sm">Pequeno</x-button>

<!-- Como link -->
<x-button href="/pagina">Ver mais</x-button>

<!-- Submit -->
<x-button type="submit">Enviar</x-button>
```

**Variantes:** `primary`, `outline`, `ghost`, `danger`  
**Tamanhos:** `sm`, `md`, `lg`

---

### 2. Alert (x-alert)

```html
<x-alert type="success">Operação realizada com sucesso!</x-alert>
<x-alert type="error">Ocorreu um erro.</x-alert>
<x-alert type="warning">Atenção!</x-alert>
<x-alert type="info">Informação útil.</x-alert>
```

**Tipos:** `success`, `error`, `warning`, `info`

---

### 3. Card Post (x-card-post)

```html
<x-card-post
    title="Nova Operação no Carnaval"
    excerpt="O 5º BPRv realizou operações..."
    image="/imagens/operacao.jpg"
    date="13/04/2026"
    category="Operações"
    href="/publicacoes/nova-operacao"
/>
```

---

### 4. Input (x-input)

```html
<x-input
    name="titulo"
    label="Título da Notícia"
    placeholder="Digite o título..."
    required
/>

<x-input
    name="email"
    type="email"
    label="Email"
    :error="$errors->first('email')"
/>
```

**Atributos:** name, label, type, value, placeholder, required, error, help

---

### 5. Textarea (x-textarea)

```html
<x-textarea
    name="conteudo"
    label="Conteúdo"
    rows="6"
    placeholder="Escreva o conteúdo aqui..."
    required
/>
```

---

## Criando Novos Componentes

1. Crie o arquivo em `resources/views/components/`
2. Use extensão `.blade.php`
3. Documente os props com `@props`
4. Use `@if`, `@foreach`, `@php` quando necessário

### Exemplo básico:

```html
{{-- resources/views/components/badge.blade.php --}}

@props(['color' => 'gray', 'text' => ''])

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $color }}-100 text-{{ $color }}-800">
    {{ $text }}
</span>
```

Uso: `<x-badge color="yellow" text="Novo" />`

---

## Boas Práticas

1. **Props com tipos definidos** - Sempre defina tipos e valores padrão
2. **Documentação inline** - Adicione comentários explicando uso
3. **Classes utilitárias** - Use Tailwind para estilização
4. **Fallbacks** - Sempre tenha valor padrão para props

---

*Última atualização: 13/04/2026*
