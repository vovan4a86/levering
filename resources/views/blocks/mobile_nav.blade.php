<div class="mob-nav" id="mobile-nav">
    <ul class="mob-nav__list mob-nav__list--first">
        <li class="mob-nav__item" data-nav-highlight>
            <a class="mob-nav__link" href="{{ route('main') }}">Главная</a>
        </li>
        <li class="mob-nav__item">
            <a class="mob-nav__link" href="{{ route('catalog.index') }}">Каталог</a>
            <ul>
                @foreach($mainMenuCats as $mItem)
                    <li class="mob-nav__item">
                        <a class="mob-nav__link" href="{{ $mItem->url }}">{{ $mItem->name }}</a>
                        @if($mItem->public_children)
                            <ul>
                                @foreach($mItem->public_children as $child)
                                    <li class="mob-nav__item">
                                        <a class="mob-nav__link" href="{{ $child->url }}">{{ $child->name }}</a>
                                        @if($child->public_children)
                                            <ul>
                                                @foreach($child->public_children as $grandchild)
                                                    <li class="mob-nav__item">
                                                        <a class="_link"
                                                           href="{{ $grandchild->url }}">{{ $grandchild->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </li>
        @if(count($mobileMenu))
            <li class="mob-nav__item">
                <a class="mob-nav__link" href="javascript:void(0)">Покупателям</a>
                <ul>
                    @foreach($mobileMenu as $mItem)
                        <li class="mob-nav__item">
                            <a class="_link" href="{{ $mItem->url }}">{{ $mItem->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endif
        <li class="mob-nav__item">
            <a class="mob-nav__link" href="{{ route('contacts') }}">Контакты</a>
        </li>
    </ul>
    <ul class="mob-nav__list mob-nav__list--second">
        @if(Settings::get('header_phone'))
            <li class="mob-nav__item">
                <a class="mob-nav__link mob-nav__link--phone"
                   href="tel:{{ preg_replace('/[^\d+]/', '', Settings::get('header_phone')) }}">{{ Settings::get('header_phone') }}</a>
            </li>
        @endif
        @if(Settings::get('header_email'))
            <li class="mob-nav__item">
                <a class="mob-nav__link mob-nav__link--email" href="mailto:{{ Settings::get('header_email') }}">
                    <svg class="svg-sprite-icon icon-email">
                        <use xlink:href="/static/images/sprite/symbol/sprite.svg#email"></use>
                    </svg>
                    {{ Settings::get('header_email') }}</a>
            </li>
        @endif
        <li class="mob-nav__item">
            <button class="mob-nav__link mob-nav__link--callback btn-reset" type="button" data-open-callback>
                <span>Заказать звонок</span>
            </button>
        </li>
    </ul>
    <ul class="mob-nav__list mob-nav__list--bottom">
        @if(Settings::get('header_whatsapp'))
            <li class="mob-nav__item">
                <a class="_link"
                   href="https://wa.me/{{ preg_replace('/[^\d+]/', '', Settings::get('header_whatsapp')) }}">
                    <svg class="svg-sprite-icon icon-whatsapp">
                        <use xlink:href="/static/images/sprite/symbol/sprite.svg#whatsapp"></use>
                    </svg>
                </a>
            </li>
        @endif
        @if(Settings::get('header_telegram'))
            <li class="mob-nav__item">
                <a class="_link"
                   href="https://t.me/{{ preg_replace('/[^\d+]/', '', Settings::get('header_telegram')) }}">
                    <svg class="svg-sprite-icon icon-telegram">
                        <use xlink:href="/static/images/sprite/symbol/sprite.svg#telegram"></use>
                    </svg>
                </a>
            </li>
        @endif
    </ul>
</div>
