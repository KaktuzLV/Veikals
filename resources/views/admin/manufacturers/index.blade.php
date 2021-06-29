<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manufacturers') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="mb-6 flex">
                <x-button-link href="{{ route('admin.manufacturers.create') }}" class="ml-auto">{{ __('Add Manufacturer') }}</x-button-link>
            </div>
            <table class="table-auto w-full">
                <thead>
                    <tr class = "border-b border-green-400">
                        <th class="text-left">ID</th>
                        <th class="text-left">Name</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($manufacturers as $manufacturer)
                        <tr>
                            <td class="text-left">{{ $manufacturer->id }}</td>
                            <td class="text-left">{{ $manufacturer->name }}</td>
                            <td>
                                <div class="flex gap-2 justify-end">
                                    <x-button-link href="{{ route('admin.manufacturers.edit', $manufacturer) }}">{{ __('Edit') }}</x-button-link>
                                    <form method="post" action="{{ route('admin.manufacturers.destroy', $manufacturer) }}">
                                        @csrf
                                        @method('delete')
                                        <x-button>{{ __('Delete') }}</x-button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">{{ __('No Manufacturers Created') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
