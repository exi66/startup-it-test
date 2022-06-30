<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;
	
	public function material() {
		return $this->belongsTo('App\Models\Material', 'material_id');
	}

	
	protected $fillable = [
        'material_id',
		'url',
		'name',
    ];
}
