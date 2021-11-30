@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <table class="table table-hover">
            <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Filename</th>
                  <th scope="col">Created</th>
                  <th scope="col">Modified</th>
                  <th scope="col">Action</th>
                </tr>
            </thead>
            <div style="opacity: 0;">{{ $id = 1 }}</div>

            @foreach( $files as $file )
            <tbody>
                <th scope="row">{{ $id }}</th>
                <td>{{ $file->name }}</td>
                <td>{{ $file->filename }}</td>
                <td>{{ $file->created_at }}</td>
                <td>{{ $file->updated_at }}</td>
                <td class="row">
                    <a href="#" class="btn btn-primary mr-2">Edit</a>
                    <form method="post" action="{{ url('/file/delete/'.$file->id) }}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                        <button class="btn btn-danger mr" type="submit">Delete</button>
                    </form>
                </td>
            </tbody>
            <div style="opacity: 0;">{{ $id += 1 }}</div>
            @endforeach
        </table>
    </div>
</div>
@endsection
