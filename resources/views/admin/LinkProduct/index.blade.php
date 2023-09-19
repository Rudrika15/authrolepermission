@extends('layouts.master')
@section('title')
Variant View || Shop
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="fs-4 fw-1">Link Product View</div>
            <div class="">
                <a href="{{route('link.create')}}" class="btn btn-success">Add New Link Product</a>
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
                    <th>Title</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
              
                <?php
                $i = 0;
                foreach ($data as $group) {
                    $i++;
                ?>
                    <tr>
                        <td>
                            @foreach($group['options'] as $option)
                            {{ $option['optionGroup'] }}:-
                            {{ $option['option'] }},
                            @endforeach
                        </td>
                        <td><a class="btn btn-danger" href='{{route("link.delete")}}/{{ $group["group"]["productGroup"]}}'>Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>


    </div>
</div>
@stop