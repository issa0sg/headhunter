@extends('layouts.layout')

@section('content')

<div class="user">
    <h1 class="user-title">{{$user->name}}</h1>
    <div class="user-inner">
        <div class="user-balance">
            <div>
                <p>Aктивный:</p>
                <p>{{$account->active_balance}}</p>
            </div>
            <div>
                <p>Холдированный:</p>
                <p>240382</p>
            </div>
        </div>

        <div class="user-buttons">
            <button class="button">пополнить баланс</button>
            <button class="button">снять деньги</button>
        </div>
    </div>
</div>

@endsection