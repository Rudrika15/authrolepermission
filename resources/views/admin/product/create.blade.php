@extends('layouts.master') @section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="fs-4 fw-1">Product Add</div>
            <div class="">
                <a href="{{route('product.index')}}" class="btn btn-success">Back</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form id="productForm" action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" />
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Category</label>
                <select class="form-control" id="catId" name="catId">
                    <option selected disabled>--Select Category--</option>

                    @foreach($category as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Photo</label>
                <input type="file" class="form-control" id="photo" name="photo" />
                <img id="preview-photo" src="{{asset('/product/default.png')}}" name="preview-photo" class="mt-3" width="100px" height="100px"> 
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Detail</label>
                <textarea class="form-control" id="detail" name="detail"></textarea>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Tag</label>
                <textarea class="form-control" id="tag" name="tag"></textarea>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="isTrending" name="isTrending" id="isTrending"> Is trending
                        </label>
                    </div>
                    <div class="col">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="isRecommend" name="isRecommend" id="isRecommend"> Is Recommend
                        </label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col">
                        <label class="form-check-label"> Start Date </label>
                        <input class="form-control" type="date" name="startDate" id="startDate">

                    </div>
                    <div class="col">
                        <label class="form-check-label">End Date</label>
                        <input class="form-control" type="date" name="endDate" id="endDate">

                    </div>
                    <div class="col">
                        <label class="form-check-label">Discount</label>
                        <input class="form-control" type="text" name="discount" id="discount">

                    </div>
                </div>
            </div>
           
            <button type="submit" class="btn btn-primary my-3">Submit</button>
        </form>

    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <!-- FOR SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#photo').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-photo').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
            $("#productForm").submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{url('product/store')}}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire(
                                'Added!',
                                'Product Added Successfully!',
                                'success'
                            )
                        }
                        window.location.href = "{{route('product.index') }}";
                        
                    },
                });
            });
        });
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#detail'))
            .then(editor => {
                console.log(about);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#tag'))
            .then(editor => {
                console.log(about);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    {{-- <script>
        window.onload = function() {
            CKEDITOR.replace('detail');
            CKEDITOR.replace('tag');
        };
    </script> --}}
    @stop