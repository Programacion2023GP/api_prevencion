<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        
        Schema::create('estados', function (Blueprint $table) {
            $table->tinyInteger('clave')->unsigned()->primary();
            $table->string('nombre', 33);
            $table->string('abreviacion', 4);
            $table->integer('cp_min');
            $table->integer('cp_max');
        });
        Schema::create('municipios', function (Blueprint $table) {
            $table->integer('id')->unsigned()->primary();
            $table->string('nombre', 60);
            $table->foreign('estado')->references('clave')->on('estados');
            $table->integer('cp_min');
            $table->integer('cp_max');
            $table->enum('huso_horario', [
                'Tiempo del Centro',
                'Tiempo del Noroeste',
                'Tiempo del Pacífico',
                'Tiempo del Sureste',
                'Tiempo del Centro en Frontera',
                'Tiempo del Noroeste en Frontera',
                'Tiempo del Pacífico en Frontera',
                'Tiempo del Pacífico Sonora'
            ])->nullable();
        });
        
        Schema::create('colonias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 60);
            $table->foreignId('municipio')->constrained('municipios');
            $table->string('asentamiento', 40);
            $table->integer('codigo_postal');
            $table->decimal('latitud', 16, 13)->nullable();
            $table->decimal('longitud', 16, 13)->nullable();
            $table->timestamps();
        });
        DB::statement("
        CREATE OR REPLACE VIEW continmap AS
        SELECT 
            COUNT(sp.colonydeed) AS conteos,
            colonias.nombre,
            MAX(colonias.longitud) AS longitud,
            MAX(colonias.latitud) AS latitud
        FROM 
            prevencion.estados 
        INNER JOIN 
            municipios ON estados.clave = municipios.estado
        INNER JOIN 
            colonias ON colonias.municipio = municipios.id
        INNER JOIN 
            (
                SELECT CONVERT(colonydeed USING utf8mb4) AS colonydeed
                FROM suicidepreventions
            ) AS sp ON sp.colonydeed = colonias.nombre
        WHERE 
            estados.clave = 10 
            AND municipios.id = 10007
        GROUP BY 
            colonias.nombre;
           "
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estados');
        Schema::dropIfExists('municipios');
        Schema::dropIfExists('colonias');
        Schema::dropIfExists('continmap');
    }
};
