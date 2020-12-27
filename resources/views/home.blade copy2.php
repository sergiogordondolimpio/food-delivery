@extends('layouts.app')

@section('content')

    @include('/components/banner')
    
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="row justify-content-center">
                @for ($i = 0; $i < 12; $i++)
                    @include('/products/cardExample')
                @endfor
            </div>
        </div>
    </div>

@endsection
