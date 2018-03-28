@extends('layouts.master')

@section('result')

    @if(count($errors) == 0)

    Hi! I'm Katy Perry. You probably don't recognize me without my blue wig. When I'm not singing on tour, making music videos or brushing Nugget's cute curls, I split bills! It's definitely a fun hobby and a great way for me to practice my math skills. Make sure to fill in the above fields. If you don't want any change, just check the "Round Up" selection and I'll round your payment to the next whole dollar. Thanks!

    @else
        @include('modules.error-form')
    @endif

@endsection

