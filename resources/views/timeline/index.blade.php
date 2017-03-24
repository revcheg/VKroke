@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <form role="form" action="#" method="post">
                <div class="form-group">
                    <textarea placeholder="Что нового Мах?" name="status" class="form-control" rows="2"></textarea>
                </div>
                <button type="submit" class="btn btn-default">Обновить статус</button>
            </form>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5">
            
        </div>
    </div>
@stop