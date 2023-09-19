@extends('layouts.master')
@section('title')
Category Add || Shop
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="fs-4 fw-1">Category Add</div>
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
        <form id="Category_form" action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Title</label>
                <input type="title" class="form-control" id="title" name="title" />
                <span class="text-danger">
                    @error('title')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Icon</label>
                <input type="file" class="form-control" id="icon" name="icon" />
                <img id="preview-icon" src="/category/default.png" name="preview-icon" class="mt-3" width="100px" height="100px">
                <span class="text-danger">
                    @error('icon')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <div class="alert alert-danger print-error-msg" style="display: none">
                <ul></ul>
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
    $(document).ready(function(e) {

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
        $('#Category_form').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{route('category.store')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    $("#Category_form").trigger("reset");
                    if (response.success) {
                        // Success message using SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                        });

                        window.location.href = "{{route('category.index') }}";
                        console.log("successfull");
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
                    console.log("Error:", response);
                    $("#saveBtn").html('save Changes');
                }
            });
        });
    });
</script>
@stop