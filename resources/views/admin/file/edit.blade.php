@extends('admin.index')

@section('body')
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @if($model->id)
        <form action="{{route('admin.file.upload')}}" method="post" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="bucket_id" value="{{$model->id}}"/>

            <table>
                <tr>
                    <td>
                        <input type="file" name="file">
                    </td>
                    <td>
                        <button type="submit" class="button">Add file</button>
                    </td>
                </tr>
            </table>
        </form>
    @else
        CREATE
    @endif

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Created at</th>
            <th>Link</th>
            <th>Download</th>
            <th>Delete</th>
        </tr>
        </thead>
        @foreach($model->files as $v)
            <tr>
                <td>{{$v->pivot->id}}</td>
                <td>{{$v->pivot->name}}</td>
                <td>{{$v->pivot->created_at->format('d.m.Y H:i:s')}}</td>
                <td>http:{{route('download.file', ['slug' => $v->pivot->slug])}}</td>
                <td>
                    <a href="{{route('download.file', ['slug' => $v->pivot->slug])}}">Download</a>
                </td>
                <td>
                    <form action="{{route('admin.file.delete', ['id' => $v->pivot->id])}}" method="post">
                        @method('DELETE')
                        @csrf

                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
