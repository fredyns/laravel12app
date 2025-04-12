<?php

namespace App\Models;

use Datetime;
use Snippet\Helpers\JsonField;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * This is the model class for table "details".
 *
 * @property string $id
 * @property string $master_id
 * @property string $label
 *
 * @property Master $master
 *
 *
 */
class Detail extends Model
{
    use HasFactory;
    use Searchable;
    use HasApiTokens;

    protected $fillable = ['master_id', 'label'];

    protected $searchableFields = ['*'];

    public function master()
    {
        return $this->belongsTo(Master::class);
    }
}
