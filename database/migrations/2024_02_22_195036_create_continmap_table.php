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
        Schema::dropIfExists('continmap');
    }
};
