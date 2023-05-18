<div class="user">
    <h1 class="user-title">{{$user->name}}</h1>
    <div class="user-inner">
        <div class="user-balance">
            <div>
                <p>Aктивный:</p>
                <p>{{$account->active_balance}}</p>
            </div>
            <div>
                <p>Холдированный:</p>
                <p>{{$account->hold_balance}}</p>
            </div>
        </div>

        <div class="user-buttons">
            <a href="{{route('deposite.form')}}" class="list-edit">Пополнить баланс</a>
            <!-- <button class="button">пополнить баланс</button> -->
            <a href="{{route('deposite.form')}}" class="list-edit">Снять баланс</a>
        </div>
    </div>
</div>