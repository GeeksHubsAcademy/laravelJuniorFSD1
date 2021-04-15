<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Database\QueryException;

use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    //

    //Función encargada del login para
    public function loginUsuario(Request $request){

        $nickname = $request->input('nickname');
        $password = $request->input('password'); 
        
        try {

            //primero cotejamos que existe el nickname en la tabla usuario

            $validate_user = Usuario::select('password')
            ->where('nickname', 'LIKE', $nickname)
            ->first();

            if(!$validate_user){
                return response()->json([
                    //email incorrecto
                    'error' => "Nickname o password incorrecto"
                ]); 
            }
            
            $hashed = $validate_user->password;

            //comprobamos si el password recibido corresponde con el del nickname de candidato
            
            if(Hash::check($password, $hashed)){
                
                //si existe, generamos el token
                
                $length = 50;
                $token = bin2hex(random_bytes($length));

                //guardamos el token en su campo correspondiente, esto
                //es opcional si guardamos el token en la DB
                Usuario::where('nickname',$nickname)
                ->update(['token' => $token]);

                //devolvemos al front la info necesaria ya actualizada
                return Usuario::where('nickname', 'LIKE', $nickname)
                ->get();
            
            }else{
                return response()->json([
                    //password incorrecto
                    'error' => "Nickname o password incorrecto"
                ]);
            }
         
        } catch(QueryException $error){
            
            return response()->$error;
                
        }


    }

    public function logOut(Request $request){

        $id = $request->input('id');

        try {

            return Usuario::where('id', '=', $id)
            ->update(['token' => '']);

        } catch(QueryException $error){
            return $error;
        }

    }

    //Función encargada de buscar un usuario dado un nick
    public function usuarioNombre($nickname) {
        try {

            return Usuario::all()->where('nickname', '=', $nickname)
            ->makeHidden(['password'])->keyBy('id');
       
        } catch (QueryException $error){
            return $error;
        }
    }


    //Función encargada de registrar un nuevo usuario
    public function registerUser(Request $request){

        //nickname,nombre,password,email
        $nickname = $request->input('nickname');
        $nombre = $request->input('nombre');
        $password = $request->input('password');
        $email = $request->input('email');

        //Hasheamos el password
        $password = Hash::make($password);

        try {

            return Usuario::create([
                'nickname' => $nickname,
                'nombre' => $nombre,
                'password' => $password,
                'email' => $email
            ]);

        } catch (QueryException $error) {
            
            $eCode = $error->errorInfo[1];

            if($eCode == 1062) {
                return response()->json([
                    'error' => "Usuario ya registrado anteriormente"
                ]);
            }

        }
    }

    public function modifyUser(Request $request){

        $nickname = $request->input('nickname');
        $nombre = $request->input('nombre');

        try {

            return Usuario::where('nickname', '=', $nickname)
            ->update(['nombre' => $nombre]);


        } catch(QueryException $error) {
             return $error;
        }
    }

    public function deleteUser(Request $request){
        $idUserDelete = $request->input('id');
        try {
            return Usuario::where ('id', '=', $idUserDelete)
            ->delete();
        } catch(QueryException $error){
            return $error;
        }
        
    }
}
