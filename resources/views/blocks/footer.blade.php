<footer class="footer section section--slide swiper-slide" data-background="light">
    <div class="footer__container container">
        <div class="footer__grid">
            <div class="footer__info">
                <!-- homepage ? block : link-->
                <div class="footer__logo lazy" data-bg="static/images/common/logo--black.svg"></div>
                <div class="footer__brand">© 2022. Levering Ural. Все права защищены</div>
                <a class="footer__policy" href="{{ route('policy') }}">Политика конфиденциальности</a>
            </div>
            <div class="footer__nav">
                <div class="footer__col">
                    @if(count($footerCatalog))
                    <div class="footer-nav">
                        <div class="footer-nav__title">Каталог</div>
                        <ul class="footer-nav__list list-reset">
                            @foreach($footerCatalog as $item)
                                <li class="footer-nav__item">
                                    <a class="footer-nav__link" href="{{ $item->url }}">{{ $item->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                <div class="footer__col">
                    @if(count($footerMenu))
                    <div class="footer-nav">
                        <div class="footer-nav__title">Компания</div>
                        <ul class="footer-nav__list list-reset">
                            @foreach($footerMenu as $item)
                                <li class="footer-nav__item">
                                    <a class="footer-nav__link" href="{{ $item->url }}">{{ $item->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
            <div class="footer__contacts">
                <div class="footer__calls">
                    <div class="footer__msg">
                        <a class="footer__msg-icon lazy" href="javascript:void(0)" data-bg="static/images/common/ico_tg.svg" target="_blank" title="Написать в Telegram"></a>
                        <a class="footer__msg-icon lazy" href="javascript:void(0)" data-bg="static/images/common/ico_wa.svg" target="_blank" title="Написать в Whatsapp"></a>
                    </div>
                    <a class="footer__phone" href="tel:+78000000000" title="Позвонить нам">+7 (800) 000 00 00</a>
                </div>
                <button class="footer__callback btn-reset" type="button" data-popup data-src="#callback" aria-label="Перезвоните мне">Перезвоните мне</button>
                <div class="footer__action">
                    <button class="btn btn--primary btn-reset" type="button" data-popup data-src="#request" aria-label="Оставить заявку">
                        <span>Оставить заявку</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</footer>

@include('blocks.mobile_nav')
@include('blocks.popups')

<div class="v-hidden" id="company" itemprop="branchOf" itemscope itemtype="https://schema.org/Corporation" aria-hidden="true" tabindex="-1">
    <article itemscope itemtype="https://schema.org/LocalBusiness" itemref="company">
        {{ Settings::get('schema.org') }}
    </article>
</div>

@include('blocks.cookie')