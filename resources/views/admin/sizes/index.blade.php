<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sizes') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="mb-6 flex">
                <x-button-link href="{{ route('admin.sizes.create') }}" class="ml-auto">{{ __('Add Size') }}</x-button-link>
            </div>
            <table class="table-auto w-full">
                <thead>
                    <tr class = "border-b border-green-400">
                        <th class="text-left">ID</th>
                        <th class="text-left">Size</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sizes as $size)
                        <tr>
                            <td class="text-left">{{ $size->id }}</td>
                            <td class="text-left">{{ $size->name }}</td>
                            <td>
                                <div class="flex gap-2 justify-end">
                                    <x-button-link href="{{ route('admin.sizes.edit', $size) }}">{{ __('Edit') }}</x-button-link>
                                    <form method="post" action="{{ route('admin.sizes.destroy', $size) }}">
                                        @csrf
                                        @method('delete')
                                        <x-button>{{ __('Delete') }}</x-button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">{{ __('No Size Added') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
