<?php namespace Fanky\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Fanky\Admin\Models\Filter
 *
 * @property-read \Fanky\Admin\Models\Catalog $catalog
 * @property-read \Fanky\Admin\Models\Product $product
 * @mixin \Eloquent
 * @property int $id
 * @property int $product_id
 * @property int $catalog_id
 * @property string $name
 * @property string $value
 * @method static Builder|Filter whereAlias($value)
 * @method static Builder|Filter whereCatalogId($value)
 * @method static Builder|Filter whereId($value)
 * @method static Builder|Filter whereName($value)
 * @method static Builder|Filter whereProductId($value)
 * @method static Builder|Filter whereValue($value)
 */
class Filter extends Model {
	protected $guarded = ['id'];
	public $timestamps = false;

	public function product(){
		return $this->belongsTo(Product::class);
	}

	public function catalog(){
		return $this->belongsTo(Catalog::class);
	}
}
