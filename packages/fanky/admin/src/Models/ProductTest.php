<?php namespace Fanky\Admin\Models;

use App\Traits\HasH1;
use App\Traits\HasSeo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;
use Settings;
use Thumb;
use Carbon\Carbon;

/**
 * Fanky\Admin\Models\ProductTest
 *
 * @property int $id
 * @property int $catalog_id
 * @property string $name
 * @property string $alias
 * @property string|null $text
 * @property int $price
 * @property int $raw_price
 * @property int $price_per_item
 * @property int $price_per_metr
 * @property int $price_per_kilo
 * @property int $price_per_m2
 * @property float $k
 * @property string $image
 * @property int $published
 * @property boolean $on_main
 * @property boolean $is_kit
 * @property int $order
 * @property string $title
 * @property string $measure
 * @property string $keywords
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $size
 * @property string|null $h1
 * @property string|null $price_name
 * @property string|null $og_title
 * @property string|null $warehouse
 * @property string|null $wall
 * @property string|null $characteristic
 * @property string|null $characteristic2
 * @property string|null $cutting
 * @property string|null $steel
 * @property string|null $length
 * @property string|null $gost
 * @property string|null $comment
 * @property float|null $weight
 * @property float|null $balance
 * @property string|null $og_description
 * @property-read CatalogTest $catalog
 * @property-read mixed $image_src
 * @property-read mixed $url
 * @property-read Collection|ProductImage[] $images
 * @method static bool|null forceDelete()
 * @method static Builder|ProductTest onMain()
 * @method static Builder|ProductTest public ()
 * @method static bool|null restore()
 * @method static Builder|ProductTest whereAlias($value)
 * @method static Builder|ProductTest whereCatalogTestId($value)
 * @method static Builder|ProductTest whereCreatedAt($value)
 * @method static Builder|ProductTest whereDeletedAt($value)
 * @method static Builder|ProductTest whereDescription($value)
 * @method static Builder|ProductTest whereId($value)
 * @method static Builder|ProductTest whereImage($value)
 * @method static Builder|ProductTest whereKeywords($value)
 * @method static Builder|ProductTest whereName($value)
 * @method static Builder|ProductTest whereOnMain($value)
 * @method static Builder|ProductTest whereOrder($value)
 * @method static Builder|ProductTest wherePrice($value)
 * @method static Builder|ProductTest wherePriceUnit($value)
 * @method static Builder|ProductTest wherePublished($value)
 * @method static Builder|ProductTest whereText($value)
 * @method static Builder|ProductTest whereTitle($value)
 * @method static Builder|ProductTest whereUnit($value)
 * @method static Builder|ProductTest whereUpdatedAt($value)
 * @method static Builder|ProductTest newModelQuery()
 * @method static Builder|ProductTest newQuery()
 * @method static Builder|ProductTest query()
 * @method static Builder|ProductTest whereBalance($value)
 * @method static Builder|ProductTest whereCharacteristic($value)
 * @method static Builder|ProductTest whereCharacteristic2($value)
 * @method static Builder|ProductTest whereComment($value)
 * @method static Builder|ProductTest whereCutting($value)
 * @method static Builder|ProductTest whereGost($value)
 * @method static Builder|ProductTest whereH1($value)
 * @method static Builder|ProductTest whereLength($value)
 * @method static Builder|ProductTest whereOgDescription($value)
 * @method static Builder|ProductTest whereOgTitle($value)
 * @method static Builder|ProductTest wherePriceName($value)
 * @method static Builder|ProductTest whereSize($value)
 * @method static Builder|ProductTest whereSteel($value)
 * @method static Builder|ProductTest whereWall($value)
 * @method static Builder|ProductTest whereWarehouse($value)
 * @method static Builder|ProductTest whereWeight($value)
 * @method static \Illuminate\Database\Query\Builder|ProductTest onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductTest withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductTest withoutTrashed()
 * @mixin \Eloquent
 */
class ProductTest extends Model {
    use HasSeo, HasH1;

    protected $table = 'products_tests';
    protected $_parents = [];

