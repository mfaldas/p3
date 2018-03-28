@extends('layouts.master')

@section('result')

    @if(count($errors) == 0)
        <div class="alert alert-danger">
            Unable to make calculation as the split bill would be less than $0.01.
        </div>

    @else
        @include('modules.error-form')
    @endif

@endsection