<x-app-layout>
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto my-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
            @foreach($products as $product)
                @include('products._product')
            @endforeach
        </div>
        {{ $products->links() }}
    </div>
</x-app-layout>
