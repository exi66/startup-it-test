<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function links()
    {
        return $this->hasMany('App\Models\Url');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'materials_tags');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * @property int $type
     * @property int $category_id
     * @property string $name
     * @property string $author
     * @property string $description
     */
    protected $fillable = [
        'type',
        'category_id',
        'name',
        'author',
        'description',
    ];
}
