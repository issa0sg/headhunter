<h1 class="title">Список заказов</h1>

@if ($orders->isEmpty())
<h3 class="none">Нет заказов</h3>
@else
<div class="list">
    <div class="list-filter">
        <div class="select">
            <p>Статус</p>
            <select id="standard-select">
                <option value="Option">Новый</option>
                <option value="Option">Обработка</option>
                <option value="Option">Ожидание</option>
                <option value="Option">Успех</option>
                <option value="Option">Ошибка</option>
                <option value="Option">Отмена</option>
            </select>
            <span class="focus"></span>
        </div>
        <div class="date-picker">
            <p>по дате</p>
            <input type="date" name="dateofbirth" id="date-picker__input">
        </div>
    </div>
    @foreach ($orders as $order)
    @if ((auth()->user()->id == $order->user_id) || auth()->user()->is_admin)
    <div class="list-inner">
        <li class="list-item"><a href="{{route('orders.show',['order' => $order->id])}}">{{ $order->id }} - {{ $order->title }}</a></li>
        <div class="bar">
            <a href="{{route('orders.edit', ['order' => $order->id])}}" class="list-edit">Edit</a>
            <form action="{{route('orders.destroy',['order' => $order->id])}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="button">Удоли</button>
            </form>
            @if (!$order->order_status)
            <form action="{{ route('orders.confirm', $order->id) }}" method="post">
                @csrf
                @method('PUT')
                <button type="submit" class="button">Confirm Order</button>
            </form>
            @endif
        </div>
    </div>
    @else
    <li class="list-item"><a href="{{route('orders.show',['order' => $order->id])}}">{{ $order->id }} - {{ $order->title }}</a></li>
    @endif
    @endforeach
</div>

@endif