    protected $guarded = ['id'];

    const UPLOAD_PATH = '/public/uploads/products/';
    const UPLOAD_URL = '/uploads/products/';

    const NO_IMAGE = "/adminlte/no_image.png";

    public function catalog() {
        return $this->belongsTo(CatalogTest::class);
    }

    public function images(): HasMany {
        return $this->hasMany(ProductImage::class, 'product_id')
            ->orderBy('order');
    }

    public function image(): HasOne {
        return $this->hasOne(ProductImage::class, 'product_id')
            ->orderBy('order');
    }

    public function getImage($img) {
        return ProductImage::UPLOAD_URL . $img;
    }

    public function getRootImage() {
        $category = CatalogTest::find($this->catalog_id);
        $root = $category;
        while ($root->parent_id !== 0) {
            $root = $root->findRootCategory($root->parent_id);
        }
        if ($root->image) {
            return CatalogTest::UPLOAD_URL . $root->image;
        } else {
            return self::NO_IMAGE;
        }
    }

    public function params() {
        return $this->hasMany(ProductParam::class);
    }

    //related
    public function related(): HasMany {
        return $this->hasMany(ProductRelated::class, 'product_id');
//            ->join('products', 'product_related.related_id', '=', 'products.id');
    }

    public function params_on_list() {
        return $this->params()
            ->where('on_list', 1);
    }

    public function params_on_spec() {
        return $this->params()
            ->where('on_spec', 1);
    }

    public function scopePublic($query) {
        return $query->where('published', 1);
    }

    public function scopeIsAction($query) {
        return $query->where('is_action', 1);
    }

    public function scopeInStock($query) {
        return $query->where('in_stock', 1);
    }

    public function scopeOnMain($query) {
        return $query->where('on_main', 1);
    }

    public function getImageSrcAttribute($value) {
        return ($this->image)
            ? $this->image->image_src
            : null;
    }

    public function thumb($thumb) {
        return ($this->image)
            ? $this->image->thumb($thumb)
            : null;
    }

    public function getUrlAttribute(): string  {
        if (!$this->_url) {
            $this->_url = $this->catalog->url . '/' . $this->alias;
        }
        return $this->_url;
    }

    public function getParents($with_self = false, $reverse = false): array {
        $parents = [];
        if ($with_self) $parents[] = $this;
        $parents = array_merge($parents, $this->catalog->getParents(true));
        $parents = array_merge($parents, $this->_parents);
        if ($reverse) {
            $parents = array_reverse($parents);
        }

        return $parents;
    }

    private $_url;

    public function delete() {
        foreach ($this->images as $image) {
            $image->delete();
        }

        parent::delete();
    }

    /**
     * @return Carbon
     */
    public function getLastModify() {
        return $this->updated_at;
    }

    public function getBread() {
        $bread = $this->catalog->getBread();
        $bread[] = [
            'url' => $this->url,
            'name' => $this->name
        ];

        return $bread;
    }

    public function getFormatedPriceAttribute() {
        return number_format($this->price, 0, ',', ' ');
    }

    public static function getActionProductTests() {
        return self::where('published', 1)->where('is_action', 1)->get();
    }

    public static function getPopularProductTests() {
        return self::where('published', 1)->where('is_popular', 1)->get();
    }

    public function showCategoryImage($catalog_id) {
        $root = CatalogTest::find($catalog_id);
        while ($root->parent_id !== 0) {
            $root = $root->findRootCategory($root->parent_id);
        }
        return $root->thumb(2);
    }

    public static function findRootParentName($catalog_id) {
        $root = CatalogTest::find($catalog_id)->getParents();

        if (isset($root[0])) {
            return CatalogTest::find($root[0]['id'])->name;
        } else {
            return CatalogTest::find($catalog_id)->name;
        }
    }

    public function multiplyPrice($price) {
        $percent = $price * Settings::get('multiplier') / 100;
        return $price + $percent;
    }

    public static function fullPrice($price) {
        $percent = $price * Settings::get('multiplier') / 100;
        return $price + $percent;
    }

