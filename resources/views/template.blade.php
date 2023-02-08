<!DOCTYPE html>
<html lang="ru">
@include('blocks.head')
<body x-data="{ menuIsOpen: false }">
    {!! Settings::get('counters') !!}
    {{--    @include('blocks.preloader')--}}

    @include('blocks.header')

    @yield('content')

{{--    @include('blocks.footer')--}}
</body>
</html>
