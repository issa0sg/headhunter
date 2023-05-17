@extends('layouts.layout')

@section('content')

<div class="create">
<label for="title">Title: </label>
<div>{{ $order->title }}</div>
<br>
<label for="title">Content: </label>
<div>{{ $order->content }}</div>
<br>
<label for="title">Reward: </label>
<div>{{ $order->reward }}</div>
<br>
<div><img src="{{$order->getImage()}}" alt=""></div>

@if ($order->user_id != auth()->user()->id)
        
<form action="{{route('orders.complete',['order' => $order->id])}}" method="post">
        @csrf
        @method('PUT')
        <button type="submit" class="order-button">Завершить</button>
</form>
@endif

</div>

@endsection