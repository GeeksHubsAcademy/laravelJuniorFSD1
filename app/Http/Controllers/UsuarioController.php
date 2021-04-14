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
