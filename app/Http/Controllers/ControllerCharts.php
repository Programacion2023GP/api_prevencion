<?php

namespace App\Http\Controllers;
use App\Models\charts;
use App\Models\ObjResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ControllerCharts extends Controller
{
    public function create(Request $request, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
         // Obtener el número total de registros del usuario actual
            $totalCharts = charts::where('user_id', Auth::user()->id)->count();

            // Calcular la nueva posición
            $newPosition = $totalCharts > 0 ? $totalCharts + 1 : 1;

            // Crear una nueva instancia de chart y asignar los valores
            $userChart = new charts();
            $userChart->user_id = Auth::user()->id;
            $userChart->name = $request->name;
            $userChart->chart_selected = $request->chart_selected;
            $userChart->option_selected = $request->option_selected;
            // $userChart->years = $request->years ?? false;
            // $userChart->months = $request->months ?? false;
            // $userChart->days = $request->days ?? false;
            // $userChart->zoom = $request->zoom ?? false;
            // $userChart->png = $request->png ?? false;
            $userChart->description = $request->description ?? "";
            $userChart->position = $newPosition;
            $userChart->save();

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


          $list = charts::orderBy('position', 'asc')
          ->where('active', 1)->where('user_id', Auth::user()->id)

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
    public function all(Response $response)
    {
       $response->data = ObjResponse::DefaultResponse();
       try {
          // $list = DB::select('SELECT * FROM users where active = 1');
          // User::on('mysql_gp_center')->get();


          $list = charts::orderBy('position', 'asc')->where('user_id', Auth::user()->id)

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
    public function destroy(int $id, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            

          
           $affectedRows = charts::where('id', $id)
           
           ->update([
               'active' => DB::raw('NOT active'),
           ]);
       
      


            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria ';
            $response->data["alert_text"] ='resguardo baja';

        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function moveUp(int $id, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            

            $chart = charts::where('id', $id)->where("user_id",Auth::user()->id)->first();
           $chartafter = charts::where('position', $chart->position-1)->where("user_id",Auth::user()->id)->first();
            $afterposition =$chart->position;
           $chart->position=$chartafter->position;
           $chartafter->position= $afterposition;
           $chart->update();
           $chartafter->update();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria ';
            $response->data["alert_text"] ='cambiado de posicion';

        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function moveDown(int $id, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            

          
           $chart = charts::where('id', $id)->where("user_id",Auth::user()->id)->first();
           $chartafter = charts::where('position', $chart->position+1)->where("user_id",Auth::user()->id)->first();
            $afterposition =$chart->position;
           $chart->position=$chartafter->position;
           $chartafter->position= $afterposition;
           $chart->update();
           $chartafter->update();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria ';
            $response->data["alert_text"] ='cambiado de posicion';

        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
}
