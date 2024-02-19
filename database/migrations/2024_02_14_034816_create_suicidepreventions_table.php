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
        Schema::create('suicidepreventions', function (Blueprint $table) {
            $table->id();
            $table->date('dateregister');
            $table->string('name')->nullable();
            $table->string('invoice');
            $table->date('datecurrence');
            $table->integer('cp')->nullable();
            $table->string('states')->nullable();
            $table->string('municipys')->nullable();
            $table->string('colony')->nullable();
            $table->date('datesuccess')->nullable();
            $table->integer('cpdeed');
            $table->string('statesdeed');
            $table->string('municipysdeed');
            $table->string('colonydeed');
            $table->string('personinformate');
            $table->string('curp')->nullable();
            $table->string('description')->nullable();
            $table->integer('age')->nullable();
            $table->date('datereindence')->nullable();
            $table->date('date_created');
            $table->foreignId('user_id')->constrained('users','id');
            $table->foreignId('sites_id')->nullable()->constrained('sites','id');
            $table->foreignId('actwas_id')->nullable()->constrained('actwas','id');
            $table->foreignId('dependeces_id')->constrained('dependeces','id');
            $table->foreignId('causes_id')->nullable()->constrained('cause','id');
            $table->foreignId('dependececanalize_id')->nullable()->constrained('dependeces','id');
            $table->foreignId('gender_id')->nullable()->constrained('gender','id');
            $table->foreignId('belief_id')->nullable()->constrained('belief','id');
            $table->foreignId('statecivil_id')->nullable()->constrained('statecivil','id');
            $table->foreignId('literacy_id')->nullable()->constrained('literacy','id');
            $table->foreignId('childrens_id')->nullable()->constrained('childrens','id');
            $table->foreignId('existence_id')->nullable()->constrained('exitence','id');
            $table->foreignId('adictions_id')->nullable()->constrained('adictions','id');
            $table->foreignId('diseases_id')->nullable()->constrained('diseases','id');
            $table->foreignId('violence_id')->nullable()->constrained('violence','id');
            $table->foreignId('family_id')->nullable()->constrained('family','id');
            $table->foreignId('school_id')->nullable()->constrained('school','id');
            $table->foreignId('indetified_id')->nullable()->constrained('indentified','id');
            $table->foreignId('meanemployeed_id')->nullable()->constrained('meansemployees','id');
            $table->foreignId('activies_id')->nullable()->constrained('activities','id');
            
            
            $table->boolean('active')->default(true);
            $table->dateTime('deleted_at')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suicidepreventions');
    }
};
