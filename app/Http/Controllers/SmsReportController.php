<?php

namespace App\Http\Controllers;

use App\Models\SmsReport;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * @OA\Post(
 *      path="/api/send-sms",
 *      operationId="Send Sms",
 *      tags={"Send Sms"},
 *      summary="User Send Sms",
 *      description="User Send Sms here",
 *      security={{ "bearerAuth": {} }},
 *      
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\MediaType(
 *              mediaType="multipart/form-data",
 *              @OA\Schema(
 *                  type="object",
 *                  @OA\Property(property="number", type="string"),
 *                  @OA\Property(property="message", type="string"),
 *              )
 *          )
 *      ),
 *      @OA\Response(
 *          response=201,
 *          description="Successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/sms"),
 * 
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
 *     schema="sms",
 *     title="Project",
 *     @OA\Property(property="property1", type="string"),
 *     @OA\Property(property="property2", type="string"),
 *     
 * )
 */

 


class SmsReportController extends Controller
{

   

    public function sendSms(Request $request)
    {
        

        $number = $request->input('number');
        $message = $request->input('message');

        $smsReport = SmsReport::create([
            'user_id' =>auth()->user()->id,
            'number' => $number,
            'message' => $message,
            'send_time' => now(),
        ]);

        return response()->json([
            'Başarılı'=>'Sms Gönderme işleminiz başarılı bir şekilde gerçekleşmiştir!!!',
            'sms_report' => $smsReport
        ]);
    }
}
