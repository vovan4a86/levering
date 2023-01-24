@php
    $headerIsWhite = true;
@endphp
@extends('template')
@section('content')
    <main>
        @include('blocks.bread')
        @include('blocks.page_head')
        <div class="container">
            {!! $text !!}
        </div>
    </main>
@stop
