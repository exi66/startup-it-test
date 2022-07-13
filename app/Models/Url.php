<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function material()
    {
        return $this->belongsTo('App\Models\Material', 'material_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * @property int $material_id
     * @property url $url
     * @property string $name
     */
    protected $fillable = [
        'material_id',
        'url',
        'name',
    ];
}
