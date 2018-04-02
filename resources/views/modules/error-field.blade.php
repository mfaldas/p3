{{-- error-field.blade.php --}}
{{-- Subview that displays the errors adjacent to their corresponding fields. --}}
{{-- Integrated from DWA15 Foobooks Project to Project 3. --}}
{{-- Created By: Susan Buck --}}
{{-- Used By: Marc-Eli Faldas --}}
{{-- Integrated: 3/26/2018  --}}

@if($errors->get($field))
    <ul class='error'>
        @foreach($errors->get($field) as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif