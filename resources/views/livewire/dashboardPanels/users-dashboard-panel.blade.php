<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="w-48 p-2 m-2 text-black rounded-md bg-slate-300">
        <h2 class="font-bold text-red-900"><i class="fa-solid fa-users"></i> Users</h2>
        <p class="m-2 text-sm font-light">
            New Users: {{ $newUsers }}
            Total Users: {{ $totalUsers }}
        </p>

        <div class="text-right">
            <a  href="{{ route('users') }}" class="px-3 py-1 text-white bg-purple-800 rounded-lg hover:bg-purple-600">Manage</a>
        </div>
    </div>
</div>
