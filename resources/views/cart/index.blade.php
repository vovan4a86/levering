@extends('template')
@section('content')
    <title>Корзина</title>
    <main>
        <section class="cart">
            <form class="cart__container container" action="#">
                <div class="cart__row">
                    <div class="cart__title">Корзина</div>
                    <button class="cart__trash btn-reset" type="button" aria-label="Очистить коризну">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.5625 4.8125L3.4375 4.81251" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M8.9375 8.9375V14.4375" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M13.0625 8.9375V14.4375" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M17.1875 4.8125V17.875C17.1875 18.0573 17.1151 18.2322 16.9861 18.3611C16.8572 18.4901 16.6823 18.5625 16.5 18.5625H5.5C5.31766 18.5625 5.1428 18.4901 5.01386 18.3611C4.88493 18.2322 4.8125 18.0573 4.8125 17.875V4.8125" stroke="currentColor"
                                  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M14.4375 4.8125V3.4375C14.4375 3.07283 14.2926 2.72309 14.0348 2.46523C13.7769 2.20737 13.4272 2.0625 13.0625 2.0625H8.9375C8.57283 2.0625 8.22309 2.20737 7.96523 2.46523C7.70737 2.72309 7.5625 3.07283 7.5625 3.4375V4.8125" stroke="currentColor"
                                  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>Очистить корзину</span>
                    </button>
                </div>
                <div class="c-order">
                    <!-- row row--head-->
                    <div class="c-order__row c-order__row--head">
                        <div class="c-order__col c-order__col--col-1">
                            <div class="c-order__label">Фото</div>
                        </div>
                        <div class="c-order__col">
                            <div class="c-order__label">Наименование</div>
                        </div>
                        <div class="c-order__col c-order__col--col-2">
                            <div class="c-order__label">Цена</div>
                        </div>
                        <div class="c-order__col c-order__col--col-2">
                            <div class="c-order__label">Количество</div>
                        </div>
                        <div class="c-order__col c-order__col--col-2">
                            <div class="c-order__label">Сумма</div>
                        </div>
                    </div>
                    <!-- row row--body-->
                    <div class="c-order__row c-order__row--body">
                        <div class="c-order__col c-order__col--col-1">
                            <a href="javascript:void(0)">
                                <img class="c-order__pic lazy" src="/" data-src="static/images/common/cart-img.png" width="94" height="74" alt="">
                            </a>
                        </div>
                        <div class="c-order__col">
                            <div class="c-order__product">Комплект Gidrolica Light: лоток водоотводный ЛВ-10.11,5.9,5 - пластиковый с решеткой РВ -10.10,8.100 стальной оцинкованной, кл. A15</div>
                        </div>
                        <div class="c-order__col c-order__col--col-2">
                            <div class="c-order__price">744.10 ₽
                                <span>/ шт</span>
                            </div>
                        </div>
                        <div class="c-order__col c-order__col--col-2">
                            <div class="counter" data-counter="data-counter">
                                <button class="counter__btn counter__btn--prev btn-reset" type="button" aria-label="Меньше">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_657_3899)">
                                            <path d="M13.0454 5.73724H0.954545C0.427635 5.73724 0 6.16488 0 6.69179V7.32811C0 7.85503 0.427635 8.28266 0.954545 8.28266H13.0454C13.5723 8.28266 14 7.85503 14 7.32811V6.69179C14 6.16488 13.5723 5.73724 13.0454 5.73724Z" fill="#BDBDBD" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_657_3899">
                                                <rect width="14" height="14" rx="4" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>

                                </button>
                                <input class="counter__input" type="number" name="count" value="1" data-count="data-count" />
                                <button class="counter__btn counter__btn--next btn-reset" type="button" aria-label="Больше">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_657_3897)">
                                            <path d="M12.75 5.75H8.5C8.36194 5.75 8.25 5.63806 8.25 5.5V1.25C8.25 0.559692 7.69031 0 7 0C6.30969 0 5.75 0.559692 5.75 1.25V5.5C5.75 5.63806 5.63806 5.75 5.5 5.75H1.25C0.559692 5.75 0 6.30969 0 7C0 7.69031 0.559692 8.25 1.25 8.25H5.5C5.63806 8.25 5.75 8.36194 5.75 8.5V12.75C5.75 13.4403 6.30969 14 7 14C7.69031 14 8.25 13.4403 8.25 12.75V8.5C8.25 8.36194 8.36194 8.25 8.5 8.25H12.75C13.4403 8.25 14 7.69031 14 7C14 6.30969 13.4403 5.75 12.75 5.75Z"
                                                  fill="#BDBDBD" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_657_3897">
                                                <rect width="14" height="14" rx="4" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>

                                </button>
                            </div>
                        </div>
                        <div class="c-order__col c-order__col--col-2">
                            <div class="c-order__price">744.10 ₽</div>
                            <button class="c-order__delete btn-reset" type="button" aria-label="Удалить">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.1875 4.8125L4.8125 17.1875" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M17.1875 17.1875L4.8125 4.8125" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>

                            </button>
                        </div>
                    </div>
                    <!-- row row--body-->
                    <div class="c-order__row c-order__row--body">
                        <div class="c-order__col c-order__col--col-1">
                            <a href="javascript:void(0)">
                                <img class="c-order__pic lazy" src="/" data-src="static/images/common/cart-img.png" width="94" height="74" alt="">
                            </a>
                        </div>
                        <div class="c-order__col">
                            <div class="c-order__product">Комплект Gidrolica Light: лоток водоотводный ЛВ-10.11,5.9,5 - пластиковый с решеткой РВ -10.10,8.100 стальной оцинкованной, кл. A15</div>
                        </div>
                        <div class="c-order__col c-order__col--col-2">
                            <div class="c-order__out">По запросу</div>
                        </div>
                        <div class="c-order__col c-order__col--col-2">
                            <div class="counter" data-counter="data-counter">
                                <button class="counter__btn counter__btn--prev btn-reset" type="button" aria-label="Меньше">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_657_3899)">
                                            <path d="M13.0454 5.73724H0.954545C0.427635 5.73724 0 6.16488 0 6.69179V7.32811C0 7.85503 0.427635 8.28266 0.954545 8.28266H13.0454C13.5723 8.28266 14 7.85503 14 7.32811V6.69179C14 6.16488 13.5723 5.73724 13.0454 5.73724Z" fill="#BDBDBD" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_657_3899">
                                                <rect width="14" height="14" rx="4" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>

                                </button>
                                <input class="counter__input" type="number" name="count" value="1" data-count="data-count" />
                                <button class="counter__btn counter__btn--next btn-reset" type="button" aria-label="Больше">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_657_3897)">
                                            <path d="M12.75 5.75H8.5C8.36194 5.75 8.25 5.63806 8.25 5.5V1.25C8.25 0.559692 7.69031 0 7 0C6.30969 0 5.75 0.559692 5.75 1.25V5.5C5.75 5.63806 5.63806 5.75 5.5 5.75H1.25C0.559692 5.75 0 6.30969 0 7C0 7.69031 0.559692 8.25 1.25 8.25H5.5C5.63806 8.25 5.75 8.36194 5.75 8.5V12.75C5.75 13.4403 6.30969 14 7 14C7.69031 14 8.25 13.4403 8.25 12.75V8.5C8.25 8.36194 8.36194 8.25 8.5 8.25H12.75C13.4403 8.25 14 7.69031 14 7C14 6.30969 13.4403 5.75 12.75 5.75Z"
                                                  fill="#BDBDBD" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_657_3897">
                                                <rect width="14" height="14" rx="4" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>

                                </button>
                            </div>
                        </div>
                        <div class="c-order__col c-order__col--col-2">
                            <div class="c-order__price">0,00 ₽</div>
                            <button class="c-order__delete btn-reset" type="button" aria-label="Удалить">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.1875 4.8125L4.8125 17.1875" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M17.1875 17.1875L4.8125 4.8125" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>

                            </button>
                        </div>
                    </div>
                    <!-- footer-->
                    <div class="c-order__footer">
                        <div class="c-order__total">Итого:</div>
                        <div class="c-order__value">744.10 ₽</div>
                        <div class="c-order__count">/ шт</div>
                    </div>
                </div>
                <div class="cart__infos">
                    <div class="order-block">
                        <div class="order-block__title">1. Контактная информация</div>
                        <div class="order-block__grid">
                            <div class="order-block__col">
                                <div class="order-block__fields">
                                    <label class="label-form">
                                        <span data-required="*">Имя</span>
                                        <input class="label-form__input" type="text" name="name" placeholder="Введите имя" required utocomplete="off">
                                    </label>
                                    <label class="label-form">
                                        <span data-required="*">Телефон</span>
                                        <input class="label-form__input" type="tel" name="phone" placeholder="+7 (___) ___-__-__" required autocomplete="off">
                                    </label>
                                    <label class="label-form">
                                        <span>Email</span>
                                        <input class="label-form__input" type="text" name="email" placeholder="Введите email" autocomplete="off">
                                    </label>
                                    <label class="label-form">
                                        <span data-required="*">Наименование организации</span>
                                        <input class="label-form__input" type="tel" name="phone" placeholder="Введите наименование организации" required autocomplete="off">
                                    </label>
                                </div>
                            </div>
                            <div class="order-block__col">
                                <div class="order-block__text">
                                    <p>Проверьте, пожалуйста, еще раз комплектацию вашего заказа.При необходимости измените заказ.</p>
                                    <p>Если у вас есть дополнительные вопросы или пожелания связанные с организацией доставки в вашу сторону, пожалуйста, воспользуйтесь полем дополнительные комментарии. Вслучае необходимости мы свяжемся с вами.</p>
                                    <p>
                                        <strong>Обращаем Ваше внимание! Работаем только с юридическими лицами.</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order-block" x-data="{ delivery: true}">
                        <div class="order-block__title">2. Доставка</div>
                        <div class="order-block__type">
                            <div class="radios-type">
                                <label class="radios-type__label">
                                    <input class="radios-type__input" type="radio" name="Доставка" value="С доставкой" @click="delivery = true" checked>
                                    <span class="radios-type__text">С доставкой</span>
                                </label>
                                <label class="radios-type__label">
                                    <input class="radios-type__input" type="radio" name="Доставка" value="Без доставки" @click="delivery = false">
                                    <span class="radios-type__text">Без доставки</span>
                                </label>
                            </div>
                        </div>
                        <div class="order-block__view">
                            <div class="order-block__grid">
                                <div class="order-block__col-4" x-show="delivery" x-transition.duration.500ms>
                                    <label class="label-form">
                                        <span data-required="*">Город</span>
                                        <input class="label-form__input" type="text" name="city" placeholder="Введите название города" :required="delivery" autocomplete="off">
                                    </label>
                                </div>
                                <div class="order-block__col-8" x-show="delivery" x-transition.duration.500ms>
                                    <label class="label-form">
                                        <span data-required="*">Индекс</span>
                                        <input class="label-form__input" type="text" name="code" placeholder="Введите индекс" :required="delivery" autocomplete="off">
                                    </label>
                                </div>
                                <div class="order-block__col-4" x-show="delivery" x-transition.duration.500ms>
                                    <label class="label-form">
                                        <span data-required="*">Улица</span>
                                        <input class="label-form__input" type="text" name="street" placeholder="Введите название улицы" :required="delivery" autocomplete="off">
                                    </label>
                                </div>
                                <div class="order-block__col-4" x-show="delivery" x-transition.duration.500ms>
                                    <label class="label-form">
                                        <span data-required="*">Дом</span>
                                        <input class="label-form__input" type="text" name="home-number" placeholder="Введите номер дома" :required="delivery" autocomplete="off">
                                    </label>
                                </div>
                                <div class="order-block__col-4" x-show="delivery" x-transition.duration.500ms>
                                    <label class="label-form">
                                        <span data-required="*">Квартира</span>
                                        <input class="label-form__input" type="text" name="apartment-number" placeholder="Введите номер квартиры" :required="delivery" autocomplete="off">
                                    </label>
                                </div>
                                <div class="order-block__col-12">
                                    <div class="label-form">
                                        <label class="label-form">
                                            <span>Комментарий</span>
                                            <textarea class="label-form__input" rows="6" placeholder="Вы можете оставить комментарий к заказу"></textarea>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cart__bottom">
                        <button class="cart__submit btn-reset" name="submit" aria-label="Оформить">
                            <span>Оформить</span>
                        </button>
                        <div class="cart__policy">Нажимая кнопку «Отправить», вы подтверждаете свое согласие на обработку
                            <a href="javascript:void(0)" target="_blank">персональных данных</a>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
@endsection
