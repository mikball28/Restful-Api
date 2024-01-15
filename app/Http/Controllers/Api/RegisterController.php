<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Post(
 *      path="/api/register",
 *      operationId="Register",
 *      tags={"Register"},
 *      summary="User Register",
 *      description="User Register here",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\MediaType(
 *              mediaType="multipart/form-data",
 *              @OA\Schema(
 *                  type="object",
 *                  @OA\Property(property="name", type="string"),
 *                  @OA\Property(property="email", type="string"),
 *                  @OA\Property(property="password", type="string", format="password"),
 *              )
 *          )
 *      ),
 *      @OA\Response(
 *          response=201,
 *          description="Successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/RegisterProject")
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
 *     schema="RegisterProject",
 *     title="Register Project",
 *     @OA\Property(property="property1", type="string"),
 *     @OA\Property(property="property2", type="string"),
 * )
 */

 
class RegisterController extends Controller
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

    public function register(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required'
        ]);

        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password
        ]);

        $token = Auth::login($user);

        return response()->json([
            'status'=>'Başarılı',
            'message'=>'Kullanıcı kaydı başarılı!',
            'user'=>$user,
            'token'=>$token
        ]);
    }
}
