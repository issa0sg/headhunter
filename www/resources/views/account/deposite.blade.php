@extends('layouts.layout')

@section('content')

<div class="create">

    <h1 class="create-title">Deposite balance</h1>

    <form action="{{ route('deposite.do') }}" class="create-form" method="post">
        
        
        @csrf
        @method('PUT')
        <div>
            <label for="balance">How much add?</label>
            <input type="number" name="balance" value="{{old('title')}}">
        </div>
        <br>
        <button type="submit" class="create-button">Add</button>
    </form>
    
</div>

@endsection