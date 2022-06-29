<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\InvoiceDetail;
use App\Models\Product;
use App\Models\ProductImage;
use DateTime;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lstInvoice = Invoice::orderBy('created_at', 'desc')->paginate(3);
        return view('Invoices.index', ['invoice' => $lstInvoice]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvoiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return view('Invoices.show', ['invoice' => $invoice]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInvoiceRequest  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }

    public function processing()
    {
        $lstInvoice = Invoice::where('status', 1)->paginate(3);
        return view('Invoices.processing', ['invoice' => $lstInvoice]);
    }
    public function being_transported()
    {
        $lstInvoice = Invoice::where('status', 2)->paginate(3);
        return view('Invoices.being-transported', ['invoice' => $lstInvoice]);
    }
    public function completed()
    {
        $lstInvoice = Invoice::where('status', 3)->paginate(3);
        return view('Invoices.completed', ['invoice' => $lstInvoice]);
    }
    public function cancelled()
    {
        $lstInvoice = Invoice::where('status', 5)->paginate(3);
        return view('Invoices.cancelled', ['invoice' => $lstInvoice]);
    }
    public function confirm($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        $invoice->fill([
            'status' => 2
        ]);
        $invoice->save();
        return Redirect::route('invoices.being_transported')->with('update', 'ok');
    }

    public function complete($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        $invoice->fill([
            'status' => 3
        ]);
        $invoice->save();
        return Redirect::route('invoices.completed')->with('update', 'ok');
    }




    public function createInv(Request $request)
    {
        //kiem tra du lieu
        $code = 'BILL' . date("Ymdhms");
        // $validate = Validator::make($request->all(), [
        //     'address' => ['required'],
        //     //'price' => ['required', 'numeric', 'integer', 'min:0'],
        //     //'quantity' => ['required', 'numeric', 'integer', 'min:0'],
        // ]);
        // //neu du lieu no' sai thitra? ve` loi~

        // if ($validate->fails())
        //     return response()->json($validate->errors(), 400);
        $inv = new Invoice;
        $inv->fill([
            'code' => $code,
            'account_id' => $request['account_id'],
            'address' => $request['address'],
            'total' => $request['total'],
        ]);
        $inv->save();
        foreach ($request['data'] as $item) {
            $ind = new InvoiceDetail;
            $total = $item['price'] * $item['quantity'];
            $ind->fill([
                'product_id' =>  $item['product_id'],
                'invoice_id' => $inv->id,
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'total' => $total,
            ]);
            $ind->save();
        }
        return response()->json(["Sucssess" => True], 200);
    }

    public function lstDetailInvoice($lstInv)
    {
        foreach ($lstInv as $inv) {
            $lstDetail = InvoiceDetail::where('invoice_id', $inv->id)->get();

            if (!empty($lstDetail)) {
                Arr::add($inv, 'detail', $lstDetail);
            }
            foreach ($lstDetail as $ind) {
                $prd = Product::where('id', $ind->product_id)->first();
                Arr::add($prd, 'img', ProductImage::where('product_id', $prd->id)->get('path'));
                if (!empty($prd)) {
                    Arr::add($ind, 'prd', $prd);
                }
            }
        }
    }

    public function getInvoice($id, $status)
    {
        $invoice = Invoice::where('account_id', $id)->where('status', $status)->get();

        InvoiceController::lstDetailInvoice($invoice);
        return response()->json($invoice, 200);
    }
   
    public function isCancel($id)  
    {
       
        $inv = Invoice::where('id',$id)->first();

        $inv->fill([
            "status" => 5
        ]);
        $inv->save();
        return response()->json(["Sucssess" => True], 200);
    }
}
