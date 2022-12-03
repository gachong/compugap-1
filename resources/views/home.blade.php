@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h6> Import and Export Excel data to Csv </h6>
        </div>

        <div class="card-body">
            <a href="{{ url('/file-import') }}" class="text-sm text-gray-700 underline">Import</a>
        </div>
    
</div>

@endsection
