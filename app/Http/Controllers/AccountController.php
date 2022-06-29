<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Http\Requests\StoreAccountRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    protected function fixImage(Account $account)
    {
        if (Storage::disk('public')->exists($account->avatar)) {
            $account->avatar = Storage::url($account->avatar);
        } else {
            $account->avatar = '/images/no_image_placehoder.png';
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search') ?? "";
        if (!empty($search))
            $lstaccount = Account::where('full_name', 'LIKE', "%$search%")->orWhere('email', 'LIKE', "%$search%")->paginate(3);
        else
            $lstaccount = Account::paginate(3);
        $lstaccount->appends($request->all());
        return (view('Accounts.index', ['account' => $lstaccount]));
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
     * @param  \App\Http\Requests\StoreAccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccountRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        $acc = Account::withTrashed()->where('id', $account->id)->first();
        $this->fixImage($acc);
        return view('Accounts.show', ['account' => $acc]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        $validated = $request->validate([
            'fullname' => ['required', 'max:255'],
            'email' => ['required', 'email'],
            'address' => ['required'],
            'password' => ['required'],
            'phone' => ['required', 'numeric'],
            'birthday' => ['required'],
            'image' => ['mimetypes:image/jpg,image/png']
        ]);
        if ($request->hasFile('image')) {
            $account->avatar = $request->file('image')->store('images/avatar/' . $account->id, 'public');
        }
        $account->fill([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'address' => $request->input('address'),
            'full_name' => $request->input('fullname'),
            'phone' => $request->input('phone'),
            'birthday' => $request->input('birthday'),
            'sex' =>  $request->input('sex')
        ]);
        $account->save();
        return Redirect::route('accounts.show', ['account' => $account])->with('update', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        $account->delete();
        return Redirect::route('accounts.index')->with('deleted', 'ok');
    }

    public function trash(Request $request)
    {
        // $search = $request->input('search') ?? "";
        // if (!empty($search))
        //     $accounts = Account::onlyTrashed()->where('full_name', 'LIKE', "%$search%")->orWhere('email', 'LIKE', "%$search%")->paginate(3);
        // else
        $accounts = Account::onlyTrashed()->paginate(3);
        return view('Accounts.trash', ['account' => $accounts]);
    }

    public function restore($id)
    {
        $account = Account::withTrashed()->where('id', $id)->first();
        $account->restore();
        return Redirect::route('accounts.trash')->with('restored', 'ok');
    }

    public function apiLogin(Request $request)
    {

        $account = Account::where('password', $request['password'])->where(function ($query) use ($request) {
            $query->orwhere('email', $request['email'])->orwhere('phone', $request['phone']);
        })->first();

        if ($account) {
            return response()->json($account, 200);
        } else {
            return response()->json($account, 405);
        }
    }
    public function getAccount($id)
    {
        $acc = Account::find($id);
        return response()->json($acc, 200);
    }
    public function signin(Request $request)
    {
        $validated = $request->validate([
            'fullname' => ['required', 'max:255'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'phone' => ['required' ],
            'address'=> ['required', 'max:255']
        ]);
        // if ($request->hasFile('image')) {
        //     $account->avatar = $request->file('image')->store('images/avatar/' . $account->id, 'public');
        // }
        $account=Account::create([
            'full_name' => $request->input('fullname'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'phone' => $request->input('phone'),
           'sex'=> $request->input('sex'),
           'address'=> $request->input('address')
        ]);
        $account->save();
        if($account)
        {
         return response()->json($account, 200);
        }
        else
        {
         return response()->json($account, 400);
        }
    }
    public function edituser(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            "id"=>['required'],
            'fullname' => ['required', 'max:255'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'phone' => ['required' ],
            'address'=> ['required', 'max:255']
        ]);
        // if ($request->hasFile('image')) {
        //     $account->avatar = $request->file('image')->store('images/avatar/' . $account->id, 'public');
        // }
        $account=Account::where('id',$request['id'])->first();
        $account->fill([
            'email' => $request['email'],
            'password' => $request['password'],
            'address' => $request['address'],
            'full_name' => $request['fullname'],
            'phone' => $request['phone'],
        ]);
        $account->save();
        $data=$account;
        if(!empty($data))
        {
         return response()->json($data, 200);
        }
        else
        {
         return response()->json($data, 400);
        }
    }
    
}
