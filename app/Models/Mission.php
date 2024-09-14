<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
	use HasFactory;

	protected $fillable = [
		'rocket_id',
		'name',
		'description',
	];

	public function rocket()
	{
		return $this->belongsTo(Rocket::class);
	}
}
