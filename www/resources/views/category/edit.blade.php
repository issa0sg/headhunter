@extends('layouts.layout')

@section('content')

<h1>Редактирование категории</h1>

    <form action="{{ route('categories.update',['category' => $category->id]) }}" method="post">

        @csrf
        @method('PUT')
        <label for="title">Category title</label>
        <input type="text" name="title" value="{{$category->title}}">
        <br>
        <button type="submit">Сохранить</button>
    </form>


@endsection