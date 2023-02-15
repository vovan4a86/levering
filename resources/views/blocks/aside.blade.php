<div class="layout__aside">
    <aside class="aside">
        <div class="aside__nav">
            <div class="aside-nav">
                @foreach($catalogMenu as $item)
                    <div class="aside-nav__item">
                        <div class="aside-nav__head" data-aside-head>
                            <div class="aside-nav__title">{{ $item->name }}</div>
                            <div class="aside-nav__icon lazy"
                                 data-bg="/static/images/common/ico_aside.svg"></div>
                        </div>
                        @if($item->children)
                            <div class="aside-nav__body" data-aside-body>
                                <ul class="aside-nav__list list-reset">
                                    @foreach($item->children as $child)
                                        <li>
                                            <a href="{{ $child->url }}" data-aside-link>
                                                {{ $child->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        <div class="aside__request">
            <div class="aside-request lazy" data-bg="/static/images/common/aside-request-bg.jpg">
                <div class="aside-request__title">Нет времени на поиск в каталоге — Запроси консультацию
                </div>
                <div class="aside-request__text">Наш специалист подскажет по ассортименту и сделает лучшее
                    предложение
                </div>
                <div class="aside-request__action">
                    <button class="btn btn--primary btn--small btn-reset" type="button" data-popup
                            data-src="#request" aria-label="Оставить заявку">
                        <span>Оставить заявку</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="aside__text">Наша главная цель – снабжение строительных объектов квалифицированной
            рабочей силой и надежной продукцией, которая будет служить долгие десятилетия.
        </div>
    </aside>
</div>
