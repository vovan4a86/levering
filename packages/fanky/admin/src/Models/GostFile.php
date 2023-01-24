<?php namespace Fanky\Admin\Models;

use App\Traits\HasFile;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Fanky\Admin\Models\GostFile
 *
 * @property int        $id
 * @property int        $gost_id
 * @property string     $name
 * @property string     $description
 * @property string     $file
 * @property int        $order
 * @mixin Eloquent
 * @method static Builder|GostFile newModelQuery()
 * @method static Builder|GostFile newQuery()
 * @method static Builder|GostFile query()
 */
class GostFile extends Model {

    use HasFile;

	protected $guarded = ['id'];

	public $timestamps = false;

	const UPLOAD_URL = '/uploads/gost_files/';

    public function gost(): BelongsTo {
        return $this->belongsTo(Page::class);
    }

}
