<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rocket extends Model
{
	use HasFactory;

	protected $fillable = [
		'name',
		'height',
		'diameter',
		'weight',
		'payload_capacity',
	];

	public function missions()
	{
		return $this->hasMany(Mission::class);
	}
}
