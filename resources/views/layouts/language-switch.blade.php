<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    @if(app()->getLocale() === 'en')
        <a href="{{ route('language.switch', 'lv') }}">{{ __('Latviski') }}</a>
    @else
        <a href="{{ route('language.switch', 'en') }}">{{ __('English') }}</a>
    @endif
</div>
