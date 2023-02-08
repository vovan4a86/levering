@extends('template')
@section('content')
    <!-- homepage layout-->
    <main class="page-slider swiper">
        <div class="page-slider__wrapper swiper-wrapper">
            <section class="hero section section--slide swiper-slide" data-background="dark">
                <div class="hero__slider swiper" data-hero-slider>
                    <div class="hero__wrapper swiper-wrapper">
                        <div class="hero__slide swiper-slide">
                            <picture>
                                <source type="image/webp" srcset="/" data-srcset="static/images/common/hero-bg--1080.webp 1080w, static/images/common/hero-bg.webp" data-sizes="100w">
                                <img class="hero__bg lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="static/images/common/hero-bg--1080.jpg 1080, static/images/common/hero-bg.jpg" data-sizes="100w" width="1920" height="1080"
                                     alt="">
                            </picture>
                            <div class="hero__content">
                                <div class="hero__container container">
                                    <div class="hero__title">Комплексное снабжение строительных компаний</div>
                                    <div class="hero__text">Подбор аналогов с полным соответствием характеристик товаров по проекту для экономии бюджета</div>
                                </div>
                            </div>
                        </div>
                        <div class="hero__slide swiper-slide">
                            <picture>
                                <source type="image/webp" srcset="/" data-srcset="static/images/common/hero-bg-2--1080.webp 1080w, static/images/common/hero-bg-2.webp" data-sizes="100w">
                                <img class="hero__bg lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="static/images/common/hero-bg-2--1080.jpg 1080, static/images/common/hero-bg-2.jpg" data-sizes="100w" width="1920" height="1080"
                                     alt="">
                            </picture>
                            <div class="hero__content">
                                <div class="hero__container container">
                                    <div class="hero__title">Поставка инженерного оборудования</div>
                                    <div class="hero__text">Полное соответствие технических требований</div>
                                </div>
                            </div>
                        </div>
                        <div class="hero__slide swiper-slide">
                            <picture>
                                <source type="image/webp" srcset="/" data-srcset="static/images/common/hero-bg--1080.webp 1080w, static/images/common/hero-bg.webp" data-sizes="100w">
                                <img class="hero__bg lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="static/images/common/hero-bg--1080.jpg 1080, static/images/common/hero-bg.jpg" data-sizes="100w" width="1920" height="1080"
                                     alt="">
                            </picture>
                            <div class="hero__content">
                                <div class="hero__container container">
                                    <div class="hero__title">Комплексное снабжение строительных компаний</div>
                                    <div class="hero__text">Подбор аналогов с полным соответствием характеристик товаров по проекту для экономии бюджета</div>
                                </div>
                            </div>
                        </div>
                        <div class="hero__slide swiper-slide">
                            <picture>
                                <source type="image/webp" srcset="/" data-srcset="static/images/common/hero-bg-2--1080.webp 1080w, static/images/common/hero-bg-2.webp" data-sizes="100w">
                                <img class="hero__bg lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="static/images/common/hero-bg-2--1080.jpg 1080, static/images/common/hero-bg-2.jpg" data-sizes="100w" width="1920" height="1080"
                                     alt="">
                            </picture>
                            <div class="hero__content">
                                <div class="hero__container container">
                                    <div class="hero__title">Поставка инженерного оборудования</div>
                                    <div class="hero__text">Полное соответствие технических требований</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hero__pagination" data-hero-pagination></div>
                    <div class="hero__mouse mouse-scroller">
                        <div class="mouse-scroller__icon lazy" data-bg="static/images/common/ico_mouse.svg"></div>
                    </div>
                </div>
            </section>
            @if(count($categories))
            <section class="s-catalog section section--slide swiper-slide" data-background="light">
                <div class="s-catalog__container container">
                    <div class="s-catalog__title">Каталог продукции</div>
                    <div class="s-catalog__grid">
{{--                        s-catalog__col--wide--}}
                        @foreach($categories as $item)
                            <div class="s-catalog__col {{ $loop->iteration <= 3 ? 's-catalog__col--wide' : null }}">
                                <a class="catalog-card" href="{{ $item->url }}" title="{{ $item->name }}">
                                    <span class="catalog-card__title">{{ $item->name }}</span>
                                    <img class="catalog-card__pic lazy" src="/" data-src="{{ $item->image }}" width="220" height="210" alt="" />
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            @endif
            <section class="s-callback section lazy section--slide swiper-slide" data-bg="static/images/common/s-callback-bg.jpg" data-background="light">
                <div class="s-callback__container container">
                    <div class="s-callback__grid">
                        <div class="s-callback__col s-callback__col--picture">
                            <div class="s-callback__decor lazy" data-bg="static/images/common/man.png"></div>
                        </div>
                        <div class="s-callback__col">
                            <div class="s-callback__title">Нет времени на поиск в каталоге?</div>
                            <div class="s-callback__subtitle">Запроси обратный звонок!</div>
                            <div class="s-callback__text">Наш специалист подскажет по ассортименту и сделает лучшее предложение</div>
                            <div class="s-callback__action">
                                <button class="btn btn--primary btn-reset" type="button" data-popup data-src="#request" aria-label="Отправить заявку">
                                    <span>Отправить заявку</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="s-about section section--slide swiper-slide" data-background="light">
                <div class="s-about__grid">
                    <div class="s-about__col"></div>
                    <div class="s-about__col s-about__col--decor lazy" data-bg="static/images/common/s-about-bg.jpg"></div>
                    <div class="s-about__body">
                        <div class="s-about__title">Levering Ural</div>
                        <div class="s-about__subtitle">Комплексное снабжение строительных компаний</div>
                        <div class="s-about__content">
                            <p>Строительство имеет характерные отличия от других отраслей производства – по техническим, экономически и организационным признакам. Одну из ключевых ролей играет отдел материально-технического обеспечения, бесперебойная работа которого оказывает
                                влияние на процессы реализации строительных проектов по срокам и стоимости. Сэкономить на покупке стройматериалов можно — нужно только знать правильную тактику снижения накладных расходов.</p>
                            <p>Бесперебойная работа которого оказывает влияние на процессы реализации строительных проектов по срокам и стоимости. Сэкономить на покупке стройматериалов можно — нужно только знать правильную тактику снижения накладных расходов.</p>
                        </div>
                        <div class="s-about__action">
                            <a class="btn btn--white" href="javascript:void(0)" title="Подробнее о компании">
                                <span>Подробнее о компании</span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="s-delivery section section--slide swiper-slide" data-background="dark">
                <div class="s-delivery__container container">
                    <div class="s-delivery__title">География доставки</div>
                    <ul class="s-delivery__list list-reset">
                        <li class="s-delivery__list-item">Москва</li>
                        <li class="s-delivery__list-item">Санкт-Петербург</li>
                        <li class="s-delivery__list-item">Ростов-на-Дону</li>
                        <li class="s-delivery__list-item">Краснодар</li>
                        <li class="s-delivery__list-item">Волгоград</li>
                        <li class="s-delivery__list-item">Самара</li>
                        <li class="s-delivery__list-item">Нижний Новгород</li>
                        <li class="s-delivery__list-item">Новосибирск</li>
                        <li class="s-delivery__list-item">Уфа</li>
                        <li class="s-delivery__list-item">Челябинск</li>
                        <li class="s-delivery__list-item">Саратов</li>
                    </ul>
                    <div class="s-delivery__action">
                        <a class="btn btn--primary" href="{{ route('contacts') }}" title="Контакты">
                            <span>Контакты</span>
                        </a>
                    </div>
                </div>
                <div class="s-delivery__map-block">
                    <img class="s-delivery__map lazy" src="/" data-src="static/images/common/map.svg" width="1091" height="677" alt="">
                    <div class="s-delivery__office">
                        <img class="lazy" src="/" data-src="static/images/common/office.jpg" width="300" height="180" alt="">
                    </div>
                </div>
            </section>

            @include('blocks.footer')
        </div>
    </main>
@stop
