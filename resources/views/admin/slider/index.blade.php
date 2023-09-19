@extends('layouts.master') 
@section('title')
Slider View || Shop
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="fs-4 fw-1">Slider View</div>
            <div class="">
                <a href="{{route('slider.create')}}" class="btn btn-success">Add New Slider</a>
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

        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th style="width: 150px;">Sr No</th>
                    <th>Type</th>
                    <th>Photo</th>
                    <th style="width: 150px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $srNo = 0;
                foreach ($sliders as $slider) {
                    ++$srNo;
                ?>
                    <tr>
                        <td>{{$srNo}}</td>
                        <td>{{$slider->type}}</td>
                        <td><img src="{{ asset('slider/'.$slider->photo) }}" class="w-25" /></td>
                        <td>Edit ||<a href="{{route('slider.delete')}}/{{$slider->id}}" class="btn btn-danger"> Delete</a></td>
                    </tr>
                <?php  } ?>
            </tbody>
        </table>
        {!! $sliders->links() !!}
    </div>
</div>
@stop