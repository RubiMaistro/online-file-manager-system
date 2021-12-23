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
                    <form class="row" method="GET" action="{{ url('/file/search') }}">
                        <div class="mr-2">
                            <input id="search-file" type="text" class="form-control mr-2" name="search" placeholder="Write something here and search..." style="width: 300px;" required>
                        </div>
                        <div class="mr-2">
                            <button class="btn btn-success" type="submit">Search</button>
                        </div>
                    </form>
                </div>  
                <div class="column justify-content-center ml-4">
                    <div class="mb-2">
                        <a href="/file/add" class="btn btn-dark">Add file</a>
                    </div>
                    <div class="mb-2">
                        <a href="/file/create/text" class="btn btn-dark">Create text file</a>
                    </div>
                    <div class="mb-2">
                        <a href="/file/send" class="btn btn-dark">Send File</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @if ($files->count() == 0) 
                <h1>No files to display.</h1> 
            @else
            <table class="table table-light table-hover" style="background-color:darkslategray; color:white; border-radius: 20px">
                <thead style="font-size:20px; color:deepskyblue;">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">@sortablelink('Name')</th>
                    <th scope="col">@sortablelink('Filename')</th>
                    <th scope="col">@sortablelink('Size')</th>
                    <th scope="col">Sender</th>
                    <th scope="col">Created</th>
                    <th scope="col">Modified</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>

                @foreach( $files as $file )
                <tbody>
                    <th style="width: 3%">{{ $id }}</th>
                    <td style="width: 10%">{{ $file->name }}</td>
                    <td style="width: 15%">{{ $file->filename }}</td>
                    <td>@if ($file->size == 0)
                        < 0.01
                        @else
                        {{ $file->size }}
                    @endif MB</td>
                    <td>
                    @foreach ($sender as $s)
                        @if ($s->id == $file->sender_id)
                            {{ $s->username }}
                        @endif
                    @endforeach
                    @if ($file->sender_id == null)
                        {{ 'Nobody' }}
                    @endif
                    </td>
                    <td>{{ $file->created_at }}</td>
                    <td>{{ $file->updated_at }}</td>
                    <td class="row" >
                        <a href="/file/edit/{{ $file->id }}" class="btn btn-primary mr-4">{{ __('Edit') }}</a>
                        <a href="/file/download/{{ $file->id }}" class="btn btn-success mr-4">{{ __('Download') }}</a>
                        <form method="post" action="{{ url('/file/delete/'.$file->id) }}">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                            <button class="btn btn-danger" type="submit">{{ __('Delete') }}</button>
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
