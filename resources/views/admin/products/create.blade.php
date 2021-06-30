<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Product') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <form method="post" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 gap-6">
                    <label class="block" for="name">
                        <span class="text-gray-700">{{ __('Product Name') }}</span>
                        <input type="text" class="mt-1 block w-full" id="name" name="name" value="{{ old('name') }}" />
                    </label>
                    <label class="block" for="description">
                        <span class="text-gray-700">{{ __('Product Description') }}</span>
                        <textarea class="mt-1 block w-full" id="description" name="description">{{ old('description') }}</textarea>
                    </label>
                    <label class="block" for="category_id">
                        <span class="text-gray-700">{{ __('Product Category') }}</span>
                        <select class="mt-1 block w-full" id="category_id" name="category_id">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id === old('category_id') ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label class="block" for="manufacturer_id">
                        <span class="text-gray-700">{{ __('Product Manufacturer') }}</span>
                        <select class="mt-1 block w-full" id="manufacturer_id" name="manufacturer_id">
                            @foreach($manufacturers as $manufacturer)
                                <option value="{{ $manufacturer->id }}" {{ $manufacturer->id === old('manufacturer_id') ? 'selected' : '' }}>{{ $manufacturer->name }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label class="block" for="color_ids">
                        <span class="text-gray-700">{{ __('Product Colors') }}</span>
                        <select class="mt-1 block w-full" id="color_ids" name="color_ids[]" multiple>
                            @foreach($colors as $color)
                                <option value="{{ $color->id }}" {{ in_array($color->id, old('color_ids', [])) ? 'selected' : '' }}>{{ $color->name }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label class="block" for="size_ids">
                        <span class="text-gray-700">{{ __('Product Sizes') }}</span>
                        <select class="mt-1 block w-full" id="size_ids" name="size_ids[]" multiple>
                            @foreach($sizes as $size)
                                <option value="{{ $size->id }}" {{ in_array($size->id, old('size_ids', [])) ? 'selected' : '' }}>{{ $size->name }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label class="block" for="price">
                        <span class="text-gray-700">{{ __('Product Price') }}</span>
                        <input type="number" min="0" max="99999.99" step="0.01" class="mt-1 block w-full" id="price" name="price" value="{{ old('price') }}" />
                    </label>
                    <label class="block" for="image">
                        <span class="text-gray-700">{{ __('Product Image') }}</span>
                        <input type="file" class="mt-1 block w-full" id="image" name="image" />
                    </label>
                    <div>
                        <x-button>{{ __('Save') }}</x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
