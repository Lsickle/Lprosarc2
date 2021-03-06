@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url'), 'logo' => secure_asset('img/LogoProsarc.png')])
        {{ config('app.name') }}
        @endcomponent
    @endslot
    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ 'Prosarc S.A. ESP' }}. @lang('Todos los derechos reservados.')
        @endcomponent
    @endslot
@endcomponent
