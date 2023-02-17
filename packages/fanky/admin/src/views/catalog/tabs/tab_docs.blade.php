<div class="tab-pane" id="tab_related">
    @if(!$product->id)
        <div>Добавление файлов доступно только после сохранения товара</div>
    @else
        <div class="form-group row">
            <div class="col-md-4">
                <label for="doc-file">Файл</label>
                <input id="doc-file" type="file" name="file" value=""
                       class="form-control"
                       onchange="return docAttache(this, event)">
            </div>
            <div class="col-md-4">
                <label for="article-image">Название</label>
                <input name="name" type="text" placeholder="Название для отображения" class="form-control">
            </div>
            <div class="col-md-4" style="line-height: 5.6;">
                <a href="{{ route('admin.catalog.add_related', $product->id) }}"
                   onclick="addDoc(this, event)" class="btn btn-primary add-rel"
                    class="form-control" >
                    Добавить документ</a>
            </div>
        </div>

        <hr>

        <table class="table table-hover table-condensed" id="related_list">
            <thead>
            <tr>
                <th>Название</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
{{--            @foreach ($product->related as $related)--}}
{{--                @include('admin::catalog.related_row', ['related' => $related])--}}
{{--            @endforeach--}}
            </tbody>
        </table>


    @endif
</div>
