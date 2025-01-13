<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\In;

class InvoiceController extends Controller
{

    public function salePage() {

        return view('pages.dashboard.sale-page');

    }

    public function invoicePage(){

        return view('pages.dashboard.invoice-page');

    }

    function invoiceCreate(Request $request){
        DB::beginTransaction();

        try {
            $user_id     = $request->header('id');
            $total       = $request->input('total');
            $discount    = $request->input('discount');
            $vat         = $request->input('vat');
            $payable     = $request->input('payable');
            $customer_id = $request->input('customer_id');

            $invoice= Invoice::create([
                'total'      => $total,
                'discount'   => $discount,
                'vat'        => $vat,
                'payable'    => $payable,
                'customer_id'=> $customer_id,
                'user_id'    => $user_id,
            ]);

            $invoiceID = $invoice->id;

            $products = $request->input('products');

            foreach ($products as $product) {
                InvoiceProduct::create([
                    'invoice_id' => $invoiceID,
                    'product_id' => $product['product_id'],
                    'user_id'    => $user_id,
                    'qty'        => $product['product_qty'],
                    'sale_price' => $product['sale_price'],
                ]);
            }
            DB::commit();
            return 1;

        }
        catch (Exception $e) {
            //print_r($e->getMessage());
            DB::rollBack();
            return 0;
        }
    }

    function invoiceList(Request $request){
        $user_id=$request->header('id');
        return Invoice::where('user_id',$user_id)->with('customer')->get();
    }

    function invoiceDetails(Request $request){

        $customer_id = $request->input('customer_id');
        $invoice_id = $request->input('invoice_id');
        $user_id=$request->header('id');

        $customerDetails = Customer::where('user_id',$user_id)->where('id',$customer_id)->first();
        $invoiceTotal    = Invoice::where('user_id',$user_id)->where('id',$invoice_id)->first();
        $invoiceProduct  = InvoiceProduct::where('invoice_id',$invoice_id)->where('user_id',$user_id)->with('product')->get();

        return [
            'customer'  => $customerDetails,
            'invoice'   => $invoiceTotal,
            'product'   => $invoiceProduct,
        ];
    }

    function invoiceDelete(Request $request){

        DB::beginTransaction();

        try {

            $invoice_id = $request->input('invoice_id');
            $user_id=$request->header('id');

            InvoiceProduct::where('invoice_id',$invoice_id)->where('user_id',$user_id)->delete();
            Invoice::where('id',$invoice_id)->delete();
            DB::commit();
            return 1;
        }
        catch (Exception $e){
            DB::rollBack();
            return 0;
        }
    }


}

