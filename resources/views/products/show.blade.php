<x-app-layout>
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }} - {{ $product->category ? $product->category->name : '' }} - {{ $product->manufacturer ? $product->manufacturer->name : '' }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto my-4 sm:px-6 lg:px-8">
        <x-errors></x-errors>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
            <div class="col-span-1 sm:col-span-9">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-2 bg-white border-b border-gray-200 relative">
                        <img class="max-w-full mb-2" src="{{ asset('storage/products/' . $product->id . '.jpg') }}" alt="" />
                        <p>{{ $product->description }}</p>
                    </div>
                </div>
            </div>
            @if(Auth::guest())
                <div class="col-span-1 sm:col-span-3">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2">
                        <div class="p-2 bg-white border-b border-gray-200 relative">
                            <p class="text-xl">€{{ number_format($product->price, 2, '.', '') }}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-span-1 sm:col-span-3">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2">
                        <div class="p-2 bg-white border-b border-gray-200 relative">
                            <p class="text-xl">€{{ number_format($product->price, 2, '.', '') }}</p>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white-600 border-b border-gray-200">
                            <form method="post" action="{{ route('cart.add', $product) }}">
                                @csrf
                                    <div class="grid grid-cols-1 gap-6">
                                        <label class="block" for="color_id">
                                            <span class="text-gray-700">{{ __('Product Color') }}</span>
                                            <select class="mt-1 block w-full" id="color_id" name="color_id">
                                                @foreach($product->colors as $color)
                                                    <option value="{{ $color->id }}" {{ $color->id === old('color_id') ? 'selected' : '' }}>{{ $color->name }}</option>
                                                @endforeach
                                            </select>
                                        </label>
                                        <label class="block" for="size_id">
                                            <span class="text-gray-700">{{ __('Product Size') }}</span>
                                            <select class="mt-1 block w-full" id="size_id" name="size_id">
                                                @foreach($product->sizes as $size)
                                                    <option value="{{ $size->id }}" {{ $size->id === old('size_id') ? 'selected' : '' }}>{{ $size->name }}</option>
                                                @endforeach
                                            </select>
                                        </label>
                                        <div>
                                            <x-button>{{ __('Add to cart') }}</x-button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
