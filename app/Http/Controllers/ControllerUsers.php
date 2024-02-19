<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\ObjResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Events\Events;
use App\Models\Groupextuser;

class ControllerUsers extends Controller
{
    public function signup(Request $request, Response $response)
    {
       $response->data = ObjResponse::DefaultResponse();
       try {


           $existingUser = User::where('email', $request->email)->first();
           if ($existingUser) {
               throw new \Exception('Ya existe un usuario con este correo.');
           }

           $User=User::create([
              'email' => $request->email,
              'name' => $request->name,
              'role' => $request->role,
              'dependece_id'=>$request->dependece_id,
          ]);
    //       if ($request->has('groups') && is_array($request->groups) && count($request->groups) > 0) {
    //        foreach ($request->groups as $item) {
    //            Groupextuser::create([
    //                'user_id' => $User->id,
    //                'group' => $item['departamento']
    //            ]);
    //        }
    //    }
          $response->data = ObjResponse::CorrectResponse();
          $response->data["message"] = 'peticion satisfactoria | usuario registrado.';
          $response->data["alert_text"] = "Se ha creado correctamente el usuario";
       } catch (\Exception $ex) {
          $response->data = ObjResponse::CatchResponse($ex->getMessage());
       }
       return response()->json($response, $response->data["status_code"]);
    }
    public function login(Request $request, Response $response)
    {
       $field = 'username';
       $value = $request->username;
       if ($request->email) {
          $field = 'email';
          $value = $request->email;
       }
       $request->validate([
          $field => 'required',
          'password' => 'required'
       ]);
       $user = User::where("$field", "$value")->where("active",1)->first();

       if (!$user || !Hash::check($request->password, $user->password)) {

          throw ValidationException::withMessages([
             'message' => 'Credenciales incorrectas',
             'alert_title' => 'Credenciales incorrectas',
             'alert_text' => 'Credenciales incorrectas',
             'alert_icon' => 'error',
          ]);
       }


       $token = $user->createToken($user->email)->plainTextToken;
       $response->data = ObjResponse::CorrectResponse();
       $response->data["message"] = 'peticion satisfactoria | usuario logeado.';
       $response->data["result"]["token"] = $token;
       $response->data["result"]["user"]= $user;
       return response()->json($response, $response->data["status_code"]);
    }
    public function update(Request $request, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
           $user = User::find($request->id);
           if ($user) {
               $user->name = $request->name;
               $user->email = $request->email;
               $user->role = $request->role;
               $user->dependece_id  = $request->dependece_id;
               $user->save();

           }

            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | departamento actualizada.';
            $response->data["alert_text"] = 'departamento actualizado';

        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    public function logout( Response $response)
    {
        try {
          //  DB::table('personal_access_tokens')->where('tokenable_id', $id)->delete();
          Auth::user()->tokens()->delete();

           $response->data = ObjResponse::CorrectResponse();
           $response->data["message"] = 'peticion satisfactoria | sesión cerrada.';
           $response->data["alert_title"] = "Bye!";
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
           $userRole = Auth::user()->role;

           // Inicializar la consulta de usuarios
           $query = User::orderBy('id', 'desc')->where('active', 1);

           // Si el usuario autenticado es "Super Admin sistemas", obtener todos los usuarios
           if ($userRole == "SuperAdmin") {
            $list = $query->where('role', '<>', 'SuperAdmin')->get();
         }
           // Si el usuario autenticado es "Administrador", obtener solo los "Capturista"
           elseif ($userRole == "Administrador") {
               $list = $query->where('role', 'Capturista')->get();
           }
           // Si el usuario autenticado es "Capturista", no devolver a nadie
           elseif ($userRole == "Capturista") {
               $list = collect(); // Devolver una colección vacía
           }




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



            $affectedRows = User::where('id', $id)
            ->where(function ($query) use ($id) {
               $query->whereNotExists(function ($subquery) use ($id) {
                   $subquery->select(DB::raw(1))
                       ->from('suicidepreventions')
                       ->whereRaw('suicidepreventions.user_id = users.id')
                       ->where('user_id', $id);
               });
           })
            ->update([
                'active' => DB::raw('NOT active'),
            ]);

        if ($affectedRows === 0) {
            throw new \Exception('No se puede eliminar ya existe un registro con usuario');
        }


             $response->data = ObjResponse::CorrectResponse();
             $response->data["message"] = 'peticion satisfactoria | sitio dado de baja.';
             $response->data["alert_text"] ='sitio dado de baja';

         } catch (\Exception $ex) {
             $response->data = ObjResponse::CatchResponse($ex->getMessage());
         }
         return response()->json($response, $response->data["status_code"]);
     }
    }
