<?php namespace Fanky\Admin\Controllers;

use Exception;
use Fanky\Admin\Models\AddParam;
use Fanky\Admin\Models\CatalogParam;
use Fanky\Admin\Models\CatalogFilter;
use Fanky\Admin\Models\CatalogSubShow;
use Fanky\Admin\Models\MenuAction;
use Fanky\Admin\Models\Param;
use Fanky\Admin\Models\ProductFilters;
use Fanky\Admin\Models\ProductIcon;
use Fanky\Admin\Models\ProductChar;
use Fanky\Admin\Models\ProductRelated;
use Fanky\Admin\Pagination;
use http\Params;
use Request;
use Settings;
use Validator;
use Text;
use DB;
use Fanky\Admin\Models\Catalog;
use Fanky\Admin\Models\Product;
use Fanky\Admin\Models\ProductImage;

class AdminCatalogController extends AdminController {

    public function getIndex() {
        $catalogs = Catalog::orderBy('order')->get();

        return view('admin::catalog.main', [
            'catalogs' => $catalogs
        ]);
    }

    public function postProducts($catalog_id) {
        $catalog = Catalog::findOrFail($catalog_id);
//        $products = $catalog->products()->orderBy('order')->paginate(20);
        $products = Pagination::init($catalog->products()->orderBy('order'), 20)->get();

        return view('admin::catalog.products', [
            'catalog'  => $catalog,
            'products' => $products
        ]);
    }

    public function getProducts($catalog_id) {
        $catalogs = Catalog::orderBy('order')->get();

        return view('admin::catalog.main', [
            'catalogs' => $catalogs,
            'content'  => $this->postProducts($catalog_id)
        ]);
    }

    public function postCatalogEdit($id = null) {
        /** @var Catalog $catalog */
        if(!$id || !($catalog = Catalog::findOrFail($id))) {
            $catalog = new Catalog([
                'parent_id'  => Request::get('parent'),
                'text_prev'  => Settings::get('catalog_text_prev_template'),
                'text_after' => Settings::get('catalog_text_after_template'),
                'published'  => 1
            ]);
        }
        $catalogs = Catalog::orderBy('order')
            ->where('id', '!=', $catalog->id)
            ->get();

        $catalogProducts = $catalog->getRecurseProducts()->orderBy('name')->pluck('id', 'name')->all();

        $menuActions = $catalog->menu_actions()->get();

        return view('admin::catalog.catalog_edit', [
            'catalog'  => $catalog,
            'catalogs' => $catalogs,
            'catalogProducts' => $catalogProducts,
            'menuActions' => $menuActions
        ]);
    }

    public function getCatalogEdit($id = null) {
        $catalogs = Catalog::orderBy('order')->get();

        return view('admin::catalog.main', [
            'catalogs' => $catalogs,
            'content'  => $this->postCatalogEdit($id)
        ]);
    }

    public function postCatalogSave(): array {
        $id = Request::input('id');
        $data = Request::except(['id']);
        if(!array_get($data, 'alias')) $data['alias'] = Text::translit($data['name']);
        if(!array_get($data, 'title')) $data['title'] = $data['name'];
        if(!array_get($data, 'h1')) $data['h1'] = $data['name'];
        if(!array_get($data, 'is_action')) $data['is_action'] = 0;
        if(!array_get($data, 'on_main')) $data['on_main'] = 0;
        if(!array_get($data, 'on_menu')) $data['on_menu'] = 0;
        if(!array_get($data, 'on_main_list')) $data['on_main_list'] = 0;
        if(!array_get($data, 'on_footer_menu')) $data['on_footer_menu'] = 0;

        $image = Request::file('image');
        $actionImage = Request::file('aimage');
//        $filters = Request::get('filters', []);
//        $checked_subcatalogs = Request::get('show_cats', []);


        \Debugbar::log($data);
        // валидация данных
        $validator = Validator::make(
            $data, [
                'name' => 'required',
            ]);
        if($validator->fails()) {
            return ['errors' => $validator->messages()];
        }
        // Загружаем изображение
        if($image) {
            $file_name = Catalog::uploadImage($image);
            $data['image'] = $file_name;
        }
        if($actionImage) {
            $file_name = Catalog::uploadActionImage($actionImage);
            $data['action_image'] = $file_name;
        }
        // сохраняем страницу
        $catalog = Catalog::find($id);
        $redirect = false;
        if(!$catalog) {
            $data['order'] = Catalog::where('parent_id', $data['parent_id'])->max('order') + 1;
            $catalog = Catalog::create($data);
            $redirect = true;

        } else {
            $catalog->update($data);
        }

        if($redirect) {
            return ['redirect' => route('admin.catalog.catalogEdit', [$catalog->id])];
        } else {
            return ['success' => true, 'msg' => 'Изменения сохранены'];
        }
    }

