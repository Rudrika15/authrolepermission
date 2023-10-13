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

                <div class="mb-3 col">
                    <label for="exampleInputEmail1" class="form-label">Category</label>

                    <select name="categoryId" id="categoryId" class="form-control">
                        <option selected>--Select Category--</option>
                        @foreach ($category as $category)
                            <option value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                        
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- <script>
    $(document).ready(function () {
        // Initially, show all option groups
        $('.option-group').show();

        // Add an event listener to the category select element to update option groups.
        $('#categoryId').on('change', function () {
            var selectedCategoryId = $(this).val();
            $('.option-group').hide().find('select').prop('required', false);
            
            // Show only the option groups that match the selected category
            $('.option-group').each(function () {
                var categoryID = $(this).find('input[name="categoryIds[]"]').val();
                if (categoryID == selectedCategoryId) {
                    $(this).show().find('select').prop('required', true);
                }
            });
        });

        // Trigger the change event initially to set the initial state.
        $('#categoryId').trigger('change');
    });
</script> --}}


{{-- @foreach ($optionGroups as $optionGroup)
                    <div class="mb-3 col option-group">
                        <label for="exampleInputEmail1" class="form-label">
                            <input type="hidden" value="{{ $optionGroup->categoryId }}" name='categoryIds[]' />
                            {{ $optionGroup->optionGroupName }}

                           
                        
                        <select class="form-control" id="title" name="title[]">
                            <option selected disabled>--Select {{ $optionGroup->optionGroupName }}--</option>
                            @foreach ($options as $option)
                            @if ($optionGroup->id === $option->optionGroupId)
                            <option value="{{ $option->option }}">{{ $option->option }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    
                @endforeach --}}

@stop