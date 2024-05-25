<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function SalesReport(){

        try{
            $currentDate = Carbon::now();
            $startOfMonth = $currentDate->copy()->startOfMonth()->toDateString();
            $endOfMonth = $currentDate->copy()->endOfMonth()->toDateString();
            
            $sale = Sale::whereBetween('date', [$startOfMonth, $endOfMonth])->with('product','customer')->get();
            $total_quantity = Sale::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('quantity');
            $g_total = Sale::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('g_total');
            $p_amount = Sale::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('p_amount');
            $d_amount = Sale::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('d_amount');

            return response()->json([
                'sale' => $sale,
                'total_quantity' => $total_quantity,
                'g_total' => $g_total,
                'p_amount' => $p_amount,
                'd_amount' => $d_amount
            ]);

        }catch(\Exception $error){
            dd($error->getMessage());

        }

      

    }

    public function SalesReportDate(Request $request){

        try{

           $start_date = $request->input('start_date');
           $end_date = $request->input('end_date');
            
            $sale = Sale::whereBetween('date', [$start_date, $end_date])->with('product','customer')->get();
            $total_quantity = Sale::whereBetween('date', [$start_date, $end_date])->sum('quantity');
            $g_total = Sale::whereBetween('date', [$start_date, $end_date])->sum('g_total');
            $p_amount = Sale::whereBetween('date', [$start_date, $end_date])->sum('p_amount');
            $d_amount = Sale::whereBetween('date', [$start_date, $end_date])->sum('d_amount');

            return response()->json([
                'message' => 'Custom filter success',
                'sale' => $sale,
                'total_quantity' => $total_quantity,
                'g_total' => $g_total,
                'p_amount' => $p_amount,
                'd_amount' => $d_amount
            ]);

        }catch(\Exception $error){
            dd($error->getMessage());

        }

      

    }


}