    public function postCatalogReorder(): array {
        // изменение родителя
        $id = Request::input('id');
        $parent = Request::input('parent');
        DB::table('catalogs')->where('id', $id)->update(array('parent_id' => $parent));
        // сортировка
        $sorted = Request::input('sorted', []);
        foreach($sorted as $order => $id) {
            DB::table('catalogs')->where('id', $id)->update(array('order' => $order));
        }

        return ['success' => true];
    }

    /**
     * @throws Exception
     */
    public function postCatalogDelete($id): array {
        $catalog = Catalog::findOrFail($id);
        $catalog->delete();

        return ['success' => true];
    }

    public function postProductEdit($id = null) {
        /** @var Product $product */
        if(!$id || !($product = Product::findOrFail($id))) {
            $product = new Product([
                'catalog_id'    => Request::get('catalog'),
                'published'     => 1,
                'measure' => 'т',
            ]);
        }
        $catalogs = Catalog::getCatalogList();
        $product_list = Product::public()->where('id', '<>', $product->id)->orderBy('name')->pluck('name', 'id')->all();

        $data = [
            'product'  => $product,
            'catalogs' => $catalogs,
            'product_list' => $product_list,
        ];
        return view('admin::catalog.product_edit', $data);
    }

    public function getProductEdit($id = null) {
        $catalogs = Catalog::orderBy('order')->get();

        return view('admin::catalog.main', [
            'catalogs' => $catalogs,
            'content'  => $this->postProductEdit($id)
        ]);
    }

    public function postProductSave(): array {
        $id = Request::get('id');
        $data = Request::except(['id', 'icons']);

        if(!array_get($data, 'published')) $data['published'] = 0;
        if(!array_get($data, 'alias')) $data['alias'] = Text::translit($data['name']);
        if(!array_get($data, 'title')) $data['title'] = $data['name'];
        if(!array_get($data, 'h1')) $data['h1'] = $data['name'];

        $rules = [
            'name' => 'required'
        ];

        $rules['alias'] = $id
            ? 'required|unique:products,alias,' . $id . ',id,catalog_id,' . $data['catalog_id']
            : 'required|unique:products,alias,null,id,catalog_id,' . $data['catalog_id'];
        // валидация данных
        $validator = Validator::make(
            $data, $rules
        );
        if($validator->fails()) {
            return ['errors' => $validator->messages()];
        }
        $redirect = false;

        // сохраняем страницу
        $product = Product::find($id);
        if(!$product) {
            $data['order'] = Product::where('catalog_id', $data['catalog_id'])->max('order') + 1;
            $product = Product::create($data);
            $redirect = true;
        } else {
            $product->update($data);
        }

        return $redirect
            ? ['redirect' => route('admin.catalog.productEdit', [$product->id])]
            : ['success' => true, 'msg' => 'Изменения сохранены'];
    }

    public function postProductReorder(): array {
        $sorted = Request::input('sorted', []);
        foreach($sorted as $order => $id) {
            DB::table('products')->where('id', $id)->update(array('order' => $order));
        }

        return ['success' => true];
    }

    public function postUpdateOrder($id): array {
        $order = Request::get('order');
        Product::whereId($id)->update(['order' => $order]);

        return ['success' => true];
    }

    public function postProductDelete($id): array {
        $product = Product::findOrFail($id);
        foreach($product->images as $item) {
            $item->deleteImage();
            $item->delete();
        }
        $product->delete();

        return ['success' => true];
    }

