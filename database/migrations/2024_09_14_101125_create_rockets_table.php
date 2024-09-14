<?php

use App\Models\Rocket;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('rockets', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->float('height');
			$table->float('diameter');
			$table->float('weight');
			$table->float('payload_capacity');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('rockets');
	}
};
