<?php

namespace App\Http\Controllers;

use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search') ?? "";
        if (!empty($search))
            $lstShipping = Shipping::where('name', 'LIKE', "%$search%")->paginate(3);
        else
            $lstShipping = Shipping::paginate(3);
        $lstShipping->appends($request->all());
        return view('Shippings.index', ['shipping' => $lstShipping]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Shippings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:shippings,name', 'max:255'],
            'price' => ['required', 'numeric', 'integer', 'min:0']
        ]);
        $sh = new Shipping;
        $sh->fill([
            'name' => $request->input('name'),
            'price' => $request->input('price')
        ]);
        $sh->save();
        return Redirect::route('shippings.index')->with('add', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function show(Shipping $shipping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipping $shipping)
    {
        return view('Shippings.edit', ['shipping' => $shipping]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shipping $shipping)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'price' => ['required', 'numeric', 'integer', 'min:0']
        ]);
        $shipping->fill([
            'name' => $request->input('name'),
            'price' => $request->input('price')
        ]);
        $shipping->save();
        return Redirect::route('shippings.edit', ['shipping' => $shipping])->with('update', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipping $shipping)
    {
        $shipping->delete();
        // $shipping->save();
        return Redirect::route('shippings.index')->with('deleted', 'ok');
    }

    public function trash()
    {
        $lstShipping = Shipping::onlyTrashed()->paginate(3);
        return view('Shippings.trash', ['shipping' => $lstShipping]);
    }

    public function restore($id)
    {
        $lstShipping = Shipping::withTrashed()->where('id', $id)->first();
        $lstShipping->restore();
        return Redirect::route('shippings.trash')->with('restored', 'ok');
    }

    public function getShippings()
    {
        $lstShipping = Shipping::get(['id', 'name', 'price']);
        return response($lstShipping, 200);
    }
}
