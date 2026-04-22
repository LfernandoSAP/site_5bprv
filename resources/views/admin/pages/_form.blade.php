<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <div class="lg:col-span-2">
        <div class="admin-card p-4 h-full">
            <div class="mb-4">
                <label for="title" class="block font-semibold text-[#202020] mb-1">Título</label>
                <input type="text" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl @error('title') border-red-300 bg-red-50 @enderror" id="title" name="title" value="{{ old('title', $page->title) }}" required>
                @error('title')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label for="slug" class="block font-semibold text-[#202020] mb-1">Slug</label>
                <input type="text" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl @error('slug') border-red-300 bg-red-50 @enderror" id="slug" name="slug" value="{{ old('slug', $page->slug) }}">
                @error('slug')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label for="excerpt" class="block font-semibold text-[#202020] mb-1">Resumo</label>
                <textarea class="w-full px-4 py-2.5 border border-gray-300 rounded-xl resize-y min-h-[100px] @error('excerpt') border-red-300 bg-red-50 @enderror" id="excerpt" name="excerpt" rows="4">{{ old('excerpt', $page->excerpt) }}</textarea>
                @error('excerpt')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label for="content" class="block font-semibold text-[#202020] mb-1">Conteúdo</label>
                <textarea class="w-full px-4 py-2.5 border border-gray-300 rounded-xl resize-y min-h-[200px] @error('content') border-red-300 bg-red-50 @enderror" id="content" name="content" rows="16" required>{{ old('content', $page->content) }}</textarea>
                @error('content')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>
    <div class="lg:col-span-1">
        <div class="admin-card p-4">
            <div class="mb-4">
                <label for="status" class="block font-semibold text-[#202020] mb-1">Status</label>
                <select class="w-full px-4 py-2.5 border border-gray-300 rounded-xl @error('status') border-red-300 bg-red-50 @enderror" id="status" name="status" required>
                    <option value="draft" @selected(old('status', $page->status) === 'draft')>Rascunho</option>
                    <option value="published" @selected(old('status', $page->status) === 'published')>Publicado</option>
                </select>
                @error('status')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label for="published_at" class="block font-semibold text-[#202020] mb-1">Data de publicação</label>
                <input type="datetime-local" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl @error('published_at') border-red-300 bg-red-50 @enderror" id="published_at" name="published_at" value="{{ old('published_at', optional($page->published_at)->format('Y-m-d\TH:i') ?? $page->published_at) }}">
                @error('published_at')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="space-y-2">
                <button type="submit" class="w-full px-4 py-3 bg-[#101010] text-white rounded-xl hover:bg-gray-900 transition">Salvar página</button>
                <a href="{{ route('admin.pages.index') }}" class="block w-full px-4 py-3 text-center border border-[#101010]/18 text-[#101010] rounded-xl hover:bg-[#101010] hover:text-white transition">Cancelar</a>
            </div>
        </div>
    </div>
</div>
