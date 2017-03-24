@extends('templates.default')

@section('content')
    <h3>Результат по запросу <b>"{{ Request::input('query') }}"</b></h3><br>

    @if (!$users->count())
        <p>Ваш запрос не дал результатов.</p>
    @else

    <div class="row">
        <div class="col-lg-12">
            @foreach ($users as $user)
                @include('user/partials/userblock')
            @endforeach
        </div>
    </div>
    @endif
@stop