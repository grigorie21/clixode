@extends('index')

@section('body')
    @dump($errors->any(), $errors->all())
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @if($model->id)
        <form action="{{route('api.file.add.upload')}}" method="post" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="bucket" value="Hello world"/>

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
