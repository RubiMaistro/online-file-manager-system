@extends('layouts.app')

@section('content')

<header>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</header>  

<div style="opacity: 0;">{{ $id = 1 }}</div>

<div class="container">
    <div class="column justify-content-center">
        <div class="row justify-content-center mb-4">
            <div class="row">
                <div class="mr-2">
                    <label for="search-file"></label>
                </div>
                <div class="mr-2">
                    <input id="search-file" type="text" class="form-control mr-2" name="search_file" required>
                </div>
                <div class="mr-2">
                    <form method="post" action="{{ url('/file/search/') }}">
                        @method('DELETE')
                        @csrf
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
        <div class="row justify-content-center">
            <table class="table table-light table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">@sortablelink('Name')</th>
                    <th scope="col">@sortablelink('Filename')</th>
                    <th scope="col">@sortablelink('Size')</th>
                    <th scope="col">@sortablelink('Created')</th>
                    <th scope="col">@sortablelink('Modified')</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>

                @if($files->count())
                @foreach( $files as $file )
                <tbody>
                    <th scope="row">{{ $id }}</th>
                    <td>{{ $file->name }}</td>
                    <td>{{ $file->filename }}</td>
                    <td>@if ($file->size == 0)
                        < 0.01
                        @else
                        {{ $file->size }}
                    @endif MB</td>
                    <td>{{ $file->created_at }}</td>
                    <td>{{ $file->updated_at }}</td>
                    <td class="row">
                        <a href="#" class="btn btn-primary mr-2">Edit</a>
                        <form method="post" action="{{ url('/file/delete/'.$file->id) }}">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tbody>
                <div style="opacity: 0;">{{ $id += 1 }}</div>
                @endforeach
                @endif
            </table>
            <div class="row justify-content-center">
            {!! $files->appends(\Request::except('page'))->render() !!}
            </div>
        <div>
    </div>
</div>
@endsection
