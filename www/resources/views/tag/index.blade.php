@extends('layouts.layout')

@section('content')

<link rel="stylesheet" href="../../../public/assets/css/section.css">

<h1 class="title">Список тэго</h1>

@if ($tags->isEmpty())
<div class="none">Нет тэгов</div>
@else
<div class="list">
    @foreach ($tags as $tag)
    <div class="list-inner">
        <li class="list-item">{{ $tag->id }} {{$tag->title}}</li>
        @if (auth()->user()->is_admin)
        <div class="bar">
            <a href="{{route('tags.edit', ['tag' => $tag->id])}}" class="list-edit">Edit</a>
            <form action="{{route('tags.destroy',['tag' => $tag->id])}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="button">Удоли</button>
            </form>
        </div>
        @endif
    </div>
    @endforeach
</div>

@endif

@endsection