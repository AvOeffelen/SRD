@extends('layouts.backend')
@section('content')
    @include('product.overview.template.hero')
    <div class="content">
        @include('product.overview.template.content')
    </div>
@endsection
@section('js_after')

@endsection
