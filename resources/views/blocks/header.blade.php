<!--
    class=(homepage && "header--home")
    class=(landingPage && "header--landing")
    class=(innerPage && "header--inner")
-->
{{--<header class="header --}}
<header class="header {{ Request::url() == route('main') ? 'header--home' : null }}
        {{ isset($innerPage) ? 'header--inner' : null }}
        {{ isset($landingPage) ? 'header--landing' : null }}">
    <div class="header__top">
        <div class="header__container container">
            <div class="header__row">
                <div class="header__col">
                    <!-- homepage ? block : link-->
                    <!-- innerPage ? "logo--solid.svg" : "logo.svg"-->
                    <div class="header__logo lazy" data-bg="/static/images/common/{{ isset($innerPage) ? 'logo--solid.svg' : 'logo.svg' }}"></div>
                    @if(count($topMenu))
                    <nav class="header__nav">
                        <ul class="header__nav-list list-reset">
                            @foreach($topMenu as $item)
                            <li class="header__nav-item">
                                <a class="header__nav-link" href="{{ $item->url }}">{{ $item->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </nav>
                    @endif
                </div>
                <div class="header__col">
                    <button class="header__callback btn-reset" type="button" data-popup data-src="#callback" aria-label="Перезвоните мне">Перезвоните мне</button>
                    <div class="header__msg">
                        <a class="header__msg-icon lazy" href="javascript:void(0)" data-bg="/static/images/common/ico_tg.svg" target="_blank" title="Написать в Telegram"></a>
                        <a class="header__msg-icon lazy" href="javascript:void(0)" data-bg="/static/images/common/ico_wa.svg" target="_blank" title="Написать в Whatsapp"></a>
                    </div>
                    <a class="header__phone" href="tel:+78000000000" title="Позвонить нам">+7 (800) 000 00 00</a>
                    <button class="header__burger btn-reset" type="button" aria-label="Открыть меню">
                        <span class="iconify" data-icon="charm:menu-hamburger" data-width="40"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="header__body">
        <div class="header__container container">
            <div class="header__content">
                <div class="header__catalog">
                    <button class="catalog-btn btn-reset" type="button" aria-label="Открыть каталог" @click="menuIsOpen = !menuIsOpen" :class="menuIsOpen &amp;&amp; 'is-active'">
                        <span class="catalog-btn__icon lazy" data-bg="/static/images/common/ico_catalog.svg"></span>
                        <span class="catalog-btn__label">Каталог</span>
                    </button>
                </div>
                <div class="header__search">
                    <form class="search-field" action="#">
                        <!-- innerPage ? "ico_loupe--grey.svg" : "ico_loupe.svg"-->
                        <button class="search-field__btn btn-reset lazy" data-bg="/static/images/common/{{ isset($innerPage) ? 'ico_loupe--grey.svg' : 'ico_loupe.svg' }}" name="submit" aria-label="Найти"></button>
                        <input class="search-field__input input-reset" type="search" name="search" placeholder="Что Вы ищете?" required autocomplete="off">
                    </form>
                </div>
                <!-- innerPage ? "ico_basket--black.svg" : "ico_basket.svg"-->
                <a class="header__basket lazy" data-bg="/static/images/common/{{ isset($innerPage) ? 'ico_basket--black.svg' : 'ico_basket.svg' }}" href="javascript:void(0)" title="Перейти в корзину"></a>
            </div>
        </div>
        <div class="header__dropdown">
            <div class="o-nav" x-show="menuIsOpen" @click.away="menuIsOpen = false" x-transition.duration.300ms x-cloak>
                <!-- current — какое меню показано по-умолчанию-->
                <div class="o-nav__container container" x-data="{current: 'Кабельная продукция'}">
                    <!-- o-nav__aside-->
                    <div class="o-nav__aside">
                        <!-- o-link-->
                        <div class="o-link" :class="current == 'Кабельная продукция' &amp;&amp; 'is-active'" @click="current = 'Кабельная продукция'" aria-label="Кабельная продукция">
                            <div class="o-link__label">Кабельная продукция</div>
                            <div class="o-link__icon lazy" data-bg="/static/images/common/ico_link.svg"></div>
                        </div>
                        <!-- o-link-->
                        <div class="o-link" :class="current == 'Кабеленесущие системы' &amp;&amp; 'is-active'" @click="current = 'Кабеленесущие системы'" aria-label="Кабеленесущие системы">
                            <div class="o-link__label">Кабеленесущие системы</div>
                            <div class="o-link__icon lazy" data-bg="/static/images/common/ico_link.svg"></div>
                        </div>
                        <!-- o-link-->
                        <div class="o-link" :class="current == 'Теплоизоляция' &amp;&amp; 'is-active'" @click="current = 'Теплоизоляция'" aria-label="Теплоизоляция">
                            <div class="o-link__label">Теплоизоляция</div>
                            <div class="o-link__icon lazy" data-bg="/static/images/common/ico_link.svg"></div>
                        </div>
                        <!-- o-link-->
                        <div class="o-link" :class="current == 'Промышленное освещение' &amp;&amp; 'is-active'" @click="current = 'Промышленное освещение'" aria-label="Промышленное освещение">
                            <div class="o-link__label">Промышленное освещение</div>
                            <div class="o-link__icon lazy" data-bg="/static/images/common/ico_link.svg"></div>
                        </div>
                        <!-- o-link-->
                        <div class="o-link" :class="current == 'Водосточные системы' &amp;&amp; 'is-active'" @click="current = 'Водосточные системы'" aria-label="Водосточные системы">
                            <div class="o-link__label">Водосточные системы</div>
                            <div class="o-link__icon lazy" data-bg="/static/images/common/ico_link.svg"></div>
                        </div>
                        <!-- o-link-->
                        <div class="o-link" :class="current == 'Трубы для инженерных систем' &amp;&amp; 'is-active'" @click="current = 'Трубы для инженерных систем'" aria-label="Трубы для инженерных систем">
                            <div class="o-link__label">Трубы для инженерных систем</div>
                            <div class="o-link__icon lazy" data-bg="/static/images/common/ico_link.svg"></div>
                        </div>
                        <!-- o-link-->
                        <div class="o-link" :class="current == 'Аренда спецтехники' &amp;&amp; 'is-active'" @click="current = 'Аренда спецтехники'" aria-label="Аренда спецтехники">
                            <div class="o-link__label">Аренда спецтехники</div>
                            <div class="o-link__icon lazy" data-bg="/static/images/common/ico_link.svg"></div>
                        </div>
                    </div>
                    <!-- o-nav__body-->
                    <div class="o-nav__body">
                        <!-- o-nav__view-->
                        <div class="o-nav__view" x-show="current == 'Кабельная продукция'">
                            <ul class="o-nav__list list-reset">
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
                                <li>
                                    <a href="javascript:void(0)">Кабели контрольные</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Кабели связи</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Кабели сигнальные огнестойкие</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Кабели силовые с бумажной изоляцией</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Кабели управления</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Провода для воздушных линий</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Провода изолированные самонесущие</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Провода обмоточные</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Провода установочные</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Радиочастотный кабель (коаксиальный)</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Судовой кабель</a>
                                </li>
                            </ul>
                        </div>
                        <!-- o-nav__view-->
                        <div class="o-nav__view" x-show="current == 'Кабеленесущие системы'">
                            <div class="o-nav__columns">
                                <ul class="o-nav__biglist list-reset">
                                    <li>
                                        <a class="o-nav__subtitle" href="javascript:void(0)">ГЭМ</a>
                                    </li>
                                    <li>
                                        <a class="o-nav__sublink" href="javascript:void(0)">Лотки листовые ЛЛ</a>
                                    </li>
                                    <li>
                                        <a class="o-nav__sublink" href="javascript:void(0)">Лотки лестничные НЛ</a>
                                    </li>
                                    <li>
                                        <a class="o-nav__sublink" href="javascript:void(0)">Метрический крепёж ГЭМ</a>
                                    </li>
                                    <li>
                                        <a class="o-nav__sublink" href="javascript:void(0)">Монтажные элементы ГЭМ</a>
                                    </li>
                                </ul>
                                <ul class="o-nav__biglist list-reset">
                                    <li>
                                        <a class="o-nav__subtitle" href="javascript:void(0)">СТАНДАРТ</a>
                                    </li>
                                    <li>
                                        <a class="o-nav__sublink" href="javascript:void(0)">Лотки листовые ST</a>
                                    </li>
                                    <li>
                                        <a class="o-nav__sublink" href="javascript:void(0)">Лотки лестничные LT</a>
                                    </li>
                                    <li>
                                        <a class="o-nav__sublink" href="javascript:void(0)">Лотки лестничные усиленные LHT</a>
                                    </li>
                                    <li>
                                        <a class="o-nav__sublink" href="javascript:void(0)">Проволочные лотки RT</a>
                                    </li>
                                    <li>
                                        <a class="o-nav__sublink" href="javascript:void(0)">Короба кабельные блочные</a>
                                    </li>
                                    <li>
                                        <a class="o-nav__sublink" href="javascript:void(0)">Монтажные элементы</a>
                                    </li>
                                    <li>
                                        <a class="o-nav__sublink" href="javascript:void(0)">Метрический крепеж</a>
                                    </li>
                                </ul>
                                <ul class="o-nav__biglist list-reset">
                                    <li>
                                        <a class="o-nav__subtitle" href="javascript:void(0)">PROMTRAY</a>
                                    </li>
                                    <li>
                                        <a class="o-nav__sublink" href="javascript:void(0)">Лотки листовые TS</a>
                                    </li>
                                    <li>
                                        <a class="o-nav__sublink" href="javascript:void(0)">Лотки лестничные TL</a>
                                    </li>
                                    <li>
                                        <a class="o-nav__sublink" href="javascript:void(0)">Лотки лестничные усиленные THL</a>
                                    </li>
                                    <li>
                                        <a class="o-nav__sublink" href="javascript:void(0)">Монтажные элементы MP</a>
                                    </li>
                                    <li>
                                        <a class="o-nav__sublink" href="javascript:void(0)">Метрический крепеж</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- o-nav__view-->
                        <div class="o-nav__view" x-show="current == 'Теплоизоляция'">
                            <ul class="o-nav__list list-reset">
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
                                <li>
                                    <a href="javascript:void(0)">Архитектурное освещение</a>
                                </li>
                            </ul>
                        </div>
                        <!-- o-nav__view-->
                        <div class="o-nav__view" x-show="current == 'Промышленное освещение'">
                            <ul class="o-nav__list list-reset">
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
                                <li>
                                    <a href="javascript:void(0)">Вспененный полиэтилен</a>
                                </li>
                            </ul>
                        </div>
                        <!-- o-nav__view-->
                        <div class="o-nav__view" x-show="current == 'Водосточные системы'">
                            <ul class="o-nav__list list-reset">
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
                                <li>
                                    <a href="javascript:void(0)">Vortex Lite Matt</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Vortex Project</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Vortex Mix</a>
                                </li>
                            </ul>
                        </div>
                        <!-- o-nav__view-->
                        <div class="o-nav__view" x-show="current == 'Трубы для инженерных систем'">
                            <ul class="o-nav__list list-reset">
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
                                <li>
                                    <a href="javascript:void(0)">Трубы ПП гофрированные</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Трубы ПА гофрированные</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Трубы ПВХ жесткие</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Коробки электромонтажные</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Аксессуары для труб</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Трубы НПВХ обсадные для скважин</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Трубы ПНД технические безнапорные</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Трубы ЗПТ защитные пластмассовые</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Трубы ПВХ канализационные наружные</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Трубы ПВХ канализационные внутренние</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Трубы ПНД гофрированные двустенные</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Фитинги ПЭ 100</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Трубы ПНД дренажные гофрированные</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Кабель-каналы</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Колодцы кабельные</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Трубы хризотилцементные напорные (ВТ, ТТ)</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Трубы ПНД канализационные гофрированные</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Трубы ПП канализационные гофрированные</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Трубы ПП дренажные гофрированные</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Металлорукав</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Трубы хризотилцементные безнапорные (БНТ)</a>
                                </li>
                            </ul>
                        </div>
                        <!-- o-nav__view-->
                        <div class="o-nav__view" x-show="current == 'Аренда спецтехники'">
                            <ul class="o-nav__list list-reset">
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
                                <li>
                                    <a href="javascript:void(0)">Бульдозеры</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Катки</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Трактор с щеткой</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Автокомпрессор</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Ямобуры</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Тралы</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Гидромолот</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Дизельные генераторы DCA</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>