<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    function get_all_invoices() {
         $invoices = Invoice::with('customer')->orderBy('id', 'ASC')->get();
         return response()->json([
            'invoices' => $invoices
         ],200);
    }

    function create_invoice(Request $request) {
         $counter = Counter::where('key', 'invoice')->first();
         $random = Counter::where('key', 'invoice')->first();
         $invoice = Invoice::orderBy('id', 'ASC')->get();

         if($invoice){
            $invoice = $invoice->id+1;
            $counters = $counter->value + $invoice;
         }else{
            $counters = $counter->value;
         }

         $formData = [
            'number' => $counter->prefix.$counters,
            'customer_id' => null,
            'customer' => null,
            'date' => date(),
            'due_date' => null,
            'reference' => null,
            'discount' => 0,
            'term_and_conditions' => 'Default',
            'items' => [
                'product_id' => null,
                'product' => null,
                'unit_price' => 0,
                'quantity' => 1
            ]
            ];
         return response()->json($formData);
    }

    function search_invoice(Request $request) {
        $search = $request->get('s');
        if($search != null) {
            $invoices = Invoice::with('customer')->where('id', 'LIKE', "%$search%")->get();
            return response()->json([
                'invoices' => $invoices
            ],200);
        }else{
            return $this->get_all_invoices();
        }
    }
}
