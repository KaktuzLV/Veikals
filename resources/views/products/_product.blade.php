<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <a href="{{ route('products.show', $product) }}">
        <div class="p-2 bg-white border-b border-gray-200 relative">
            <h4 class="font-semibold text-lg leading-tight">{{ $product->name }}</h4>
            <h5 class="font-semibold text-xs leading-tight">{{ __('Colors') }}: {{ $product->colors()->pluck('name')->join(', ') }}</h5>
            <h5 class="font-semibold text-xs leading-tight">{{ __('Sizes') }}: {{ $product->sizes()->pluck('name')->join(', ') }}</h5>
            <h5 class="font-semibold text-sm leading-tight">€{{ number_format($product->price, 2, '.', '') }}</h5>
        </div>
    </a>
</div>
