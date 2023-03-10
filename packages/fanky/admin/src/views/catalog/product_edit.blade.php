@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="{{ route('admin.catalog') }}"><i class="fa fa-list"></i> Каталог</a></li>
        @foreach($product->getParents(false, true) as $parent)
            <li><a href="{{ route('admin.catalog.products', [$parent->id]) }}">{{ $parent->name }}</a></li>
        @endforeach
        <li class="active">{{ $product->id ? $product->name : 'Новый товар' }}</li>
    </ol>
@stop
@section('page_name')
    <h1>Каталог
        <small style="max-width: 350px;">{{ $product->id ? $product->name : 'Новый товар' }}</small>
    </h1>
@stop

<form action="{{ route('admin.catalog.productSave') }}" onsubmit="return productSave(this, event)">
    {!! Form::hidden('id', $product->id) !!}

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Параметры</a></li>
            <li><a href="#tab_2" data-toggle="tab">Текст ({{ $product->text ? 1 : 0 }})</a></li>
            <li><a href="#tab_3" data-toggle="tab">Характеристики ({{ count($product->chars()->get()) }})</a></li>
            <li><a href="#tab_4" data-toggle="tab">Изображения ({{ count($product->images()->get()) }})</a></li>
            <li><a href="#tab_sert" data-toggle="tab">Сертификаты и ТУ ({{ count($product->certificates()->get()) }})</a></li>
            <li><a href="#tab_docs" data-toggle="tab">Документы ({{ count($product->docs) }})</a></li>
            <li class="pull-right">
                <a href="{{ route('admin.catalog.products', [$product->catalog_id]) }}"
                   onclick="return catalogContent(this)">К списку товаров</a>
            </li>
            @if($product->id)
                <li class="pull-right">
                    <a href="{{ $product->url }}" target="_blank">Посмотреть</a>
                </li>
            @endif
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">

                {!! Form::groupText('name', $product->name, 'Название') !!}
                {!! Form::groupText('h1', $product->h1, 'H1') !!}
                {!! Form::groupSelect('catalog_id', $catalogs, $product->catalog_id, 'Каталог') !!}
                {!! Form::groupText('alias', $product->alias, 'Alias') !!}
                {!! Form::groupText('title', $product->title, 'Title') !!}
                {!! Form::groupText('keywords', $product->keywords, 'keywords') !!}
                {!! Form::groupText('description', $product->description, 'description') !!}
                {!! Form::groupText('price', $product->price ?: 0, 'price') !!}
                {!! Form::groupText('measure', $product->measure ?: 0, 'Измерение') !!}
                {!! Form::groupText('discount', $product->discont, 'Скидка на товар (приоритет перед скидкой во всем разделе)') !!}
                <hr>
                {!! Form::hidden('in_stock', 0) !!}
                {!! Form::groupCheckbox('published', 1, $product->published, 'Показывать товар') !!}
                {!! Form::groupCheckbox('in_stock', 1, $product->in_stock, 'В наличии') !!}

            </div>
            <div class="tab-pane" id="tab_2">
                {{--                {!! Form::groupRichtext('announce_text', $product->announce_text, 'Краткое описание', ['rows' => 3]) !!}--}}
                {!! Form::groupRichtext('text', $product->text, 'Текст', ['rows' => 3]) !!}
                {{--                {!! Form::groupRichtext('seo_text', $product->seo_text, 'SEO Текст', ['rows' => 3]) !!}--}}
            </div>
            <div class="tab-pane" id="tab_3">
                @if($product->chars()->get())
                    @foreach($product->chars()->get() as $ch)
                        <div class="char" style="display: flex; column-gap: 20px;"
                             data-id="{{ $ch->id }}" data-product="{{ $product->id }}">
                            <input type="text" value="{{ $ch->name }}" disabled class="form-control"
                                   style="max-width: 250px;">
                            <div style="max-width: 400px; display: flex;">
                                <input type="text" name="char" value="{{ $ch->value }}"
                                       class="form-control">
                                <span class="input-group-btn">
                                    <button class="btn btn-success btn-flat" onclick="updateCharValue(this, event)">
                                       <span class="glyphicon glyphicon-ok"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                    @endforeach
                @endif
                <hr>
            </div>

            <div class="tab-pane" id="tab_4">
                <input id="product-image" type="hidden" name="image" value="{{ $product->image }}">
                @if ($product->id)
                    <div class="form-group">
                        <label class="btn btn-success">
                            <input id="offer_imag_upload" type="file" multiple
                                   data-url="{{ route('admin.catalog.productImageUpload', $product->id) }}"
                                   style="display:none;" onchange="productImageUpload(this, event)">
                            Загрузить изображения
                        </label>
                    </div>
                    <p>Размер изображения: 586x386</p>

                    <div class="images_list">
                        @foreach ($product->images()->get() as $image)
                            @include('admin::catalog.product_image', ['image' => $image, 'active' => $product->image])
                        @endforeach
                    </div>
                @else
                    <p class="text-yellow">Изображения можно будет загрузить после сохранения товара!</p>
                @endif
            </div>

            <div class="tab-pane" id="tab_sert">
                @if(count($product->certificates()->get()))
                    <div class="certificates" style="display: flex; column-gap: 20px;">
                        @foreach($product->certificates()->get() as $cert)
                            <img class="img-polaroid" style="cursor: zoom-in;"
                                 src="{{ \Fanky\Admin\Models\Product::CERTIFICATE_PATH . $cert->image }}"
                                 height="200"
                                 data-image="{{ \Fanky\Admin\Models\Product::CERTIFICATE_PATH . $cert->image }}"
                                 onclick="return popupImage($(this).data('image'))">
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="tab-pane" id="tab_docs">
                @include('admin::catalog.tabs.tab_docs')
            </div>
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(".images_list").sortable({
        update: function (event, ui) {
            var url = "{{ route('admin.catalog.productImageOrder') }}";
            var data = {};
            data.sorted = $('.images_list').sortable("toArray", {attribute: 'data-id'});
            sendAjax(url, data);
            //console.log(data);
        },
    }).disableSelection();
</script>
