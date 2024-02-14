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
            $table->string('name');
            $table->string('invoice');
            $table->date('datecurrence');
            $table->integer('cp');
            $table->string('states');
            $table->string('municipys');
            $table->string('colony');
            $table->date('datesuccess');
            $table->integer('cpdeed');
            $table->string('statesdeed');
            $table->string('municipysdeed');
            $table->string('colonydeed');
            $table->string('personinformate');
            $table->string('curp');
            $table->string('description');
            $table->integer('age');
            $table->date('datereindence');
            $table->foreignId('user_id')->constrained('users','id');
            $table->foreignId('sites_id')->constrained('sites','id');
            $table->foreignId('actwas_id')->constrained('actwas','id');
            $table->foreignId('dependeces_id')->constrained('dependeces','id');
            $table->foreignId('causes_id')->constrained('cause','id');
            $table->foreignId('dependececanalize_id')->constrained('dependeces','id');
            $table->foreignId('gender_id')->constrained('gender','id');
            $table->foreignId('belief_id')->constrained('belief','id');
            $table->foreignId('statecivil_id')->constrained('statecivil','id');
            $table->foreignId('literacy_id')->constrained('literacy','id');
            $table->foreignId('childrens_id')->constrained('childrens','id');
            $table->foreignId('existence_id')->constrained('exitence','id');
            $table->foreignId('adictions_id')->constrained('adictions','id');
            $table->foreignId('diseases_id')->constrained('diseases','id');
            $table->foreignId('violence_id')->constrained('violence','id');
            $table->foreignId('family_id')->constrained('family','id');
            $table->foreignId('school_id')->constrained('school','id');
            $table->foreignId('indetified_id')->constrained('indentified','id');
            $table->foreignId('meanemployeed_id')->constrained('meansemployees','id');
            $table->foreignId('activies_id')->constrained('activities','id');
            
            
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
