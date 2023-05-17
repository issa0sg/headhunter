@extends('layouts.layout')

@section('content')

<link rel="stylesheet" href="../../../public/assets/css/section.css">


<h1 class="title">Список категории</h1>

@if ($categories->isEmpty())
<div class="none">Нет категории</div>
@else
<div class="list">
    @foreach ($categories as $category)
    <div class="list-inner">
        <li class="list-item">{{ $category->id }} {{$category->title}}</li>
        @if (auth()->user()->is_admin)
        <div class="bar">
            <a href="{{route('categories.edit', ['category' => $category->id])}}" class="list-edit">Edit</a>
            <form action="{{route('categories.destroy',['category' => $category->id])}}" method="post">
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