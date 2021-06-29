<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Color') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <form method="post" action="{{ route('admin.colors.store') }}">
                @csrf
                <div class="grid grid-cols-1 gap-6">
                    <label class="block" for="name">
                        <span class="text-gray-700">{{ __('Color') }}</span>
                        <input type="text" class="mt-1 block w-full" id="name" name="name" value="{{ old('name') }}" />
                    </label>
                    <div>
                        <x-button>{{ __('Save') }}</x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
