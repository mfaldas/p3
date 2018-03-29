@extends('layouts.master')


@section('input')
    <form method='GET' action='/'>
    @parent
    </form>
@stop

@section('result')
    @parent

    @if(count($errors) == 0)

        @if($standard)
        <br>
        <br>
            Hi! I'm Katy Perry. You probably don't recognize me without my blue wig. When I'm not singing on tour, making music videos or brushing Nugget's cute curls, I split bills! It's definitely a fun hobby and a great way for me to practice my math skills. Make sure to fill in the above fields. If you don't want any change, just check the "Round Up" selection and I'll round your payment to the next whole dollar. Thanks!
        @elseif(!$calculable)
            <div class="alert alert-danger">
                Unable to make calculation as the split bill would be less than $0.01.
            </div>
        @else
            <br>
            <div class="alert alert-success">
                {{ $printResults }}
            </div>
        @endif
    @else
        <br>
        @include('modules.error-form')
    @endif

@endsection