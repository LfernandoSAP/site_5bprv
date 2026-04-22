<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <div class="lg:col-span-2">
        <div class="admin-card p-4 h-full">
            <div class="mb-4">
                <label for="name" class="block font-semibold text-[#202020] mb-1">Nome</label>
                <input type="text" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl @error('name') border-red-300 bg-red-50 @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label for="email" class="block font-semibold text-[#202020] mb-1">E-mail</label>
                <input type="email" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl @error('email') border-red-300 bg-red-50 @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div>
                    <label for="password" class="block font-semibold text-[#202020] mb-1">{{ $user->exists ? 'Nova senha' : 'Senha' }}</label>
                    <input type="password" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl @error('password') border-red-300 bg-red-50 @enderror" id="password" name="password" {{ $user->exists ? '' : 'required' }}>
                    @error('password')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block font-semibold text-[#202020] mb-1">Confirmar senha</label>
                    <input type="password" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl" id="password_confirmation" name="password_confirmation" {{ $user->exists ? '' : 'required' }}>
                </div>
            </div>
            @if ($user->exists)
                <div class="text-sm text-[#6e6e6e] mt-3">Deixe os campos de senha em branco para manter a senha atual.</div>
            @endif
        </div>
    </div>
    <div class="lg:col-span-1">
        <div class="admin-card p-4">
            <div class="mb-4">
                <label for="role" class="block font-semibold text-[#202020] mb-1">Perfil</label>
                <select class="w-full px-4 py-2.5 border border-gray-300 rounded-xl @error('role') border-red-300 bg-red-50 @enderror" id="role" name="role" required>
                    <option value="admin" @selected(old('role', $user->role) === 'admin')>Administrador</option>
                    <option value="editor" @selected(old('role', $user->role) === 'editor')>Editor</option>
                </select>
                @error('role')<div class="text-sm text-red-600 mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" class="w-5 h-5 rounded border-gray-300" id="is_active" name="is_active" value="1" @checked(old('is_active', $user->is_active))>
                    <span>Conta ativa</span>
                </label>
            </div>
            @if ($user->exists)
                <div class="text-sm text-[#6e6e6e] mb-4">
                    Último acesso:
                    {{ optional($user->last_login_at)->format('d/m/Y H:i') ?? 'ainda não registrado' }}
                </div>
            @endif
            <div class="space-y-2">
                <button type="submit" class="w-full px-4 py-3 bg-[#101010] text-white rounded-xl hover:bg-gray-900 transition">Salvar usuário</button>
                <a href="{{ route('admin.users.index') }}" class="block w-full px-4 py-3 text-center border border-[#101010]/18 text-[#101010] rounded-xl hover:bg-[#101010] hover:text-white transition">Cancelar</a>
            </div>
        </div>
    </div>
</div>
