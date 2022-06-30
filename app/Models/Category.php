<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
	
	public function materials() {
		return $this->hasMany('App\Models\Material');
	}
	
	protected $fillable = [
        'name',
    ];
}
