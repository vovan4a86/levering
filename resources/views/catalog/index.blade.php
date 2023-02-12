@extends('template')
@section('content')
    @include('blocks.bread')
    <main>
        <section class="section">
            <div class="section__container container">
                <button class="request-btn btn-reset" type="button" data-popup="data-popup" data-src="#request"
                        aria-label="Запрос менеджеру">
                    <span class="request-btn__icon lazy" data-bg="static/images/common/ico_request.svg"></span>
                    <span class="request-btn__label">Запрос менеджеру</span>
                </button>
                <div class="section__title">Каталог</div>
                <div class="section__grid">
                    <div class="section__item">
                        <div class="catalog-item">
                            <a class="catalog-item__title" href="javascript:void(0)">Кабельная продукция</a>
                            <img class="catalog-item__pic lazy" src="/" data-src="static/images/common/catalog-1.png"
                                 width="86" height="111" alt="">
                            <ul class="catalog-item__list list-reset">
                                <li>
                                    <a href="javascript:void(0)">Кабели силовые с ПВХ изоляцией</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Кабели гибкие с резиновой изоляцией</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Авиационный провод</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Автомобильный провод</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Волоконно-оптический кабель</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Кабели бронированные</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Кабели и провода монтажные</a>
                                </li>
                            </ul>
                            <div class="catalog-item__action">
                                <a class="catalog-item__link" href="javascript:void(0)" title="Кабельная продукция">
                                    <span>Все подкатегории</span>
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.4375 11H18.5625" stroke="currentColor" stroke-width="1.5"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12.375 4.8125L18.5625 11L12.375 17.1875" stroke="currentColor"
                                              stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="section__item">
                        <div class="catalog-item">
                            <a class="catalog-item__title" href="javascript:void(0)">Кабеленесущие системы</a>
                            <img class="catalog-item__pic lazy" src="/" data-src="static/images/common/catalog-2.png"
                                 width="116" height="127" alt="">
                            <ul class="catalog-item__list list-reset">
                                <li>
                                    <a href="javascript:void(0)">ГЭМ</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">СТАНДАРТ</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">PROMTRAY</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="section__item">
                        <div class="catalog-item">
                            <a class="catalog-item__title" href="javascript:void(0)">Промышленное освещение</a>
                            <img class="catalog-item__pic lazy" src="/" data-src="static/images/common/catalog-3.png"
                                 width="110" height="155" alt="">
                            <ul class="catalog-item__list list-reset">
                                <li>
                                    <a href="javascript:void(0)">Наружное освещение</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Производственное освещение</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Светильники для АЗС</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Взрывозащищенные светильники</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Парковое освещение</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Освещение для ЖКХ</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Освещение для офисов</a>
                                </li>
                            </ul>
                            <div class="catalog-item__action">
                                <a class="catalog-item__link" href="javascript:void(0)" title="Промышленное освещение">
                                    <span>Все подкатегории</span>
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.4375 11H18.5625" stroke="currentColor" stroke-width="1.5"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12.375 4.8125L18.5625 11L12.375 17.1875" stroke="currentColor"
                                              stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="section__item">
                        <div class="catalog-item">
                            <a class="catalog-item__title" href="javascript:void(0)">Теплоизоляция</a>
                            <img class="catalog-item__pic lazy" src="/" data-src="static/images/common/catalog-4.png"
                                 width="114" height="128" alt="">
                            <ul class="catalog-item__list list-reset">
                                <li>
                                    <a href="javascript:void(0)">Базальтовая теплоизоляция</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Минеральная теплоизоляция (кварц)</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Экструдированный пенополистирол</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Джут, пакля</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="section__item">
                        <div class="catalog-item">
                            <a class="catalog-item__title" href="javascript:void(0)">Водосточные системы</a>
                            <img class="catalog-item__pic lazy" src="/" data-src="static/images/common/catalog-5.png"
                                 width="127" height="147" alt="">
                            <ul class="catalog-item__list list-reset">
                                <li>
                                    <a href="javascript:void(0)">Grand Line 125/90</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Grand Line 150/100</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Optima круглый 125/90</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Optima круглый 150/100</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Vortex прямоугольный</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Vortex прямоугольный Matt</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Vortex Lite</a>
                                </li>
                            </ul>
                            <div class="catalog-item__action">
                                <a class="catalog-item__link" href="javascript:void(0)" title="Водосточные системы">
                                    <span>Все подкатегории</span>
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.4375 11H18.5625" stroke="currentColor" stroke-width="1.5"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12.375 4.8125L18.5625 11L12.375 17.1875" stroke="currentColor"
                                              stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="section__item">
                        <div class="catalog-item">
                            <a class="catalog-item__title" href="javascript:void(0)">Трубы для строительства инженерных
                                систем</a>
                            <img class="catalog-item__pic lazy" src="/" data-src="static/images/common/catalog-6.png"
                                 width="105" height="115" alt="">
                            <ul class="catalog-item__list list-reset">
                                <li>
                                    <a href="javascript:void(0)">Трубы ПЭ 100 газовые ГОСТ Р 58121.2-2018</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Ленты сигнальные</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Трубы ПНД обсадные для скважин</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Плиты ПЗК для закрытия кабеля</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Трубы ПЭ 100 питьевые ГОСТ 18599-2001</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Трубы ПВХ гофрированные</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Трубы ПНД гофрированные</a>
                                </li>
                            </ul>
                            <div class="catalog-item__action">
                                <a class="catalog-item__link" href="javascript:void(0)"
                                   title="Трубы для строительства инженерных систем">
                                    <span>Все подкатегории</span>
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.4375 11H18.5625" stroke="currentColor" stroke-width="1.5"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12.375 4.8125L18.5625 11L12.375 17.1875" stroke="currentColor"
                                              stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="section__item">
                        <div class="catalog-item">
                            <a class="catalog-item__title" href="javascript:void(0)">Аренда спецтехники</a>
                            <img class="catalog-item__pic lazy" src="/" data-src="static/images/common/catalog-7.png"
                                 width="130" height="178" alt="">
                            <ul class="catalog-item__list list-reset">
                                <li>
                                    <a href="javascript:void(0)">Экскаваторы-погрузчики</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Экскаваторы</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Фронтальные погрузчики</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Самосвалы</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Автокраны</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Манипуляторы</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Автовышки</a>
                                </li>
                            </ul>
                            <div class="catalog-item__action">
                                <a class="catalog-item__link" href="javascript:void(0)" title="Аренда спецтехники">
                                    <span>Все подкатегории</span>
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.4375 11H18.5625" stroke="currentColor" stroke-width="1.5"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12.375 4.8125L18.5625 11L12.375 17.1875" stroke="currentColor"
                                              stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section__block">
                    <div class="section__subtitle">{{ $h1 }}</div>
                    {!! $text !!}
                    @include('blocks.send_detail_count')
                </div>
            </div>
        </section>
        @include('blocks.send_request_conultation')
    </main>
@endsection
