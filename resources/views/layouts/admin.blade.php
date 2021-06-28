<x-app-layout>
    @if(isset($header))
        <x-slot name="header">
            {!! $header !!}
        </x-slot>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
                <div class="col-span-3">
                    <div class="divide-y divide-gray-300 bg-white overflow-hidden shadow-sm sm:rounded-lg border-b border-gray-200">
                        <a href="{{ route('admin.dashboard') }}" class="block p-4 hover:bg-gray-50 cursor-pointer">{{ __('Admin Dashboard') }}</a>
                        @if(Auth::user()->role === 'admin')
                            <a href="#" class="block p-4 hover:bg-gray-50 cursor-pointer">{{ __('Categories') }}</a>
                            <a href="#" class="block p-4 hover:bg-gray-50 cursor-pointer">{{ __('Products') }}</a>
                            <a href="#" class="block p-4 hover:bg-gray-50 cursor-pointer">{{ __('Orders') }}</a>
                            <a href="#" class="block p-4 hover:bg-gray-50 cursor-pointer">{{ __('Users') }}</a>
                        @endif
                        @if(Auth::user()->role === 'support' || Auth::user()->role === 'admin')
                            <a href="#" class="block p-4 hover:bg-gray-50 cursor-pointer">{{ __('Messages') }}</a>
                        @endif
                    </div>
                </div>
                <div class="col-span-9">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
