@extends('template')
@section('content')
    @include('blocks.bread')
    <main>
        <section class="section">
            <div class="section__container container">
                <button class="request-btn btn-reset" type="button" data-popup="data-popup" data-src="#request" aria-label="Запрос менеджеру">
                    <span class="request-btn__icon lazy" data-bg="static/images/common/ico_request.svg"></span>
                    <span class="request-btn__label">Запрос менеджеру</span>
                </button>
                <div class="section__title">Подкаталог</div>
                <div class="section__grid">
                    <div class="section__item">
                        <div class="catalog-item">
                            <a class="catalog-item__title" href="javascript:void(0)">ГЭМ</a>
                            <img class="catalog-item__pic lazy" src="/" data-src="static/images/common/subcat-1.png" width="152" height="114" alt="">
                            <ul class="catalog-item__list list-reset">
                                <li>
                                    <a href="javascript:void(0)">Лотки листовые ЛЛ</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Лотки лестничные НЛ</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Метрический крепёж ГЭМ</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Монтажные элементы ГЭМ</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="section__item">
                        <div class="catalog-item">
                            <a class="catalog-item__title" href="javascript:void(0)">СТАНДАРТ</a>
                            <img class="catalog-item__pic lazy" src="/" data-src="static/images/common/subcat-2.png" width="138" height="150" alt="">
                            <ul class="catalog-item__list list-reset">
                                <li>
                                    <a href="javascript:void(0)">Лотки листовые ST</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Лотки лестничные LT</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Лотки лестничные усиленные LHT</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Проволочные лотки RT</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Короба кабельные блочные</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Монтажные элементы</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Метрический крепеж</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="section__item">
                        <div class="catalog-item">
                            <a class="catalog-item__title" href="javascript:void(0)">PROMTRAY</a>
                            <img class="catalog-item__pic lazy" src="/" data-src="static/images/common/subcat-3.png" width="135" height="157" alt="">
                            <ul class="catalog-item__list list-reset">
                                <li>
                                    <a href="javascript:void(0)">Лотки листовые TS</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Лотки лестничные TL</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Лотки лестничные усиленные THL</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Монтажные элементы MP</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Метрический крепеж</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="section__block">
                    <div class="section__subtitle">Электричество</div>
                    <p>Кабеленесущие системы создаются таким образом, чтобы организовать, защитить и скрыть кабели, провода в них гораздо легче прокладывать и обслуживать, без проблем возможно наращивание кабельных трасс, их изменение и ремонт.</p>
                    <p>Кабеленесущие системы создаются таким образом, чтобы организовать, защитить и скрыть кабели, провода в них гораздо легче прокладывать и обслуживать, без проблем возможно наращивание кабельных трасс, их изменение и ремонт.</p>
                    <div class="block-request">
                        <button class="block-request__request btn-reset" type="button" data-popup="data-popup" data-src="#request" aria-label="Получить расчёт цены">
                            <span>Получить расчёт цены</span>
                        </button>
                        <div class="block-request__body">Получите детальный расчет чены на ваш строительный объект. Используйте запорную арматуру высокого качества. Детальную информацию можно получить в отделе продаж.</div>
                    </div>
                </div>
                <div class="section__block">
                    <div class="section__subtitle">Электричество</div>
                    <p>Кабеленесущие системы создаются таким образом, чтобы организовать, защитить и скрыть кабели, провода в них гораздо легче прокладывать и обслуживать, без проблем возможно наращивание кабельных трасс, их изменение и ремонт.</p>
                    <p>Кабеленесущие системы создаются таким образом, чтобы организовать, защитить и скрыть кабели, провода в них гораздо легче прокладывать и обслуживать, без проблем возможно наращивание кабельных трасс, их изменение и ремонт.</p>
                    <div class="block-request">
                        <button class="block-request__request btn-reset" type="button" data-popup="data-popup" data-src="#request" aria-label="Получить расчёт цены">
                            <span>Получить расчёт цены</span>
                        </button>
                        <div class="block-request__body">Получите детальный расчет чены на ваш строительный объект. Используйте запорную арматуру высокого качества. Детальную информацию можно получить в отделе продаж.</div>
                    </div>
                </div>
                <div class="section__block">
                    <div class="section__row">
                        <div class="section__content">
                            <div class="section__subtitle">Электричество</div>
                            <p>Кабеленесущие системы создаются таким образом, чтобы организовать, защитить и скрыть кабели, провода в них гораздо легче прокладывать и обслуживать, без проблем возможно наращивание кабельных трасс, их изменение и ремонт.</p>
                            <p>Кабеленесущие системы создаются таким образом, чтобы организовать, защитить и скрыть кабели, провода в них гораздо легче прокладывать и обслуживать, без проблем возможно наращивание кабельных трасс, их изменение и ремонт.</p>
                            <p>Кабеленесущие системы создаются таким образом, чтобы организовать, защитить и скрыть кабели, провода в них гораздо легче прокладывать и обслуживать, без проблем возможно наращивание кабельных трасс, их изменение и ремонт.</p>
                        </div>
                        <div class="section__aside">
                            <a class="b-aside" href="javascript:void(0)" title="Оптовый прайс-лист">
                                <div class="b-aside__currency">₽</div>
                                <div class="b-aside__label">Оптовый прайс-лист</div>
                                <div class="b-aside__text">Отправте заявку на получение прайс-листа на технические трубы ПНД - получите выгодные цены сейчас</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="s-request">
            <div class="s-request__container container">
                <div class="s-request__body">
                    <form class="s-request__content" action="#">
                        <div class="s-request__title">Нет времени на поиск в каталоге — Запроси консультацию</div>
                        <div class="s-request__text">Наш специалист подскажет по ассортименту и сделает лучшее предложение</div>
                        <div class="s-request__fields">
                            <label class="s-request__label">
                                <span data-required="*">Имя</span>
                                <input class="s-request__input" type="text" name="name" placeholder="Введите имя" required autocomplete="off">
                            </label>
                            <label class="s-request__label">
                                <span data-required="*">Телефон</span>
                                <input class="s-request__input" type="tel" name="phone" placeholder="Телефон" required autocomplete="off">
                            </label>
                            <label class="checkbox">
                                <input class="checkbox__input" type="checkbox" checked required>
                                <span class="checkbox__box"></span>
                                <span class="checkbox__policy">Согласен на обработку
										<a href="javascript:void(0)" target="_blank">персональных данных</a>
									</span>
                            </label>
                            <button class="btn btn--primary btn-reset" name="submit">
                                <span>Оставить заявку</span>
                            </button>
                        </div>
                    </form>
                    <div class="s-request__decor">
                        <img class="s-request__pic lazy" src="/" data-src="static/images/common/man-img.png" width="476" height="464" alt="">
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
