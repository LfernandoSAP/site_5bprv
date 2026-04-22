<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <div class="lg:col-span-2">
        <div class="admin-card p-4 h-full">
            <div class="mb-4">
                <label for="title" class="block font-semibold text-[#202020] mb-1">Título</label>
                <input type="text" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl @error('title') border-red-300 bg-red-50 @enderror" id="title" name="title" value="{{ old('title', $post->title) }}" required>
                @error('title')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label for="slug" class="block font-semibold text-[#202020] mb-1">Slug</label>
                <input type="text" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl @error('slug') border-red-300 bg-red-50 @enderror" id="slug" name="slug" value="{{ old('slug', $post->slug) }}">
                @error('slug')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
                <div class="text-sm text-[#6e6e6e] mt-1">Opcional. Se ficar em branco, será gerado automaticamente a partir do título.</div>
            </div>

            <div class="mb-4">
                <label for="excerpt" class="block font-semibold text-[#202020] mb-1">Resumo</label>
                <textarea class="w-full px-4 py-2.5 border border-gray-300 rounded-xl resize-y min-h-[100px] @error('excerpt') border-red-300 bg-red-50 @enderror" id="excerpt" name="excerpt" rows="4">{{ old('excerpt', $post->excerpt) }}</textarea>
                @error('excerpt')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
            </div>

            <div>
                <label for="content" class="block font-semibold text-[#202020] mb-1">Conteúdo</label>
                <textarea class="w-full px-4 py-2.5 border border-gray-300 rounded-xl resize-y min-h-[200px] @error('content') border-red-300 bg-red-50 @enderror" id="content" name="content" rows="14" required>{{ old('content', $post->content) }}</textarea>
                @error('content')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>

    <div class="lg:col-span-1">
        <div class="admin-card p-4 mb-4">
            <div class="mb-4">
                <label for="status" class="block font-semibold text-[#202020] mb-1">Status</label>
                <select class="w-full px-4 py-2.5 border border-gray-300 rounded-xl @error('status') border-red-300 bg-red-50 @enderror" id="status" name="status" required>
                    <option value="draft" @selected(old('status', $post->status) === 'draft')>Rascunho</option>
                    <option value="published" @selected(old('status', $post->status) === 'published')>Publicado</option>
                </select>
                @error('status')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label for="published_at" class="block font-semibold text-[#202020] mb-1">Data de publicação</label>
                <input type="datetime-local" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl @error('published_at') border-red-300 bg-red-50 @enderror" id="published_at" name="published_at" value="{{ old('published_at', optional($post->published_at)->format('Y-m-d\TH:i') ?? $post->published_at) }}">
                @error('published_at')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" class="w-5 h-5 rounded border-gray-300" id="is_featured" name="is_featured" value="1" @checked(old('is_featured', $post->is_featured))>
                    <span>Marcar como destaque</span>
                </label>
            </div>

            <div class="mb-4">
                <label for="image" class="block font-semibold text-[#202020] mb-1">Imagem principal</label>
                <input type="file" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm @error('image') border-red-300 bg-red-50 @enderror" id="image" name="image" accept=".jpg,.jpeg,.png,.webp">
                @error('image')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
            </div>

            @if ($post->image_path)
                <div class="text-sm text-[#6e6e6e] mb-3">Imagem atual: <code class="text-xs bg-gray-100 px-1 py-0.5 rounded">{{ $post->image_path }}</code></div>
            @endif

            <div class="space-y-2">
                <button type="submit" class="w-full px-4 py-3 bg-[#101010] text-white rounded-xl hover:bg-gray-900 transition">Salvar notícia</button>
                <a href="{{ route('admin.posts.index') }}" class="block w-full px-4 py-3 text-center border border-[#101010]/18 text-[#101010] rounded-xl hover:bg-[#101010] hover:text-white transition">Cancelar</a>
            </div>
        </div>
    </div>
</div>
