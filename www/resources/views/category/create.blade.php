@extends('layouts.layout')

@section('content')

<div class="create">

    <h1 class="create-title">Create category</h1>

    <form action="{{ route('categories.store') }}" class="create-form" method="post">
        
        
        @csrf
        <div>
            <label for="title">Category title</label>
            <input type="text" name="title" value="{{old('title')}}">
        </div>
        <br>
        <button type="submit" class="create-button">Create</button>
    </form>
    
</div>

@endsection