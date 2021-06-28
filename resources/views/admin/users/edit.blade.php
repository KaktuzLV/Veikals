<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <form method="post" action="{{ route('admin.users.update', $user) }}">
                @csrf
                @method('put')
                <div class="grid grid-cols-1 gap-6">
                    <label class="block" for="name">
                        <span class="text-gray-700">{{ __('User Name') }}</span>
                        <input type="text" class="mt-1 block w-full" id="name" name="name" value="{{ old('name', $user->name) }}" />
                    </label>
                    <label class="block" for="email">
                        <span class="text-gray-700">{{ __('Email Name') }}</span>
                        <input type="email" class="mt-1 block w-full" id="email" name="email" value="{{ old('email', $user->email) }}" />
                    </label>
                    <label class="block" for="role">
                        <span class="text-gray-700">{{ __('Role') }}</span>
                        <select class="mt-1 block w-full" id="role" name="role">
                            @foreach(['user','support','admin'] as $role)
                                <option value="{{ $role }}" {{ $role === old('role', $user->role) ? 'selected' : '' }}>{{ $role }}</option>
                            @endforeach
                        </select>
                    </label>
                    <div>
                        <x-button>{{ __('Save') }}</x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
