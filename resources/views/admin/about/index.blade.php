@extends('layouts.master') @section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="fs-4 fw-1">About View</div>
            <div class="">
                <a href="{{route('about.create')}}" class="btn btn-success">Add New About</a>
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
                    <th style="width: 70px;">Sr No</th>
                    <th>About</th>
                    <th style="width: 150px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $srNo=0;
                foreach($abouts as $about)
                {
                    ++$srNo;
                    ?>
                <tr>
                    <td>{{$srNo}}</td>
                    <td>{!!$about->about!!}</td>
                    <td style="width: 150px;">Edit ||<a href="{{route('about.delete')}}/{{$about->id}}" class="btn btn-danger"> Delete</a></td>
                   </tr>
                <?php  }?>
            </tbody>
        </table>
        {!! $abouts->links() !!}
    </div>
</div>
@stop