<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
	
	public function links() {
		return $this->hasMany('App\Models\Url');
	}
	
	public function category() {
		return $this->belongsTo('App\Models\Category');
	}

	public function tags() {
		return $this->belongsToMany('App\Models\Tag', 'materials_tags');
	}
	
	protected $fillable = [
        'type',
        'category_id',
        'name',
		'author',
		'description',
    ];
}
