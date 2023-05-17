@extends('layouts.layout')

@section('content')


<div class="create">

    <h1 class="create-title">Создание заказа</h1>

    <form action="{{ route('orders.store') }}" method="post" class="create-form" enctype="multipart/form-data">

        @csrf
        <div>
            <label for="title">Order title</label>
            <input type="text" name="title" value="{{old('title')}}" placeholder="title">
        </div>
        <div><label for="content">Order content</label>
            <input type="text" name="content" value="{{old('title')}}" placeholder="content">
        </div>
        <div>
            <label for="category_id">Order category</label>
            <div class="category_id-wrapper">
                <select name="category_id" id="category_id">
                    @foreach ($categories as $k => $v )
                    <option value="{{ $k }}">{{$v}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div>
            <label for="tags">Order tags</label>
            <select name="tags[]" id="tags" multiple="multiple">
                @foreach ($tags as $k => $v )
                <option value="{{ $k }}">{{$v}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="reward">Order reward</label>
            <input type="number" name="reward" value="{{old('reward')}}" placeholder="reward">
        </div>
        <div>
            <label for="image">Image</label>
            <input type="file" name="image" id="image">
        </div>
        <button type="submit" class="create-button">Create</button>
    </form>

</div>

@endsection