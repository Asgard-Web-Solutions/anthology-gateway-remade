<div>
    <a href="{{ route('users.index') }}">
        <div class="w-48 p-2 m-2 text-black bg-gray-200 rounded-md hover:bg-gray-300">
            <h2 class="font-bold text-red-900"><i class="fa-solid fa-users"></i> Users</h2>
            <p class="m-2 text-sm font-light">
                New: <span class="mr-4 font-bold">{{ $newUsers }}</span>
                Total: <span class="font-bold">{{ $totalUsers }}</span>
            </p>
        </div>
    </a>
</div>
