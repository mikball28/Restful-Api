<?php

namespace App\Http\Controllers;

use App\Models\SmsReport;
use Carbon\Carbon;
use Illuminate\Http\Request;

 /**
 * @OA\Get(
 *      path="/api/sms-filter",
 *      operationId="Sms Filter Filter",
 *      tags={"Sms Filter"},
 *      summary="Get filtered SMS Filter",
 *      description="Get SMS Filter within a specified date range",
 *      security={{ "bearerAuth": {} }},
 *      @OA\Parameter(
 *          name="start_date",
 *          in="query",
 *          required=true,
 *          description="Start date for filtering (format: Y-m-d )",
 *          @OA\Schema(type="string", format="date"),
 *      ),
 *      @OA\Parameter(
 *          name="end_date",
 *          in="query",
 *          required=true,
 *          description="End date for filtering (format: Y-m-d )",
 *          @OA\Schema(type="string", format="date"),
 *      ),
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
 *                      @OA\Property(property="property1", type="string"),
 *                      @OA\Property(property="property2", type="string"),
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

 
class SmsFilterController extends Controller
{
    public function SmsReportsFilter(Request $request)
    {
        $user = auth()->user();

      

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        

        $startDateTime = Carbon::parse($startDate)->startOfDay();
        $endDateTime = Carbon::parse($endDate)->endOfDay();

        $startDateTime = Carbon::parse($startDate)->startOfDay();
        $endDateTime = Carbon::parse($endDate)->endOfDay();

        $filteredReports = SmsReport::whereBetween('created_at', [$startDateTime, $endDateTime])->get();

        if ($filteredReports->count() === 0) {

        return response()->json(['Uyarı' => 'Belirtilen tarih aralığında SMS raporu bulunamadı.']);
        
        }
        return response()->json([
            'Başarılı'=>'Filtreleme işleminiz başarılı bir şekilde gerçekleşmiştri',
            'sms_reports' => $filteredReports
        ]);
    }
}
