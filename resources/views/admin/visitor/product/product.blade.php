@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="row py-5">
        @foreach($products as $product)
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="{{ asset('product')}}/{{$product->photo}}" class="card-img-top "  alt="...">
                <div class="card-body">
                    <p class="card-title" style='min-height: 50px;font-weight: 600;' > {{$product->title}}</p>
                    <p class="card-text" >{{$product->catTitle}}.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection