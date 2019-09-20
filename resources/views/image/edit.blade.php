@extends('index')

@section('body')
    @if($model->id)
        EDIT
    @else
        CREATE
    @endif
    IMAGE BUCKET
@endsection
