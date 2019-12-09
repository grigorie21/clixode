@extends('admin.index')

@section('body')
    @if($model->id)
        EDIT
    @else
        CREATE
    @endif

    <form action="{{route('admin.bucket-image.upload', ['model' => $model->id])}}" method="post" enctype="multipart/form-data">
        @csrf

        <input type="file" multiple name="images[]" />
        <br/>
        <button type="submit">Загрузить картинки</button>
    </form>

    @dump($model)
    @dump($images)
@endsection
