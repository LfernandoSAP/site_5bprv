@if (session('success'))
    <div class="mb-4 p-4 rounded-xl bg-green-50 border border-green-200 text-green-800">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-4 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800">
        {{ session('error') }}
    </div>
@endif

@if (session('warning'))
    <div class="mb-4 p-4 rounded-xl bg-yellow-50 border border-yellow-200 text-yellow-800">
        {{ session('warning') }}
    </div>
@endif
