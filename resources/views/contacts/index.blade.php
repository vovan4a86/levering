@extends('template')
@section('content')
    @include('blocks.bread')
    <main>
        <section class="contacts">
            <div class="contacts__container container">
                <div class="contacts__grid">
                    <div class="contacts__about">
                        <div class="contacts__title">Контакты</div>
                        <div class="contacts__datalist">
                            <dl>
                                <dt>Адрес:</dt>
                                <dd>Россия, г. Екатеринбург,
                                    <br />ул. Енисейская, 39</dd>
                            </dl>
                            <dl>
                                <dt>E-mail:</dt>
                                <dd>
                                    <a href="mailto:zakaz@mail.ru">zakaz@mail.ru</a>
                                </dd>
                            </dl>
                            <dl>
                                <dt>Телефон:</dt>
                                <dd>
                                    <a href="tel:+78000000000">+7 (800) 000 00 00</a>
                                </dd>
                            </dl>
                            <dl>
                                <dt>Режим работы:</dt>
                                <dd>Пн - Вс: с 9:00 до 20:00</dd>
                            </dl>
                            <dl>
                                <dt>Пишите нам</dt>
                                <dd>
                                    <a class="contacts__msg-icon lazy" href="javascript:void(0)" data-bg="static/images/common/ico_tg.svg" target="_blank" title="Написать в Telegram"></a>
                                    <a class="contacts__msg-icon lazy" href="javascript:void(0)" data-bg="static/images/common/ico_wa.svg" target="_blank" title="Написать в Whatsapp"></a>
                                </dd>
                            </dl>
                        </div>
                        <div class="contacts__action">
                            <button class="btn btn--primary btn-reset" type="button" data-popup data-src="#consult" aria-label="Написать в форме обратной связи">
                                <span>Написать нам</span>
                            </button>
                        </div>
                    </div>
                    <div class="contacts__map" id="map" data-map data-lat="56.887364" data-long="60.499262" data-hint="г. Екатеринбург, ул. Енисейская, 39"></div>
                </div>
                <div class="contacts__data" x-data="{ dataIsOpen: false }">
                    <div class="contacts__subtitle">Реквизиты</div>
                    <div class="contacts__row">
                        <div class="contacts__column">
                            <div class="contacts__caption">Краткое наименование:</div>
                            <div class="contacts__value">ООО «ЛИВЕРИНГУРАЛ»</div>
                        </div>
                        <div class="contacts__column">
                            <div class="contacts__caption">Статус:</div>
                            <div class="contacts__value">Действующее предприятие</div>
                        </div>
                    </div>
                    <div class="contacts__row">
                        <div class="contacts__column">
                            <div class="contacts__caption">ИНН:</div>
                            <div class="contacts__value">0000000000</div>
                        </div>
                        <div class="contacts__column">
                            <div class="contacts__caption">КПП:</div>
                            <div class="contacts__value">000000000</div>
                        </div>
                    </div>
                    <div class="contacts__row">
                        <div class="contacts__column">
                            <div class="contacts__caption">ОГРН:</div>
                            <div class="contacts__value">0000000000000</div>
                        </div>
                        <div class="contacts__column">
                            <div class="contacts__caption">Дата образования:</div>
                            <div class="contacts__value">10 мая 2016</div>
                        </div>
                    </div>
                    <div class="contacts__row" x-show="dataIsOpen" x-transition.duration.250ms x-cloak>
                        <div class="contacts__column">
                            <div class="contacts__caption">Краткое наименование:</div>
                            <div class="contacts__value">ООО «ЛИВЕРИНГУРАЛ»</div>
                        </div>
                        <div class="contacts__column">
                            <div class="contacts__caption">Статус:</div>
                            <div class="contacts__value">Действующее предприятие</div>
                        </div>
                    </div>
                    <div class="contacts__row" x-show="dataIsOpen" x-transition.duration.250ms x-cloak>
                        <div class="contacts__column">
                            <div class="contacts__caption">ИНН:</div>
                            <div class="contacts__value">0000000000</div>
                        </div>
                        <div class="contacts__column">
                            <div class="contacts__caption">КПП:</div>
                            <div class="contacts__value">000000000</div>
                        </div>
                    </div>
                    <div class="contacts__row" x-show="dataIsOpen" x-transition.duration.250ms x-cloak>
                        <div class="contacts__column">
                            <div class="contacts__caption">ОГРН:</div>
                            <div class="contacts__value">0000000000000</div>
                        </div>
                        <div class="contacts__column">
                            <div class="contacts__caption">Дата образования:</div>
                            <div class="contacts__value">10 мая 2016</div>
                        </div>
                    </div>
                    <div class="contacts__action" @click="dataIsOpen = !dataIsOpen" aria-label="Развернуть">
                        <span x-show="!dataIsOpen">Развернуть</span>
                        <span x-show="dataIsOpen">Свернуть</span>
                    </div>
                </div>
            </div>
        </section>
    </main>
@stop