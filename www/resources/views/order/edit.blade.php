@extends('layouts.layout')

@section('content')


<div class="create">

    <h1 class="create-title">Редактирование заказа</h1>

    <form action="{{ route('orders.update',['order' => $order->id]) }}" method="post" class="create-form" enctype="multipart/form-data">

        @csrf
        @method('PUT')
        <div>
            <label for="title">Order title</label>
            <input type="text" name="title" value="{{$order->title}}">
        </div>
        <div><label for="content">Order content</label>
            <input type="text" name="content" value="{{$order->content}}">
        </div>
        <div>
            <label for="category_id">Order category</label>
            <div class="category_id-wrapper">
                <select name="category_id" id="category_id">
                    @foreach ($categories as $k => $v )
                        <option value="{{ $k }}" @if ($k == $order->category_id)
                            selected
                        @endif >{{$v}}</option>
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
            <input type="number" name="reward" value="{{$order->reward}}">
        </div>
        <div>
            <label for="image">Image</label>
            <input type="file" name="image" id="image">
            @if ($order->image)
                <img src="{{$order->getImage()}}" alt="" width="200">
            @endif
        </div>
        <button type="submit" class="create-button">Update</button>
    </form>

</div>

@endsection