@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-5">
            @include('user.partials.userblock')
            <hr>
            
        </div>
        <div class="col-lg-4 col-lg-offset-3">
            @if (Auth::user()->hasFriendRequestPending($user))
                <p>Ожидайте пока {{ $user->getNameOrUsername() }}, примет ваш запрос.</p>
            @elseif (Auth::user()->hasFriendRequestReceived($user))
                <a href="{{ route('friend.accept', ['username' => $user->username]) }}" class="btn btn-primary">Принять запрос в друзья</a>
            @elseif (Auth::user()->isFriendsWith($user))
                <p>Вы и {{ $user->getNameOrUsername() }} уже являетесь друзьями</p>
            @elseif (Auth::user()->id !== $user->id)
                <a href="{{ route('friend.add', ['username' => $user->username]) }}" class="btn btn-primary">Добавить в друзья</a>
            @endif
            <h4>Друзья, {{ $user->getFirstNameOrUsername() }}</h4>
            
            @if (!$user->friends()->count())
                <p>{{ $user->getFirstNameOrUsername() }}, не имеет ни одного друга.</p>
            @else
                @foreach ($user->friends() as $user)
                    @include('user/partials/userblock')
                @endforeach
            @endif
        </div>
    </div>
@stop