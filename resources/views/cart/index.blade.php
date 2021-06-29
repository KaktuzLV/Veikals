<x-app-layout>
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto my-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white-600 border-b border-gray-200">
                <table class="table-auto w-full">
                    <thead>
                        <tr class = "border-b border-green-400">
                            <th class="text-left">{{ __('Product') }}</th>
                            <th class="text-left">{{ __('Color') }}</th>
                            <th class="text-left">{{ __('Size') }}</th>
                            <th class="text-left">{{ __('Price') }}</th>
                            <th class="text-left" style="width: 1%;"></th>
                            <th class="text-left" style="width: 1%;">{{ __('Quantity') }}</th>
                            <th class="text-left" style="width: 1%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($cart as $cartItem)
                        <tr>
                            <td class="text-left">
                                <a href="{{ route('products.show', $cartItem['product']) }}">{{ $cartItem['product']->name }}</a>
                            </td>
                            <td class="text-left">{{ $cartItem['color']->name }}</td>
                            <td class="text-left">{{ $cartItem['size']->name }}</td>
                            <td class="text-left">€{{ number_format($cartItem['product']->price, 2, '.', '') }}</td>
                            <td>
                                <form method="post" action="{{ route('cart.remove', $cartItem['product']) }}">
                                    @csrf
                                    <input type="hidden" name="color_id" value="{{ $cartItem['color_id'] }}" />
                                    <input type="hidden" name="size_id" value="{{ $cartItem['size_id'] }}" />
                                    <x-button-small>-</x-button-small>
                                </form>
                            </td>
                            <td class="text-center">{{ $cartItem['quantity'] }}</td>
                            <td>
                                <form method="post" action="{{ route('cart.add', $cartItem['product']) }}">
                                    @csrf
                                    <input type="hidden" name="color_id" value="{{ $cartItem['color_id'] }}" />
                                    <input type="hidden" name="size_id" value="{{ $cartItem['size_id'] }}" />
                                    <x-button-small>+</x-button-small>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">{{ __('No Products Added') }}</td>
                        </tr>
                    @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-right">{{ __('Total Amount') }}</th>
                            <th colspan="3">€{{ number_format($cartAmount, 2, '.', '') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
