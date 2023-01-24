@extends('template')
@section('content')
    @include('blocks.bread')
    <main>
        <section class="about">
            <div class="about__lead">
                <div class="about__container container">
                    <div class="about__lead-grid">
                        <div class="about__lead-col">
                            <div class="about__title">{{ Settings::get('about_title') }}</div>
                            <div class="about__text">{{ Settings::get('about_text') }}</div>
                            @if($feats = Settings::get('about_features'))
                                <div class="lead-features">
                                    @foreach($feats as $feat)
                                        <div class="lead-features__column">
                                            <div class="lead-features__decor">
                                                <div class="lead-features__icon lazy"
                                                     data-bg="{{ Settings::fileSrc($feat['about_features_image']) }}">
                                                </div>
                                            </div>
                                            <div class="lead-features__label">{{ $feat['about_features_title'] }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="about__lead-img lazy" data-bg="{{ $about_image }}"></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="s-trade">
            <div class="s-trade__container container">
                <div class="s-trade__row">
                    <div class="title">Что мы продаём</div>
                    <a class="link-arrow" href="{{ route('catalog.index') }}" title="В каталог">
                        <span>В каталог</span>
                        <svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 5L13 0.958548V9.04145L20 5ZM0 5.7H13.7V4.3H0V5.7Z" fill="currentColor"/>
                        </svg>
                    </a>
                </div>
                <div class="s-trade__grid">
                    @foreach($categories as $cat)
                        <div class="s-trade__col
                        {{ $loop->iteration == 1 ? 's-trade__col--wide' : null }}
                        {{ $loop->iteration == 2 ? 's-trade__col--medium' : null }}">
                            <a class="card-link" href="{{ $cat->url }}" title="Трубы">
                                <span class="card-link__title">{{ $cat->name }}</span>
                                <span class="card-link__text">{{ $cat->about_announce }}</span>
                                <img class="card-link__pic lazy" src="/" data-src="{{ $cat->getImageUrl() }}"
                                     width="305" height="270" alt=""/>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <section class="s-services s-services--normal lazy"
                 data-bg="{{ Settings::fileSrc(Settings::get('about_bg')) }}">
            @include('pages.unique.about_services')
        </section>
        <section class="s-top">
            <div class="s-top__container container">
                <div class="s-top__grid">
                    <div class="s-top__body">
                        <div class="s-top__title">{{ Settings::get('top_title') }}</div>
                        @if($top = Settings::get('top_list'))
                            <div class="s-top__list">
                                @foreach($top as $item)
                                    <div class="s-top__item">
                                        <div class="s-top__row">
                                            <div class="s-top__icon lazy"
                                                 data-bg="{{ Settings::fileSrc($item['top_list_image']) }}"></div>
                                            <div class="s-top__subtitle">{{ $item['top_list_title'] }}</div>
                                        </div>
                                        <div class="s-top__text">{{ $item['top_list_text'] }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="s-top__pic lazy" data-bg="{{ Settings::fileSrc(Settings::get('top_image')) }}"></div>
                </div>
            </div>
        </section>
        @include('catalog.blocks.payments')
        @if($pictures = Settings::get('about_gallery'))
            <section class="s-gallery">
                <div class="s-gallery__container container">
                    <div class="title">Фото-галерея</div>
                    <div class="s-gallery__grid">
                        @foreach($pictures as $pic)
                            <a class="s-gallery__card" href="{{ Settings::fileSrc($pic['about_gallery_image']) }}" data-fancybox="gallery">
                                <img class="s-gallery__pic lazy"
                                     src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                     data-src="{{ Settings::fileSrc($pic['about_gallery_image']) }}" alt="">
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </main>
@stop
