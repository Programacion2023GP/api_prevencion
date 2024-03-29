<?php

namespace App\Http\Controllers;
use App\Models\Family;
use App\Models\ObjResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
class ControllerFamily extends Controller
{
    public function create(Request $request, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $create = Family::create([
                'name' => $request->name,

            ]);

            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Petición satisfactoria | grupo registrado.';
            $response->data["alert_text"] = "Se ha creado correctamente el sitio";
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }

        return response()->json($response, $response->data["status_code"]);

    }
    public function index(Response $response)
     {
        $response->data = ObjResponse::DefaultResponse();
        try {
           // $list = DB::select('SELECT * FROM users where active = 1');
           // User::on('mysql_gp_center')->get();
           $list = Family::orderBy('id', 'desc')
           ->where('active', 1)

           ->get();




           $response->data = ObjResponse::CorrectResponse();
           $response->data["message"] = 'peticion satisfactoria | lista de sitios.';
           $response->data["alert_text"] = "sitios encontrados";
           $response->data["result"] = $list;
        } catch (\Exception $ex) {
           $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
     }
     public function update(Request $request, Response $response)
     {
         $response->data = ObjResponse::DefaultResponse();
         try {
            $site = Family::find($request->id);
            if ($site) {
                $site->name = $request->name;
                $site->save();

            }

             $response->data = ObjResponse::CorrectResponse();
             $response->data["message"] = 'peticion satisfactoria | departamento actualizada.';
             $response->data["alert_text"] = 'departamento actualizado';

         } catch (\Exception $ex) {
             $response->data = ObjResponse::CatchResponse($ex->getMessage());
         }
         return response()->json($response, $response->data["status_code"]);
     }
     public function destroy(int $id, Response $response)
     {
         $response->data = ObjResponse::DefaultResponse();
         try {



            $affectedRows = Family::where('id', $id)
            ->where(function ($query) use ($id) {
                $query->whereNotExists(function ($subquery) use ($id) {
                    $subquery->select(DB::raw(1))
                        ->from('suicidepreventions')
                        ->whereRaw('suicidepreventions.family_id = family.id')
                        ->where('family_id', $id);
                });
            })
            ->update([
                'active' => DB::raw('NOT active'),
            ]);

        if ($affectedRows === 0) {
            throw new \Exception('No se puede eliminar ya existe un registro con el tipo de familia');
        }


             $response->data = ObjResponse::CorrectResponse();
             $response->data["message"] = 'peticion satisfactoria | sitio dado de baja.';
             $response->data["alert_text"] ='sitio dado de baja';

         } catch (\Exception $ex) {
             $response->data = ObjResponse::CatchResponse($ex->getMessage());
         }
         return response()->json($response, $response->data["status_code"]);
     }
     public function values(Response $response)
     {
        $response->data = ObjResponse::DefaultResponse();
        try {
           // $list = DB::select('SELECT * FROM users where active = 1');
           // User::on('mysql_gp_center')->get();
           $list = Family::orderBy('id', 'desc')
           ->where('active', 1)
           ->select('name as text', 'id as value')
           ->get();





           $response->data = ObjResponse::CorrectResponse();
           $response->data["message"] = 'peticion satisfactoria | lista de sitios.';
           $response->data["alert_text"] = "sitios encontrados";
           $response->data["result"] = $list;
        } catch (\Exception $ex) {
           $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
     }
}
