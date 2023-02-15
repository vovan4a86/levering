@extends('template')
@section('content')
    @include('blocks.bread')
    <!-- aside layout-->
    <div class="layout">
        <div class="layout__container container">
            <div class="layout__request" x-show="!menuIsOpen">
                <button class="request-btn btn-reset" type="button" data-popup="data-popup" data-src="#request"
                        aria-label="Запрос менеджеру">
                    <span class="request-btn__icon lazy" data-bg="/static/images/common/ico_request.svg"></span>
                    <span class="request-btn__label">Запрос менеджеру</span>
                </button>
            </div>
            @include('catalog.blocks.layout_aside')
            <div class="layout__content">
                <main>
                    <section class="section">
                        <div class="section__lead">{{ $category->title }}</div>
                        @if(count($category->children))
                            <div class="b-links">
                                <ul class="b-links__list list-reset">
                                    @foreach($category->children as $children)
                                        <li class="b-links__item">
                                            <a class="b-links__link" href="{{ $children->url }}"
                                               data-block-link>{{ $children->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(count($items))
                            <div class="b-cards">
                                <div class="b-cards__grid">
                                    @foreach($items as $item)
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
                                    @endforeach
                                </div>
                            </div>
                            @include('catalog.section_pagination', ['paginator' => $items])
                        @endif
                        @include('blocks.send_detail_count')
                        @if($category->text)
                            <div class="section__subtitle">{{ $category->title }}</div>
                            {!! $category->text !!}
                        @endif
                    </section>
                </main>
            </div>
        </div>
    </div>
@endsection
