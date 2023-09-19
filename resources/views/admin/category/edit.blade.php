@extends('layouts.master')
@section('title')
Category Edit || Shop
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="fs-4 fw-1">Category Edit</div>
            <div class="">
                <a href="{{route('category.index')}}" class="btn btn-success">Back</a>
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

        <form action="{{route('category.update')}}" id="category_form" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="category_id" id="category_id" value="{{$category->id}}">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Title</label>
                <input type="title" class="form-control" value="{{$category->title}}" id="title" name="title" />
                <span class="text-danger">
                    @error('title')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <div class="mb-3">
                <label for="Icon" class="form-label">Icon</label>
                <input type="file" value="{{$category->icon}}" id="icon" name="icon" class="form-control" placeholder="icon" />
                <br>
                <img id="preview-icon" src="{{ url('/category/' . $category->icon) }}" alt="" class="mt-3" style="height:100px; width: 100px;">
            </div>
            <button type="submit" id="saveBtn" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<!-- FOR SWEET ALERT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#icon').change(function() {
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#preview-icon').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });
    $('#category_form').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{ route('category.update') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#category_form').trigger("reset");
                if (response.success) {
                    // Success message using SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                    });

                    window.location.href = "{{route('category.index') }}";
                    console.log("successfully edited");
                } else {
                    // Error message using SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred!',
                    });
                }

            },
            error: function(response) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred!',
                });
                console.log('Error:', response);
                $('#saveBtn').html('Save Changes');
            }
        });
    });
</script>
@stop