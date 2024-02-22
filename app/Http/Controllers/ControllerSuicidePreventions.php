<?php

namespace App\Http\Controllers;
use App\Models\Suicidepreventions;
use App\Models\Dependence;
use App\Models\Map;
use App\Models\Querypreventionsuicide;
use App\Models\ObjResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;

class ControllerSuicidePreventions extends Controller
{
    public function create(Request $request, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {

            $dependece = Auth::user()->role == "Capturista" ? Auth::user()->dependece_id : $request->dependeces_id;
            $create = Suicidepreventions::create([
                'dateregister' => $formattedDate = date('Y-m-d', strtotime(str_replace('/', '-', $request->dateregister))),
                'name' => $request->name ?? null,
                'invoice' => $request->invoice,
                'datecurrence' => date('Y-m-d', strtotime($request->datecurrence)),
                'cp' => $request->cp?? null,
                'states' => $request->states?? null,
                'municipys' => $request->municipys?? null,
                'colony' => $request->colony?? null,
                'datesuccess' =>date('Y-m-d', strtotime($request->datesuccess))?? null,
                'cpdeed' => $request->cpdeed,
                'statesdeed' => $request->statesdeed,
                'municipysdeed' => $request->municipysdeed,
                'colonydeed' => $request->colonydeed,
                'personinformate' => $request->personinformate,
                'curp' => $request->curp?? null,
                'description'=> $request->description?? null,
                'age' => $request->age?? null,
                'addicion'=>$request->addicion,
                'datereindence' => date('Y-m-d', strtotime($request->datereindence))?? null,
                'date_created'=> date('Y-m-d', strtotime($request->date_created)),
                'estudiante' => $request->estudiante,
                'user_id' => Auth::user()->id,
                'sites_id' => $request->sites_id ?? null,
                'actwas_id' => $request->actwas_id ?? null,
                'dependeces_id' => $dependece,
                'causes_id' => $request->causes_id ?? null,
                'dependececanalize_id' => $request->dependececanalize_id ?? null,
                'gender_id' => $request->gender_id ?? null,
                'belief_id' => $request->belief_id ?? null,
                'statecivil_id' => $request->statecivil_id ?? null,
                'literacy_id' => $request->literacy_id ?? null,
                'childrens_id' => $request->childrens_id ?? null,
                'existence_id' => $request->existence_id ?? null,
                'adictions_id' => $request->adictions_id ?? null,
                'diseases_id' => $request->diseases_id ?? null,
                'violence_id' => $request->violence_id ?? null,
                'family_id' => $request->family_id ?? null,
                'school_id' => $request->school_id ?? null,
                'indetified_id' => $request->indetified_id ?? null,
                'meanemployeed_id' => $request->meanemployeed_id ?? null,
                'activies_id' => $request->activies_id ?? null,

            ]);

            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Petición satisfactoria | grupo registrado.';
            $response->data["alert_text"] = "Se ha creado correctamente el sitio";
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }

        return response()->json($response, $response->data["status_code"]);
    }
    public function update(Request $request, Response $response,int $id)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $dependece = Auth::user()->role == "Capturista" ? Auth::user()->dependece_id : $request->dependeces_id;
            $create = Suicidepreventions::updateOrCreate(
                ['id' => $id], // Busca el registro por su ID
                [
                    // 'dateregister' => $formattedDate = date('Y-m-d', strtotime(str_replace('/', '-', $request->dateregister))),
                    'name' => $request->name,
                    'invoice' => $request->invoice,
                    'datecurrence' => date('Y-m-d', strtotime($request->datecurrence)),
                    'cp' => $request->cp,
                    'states' => $request->states,
                    'municipys' => $request->municipys,
                    'colony' => $request->colony,
                    'datesuccess' =>date('Y-m-d', strtotime($request->datesuccess)),
                    'cpdeed' => $request->cpdeed,
                    'statesdeed' => $request->statesdeed,
                    'municipysdeed' => $request->municipysdeed,
                    'colonydeed' => $request->colonydeed,
                    'personinformate' => $request->personinformate,
                    'addicion'=>$request->addicion,
                    'curp' => $request->curp,
                    'estudiante' => $request->estudiante,
                    'description'=> $request->description,
                    'age' => $request->age,
                    'datereindence' => date('Y-m-d', strtotime($request->datereindence)),
                    'sites_id' => $request->sites_id,
                    'actwas_id' => $request->actwas_id,
                    'dependeces_id' => $dependece,
                    'causes_id' => $request->causes_id,
                    'dependececanalize_id' => $request->dependececanalize_id,
                    'gender_id' => $request->gender_id,
                    'belief_id' => $request->belief_id,
                    'statecivil_id' => $request->statecivil_id,
                    'literacy_id' => $request->literacy_id,
                    'childrens_id' => $request->childrens_id,
                    'existence_id' => $request->existence_id,
                    'adictions_id' => $request->adictions_id,
                    'diseases_id' => $request->diseases_id,
                    'violence_id' => $request->violence_id,
                    'family_id' => $request->family_id,
                    'school_id' => $request->school_id,
                    'indetified_id' => $request->indetified_id,
                    'meanemployeed_id'=> $request->meanemployeed_id,
                    'activies_id'=> $request->activies_id,
                ]
            );

            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Petición satisfactoria | grupo registrado.';
            $response->data["alert_text"] = "Se ha creado correctamente el sitio";
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }

        return response()->json($response, $response->data["status_code"]);
    }
    public function findIndex(Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $latestSuicidePrevention = Suicidepreventions::orderBy('id', 'desc')->first();
            $nextId = $latestSuicidePrevention ? $latestSuicidePrevention->id + 1 : 1;
    
            $list = Suicidepreventions::orderBy('id', 'desc')
                ->where('active', 1)
                ->get();
    
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Petición satisfactoria | Lista de sitios.';
            $response->data["alert_text"] = "Sitios encontrados";
            $response->data["result"] = $list;
            $response->data["next_id"] = $nextId;
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function index(Response $response)
     {
        $response->data = ObjResponse::DefaultResponse();
        try {
           
           $userRole = Auth::user()->role;

           $query = Querypreventionsuicide::orderBy('id', 'desc')
           ->where('active', 1);
           
          
           if ($userRole == "Capturista") {
            $query =$query->where('user_id', Auth::user()->id);
            }
           $list = $query->get();
       
       
       
  
           $response->data = ObjResponse::CorrectResponse();
           $response->data["message"] = 'peticion satisfactoria | lista de sitios.';
           $response->data["alert_text"] = "sitios encontrados";
           $response->data["result"] = $list;
        } catch (\Exception $ex) {
           $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
     } 
     public function Show(Response $response)
     {
        $response->data = ObjResponse::DefaultResponse();
        try {
           
           $userRole = Auth::user()->role;

           $query = Querypreventionsuicide::orderBy('id', 'desc')
           ->where('active', 1)
           ->whereNotNull("gender_id");

           
          
           if ($userRole == "Capturista") {
            $query =$query->where('user_id', Auth::user()->id);
            }
           $list = $query->get();
       
       
       
  
           $response->data = ObjResponse::CorrectResponse();
           $response->data["message"] = 'peticion satisfactoria | lista de sitios.';
           $response->data["alert_text"] = "sitios encontrados";
           $response->data["result"] = $list;
        } catch (\Exception $ex) {
           $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
     } 
    
     public function Map(Response $response)
     {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $query = Map::all(); // Cambiado a Map::all() para obtener todos los registros de la tabla Map 
           $response->data = ObjResponse::CorrectResponse();
           $response->data["message"] = 'peticion satisfactoria | lista de sitios.';
           $response->data["alert_text"] = "sitios encontrados";
           $response->data["result"] = $query;
        } catch (\Exception $ex) {
           $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
     } 
}
