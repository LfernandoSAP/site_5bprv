# PATTERNS.md — Padrões Inegociáveis do Projeto
> Estas regras não são sugestões. São o contrato de qualidade do projeto.
> Um dev sênior não pergunta se deve seguir — simplesmente segue.

---

## 1. Nomenclatura

| Contexto | Convenção | Exemplo |
|----------|-----------|---------|
| Classes PHP | StudlyCase | `PostController`, `GalleryPhoto` |
| Métodos e variáveis | camelCase | `getPublishedPosts()`, `$imageUrl` |
| Tabelas do banco | plural + snake_case | `gallery_photos`, `posts` |
| Colunas do banco | snake_case | `created_by`, `published_at` |
| Arquivos Blade | kebab-case | `card-post.blade.php` |
| Rotas públicas | prefixo `public.` | `public.posts.show` |
| Rotas admin | prefixo `admin.` | `admin.posts.index` |
| Slugs | kebab-case único | `historico-do-batalhao` |

---

## 2. Controllers

### Regra principal: controllers curtos
Controllers **não contêm lógica de negócio**. Apenas orquestram: receber request → validar → chamar model → retornar view/redirect.

### Estrutura de namespaces

```php
// Área pública
namespace App\Http\Controllers\Site;

// Área administrativa
namespace App\Http\Controllers\Admin;
```

### Padrão de um controller administrativo completo

```php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePostRequest;
use App\Http\Requests\Admin\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::latest()->paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    public function create(): View
    {
        return view('admin.posts.create');
    }

    public function store(StorePostRequest $request): RedirectResponse
    {
        Post::create($request->validated());
        return redirect()->route('admin.posts.index')
            ->with('success', 'Publicação criada com sucesso.');
    }

    public function edit(Post $post): View
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $post->update($request->validated());
        return redirect()->route('admin.posts.index')
            ->with('success', 'Publicação atualizada com sucesso.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
        return redirect()->route('admin.posts.index')
            ->with('success', 'Publicação removida.');
    }
}
```

> ✅ Sem lógica de negócio no controller
> ✅ Type hints em todos os métodos
> ✅ Redirect com mensagem flash após mutações
> ✅ Route model binding sempre que possível

---

## 3. Form Requests

Toda validação fica em Form Requests. **Nunca validar diretamente no controller.**

```
app/Http/Requests/Admin/StorePostRequest.php
app/Http/Requests/Admin/UpdatePostRequest.php
```

### Padrão de Form Request

```php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Autorização já feita pelo middleware
    }

    public function rules(): array
    {
        return [
            'title'        => ['required', 'string', 'max:255'],
            'slug'         => ['required', 'string', 'max:255', 'unique:posts,slug'],
            'content'      => ['required', 'string'],
            'image'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:1024'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['boolean'],
        ];
    }
}
```

> ✅ `authorize()` retorna `true` — autorização é responsabilidade do middleware
> ✅ Regras como arrays, não strings concatenadas
> ✅ Uploads validados com `mimes` e `max` explícitos

---

## 4. Models

### Padrão de Model

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'is_published',
        'published_at',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }
}
```

### Regras de SoftDeletes
Usar `SoftDeletes` **apenas** em: `Post`, `Page`, `Gallery`, `Banner`.
**Não usar** em: `Setting`, `GalleryPhoto` (sem valor administrativo em recuperação).

### Campos padrão em módulos editoriais
Sempre incluir `created_by` e `updated_by` (int, foreign key para `users.id`).

---

## 5. Migrations

### Padrão de migration

```php
public function up(): void
{
    Schema::create('posts', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('slug')->unique();
        $table->longText('content');
        $table->string('image')->nullable();
        $table->boolean('is_published')->default(false);
        $table->timestamp('published_at')->nullable();
        $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
        $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
        $table->timestamps();
        $table->softDeletes();
    });
}
```

> ✅ `foreignId()->constrained()` para chaves estrangeiras
> ✅ `slug` sempre `unique()`
> ✅ `nullable()` em campos opcionais
> ✅ `timestamps()` sempre presente

---

## 6. Rotas

```php
// routes/web.php

// Área pública
Route::prefix('/')->name('public.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/publicacoes', [PostController::class, 'index'])->name('posts.index');
    Route::get('/publicacoes/{post:slug}', [PostController::class, 'show'])->name('posts.show');
    Route::get('/institucional/{page:slug}', [PageController::class, 'show'])->name('pages.show');
    Route::get('/galerias', [GalleryController::class, 'index'])->name('galleries.index');
    Route::get('/galerias/{gallery:slug}', [GalleryController::class, 'show'])->name('galleries.show');
});