    public function getLength() {
        if ($this->length) {
            return $this->length;
        } elseif ($this->dlina) {
            return preg_replace('/[А-Яа-я]/', '', $this->dlina);
        } else {
            return null;
        }
    }

    public function showAnyImage() {
        $is_item_images = $this->images()->get();
        $root_image = $this->getRootImage() ?: self::NO_IMAGE;
        return count($is_item_images) ? ProductImage::UPLOAD_URL . $is_item_images[0]->image :
            $root_image;
    }

    private function replaceTemplateVariable($template) {
        $name_parts = explode(' ', $this->name, 2);
        $replace = [
            '{name}' => $this->name,
            '{lower_name}' => Str::lower($this->name),
            '{gost}' => $this->gost,
            '{price}' => $this->price ?? 0,
            '{name_part1}' => array_get($name_parts, 0),
            '{name_part2}' => array_get($name_parts, 1),
            '{size}' => $this->size,
            '{wall}' => $this->wall,
            '{steel}' => $this->steel,
            '{measure}' => $this->measure,
            '{manufacturer}' => $this->manufacturer,
            '{length}' => $this->length,
            '{emails_for_order}' => $this->emails_for_order,
            '{product_article}' => $this->product_article,
        ];

        return str_replace(array_keys($replace), array_values($replace), $template);
    }

    public function getTitleTemplate($catalog_id = null) {
        if (!$catalog_id) $catalog_id = $this->catalog_id;
        $catalog = CatalogTest::find($catalog_id);
        if (!$catalog) return null;
        if (!empty($catalog->product_title_template)) return $catalog->product_title_template;
        if ($catalog->parent_id) return $this->getTitleTemplate($catalog->parent_id);

        return self::$defaultTitleTemplate;
    }

    public static $defaultTitleTemplate = '{name} купить - БИЗНЕС-МС';

    public function generateTitle() {
        if (!($template = $this->getTitleTemplate())) {
            if ($this->title && $this->title != $this->name) {
                $template = $this->title;
            } else {
                $template = self::$defaultTitleTemplate;
            }
        }

//        if (strpos($template, '{city}') === false) { //если кода city нет - добавляем
//            $template .= '{city}';
//        }
        $this->title = $this->replaceTemplateVariable($template);
    }

    public function getDescriptionTemplate($catalog_id = null) {
        if (!$catalog_id) $catalog_id = $this->catalog_id;
        $catalog = CatalogTest::find($catalog_id);
        if (!$catalog) return null;
        if (!empty($catalog->product_description_template)) return $catalog->product_description_template;
        if ($catalog->parent_id) return $this->getDescriptionTemplate($catalog->parent_id);

        return self::$defaultDescriptionTemplate;
    }

    public function getTextTemplate($catalog_id = null) {
        if (!$catalog_id) $catalog_id = $this->catalog_id;
        $catalog = CatalogTest::find($catalog_id);
        if (!$catalog) return null;
        if (!empty($catalog->product_text_template)) return $catalog->product_text_template;
        if ($catalog->parent_id) return $this->getTextTemplate($catalog->parent_id);

        return null;
    }

    public static $defaultDescriptionTemplate = '{name} купить по цене от {price} руб. | БИЗНЕС-МС';

    public function generateDescription() {
        if (!($template = $this->getDescriptionTemplate())) {
            if (!$template && $this->description) {
                $template = $this->description;
            } else {
                $template = self::$defaultDescriptionTemplate;
            }
        }

//        if (strpos($template, '{city}') === false) { //если кода city нет - добавляем
//            $template .= '{city}';
//        }

        $this->description = $this->replaceTemplateVariable($template);;
    }

    public function generateText() {
        $template = $this->getTextTemplate();
        if (!$template) {
            $template = $this->text;
        }

        $this->text = $this->replaceTemplateVariable($template);
    }

    public function generateKeywords() {
        if (!$this->keywords) {
            $this->keywords = mb_strtolower($this->name . ' цена, ' . $this->name . ' купить, ' . $this->name . '');
        }
    }
}
