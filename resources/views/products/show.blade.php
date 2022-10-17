@extends('layouts.app')

@section('content')
    <h2>{{ $product->name }}</h2>
    {{$product->description}}
@endsection
