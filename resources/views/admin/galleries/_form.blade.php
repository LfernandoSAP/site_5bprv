<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <div class="lg:col-span-2">
        <div class="admin-card p-4 h-full">
            <div class="mb-4">
                <label for="title" class="block font-semibold text-[#202020] mb-1">Título</label>
                <input type="text" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl @error('title') border-red-300 bg-red-50 @enderror" id="title" name="title" value="{{ old('title', $gallery->title) }}" required>
                @error('title')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label for="description" class="block font-semibold text-[#202020] mb-1">Descrição</label>
                <textarea class="w-full px-4 py-2.5 border border-gray-300 rounded-xl resize-y min-h-[100px] @error('description') border-red-300 bg-red-50 @enderror" id="description" name="description" rows="6">{{ old('description', $gallery->description) }}</textarea>
                @error('description')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label for="cover_image" class="block font-semibold text-[#202020] mb-1">Imagem de capa</label>
                <input type="file" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm @error('cover_image') border-red-300 bg-red-50 @enderror" id="cover_image" name="cover_image" accept=".jpg,.jpeg,.png,.webp">
                @error('cover_image')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
                @if ($gallery->cover_image_path)
                    <div class="text-sm text-[#6e6e6e] mt-2">Capa atual: <code class="text-xs bg-gray-100 px-1 py-0.5 rounded">{{ $gallery->cover_image_path }}</code></div>
                @endif
            </div>
            <div>
                <label class="block font-semibold text-[#202020] mb-2">Novas fotos da galeria</label>
                <div class="space-y-3">
                    @for ($i = 0; $i < 3; $i++)
                        <div class="border rounded-xl p-3">
                            <input type="file" class="w-full px-3 py-2 border border-gray-300 rounded-xl text-sm mb-2" name="photos[]" accept=".jpg,.jpeg,.png,.webp">
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-xl text-sm mb-2" name="photo_titles[]" placeholder="Título opcional da foto">
                            <textarea class="w-full px-3 py-2 border border-gray-300 rounded-xl text-sm" name="photo_captions[]" rows="2" placeholder="Legenda opcional"></textarea>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
    <div class="lg:col-span-1">
        <div class="admin-card p-4">
            <div class="mb-4">
                <label for="status" class="block font-semibold text-[#202020] mb-1">Status</label>
                <select class="w-full px-4 py-2.5 border border-gray-300 rounded-xl @error('status') border-red-300 bg-red-50 @enderror" id="status" name="status" required>
                    <option value="draft" @selected(old('status', $gallery->status) === 'draft')>Rascunho</option>
                    <option value="published" @selected(old('status', $gallery->status) === 'published')>Publicada</option>
                </select>
                @error('status')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label for="published_at" class="block font-semibold text-[#202020] mb-1">Data de publicação</label>
                <input type="datetime-local" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl @error('published_at') border-red-300 bg-red-50 @enderror" id="published_at" name="published_at" value="{{ old('published_at', optional($gallery->published_at)->format('Y-m-d\TH:i') ?? $gallery->published_at) }}">
                @error('published_at')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="space-y-2">
                <button type="submit" class="w-full px-4 py-3 bg-[#101010] text-white rounded-xl hover:bg-gray-900 transition">Salvar galeria</button>
                <a href="{{ route('admin.galleries.index') }}" class="block w-full px-4 py-3 text-center border border-[#101010]/18 text-[#101010] rounded-xl hover:bg-[#101010] hover:text-white transition">Cancelar</a>
            </div>
        </div>

        @if ($gallery->exists && $gallery->photos->isNotEmpty())
            <div class="admin-card p-4 mt-4">
                <h2 class="font-heading text-xl mb-3">Fotos cadastradas</h2>
                <div class="space-y-3">
                    @foreach ($gallery->photos as $photo)
                        <div class="border rounded-xl p-3">
                            <div class="font-semibold">{{ $photo->title ?: 'Sem título' }}</div>
                            <div class="text-sm text-[#6e6e6e] mb-2">{{ $photo->caption ?: 'Sem legenda' }}</div>
                            <div class="text-sm text-[#6e6e6e] mb-3"><code class="text-xs bg-gray-100 px-1 py-0.5 rounded">{{ $photo->file_path }}</code></div>
                            <form method="POST" action="{{ route('admin.galleries.photos.destroy', [$gallery, $photo]) }}" onsubmit="return confirm('Deseja remover esta foto?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 text-sm border border-red-300 text-red-600 rounded-full hover:bg-red-600 hover:text-white hover:border-red-600 transition">Excluir foto</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