// Área administrativa
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('posts', PostController::class);
    Route::resource('pages', PageController::class);
    Route::resource('banners', BannerController::class);
    Route::resource('galleries', GalleryController::class);
    Route::resource('users', UserController::class);
    Route::resource('settings', SettingController::class)->only(['index', 'update']);
});
```

> ✅ `Route::resource()` para CRUDs completos
> ✅ Route model binding com campo explícito: `{post:slug}`
> ✅ Middleware `auth` + `admin` em todo o grupo admin
> ✅ Nomes consistentes com prefixos `public.` e `admin.`

---

## 7. Views Blade

### Estrutura de layouts

```
layouts/
├── app.blade.php       # Layout público
└── admin.blade.php     # Layout administrativo
```

### Padrão de view pública

```blade
@extends('layouts.app')

@section('title', $post->title . ' | Portal 5º BPRv')

@section('content')
    <div class="container mx-auto px-4 py-8">
        {{-- conteúdo --}}
    </div>
@endsection
```

### Padrão de view administrativa

```blade
@extends('layouts.admin')

@section('title', 'Publicações')

@section('content')
    <div class="p-6">
        @if(session('success'))
            <x-alert type="success">{{ session('success') }}</x-alert>
        @endif

        {{-- conteúdo --}}
    </div>
@endsection
```

### Regra: lógica fora da view
Views **não fazem queries**. Dados vêm do controller via `compact()` ou `with()`.

---

## 8. Componentes Blade

Componentes disponíveis em `resources/views/components/`:

| Tag | Arquivo | Uso |
|-----|---------|-----|
| `<x-button>` | `button.blade.php` | Botões padronizados |
| `<x-alert>` | `alert.blade.php` | Feedback de operações |
| `<x-card-post>` | `card-post.blade.php` | Cards de notícias |
| `<x-input>` | `input.blade.php` | Campos de formulário |
| `<x-textarea>` | `textarea.blade.php` | Campos de texto longo |

### Uso correto de componentes

```blade
{{-- Botão --}}
<x-button type="submit">Salvar</x-button>
<x-button variant="outline" href="{{ route('admin.posts.index') }}">Cancelar</x-button>

{{-- Alerta --}}
<x-alert type="success">Operação realizada com sucesso!</x-alert>

{{-- Input --}}
<x-input name="title" label="Título" :error="$errors->first('title')" required />
```

---

## 9. Uploads e Storage

```php
// Padrão de upload — NUNCA usar o nome original do arquivo
if ($request->hasFile('image')) {
    $path = $request->file('image')->store('posts', 'public');
    // Salvar apenas o path relativo: "posts/abc123.jpg"
}
```

### Pastas de upload por módulo

| Módulo | Pasta |
|--------|-------|
| Banners | `storage/app/public/banners/` |
| Posts | `storage/app/public/posts/` |
| Galerias | `storage/app/public/galleries/` |
| Páginas | `storage/app/public/pages/` |

### Exibição de imagens

```blade
<img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}">
```

> ✅ Sempre `Storage::url()` — nunca concatenar path manualmente
> ✅ Nunca confiar no nome original do arquivo enviado pelo usuário
> ✅ Validar: `mimes:jpg,jpeg,png,webp` + `max:1024` (1MB)

---

## 10. Identidade Visual

### Variáveis CSS (definidas em `resources/css/app.css`)

```css
:root {
    --bprv-black:     #101010;   /* Cor principal */
    --bprv-gold:      #d5aa32;   /* Destaque dourado */
    --bprv-gold-soft: #f2df9c;   /* Dourado suave */
    --bprv-text:      #202020;   /* Texto padrão */
    --bprv-muted:     #6e6e6e;   /* Texto secundário */
}
```

### Classes Tailwind do projeto

| Intenção | Classe Tailwind |
|----------|----------------|
| Fundo principal | `bg-[#101010]` ou `bg-black` |
| Destaque dourado | `bg-[#d5aa32]` |
| Texto dourado | `text-[#d5aa32]` |
| Borda dourada | `border-[#d5aa32]` |
| Texto principal | `text-[#202020]` |
| Texto secundário | `text-[#6e6e6e]` |

### Tipografia
- **Títulos**: Barlow Condensed (Google Fonts)
- **Texto**: Source Sans 3 (Google Fonts)

---

## 11. Segurança — Checklist Mínimo

Toda implementação nova deve garantir:

- [ ] Formulários têm `@csrf`
- [ ] Rotas admin têm middleware `auth` + `admin`
- [ ] Validação server-side via Form Request (nunca confiar só no JS)
- [ ] Uploads validados por tipo e tamanho
- [ ] Nomes de arquivo gerados pelo sistema (nunca usar `$file->getClientOriginalName()`)
- [ ] `APP_DEBUG=false` em produção
- [ ] `.env` fora do versionamento
- [ ] Sem `dd()`, `dump()` ou `console.log()` no código commitado

---

## 12. Padrões de Mensagens Flash

```php
// Sucesso
->with('success', 'Publicação criada com sucesso.')

// Erro
->with('error', 'Ocorreu um erro ao salvar.')

// Aviso
->with('warning', 'Atenção: verifique os dados.')
```

Na view, usar o componente `<x-alert>`:

```blade
@foreach(['success', 'error', 'warning'] as $type)
    @if(session($type))
        <x-alert :type="$type">{{ session($type) }}</x-alert>
    @endif
@endforeach
```
