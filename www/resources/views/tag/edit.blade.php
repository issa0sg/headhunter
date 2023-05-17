@extends('layouts.layout')

@section('content')

<h1>Редактирование тэга</h1>

    <form action="{{ route('tags.update',['tag' => $tag->id]) }}" method="post">

        @csrf
        @method('PUT')
        <label for="title">tag title</label>
        <input type="text" name="title" value="{{$tag->title}}">
        <br>
        <button type="submit">Сохранить</button>
    </form>


@endsection