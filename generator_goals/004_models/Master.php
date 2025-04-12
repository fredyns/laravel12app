<?php

namespace App\Models;

use Datetime;
use Snippet\Helpers\JsonField;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * This is the model class for table "masters".
 *
 * @property string $id
 * @property string $name
 *
 * @property Detail[] $details
 *
 *
 */
class Master extends Model
{
    use HasFactory;
    use Searchable;
    use HasApiTokens;

    protected $fillable = ['name'];

    protected $searchableFields = ['*'];

    public function details()
    {
        return $this->hasMany(Detail::class);
    }
}
