<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Colors') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="mb-6 flex">
                <x-button-link href="{{ route('admin.colors.create') }}" class="ml-auto">{{ __('Add Color') }}</x-button-link>
            </div>
            <table class="table-auto w-full">
                <thead>
                    <tr class = "border-b border-green-400">
                        <th class="text-left">ID</th>
                        <th class="text-left">Color</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($colors as $color)
                        <tr>
                            <td class="text-left">{{ $color->id }}</td>
                            <td class="text-left">{{ $color->name }}</td>
                            <td>
                                <div class="flex gap-2 justify-end">
                                    <x-button-link href="{{ route('admin.colors.edit', $color) }}">{{ __('Edit') }}</x-button-link>
                                    <form method="post" action="{{ route('admin.colors.destroy', $color) }}">
                                        @csrf
                                        @method('delete')
                                        <x-button>{{ __('Delete') }}</x-button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">{{ __('No Colors Added') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
