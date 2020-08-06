@extends('layouts.backend')
@section('content')
    @include('customer.overview.template.hero')
    <div class="content">
        @include('customer.overview.template.content')
    </div>
@endsection
@section('js_after')

@endsection
