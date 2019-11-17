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
        EDIT
    @else
        CREATE
    @endif
    FILE BUCKET
@endsection
