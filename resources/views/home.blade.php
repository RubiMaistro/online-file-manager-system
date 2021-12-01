@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="column justify-content-center" style="width: 100%">
        <div class="row justify-content-end">
            <div class="row">
                <div class="mr-2">
                    <label for="search-file"></label>
                </div>
                <div class="mr-2">
                    <input id="search-file" type="text" class="form-control mr-2" name="search_file" required>
                </div>
                <div class="mr-2">
                    <form method="post" action="{{ url('/file/search/') }}">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                            <button class="btn btn-success" type="submit">Search</button>
                    </form>
                </div>  
                <div class="mr-2">
                    <a href="/file/add" class="btn btn-dark">Add file</a>
                </div>
                <div class="mr-2">
                    <a href="#" class="btn btn-dark">Create text</a>
                </div>
            </div>
        </div>
        <div>
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
        <div>
    </div>
</div>
@endsection
