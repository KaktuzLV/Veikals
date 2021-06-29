<x-app-layout>
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category') }} - {{ $category->name }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto my-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
            <div class="col-span-1 sm:col-span-3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white-600 border-b border-gray-200">
                        <form method="get" action="{{ route('categories.show', $category) }}">
                            <div class="mb-2">
                                <h3 class="font-semibold">{{ __('Manufacturer') }}</h3>
                                @foreach($manufacturers as $manufacturer)
                                    <div class="block">
                                        <div>
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" {{ in_array($manufacturer->id, $activeFilters['manufacturers']) ? 'checked' : '' }} name="manufacturers[]" value="{{ $manufacturer->id }}">
                                                <span class="ml-2">{{ $manufacturer->name }}</span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mb-2">
                                <h3 class="font-semibold">{{ __('Color') }}</h3>
                                @foreach($colors as $color)
                                    <div class="block">
                                        <div>
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" {{ in_array($color->id, $activeFilters['colors']) ? 'checked' : '' }} name="colors[]" value="{{ $color->id }}">
                                                <span class="ml-2">{{ $color->name }}</span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mb-2">
                                <h3 class="font-semibold">{{ __('Size') }}</h3>
                                @foreach($sizes as $size)
                                    <div class="block">
                                        <div>
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" {{ in_array($size->id, $activeFilters['sizes']) ? 'checked' : '' }} name="sizes[]" value="{{ $size->id }}">
                                                <span class="ml-2">{{ $size->name }}</span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div>
                                <x-button>{{ __('Filter') }}</x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-span-1 sm:col-span-9">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    @foreach($products as $product)
                        @include('products._product')
                    @endforeach
                </div>
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
