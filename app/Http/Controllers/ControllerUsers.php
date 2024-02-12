<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\ObjResponse;
use Illuminate\Http\Response;

use Illuminate\Http\Request;

class ControllerUsers extends Controller
{
    public function signup(Request $request, Response $response)
    {
       $response->data = ObjResponse::DefaultResponse();
       try {

           $existingUser = User::where('payroll', $request->payroll)->first(); 
           if ($existingUser) {
               throw new \Exception('Ya existe un usuario con este número de nomina o correo.');
           }
           $existingUser = User::where('email', $request->email)->first();
           if ($existingUser) {
               throw new \Exception('Ya existe un usuario con este correo.');
           }

           $User=User::create([
              'email' => $request->email,
              'name' => $request->name,
              'role' => $request->role,
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
       $query = User::select('users.*',
       DB::raw("GROUP_CONCAT(DISTINCT groupsextuser.group) as departamentos")
       )->leftjoin('groupsextuser', 'groupsextuser.user_id', '=', 'users.id')
       ->where("users.id",$user->id)
       ->groupBy('users.id')->orderBy('role')->get();
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
       $response->data["result"]["user"]= $query;
       return response()->json($response, $response->data["status_code"]);
    }
    public function logout( Response $response)
    {
        try {
          //  DB::table('personal_access_tokens')->where('tokenable_id', $id)->delete();
          auth()->user()->tokens()->delete();

           $response->data = ObjResponse::CorrectResponse();
           $response->data["message"] = 'peticion satisfactoria | sesión cerrada.';
           $response->data["alert_title"] = "Bye!";
        } catch (\Exception $ex) {
           $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
     }
}
