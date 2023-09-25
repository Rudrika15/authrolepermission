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
        <form id="productForm" method="POST" enctype="multipart/form-data">
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
           
            <div class='row pt-3'>
                <div class='col'>
                    <label for='exampleInputEmail1' class='form-label'>Option Group</label>
                   
                    <select class='form-control' id='productGroupId' name='productGroupId[]'>
                        <option selected disabled>Select Option Group</option>
                        @php
                            $groupedOptions = collect($optionGroup)->groupBy('productGroup');
                        @endphp
                
                        @foreach ($groupedOptions as $productGroupId => $options)
                            <option value="{{ $productGroupId }}">
                                @foreach ($options as $option)
                                    {{ $option->optionGroup }}: {{ $option->option }}, 
                                @endforeach
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class='col'> 
                        <label for='exampleInputEmail1' class='form-label'>Option </label>
                        <input type='text' class='form-control' placeholder='Enter option' name='option'>
                </div> --}}
                <div class='col'>
                        <label for='exampleInputEmail1' class='form-label'>Stock</label>
                        <input type='text' class='form-control' placeholder='Enter stock' id="stock" name='stock[]'>
                </div>
                    <div class='col'>
                        <label for='exampleInputEmail1' class='form-label'>Price</label>
                        <input type='text' class='form-control' placeholder='Enter price' id="price" name='price[]'>  
                    </div>
                </div>
                <div class='row pt-3'> 
                    <div class='col'> 
                        <label for='exampleInputEmail1' class='form-label'>Product Gallery <sup class='text-danger'> (To add multiple photo press control button and select image)</sup></label> 
                            <input type='file' multiple class='form-control' id='productGallery' name='productGallery[]' />
                    </div>
                </div>
            <span id="Add" class="btn btn-success mt-3">Add</span>
            <span id="Remove" class="btn btn-danger mt-3">Remove</span>
            <div id="textboxDiv"></div>


            <div class="alert alert-danger print-error-msg" style="display: none">
                <ul></ul>
            </div>
            <button type="submit" class="btn btn-primary my-3">Submit</button>
        </form>

    </div>
</div>

<<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
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

            
            $("#Add").on("click", function() {
                $("#textboxDiv").append("<div class='row pt-3'><div class='col'><label for='exampleInputEmail1' class='form-label'>Option Group</label><select class='form-control' id='productGroupId'  name='productGroupId[]'><option selected disabled>Select Option Group</option>@php $groupedOptions = collect($optionGroup)->groupBy('productGroup'); @endphp @foreach ($groupedOptions as $productGroupId => $options) <option value='{{ $productGroupId }}'> @foreach ($options as $option) {{ $option->optionGroup }}: {{ $option->option }}, @endforeach </option> @endforeach </select></div><div class='col'><label for='exampleInputEmail1' class='form-label'>Stock</label><input type='text' class='form-control' placeholder='Enter stock' id='stock' name='stock[]'></div><div class='col'><label for='exampleInputEmail1' class='form-label'>Price</label><input type='text' class='form-control' placeholder='Enter price' name='price[]' id='price'> </div></div><div class='row pt-3'> <div class='col'> <label for='exampleInputEmail1' class='form-label'>Product Gallery <sup class='text-danger'> (To add multiple photo press control button and select image)</sup></label> <input type='file' multiple class='form-control' id='productGallery' name='productGallery[]' /></div></div>");

                // $("#textboxDiv").append("<div class='row pt-3'><div class='col'><label for='exampleInputEmail1' class='form-label'>Option Group</label><select class='form-control'  name='optionGroupId'><option selected disble>Select Option Group</option><option>Size</option><option>Color</option></select></div><div class='col'><label for='exampleInputEmail1' class='form-label'>Option </label><input type='text' class='form-control' placeholder='Enter option' name='option'></div><div class='col'><label for='exampleInputEmail1' class='form-label'>Stock</label><input type='text' class='form-control' placeholder='Enter stock' name='stock'></div><div class='col'><label for='exampleInputEmail1' class='form-label'>Price</label><input type='text' class='form-control' placeholder='Enter price' name='price'>  </div></div><div class='row pt-3'> <div class='col'> <label for='exampleInputEmail1' class='form-label'>Product Gallery <sup class='text-danger'> (To add multiple photo press control button and select image)</sup></label> <input type='file' multiple class='form-control' id='files' name='files' /></div></div>");
            });
            $("#Remove").on("click", function() {
                $("#textboxDiv").children().last().remove();
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
                        // if (response.status == 200) {
                        //     Swal.fire(
                        //         'Added!',
                        //         'Product Added Successfully!',
                        //         'success'
                        //     )
                        // }
                        // window.location.href = "{{route('product.index') }}";
                        alert(response)
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