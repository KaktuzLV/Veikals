<x-app-layout>
    @if(isset($header))
        <x-slot name="header">
            {!! $header !!}
        </x-slot>
    @endif
    <div class="py-12" >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
                <div class="col-span-1 sm:col-span-3">
                    <div class="divide-y divide-gray-300 bg-white overflow-hidden shadow-sm sm:rounded-lg border-b border-gray-200">
                        <a href="{{ route('admin.dashboard') }}" class="block p-4 bg-green-700 text-white hover:bg-green-300 cursor-pointer">{{ __('Admin Dashboard') }}</a>
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.categories.index') }}" class="block p-4 hover:bg-green-400 cursor-pointer">{{ __('Categories') }}</a>
                            <a href="{{ route('admin.products.index') }}" class="block p-4 hover:bg-green-400 cursor-pointer">{{ __('Products') }}</a>
                            <a href="{{ route('admin.manufacturers.index') }}" class="block p-4 hover:bg-green-400 cursor-pointer">{{ __('Manufacturers') }}</a>
                            <a href="{{ route('admin.sizes.index') }}" class="block p-4 hover:bg-green-400 cursor-pointer">{{ __('Sizes') }}</a>
                            <a href="{{ route('admin.colors.index') }}" class="block p-4 hover:bg-green-400 cursor-pointer">{{ __('Colors') }}</a>
                            <a href="#" class="block p-4 hover:bg-green-400 cursor-pointer">{{ __('Orders') }}</a>
                            <a href="{{ route('admin.users.index') }}" class="block p-4 hover:bg-green-400 cursor-pointer">{{ __('Users') }}</a>
                        @endif
                        @if(Auth::user()->role === 'support' || Auth::user()->role === 'admin')
                            <a href="#" class="block p-4 hover:bg-green-400 cursor-pointer">{{ __('Messages') }}</a>
                        @endif
                    </div>
                </div>
                <div class="col-span-1 sm:col-span-9">
                    <x-errors></x-errors>
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
