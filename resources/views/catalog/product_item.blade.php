<div class="b-cards__item">
    <div class="p-card">
        @if($item->price && $item->getRecourseDiscountAmount())
            <div class="p-card__badge badge">Лучшая цена</div>
        @endif
        <div class="p-card__preview">
            <img class="p-card__img lazy" src="/"
                 data-src="{{ $item->image()->first() ? $item->image()->first()->image : $item->showAnyImage() }}"
                 width="227" height="162" alt="{{ $item->name }}"/>
        </div>
        <div class="p-card__code">Код: {{ $item->id }}</div>
        <div class="p-card__body">{{ $item->name }}</div>
        <div class="p-card__bottom">
            <div class="p-card__pricing">
                @if($item->price)
                    @if($item->getRecourseDiscountAmount())
                        <div class="p-card__discounts">
                            <span data-end="₽/{{ $item->measure ?: 'шт' }}">{{ round($item->getPriceWithDiscount()) }}</span>
                            <div class="p-card__value">
                                -{{ $item->getRecourseDiscountAmount() }}%
                            </div>
                        </div>
                    @endif
                    <div class="p-card__current"
                         data-end="/ {{ $item->measure ?: 'шт' }}">{{ $item->price }}
                        ₽
                    </div>
                @endif
            </div>
            <div class="p-card__action">
                <button class="btn btn--primary btn--small btn-reset"
                        type="button"
                        aria-label="Заказать">
                    <span>Заказать</span>
                </button>
            </div>
        </div>
    </div>
</div>