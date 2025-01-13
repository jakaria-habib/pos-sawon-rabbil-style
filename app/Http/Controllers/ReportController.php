<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use FontLib\Table\Type\loca;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    function reportPage(){
        return view('pages.dashboard.report-page');
    }

    function salesReportPreview(Request $request){
        // Get user and date range from the request
        $user_id = $request->header('id');

        $FromDate = date('Y-m-d', strtotime($request->FromDate));
        $ToDate   = date('Y-m-d', strtotime($request->ToDate));

        // Calculate totals
        $total    = Invoice::where('user_id', $user_id)->whereDate('created_at', '>=', $FromDate)->whereDate('created_at', '<=', $ToDate)->sum('total');
        $vat      = Invoice::where('user_id', $user_id)->whereDate('created_at', '>=', $FromDate)->whereDate('created_at', '<=', $ToDate)->sum('vat');
        $payable  = Invoice::where('user_id', $user_id)->whereDate('created_at', '>=', $FromDate)->whereDate('created_at', '<=', $ToDate)->sum('payable');
        $discount = Invoice::where('user_id', $user_id)->whereDate('created_at', '>=', $FromDate)->whereDate('created_at', '<=', $ToDate)->sum('discount');

        // Get the list of invoices
        $list = Invoice::where('user_id', $user_id)->whereDate('created_at', '>=', $FromDate)->whereDate('created_at', '<=', $ToDate)->with('customer')->get();

        $data = [
            'payable' => $payable,
            'discount'=> $discount,
            'total'   => $total,
            'vat'     => $vat,
            'list'    => $list,
            'FromDate'=> $FromDate,
            'ToDate'  => $ToDate
        ];

        // Return the preview page
        return view('pages.report.sales-report-preview', $data);
    }


    function salesReportDownload(Request $request){

        //invoice info
        $user_id  = $request->header('id');
        $FromDate = date('Y-m-d',strtotime($request->FromDate));
        $ToDate   = date('Y-m-d',strtotime($request->ToDate));
        $total    = Invoice::where('user_id',$user_id)->whereDate('created_at', '>=', $FromDate)->whereDate('created_at', '<=', $ToDate)->sum('total');
        $vat      = Invoice::where('user_id',$user_id)->whereDate('created_at', '>=', $FromDate)->whereDate('created_at', '<=', $ToDate)->sum('vat');
        $payable  = Invoice::where('user_id',$user_id)->whereDate('created_at', '>=', $FromDate)->whereDate('created_at', '<=', $ToDate)->sum('payable');
        $discount = Invoice::where('user_id',$user_id)->whereDate('created_at', '>=', $FromDate)->whereDate('created_at', '<=', $ToDate)->sum('discount');

        //customer info
        $list = Invoice::where('user_id',$user_id)->whereDate('created_at', '>=', $FromDate)->whereDate('created_at', '<=', $ToDate)->with('customer')->get();
        $data = [
            'payable' => $payable,
            'discount'=> $discount,
            'total'   => $total,
            'vat'     => $vat,
            'list'    => $list,
            'FromDate'=> $request->FromDate,
            'ToDate'  => $request->FromDate
        ];

        $pdf = Pdf::loadView('pages.report.sales-report-download',$data);
        return $pdf->download('invoice.pdf');

    }




}
