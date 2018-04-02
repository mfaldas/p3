{{-- Subview that displays the form errors. --}}
{{-- Integrated from DWA15 Foobooks Project to Project 3. --}}
{{-- Created By: Susan Buck --}}
{{-- Used By: Marc-Eli Faldas --}}
{{-- Integrated: 3/26/2018  --}}

@if(count($errors) > 0)
    <ul class='alert alert-danger' id='validationError'>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif