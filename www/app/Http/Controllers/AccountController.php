<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $account = auth()->user()->account;
        return view('account.index',compact('account','user'));
    }

    public function depositeForm()
    {
        return view('account.deposite');
    }

    public function depositeDo(Request $request)
    {
        $request->validate([
            'balance' => 'required|integer|min:1'
        ]);

        $addValue = $request->all();

        $account = auth()->user()->account;
        $account->addBalance($addValue['balance']);
        
        $account->update();

        return redirect()->route('user.index')->with('success','Удалось добавить сумму');
    }

    

}
