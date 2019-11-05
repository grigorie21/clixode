@extends('index')

@section('body')
    <a href="{{route('file.create')}}" class="button">Create</a>
    <table>
        <thead>
        <tr>
            <th class="id">#</th>
            <th class="title">Title</th>
            <th class="datetime">Created</th>
            <th class="datetime">Updated</th>
            <th class="actions">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($model as $v)
            <tr>
                <td class="text-right">{{$v->id}}</td>
                <td>{{$v->title}}</td>
                <td class="text-center">{{$v->created_at}}</td>
                <td class="text-center">{{$v->updated_at}}</td>
                <td class="actions">
                    <a href="{{route('file.edit', ['model' => $v->id])}}">
                        <i class="icon edit"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
