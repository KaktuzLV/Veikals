<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="mb-6 flex">
                <x-button-link href="{{ route('admin.products.create') }}" class="ml-auto">{{ __('Add Product') }}</x-button-link>
            </div>
            <table class="table-auto w-full">
                <thead>
                    <tr class = "border-b border-green-400">
                        <th class="text-left ">{{__('ID')}}</th>
                        <th class="text-left">{{__('Title')}}</th>
                        <th class="text-left">{{__('Category')}}</th>
                        <th class="text-left">{{__('Manufacturer')}}</th>
                        <th class="text-left">{{__('Colors')}}</th>
                        <th class="text-left">{{__('Sizes')}}</th>
                        <th class="text-left">{{__('Price')}}</th>
                        <th class="text-right">{{__('Actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td class="text-left">{{ $product->id }}</td>
                            <td class="text-left">{{ $product->name }}</td>
                            <td class="text-left">{{ $product->category ? $product->category->name : '' }}</td>
                            <td class="text-left">{{ $product->manufacturer ? $product->manufacturer->name : '' }}</td>
                            <td class="text-left">{{ $product->colors()->pluck('name')->join(', ') }}</td>
                            <td class="text-left">{{ $product->sizes()->pluck('name')->join(', ') }}</td>
                            <td class="text-left">{{ number_format($product->price, 2, '.', '') }}</td>
                            <td>
                                <div class="flex gap-2 justify-end">
                                    <x-button-link href="{{ route('admin.products.edit', $product) }}">{{ __('Edit') }}</x-button-link>
                                    <form method="post" action="{{ route('admin.products.destroy', $product) }}">
                                        @csrf
                                        @method('delete')
                                        <x-button>{{ __('Delete') }}</x-button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">{{ __('No Products Added') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
