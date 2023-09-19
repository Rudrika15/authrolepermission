@extends('layouts.master') 
@section('title')
Slider Add || Shop
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="fs-4 fw-1">Slider Add</div>
            <div class="">
                <a href="" class="btn btn-success">Back</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <form id="create" action="{{route('slider.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Title</label>
                <select class="form-control" id="type" name="type">
                    <option selected disabled>--select type--</option>
                    <option>Home</option>
                    <option>Inside</option>
                </select>
                <span class="text-danger">
                    @error('type')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Icon</label>
                <input type="file" class="form-control" id="photo" name="photo" />
                <span class="text-danger">
                    @error('photo')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <div class="alert alert-danger print-error-msg" style="display: none">
                <ul></ul>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@stop