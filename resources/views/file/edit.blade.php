@extends('index')

@section('body')
    @if($model->id)
        EDIT
    @else

{{--        <h4>CREATE</h4><br/>--}}

{{--        {{Form::model($model, ['route' => ['admin.ref.payment-type.update', 'id' => $model->id], 'method' => 'POST'])}}--}}
{{--        <div class="card">--}}
{{--            <div class="card-header">--}}
{{--                <ul class="nav nav-pills card-header-pills">--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link active" href="#">Основные параметры</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}

{{--            <div class="card-body">--}}
{{--                <div class="form-group">--}}
{{--                    <label>Заголовок</label>--}}
{{--                    {{Form::text('title', null, ['class' => 'form-control'])}}--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="card-footer">--}}
{{--                <div class="btn-group">--}}
{{--                    <a href="{{route('admin.ref.payment-type.index', request()->query())}}" class="btn btn-secondary">Назад</a>--}}
{{--                    <button type="submit" class="btn btn-success">Сохранить</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        {{Form::close()}}--}}
    @endif
{{--    <form action="{{route('file.store')}}">--}}
{{--        </br>--}}
{{--        </br>--}}
{{--        <input type="text">--}}
{{--        </br>--}}
{{--        </br>--}}
{{--        <input type="text">--}}
{{--        </br>--}}
{{--        </br>--}}
{{--        <select type="text">--}}
{{--    </form>--}}
@endsection
