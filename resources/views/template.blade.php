<!DOCTYPE html>
<html lang="ru">
@include('blocks.head')
@if(!Route::is('main'))
    @php $innerPage = true; @endphp
@endif
<body x-data="{ menuIsOpen: false }">
    {!! Settings::get('counters') !!}
    @include('blocks.header')

    @yield('content')

    @if(!Route::is('main'))
        @include('blocks.footer')
    @endif
</body>
</html>
