@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-5">
            @include('user.partials.userblock')
            <hr>
            
            @if (!$statuses->count())
                <p>{{ $user->getFirstNameOrUsername() }}, ничего не постил.</p>
            @else
                @foreach ($statuses as $status)
                    <div class="media">
                        <a href="{{ route('profile.index', ['username' => $status->user->username]) }}" class="pull-left">
                            <img src="{{ $status->user->getAvatarUrl() }}" alt="{{ $status->user->getNameOrUsername() }}" class="media-object">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="{{ route('profile.index', ['username' => $status->user->username]) }}">{{ $status->user->getNameOrUsername() }}</a></h4>
                            <p>{{ $status->body }}</p>
                            <ul class="list-inline">
                                <li>{{ $status->created_at->diffForHumans() }}</li>
                                @if ($status->user->id !== Auth::user()->id)
                                    <li><a class="btn btn-xs btn-info" href="{{ route('status.like', ['statusId' => $status->id]) }}">Like</a></li>
                                @endif
                                <li>{{ $status->likes->count() }} {{ str_plural('like', $status->likes->count()) }}</li>
<!--
                                @if ($status->user->id !== Auth::user()->id)
                                    <li><a class="btn btn-xs btn-info" href="{{ route('status.like', ['statusId' => $status->id]) }}">Like</a></li>
                                    <li>{{ $status->likes->count() }} {{ str_plural('like', $status->likes->count()) }}</li>
                                    <li><a class="btn btn-xs btn-danger" href="#">Dislike</a></li>
                                    <li>3 dislike</li>
                                @endif
-->
                            </ul>
                            
                            @foreach ($status->replies as $reply)
                                <div class="media">
                                    <a href="{{ route('profile.index', ['username' => $reply->user->username]) }}" class="pull-left">
                                        <img src="{{ $reply->user->getAvatarUrl() }}" alt="" class="media-object">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="media-heading"><a href="{{ route('profile.index', ['username' => $reply->user->username]) }}">{{ $reply->user->getNameOrUsername() }}</a></h5>
                                        <p>{{ $reply->body }}</p>
                                        <ul class="list-inline">
                                            <li>{{ $reply->created_at->diffForHumans() }}</li>
                                            @if ($reply->user->id !== Auth::user()->id)
                                                <li><a class="btn btn-xs btn-info" href="{{ route('status.like', ['statusId' => $reply->id]) }}">Like</a></li>
                                            @endif
                                            <li>{{ $reply->likes->count() }} {{ str_plural('like', $reply->likes->count()) }}</li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                            
                            @if ($authUserIsFriend || Auth::user()->id === $status->user->id)
                                <form role="form" action="{{ route('status.reply', ['statusId' => $status->id]) }}" method="post">
                                    <div class="form-group{{ $errors->has("reply-{$status->id}") ? ' has-error': '' }}">
                                        <textarea name="reply-{{ $status->id }}" class="form-control" rows="2" placeholder="Написать комментарий..."></textarea>
                                        @if ($errors->has("reply-{$status->id}"))
                                            <span class="help-block">{{ $errors->first("reply-{$status->id}") }}</span>
                                        @endif
                                    </div>
                                    <input type="submit" value="Ответить" class="btn btn-sm btn-success">
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
            
        </div>
        <div class="col-lg-4 col-lg-offset-3">
            @if (Auth::user()->hasFriendRequestPending($user))
                <p>Ожидайте пока {{ $user->getNameOrUsername() }}, примет ваш запрос.</p>
            @elseif (Auth::user()->hasFriendRequestReceived($user))
                <a href="{{ route('friend.accept', ['username' => $user->username]) }}" class="btn btn-primary">Принять запрос в друзья</a>
            @elseif (Auth::user()->isFriendsWith($user))
                <p>Вы и {{ $user->getNameOrUsername() }} уже являетесь друзьями</p>
                
                <form action="{{ route('friend.delete', ['username' => $user->username]) }}" method="post">
                    <input class="btn btn-danger" type="submit" value="Удалить из друзей">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
                
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