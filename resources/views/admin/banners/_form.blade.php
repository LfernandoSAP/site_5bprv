<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <div class="lg:col-span-2">
        <div class="admin-card p-4 h-full">
            <div class="mb-4">
                <label for="title" class="block font-semibold text-[#202020] mb-1">Título</label>
                <input type="text" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl @error('title') border-red-300 bg-red-50 @enderror" id="title" name="title" value="{{ old('title', $banner->title) }}" required>
                @error('title')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label for="subtitle" class="block font-semibold text-[#202020] mb-1">Subtítulo</label>
                <textarea class="w-full px-4 py-2.5 border border-gray-300 rounded-xl resize-y min-h-[100px] @error('subtitle') border-red-300 bg-red-50 @enderror" id="subtitle" name="subtitle" rows="4">{{ old('subtitle', $banner->subtitle) }}</textarea>
                @error('subtitle')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label for="link_url" class="block font-semibold text-[#202020] mb-1">Link</label>
                <input type="url" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl @error('link_url') border-red-300 bg-red-50 @enderror" id="link_url" name="link_url" value="{{ old('link_url', $banner->link_url) }}">
                @error('link_url')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
            </div>

            <div>
                <label for="image" class="block font-semibold text-[#202020] mb-1">Imagem</label>
                <input type="file" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm @error('image') border-red-300 bg-red-50 @enderror" id="image" name="image" accept=".jpg,.jpeg,.png,.webp">
                @error('image')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
                @if ($banner->image_path)
                    <div class="text-sm text-[#6e6e6e] mt-2">Imagem atual: <code class="text-xs bg-gray-100 px-1 py-0.5 rounded">{{ $banner->image_path }}</code></div>
                @endif
            </div>
        </div>
    </div>

    <div class="lg:col-span-1">
        <div class="admin-card p-4">
            <div class="mb-4">
                <label for="sort_order" class="block font-semibold text-[#202020] mb-1">Ordem</label>
                <input type="number" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl @error('sort_order') border-red-300 bg-red-50 @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $banner->sort_order) }}" min="0" required>
                @error('sort_order')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" class="w-5 h-5 rounded border-gray-300" id="is_active" name="is_active" value="1" @checked(old('is_active', $banner->is_active))>
                    <span>Banner ativo</span>
                </label>
            </div>

            <div class="space-y-2">
                <button type="submit" class="w-full px-4 py-3 bg-[#101010] text-white rounded-xl hover:bg-gray-900 transition">Salvar banner</button>
                <a href="{{ route('admin.banners.index') }}" class="block w-full px-4 py-3 text-center border border-[#101010]/18 text-[#101010] rounded-xl hover:bg-[#101010] hover:text-white transition">Cancelar</a>
            </div>
        </div>
    </div>
</div>
