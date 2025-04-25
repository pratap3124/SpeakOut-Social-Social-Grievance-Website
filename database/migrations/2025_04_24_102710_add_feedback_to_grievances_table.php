<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('grievances', function (Blueprint $table) {
            $table->text('feedback')->nullable();  // For user comments
            $table->integer('rating')->nullable();  // For user rating (e.g., 1-5 scale)
        });
    }

    public function down()
    {
        Schema::table('grievances', function (Blueprint $table) {
            $table->dropColumn(['feedback', 'rating']);
        });
}

};
