@extends('layouts.master') 
@section('title')
Variant Add || Shop
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="fs-4 fw-1">Link Product Add</div>
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
        <form id="create" action="{{route('link.store')}}" method="POST">
            @csrf
            <div class="row">
                <?php
                $i = 0;
                foreach ($optionGroups as $optionGroup) {
                    $i++;
                ?>
                    <div class="mb-3 col">
                        <label for="exampleInputEmail1" class="form-label">
                           <input type="hidden" value="{{$optionGroup->optionGroupName}}" name='optiongroup[]' />
                            {{$optionGroup->optionGroupName}}
                        </label>

                        <select type class="form-control" id="title" name="title[]">
                            <option selected disabled>--Select {{$optionGroup->optionGroupName}}--</option>
                            @foreach($options as $option)
                            @if($optionGroup->id === $option->optionGroupId)
                            <option value="{{$option->option}}">{{$option->option}}</option>
                            @endif
                            @endforeach

                        </select>
                    </div>
                <?php  } ?>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@stop