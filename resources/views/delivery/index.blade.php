@extends('template')
@section('content')
    @include('blocks.bread')
    <main>
        <section class="section">
            <div class="section__container container">
                <div class="section__title">Доставка и оплата</div>
                <div class="b-delivery" x-data="{ view: 'Доставка'}">
                    <div class="b-delivery__nav">
                        <div class="tabs">
                            <div class="tabs__item" :class="view == 'Доставка' &amp;&amp; 'is-active'" @click="view = 'Доставка'">Доставка</div>
                            @if(count($payments))
                            <div class="tabs__item" :class="view == 'Оплата' &amp;&amp; 'is-active'" @click="view = 'Оплата'">Оплата</div>
                            @endif
                        </div>
                    </div>
                    <div class="b-delivery__views">
                        <div class="b-delivery__view" x-show="view == 'Доставка'" x-transition.duration.500ms x-cloak>
                            <div class="b-delivery__grid">
                                <div class="b-delivery__block">
                                    <div class="b-delivery__head">
                                        <div class="b-delivery__title">Самовывоз</div>
                                        <div class="b-delivery__data">
                                            <div class="b-delivery__icon lazy" data-bg="static/images/common/ico_loc.svg"></div>
                                            <div class="b-delivery__info">Вы можете забрать на нашем складе по адресу:
                                                <div class="b-delivery__address">Россия, г. Екатеринбург, ул. Енисейская, 39</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="b-delivery__subtitle">Условия самовывоза:</div>
                                    <ul class="b-delivery__list list-reset">
                                        <li>Чтобы получить заказ, необходимо обратиться к сотруднику стойки информации и сообщить ему номер заказа.</li>
                                        <li>Уведомление о готовности заказа может осуществляться через SMS-сообщения, мессенджеры (Viber, WhatsApp и т.д.) и/или сообщения на электронную почту.</li>
                                    </ul>
                                </div>
                                <div class="b-delivery__block">
                                    <div class="b-delivery__head">
                                        <div class="b-delivery__title">Доставка</div>
                                        <div class="b-delivery__data">
                                            <div class="b-delivery__icon lazy" data-bg="static/images/common/ico_car.svg"></div>
                                            <div class="b-delivery__info">
                                                Для доставки заказа через транспортную компанию необходимо будет указать адрес доставки</div>
                                        </div>
                                    </div>
                                    <div class="b-delivery__subtitle">Условия доставки:</div>
                                    <ul class="b-delivery__list list-reset">
                                        <li>Чтобы получить заказ, необходимо обратиться к сотруднику стойки информации и сообщить ему номер заказа.</li>
                                        <li>Уведомление о готовности заказа может осуществляться через SMS-сообщения, мессенджеры (Viber, WhatsApp и т.д.) и/или сообщения на электронную почту.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @if(count($payments))
                        <div class="b-delivery__view" x-show="view == 'Оплата'" x-transition.duration.500ms x-cloak>
                            @foreach($payments as $row)
                            <div class="b-delivery__row">
                                @foreach($row as $item)
                                <div class="b-delivery__block">
                                    <div class="b-delivery__title">{{ $item->name }}</div>
                                    <div class="b-delivery__body">{{ $item->description }}</div>
                                </div>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
