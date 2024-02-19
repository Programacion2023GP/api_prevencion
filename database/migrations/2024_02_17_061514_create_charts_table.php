<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('charts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users','id');
            $table->string('name');
            $table->string('chart_selected');
            $table->string('option_selected');
            $table->boolean("dependences")->nullable()->default(false);
            // $table->boolean("years");
            // $table->boolean("months");
            // $table->boolean("days");
            // $table->boolean("zoom");
            // $table->boolean("png");
            $table->text("description");
            $table->integer('position');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charts');
    }
};
