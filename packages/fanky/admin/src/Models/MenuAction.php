<?php namespace Fanky\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

/**
 * Fanky\Admin\Models\MenuAction
 *
 * @property-read Catalog $catalog
 * @property-read Product $product
 * @mixin \Eloquent
 * @property int $id
 * @property int $product_id
 * @property int $catalog_id
 * @property string $name
 * @property string $value
 * @method static Builder|MenuAction whereCatalogId($value)
 * @method static Builder|MenuAction whereId($value)
 * @method static Builder|MenuAction whereName($value)
 * @method static Builder|MenuAction whereProductId($value)
 * @method static Builder|MenuAction whereValue($value)
 */
class MenuAction extends Model {

	protected $guarded = ['id'];

	public function product(): BelongsTo {
		return $this->belongsTo(Product::class);
	}

	public function catalog(): BelongsTo {
		return $this->belongsTo(Catalog::class);
	}
}
