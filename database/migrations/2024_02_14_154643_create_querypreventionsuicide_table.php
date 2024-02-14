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
            from users inner join suicidepreventions as sc on users.id =sc.user_id
            inner join sites as s on s.id = sc.sites_id inner join actwas as ac on ac.id = sc.actwas_id
            inner join dependeces as d on d.id = sc.dependeces_id inner join cause as c on c.id =sc.causes_id
            inner join dependeces as dc on dc.id = sc.dependececanalize_id inner join gender as g on g.id = sc.gender_id
            inner join belief as b on b.id =sc.belief_id inner join statecivil as st on st.id =sc.statecivil_id
            inner join literacy as li on li.id=sc.literacy_id inner join childrens as ch on ch.id =sc.childrens_id
            inner join exitence as ex on ex.id = sc.existence_id inner join adictions as ad on ad.id = sc.adictions_id
            inner join diseases as dis on dis.id = sc.diseases_id inner join violence as vi on vi.id =sc.violence_id
            inner join family as fa on fa.id=sc.family_id inner join school as sch on sch.id = sc.school_id inner join indentified as ind on ind.id=sc.indetified_id
            inner join meansemployees as mea on mea.id = sc.meanemployeed_id inner join activities as act on act.id = sc.activies_id
            group by sc.id"
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
