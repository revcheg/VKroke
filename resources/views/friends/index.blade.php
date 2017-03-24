@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h3>Ваши друзья</h3>

            @if (!$friends->count())
                <p>У вас нет ни одного друга.</p>
            @else
                @foreach ($friends as $user)
                    @include('user/partials/userblock')
                @endforeach
            @endif
            
        </div>
        <div class="col-lg-6">
            <h3>Запросы в друзья</h3>

            @if (!$requests->count())
                <p>У вас нет новых запросов.</p>
            @else
                @foreach ($requests as $user)
                    @include('user.partials.userblock')
                @endforeach
            @endif
        </div>
    </div>
@stop
