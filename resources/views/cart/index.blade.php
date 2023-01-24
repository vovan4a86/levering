@extends('template')
@section('content')
    @include('blocks.bread')
    <main>
        <section class="cart">
            <div class="cart__container container">
                <div class="cart__layout">
                    <div class="cart__head">
                        <div class="cart__title">Корзина</div>
                        <button class="trash-btn btn-reset" type="button" aria-label="Очистить корзину" onclick="purgeCart()">
                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.1207 6.88379C11.875 6.88379 11.6758 7.08298 11.6758 7.32875V15.7386C11.6758 15.9842 11.875 16.1835 12.1207 16.1835C12.3665 16.1835 12.5657 15.9842 12.5657 15.7386V7.32875C12.5657 7.08298 12.3665 6.88379 12.1207 6.88379Z" fill="currentColor"
                                />
                                <path d="M6.87074 6.88379C6.62497 6.88379 6.42578 7.08298 6.42578 7.32875V15.7386C6.42578 15.9842 6.62497 16.1835 6.87074 16.1835C7.11652 16.1835 7.31571 15.9842 7.31571 15.7386V7.32875C7.31571 7.08298 7.11652 6.88379 6.87074 6.88379Z" fill="currentColor"
                                />
                                <path d="M3.04307 5.65648V16.6194C3.04307 17.2674 3.28067 17.8759 3.69574 18.3126C4.10889 18.7504 4.68387 18.999 5.28561 19H13.7045C14.3064 18.999 14.8814 18.7504 15.2943 18.3126C15.7094 17.8759 15.947 17.2674 15.947 16.6194V5.65648C16.7721 5.43748 17.3068 4.64037 17.1964 3.79372C17.0858 2.94725 16.3647 2.31404 15.5109 2.31387H13.2327V1.75766C13.2353 1.28993 13.0504 0.840796 12.7193 0.510376C12.3882 0.18013 11.9383 -0.00376544 11.4706 5.84646e-05H7.51947C7.05173 -0.00376544 6.6019 0.18013 6.27079 0.510376C5.93967 0.840796 5.75474 1.28993 5.75734 1.75766V2.31387H3.47916C2.62539 2.31404 1.90424 2.94725 1.79369 3.79372C1.68332 4.64037 2.21797 5.43748 3.04307 5.65648ZM13.7045 18.1101H5.28561C4.52483 18.1101 3.93299 17.4565 3.93299 16.6194V5.69559H15.0571V16.6194C15.0571 17.4565 14.4652 18.1101 13.7045 18.1101ZM6.64727 1.75766C6.64432 1.52597 6.73539 1.30297 6.89982 1.13941C7.06408 0.97585 7.2876 0.885988 7.51947 0.889986H11.4706C11.7025 0.885988 11.926 0.97585 12.0903 1.13941C12.2547 1.30279 12.3458 1.52597 12.3428 1.75766V2.31387H6.64727V1.75766ZM3.47916 3.2038H15.5109C15.9533 3.2038 16.3118 3.56237 16.3118 4.00473C16.3118 4.44709 15.9533 4.80566 15.5109 4.80566H3.47916C3.03681 4.80566 2.67823 4.44709 2.67823 4.00473C2.67823 3.56237 3.03681 3.2038 3.47916 3.2038Z"
                                      fill="currentColor" />
                                <path d="M9.49574 6.88379C9.24997 6.88379 9.05078 7.08298 9.05078 7.32875V15.7386C9.05078 15.9842 9.24997 16.1835 9.49574 16.1835C9.74152 16.1835 9.94071 15.9842 9.94071 15.7386V7.32875C9.94071 7.08298 9.74152 6.88379 9.49574 6.88379Z" fill="currentColor"
                                />
                            </svg>
                            <span>Очистить корзину</span>
                        </button>
                    </div>
                </div>
                <div class="cart__layout">
                    <div class="cart__body">
                        <div class="cart-table">
                            <div class="cart-table__row cart-table__row--head">
                                <div class="cart-table__col cart-table__col--wide">
                                    <div class="cart-table__label">Товар</div>
                                </div>
                                <div class="cart-table__col">
                                    <div class="cart-table__label">Цена</div>
                                </div>
                                <div class="cart-table__col">
                                    <div class="cart-table__label">Кол-во</div>
                                </div>
                                <div class="cart-table__col">
                                    <div class="cart-table__label">Сумма</div>
                                </div>
                            </div>
                            @each('cart.table_row', $items, 'item')
                        </div>
                    </div>
                   @include('cart.blocks.order_total')
                </div>
            </div>
        </section>
    </main>
@endsection
