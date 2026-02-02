<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
    <form wire:submit.prevent="login" class="space-y-4">
        <div>
            <label>Email</label>
            <input type="email" wire:model="email" class="w-full border rounded px-3 py-2">
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label>Password</label>
            <input type="password" wire:model="password" class="w-full border rounded px-3 py-2">
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="w-full bg-orange-500 text-white py-2 rounded hover:bg-orange-600">Login</button>
    </form>
</div>
