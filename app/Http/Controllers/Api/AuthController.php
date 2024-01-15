<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


/**
 * @OA\Post(
 *      path="/api/login",
 *      operationId="Login",
 *      tags={"Login"},
 *      summary="User Login",
 *      description="User Login here",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\MediaType(
 *              mediaType="multipart/form-data",
 *              @OA\Schema(
 *                  type="object",
 *                  @OA\Property(property="email", type="string"),
 *                  @OA\Property(property="password", type="string", format="password"),
 *              )
 *          )
 *      ),
 *      @OA\Response(
 *          response=201,
 *          description="Successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/LoginProject")
 *      ),
 *      @OA\Response(
 *          response=400,
 *          description="Bad Request"
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthenticated"
 *      ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 * 
 * @OA\Schema(
 *     schema="LoginProject",
 *     title="Login Project",
 *     @OA\Property(property="property1", type="string"),
 *     @OA\Property(property="property2", type="string"),
 * )
 */


 



class AuthController extends Controller 
{
    public function __construct()
    {
        $this->middleware('auth:api',[
            'except'=>[
                'login',
                'register'
            ]
        ]);
    }

    

    public function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $credantials=$request->only('email','password');

        $token=Auth::attempt($credantials);

        if(!$token){
            return response()->json([
                'status'=>'Hata',
                'message'=>'Giriş İşlemi Başarısız!!! '
            ]);

        }

        return response()->json([
            'status'=>'Başarılı',
            'message'=>'Giriş İşlemi Başarılı Sisteme Hoşgeldiniz',
            'token'=>$token
        ]);
    }
}


