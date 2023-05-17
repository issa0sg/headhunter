<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{

    public function index()
    {
        $account = auth()->user()->account;
        return view('account.index',compact('account'));
    }

    public function depositeForm()
    {
        return view('account.deposite');
    }

    public function depositeDo(Request $request)
    {
        $request->validate([
            'balance' => 'required|integer'
        ]);

        $addValue = $request->all();
        if($addValue['balance']<0){
            return redirect()->route('account.index')->with('error','Невозможно добавить отрициательную сумму');
        }

        $account = auth()->user()->account;
        $account->addBalance($addValue['balance']);
        $account->update();

        return redirect()->route('account.index')->with('success','Удалось добавить сумму');
    }

    

}
