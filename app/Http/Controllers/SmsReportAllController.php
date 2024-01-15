<?php

namespace App\Http\Controllers;

use App\Models\SmsReport;
use Illuminate\Http\Request;

 /**
 * @OA\Get(
 *      path="/api/sms-report",
 *      operationId="Sms Reports Filter",
 *      tags={"Sms Reports"},
 *      summary="Get filtered SMS reports",
 *      description="Get SMS reports within a specified date range",
 *      security={{ "bearerAuth": {} }},

 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="Başarılı", type="string"),
 *              @OA\Property(
 *                  property="sms_reports",
 *                  type="array",
 *                  @OA\Items(
 *                      type="object",
 *                     
 *                  )
 *              ),
 *          ),
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
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="No SMS reports found in the specified date range",
 *      ),
 * )
 */

class SmsReportAllController extends Controller
{
    public function SmsReport(){

        $user = auth()->user();


        $filteredReports = SmsReport::get();

        if ($filteredReports->count() === 0) {

        return response()->json(['Uyarı' => 'Sms Rapor kaydınız bulunmamaktadır.']);
        
        }
        return response()->json([
            'Başarılı'=>'Raporlama işleminiz başarılı bir şekilde gerçekleşmiştri',
            'sms_reports' => $filteredReports
        ]);

    }
}
