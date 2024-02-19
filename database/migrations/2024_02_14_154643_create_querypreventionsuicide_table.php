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
            CREATE OR REPLACE VIEW querypreventionsuicide AS
                select users.name as sesion_nombre,users.email as sesion_correo,s.name as sitio,ac.name as acto_fue,d.name as dependencia,c.name as causa,dc.name dependencia_canalizada,
            g.name as genero,b.name as religion,st.name as estado_civil,li.name as alfabetismo_escolaridad,ch.name as posesion_hijos,
            ex.name as suicidas_familia,ad.name as adiciones,dis.name as enfermedades,vi.name as violencia,fa.name as familia,sch.name as centro_educativo,
            ind.name as como_indentifica,mea.name as medio_empleado,act.name as ocupacion, sc.*
            from users left join suicidepreventions as sc on users.id =sc.user_id
            left join sites as s on s.id = sc.sites_id left join actwas as ac on ac.id = sc.actwas_id
            left join dependeces as d on d.id = sc.dependeces_id left join cause as c on c.id =sc.causes_id
            left join dependeces as dc on dc.id = sc.dependececanalize_id left join gender as g on g.id = sc.gender_id
            left join belief as b on b.id =sc.belief_id left join statecivil as st on st.id =sc.statecivil_id
            left join literacy as li on li.id=sc.literacy_id left join childrens as ch on ch.id =sc.childrens_id
            left join exitence as ex on ex.id = sc.existence_id left join adictions as ad on ad.id = sc.adictions_id
            left join diseases as dis on dis.id = sc.diseases_id left join violence as vi on vi.id =sc.violence_id
            left join family as fa on fa.id=sc.family_id left join school as sch on sch.id = sc.school_id left join indentified as ind on ind.id=sc.indetified_id
            left join meansemployees as mea on mea.id = sc.meanemployeed_id left join activities as act on act.id = sc.activies_id
           "
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('querypreventionsuicide');
    }
};
