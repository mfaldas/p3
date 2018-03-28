@extends('layouts.master')

@section('result')

    @if(count($errors) == 0)
        <div class="alert alert-success">
           {{ $printResults }}
        </div>

    @else
        @include('modules.error-form')
    @endif

@endsection