    public function postProductImageUpload($product_id): array {
        $product = Product::findOrFail($product_id);
        $images = Request::file('images');
        $items = [];
        if($images) foreach($images as $image) {
            $file_name = ProductImage::uploadImage($image);
            $order = ProductImage::where('product_id', $product_id)->max('order') + 1;
            $item = ProductImage::create(['product_id' => $product_id, 'image' => $file_name, 'order' => $order]);
            $items[] = $item;
        }

        $html = '';
        foreach($items as $item) {
            $html .= view('admin::catalog.product_image', ['image' => $item, 'active' => '']);
        }

        return ['html' => $html];
    }

    public function postProductImageOrder(): array {
        $sorted = Request::get('sorted', []);
        foreach($sorted as $order => $id) {
            ProductImage::whereId($id)->update(['order' => $order]);
        }

        return ['success' => true];
    }

    /**
     * @throws Exception
     */
    public function postProductImageDelete($id): array {
        /** @var ProductImage $item */
        $item = ProductImage::findOrFail($id);
        $item->deleteImage();
        $item->delete();

        return ['success' => true];
    }

    public function getGetCatalogs($id = 0): array {
        $catalogs = Catalog::whereParentId($id)->orderBy('order')->get();
        $result = [];
        foreach($catalogs as $catalog) {
            $has_children = (bool)$catalog->children()->count();
            $result[] = [
                'id'       => $catalog->id,
                'text'     => $catalog->name,
                'children' => $has_children,
                'icon'     => ($catalog->published) ? 'fa fa-eye text-green' : 'fa fa-eye-slash text-muted',
            ];
        }

        return $result;
    }

    public function postAddRelated($product_id): array {
        $product = Product::findOrFail($product_id);
        $data = Request::all();
        $valid = Validator::make($data, [
            'related_id' => 'required',
        ]);

        if ($valid->fails()) {
            return ['errors' => $valid->messages()];
        } else {
            $data = array_map('trim', $data);
            $data['product_id'] = $product->id;
            $data['order'] = 0;
            $related = ProductRelated::create($data);
            $row = view('admin::catalog.related_row', ['related' => $related])->render();

            return ['row' => $row];
        }
    }

    public function postDelRelated($related_id): array {
        $related = ProductRelated::findOrFail($related_id);
        $related->delete();

        return ['success' => true];
    }

    public function postAddParam($catalog_id): array {
        $data = Request::all();
        $valid = Validator::make($data, [
            'name'  => 'required',
        ]);

        if($valid->fails()) {
            return ['errors' => $valid->messages()];
        } else {
            $data = array_map('trim', $data);
            $data['cat_id'] = $catalog_id;
            $data['alias'] = Text::translit($data['name']);
            $data['title'] = $data['name'];
            $param = Param::create($data);

            CatalogParam::create([
                'catalog_id' => $catalog_id,
                'param_id' => $param->id,
                'order' => 1
            ]);
            CatalogFilter::create([
                'catalog_id' => $catalog_id,
                'param_id' => $param->id,
            ]);
            $row = view('admin::catalog.param_row', ['param' => $param])->render();

            return ['row' => $row];
        }
    }

    /**
     * @throws \Throwable
     */
    public function postAddMenuAction($catalog_id): array {
        $data = Request::except(['file']);
        $file = Request::file('file');

        $valid = Validator::make($data, [
            'title'  => 'required',
            'price'  => 'required',
            'measure'  => 'required',
        ]);

        if($file) {
            $file_name = Catalog::uploadImage($file);
            $data['image'] = $file_name;
        }

        if($valid->fails()) {
            return ['errors' => $valid->messages()];
        } else {
            $product = Product::find($data['product_id']);
            if(!$data['url']) $data['url'] = $product->url;
            $data['catalog_id'] = $catalog_id;
            $action = MenuAction::create($data);

            $row = view('admin::catalog.tabs.menu_action_item', ['action' => $action])->render();

            return ['row' => $row];
        }
    }

    public function postUpdateMenuAction($action_id): array {
        $data = Request::all();

        $valid = Validator::make($data, [
            'title'  => 'required',
        ]);

        if($valid->fails()) {
            return ['errors' => $valid->messages()];
        } else {
            $action = MenuAction::find($action_id);
            $action->update($data);
            $action->save();

            $row = view('admin::catalog.tabs.menu_action_span', ['action' => $action])->render();

            return ['row' => $row, 'id' => $action_id];
        }
    }

    public function postDeleteMenuAction($action_id): array {
        $action = MenuAction::findOrFail($action_id);
        $action->delete();

        return ['success' => true];
    }
}
