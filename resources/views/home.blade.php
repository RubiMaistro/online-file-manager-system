@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('File Manager') }}</div>
                @foreach( $files as $file )
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h2>{{ $file->name }}</h2>
                    <div>
                        {{ $file->file }}
                    </div>
                    
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
