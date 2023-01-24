@php
    $headerIsWhite = true;
@endphp
@extends('template')
@section('content')
    <nav class="breadcrumbs">
        <div class="breadcrumbs__container container">
            <ul class="breadcrumbs__list list-reset" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a class="breadcrumbs__link" href="{{ route('main') }}" itemprop="item">
                        <span itemprop="name">Главная</span>
                        <meta itemprop="position" content="1">
                    </a>
                </li>
                <li class="breadcrumbs__item" itemprop="itemListElement" itemscope
                    itemtype="https://schema.org/ListItem">
                    <a class="breadcrumbs__link breadcrumbs__link"
                       href="#" itemprop="item">
                        <span itemprop="name">Доставка и оплата</span>
                        <meta itemprop="position" content="{{ 2 }}">
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <main>
        <div class="page-head">
            <div class="page-head__container container">
                <div class="page-head__content">
                    <div class="page-head__title">{{ $title }}</div>
                    @if(isset($announce))
                        <div class="page-head__text">{!! $announce !!}</div>
                    @endif
                </div>
            </div>
        </div>
        <section class="delivery">
            <div class="delivery__container container">
                {!! $text !!}
            </div>
        </section>
    </main>
@endsection
