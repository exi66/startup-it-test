<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
	
	/**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
	public function materials() {
		return $this->belongsToMany('App\Models\Material', 'materials_tags');
	}
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */	
	protected $fillable = [
        'name',
    ];
}
