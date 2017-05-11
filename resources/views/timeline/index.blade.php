@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <form role="form" action="{{ route('status.post') }}" method="post">
                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                    <textarea placeholder="Что нового {{ Auth::user()->getFirstNameOrUsername() }}?" name="status" class="form-control" rows="2"></textarea>
                    @if ($errors->has('status'))
                        <span class="help-block">{{ $errors->first('status') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Отправить</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5">
            @if (!$statuses->count())
                <p>Ваша лента пуста.</p>
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
                                <li><a href="#">Like</a></li>
                                <li><a href="#">Dislike</a></li>
                                <li>10 likes</li>
                                <li>3 dislike</li>
                            </ul>
                            
<!--
                            <div class="media">
                                <a href="#" class="pull-left">
                                    <img src="" alt="" class="media-object">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="">Billy</a></h4>
                                    <p>Yes, it is lovely!</p>
                                    <ul class="list-inline">
                                        <li>28 minutes ago.</li>
                                        <li><a href="#">Like</a></li>
                                        <li><a href="#">Dislike</a></li>
                                        <li>4 likes</li>
                                    </ul>
                                </div>
                            </div>
-->
                        <form role="form" action="#" method="post">
                            <div class="form-group">
                                <textarea name="reply-1" class="form-control" rows="2" placeholder="Написать комментарий..."></textarea>
                            </div>
                            <input type="submit" value="Ответить" class="btn btn-sm btn-success">
                        </form>
                        </div>
                    </div>
                @endforeach
                
                {!! $statuses->render() !!}
            @endif
        </div>
    </div>
@stop