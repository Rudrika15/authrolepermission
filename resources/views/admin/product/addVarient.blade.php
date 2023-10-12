@extends('layouts.master') @section('content')
<div class="card">
    
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="fs-4 fw-1">Product Varient Add</div>
            <div class="">
                <a href="{{route('product.index')}}" class="btn btn-success">Back</a>
            </div>
        </div>
    </div>
   
    <div class="card-body">
        <form id="productVarientForm"  enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="productId" id="productId" value="{{$products->id}}">
            <div class='row pt-3'>
                <div class='col'>
                    <label for='exampleInputEmail1' class='form-label'>Option Group</label>
                   
                    <select class='form-control @error('productGroupId') is-invalid @enderror' id='productGroupId' name='productGroupId' value="">
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
                        @error('productGroupId')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </select>
                    
                </div>
               
                <div class='col'>
                        <label for='exampleInputEmail1' class='form-label'>Stock</label>
                        <input type='text' class='form-control @error('stock') is-invalid @enderror' placeholder='Enter stock' id="stock" name='stock'>
                        @error('stock')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>
                    <div class='col'>
                        <label for='exampleInputEmail1' class='form-label'>Price</label>
                        <input type='text' class='form-control @error('price') is-invalid @enderror' placeholder='Enter price' id="price" name='price'>  
                        @error('price')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class='row pt-3'> 
                    <div class='col'> 
                        <label for='exampleInputEmail1' class='form-label'>Product Gallery <sup class='text-danger'> (To add multiple photo press control button and select image)</sup></label> 
                            <input type='file' multiple class='form-control' id='productGallery' name='productGallery[]' />
                    </div>
                </div>
                <input type="hidden" id="id" name="id" value="">

                <input type="hidden" id="optionGroupData" value="">
            <button type="submit" class="btn btn-primary my-3">Submit</button>
        </form>

    </div>
</div>
<div class="card mt-2">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="fs-4 fw-1">Product Varient List</div>
            {{-- <div class="">
                <a href="{{route('product.create')}}" class="btn btn-success">Add New Product</a>
            </div> --}}
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table  table-bordered data-table">
            <thead>
                <tr>
                    <th>Product Group</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th>Product Gallery</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productData as $product)
                            @foreach ($product->productStockPrice as $productStockPrice)  
                            <tr>
                                <td>
                                    @foreach ($productStockPrice->linkVariant as $linkVariant)
                                         <p>{{$linkVariant->optionGroup}}-{{$linkVariant->option}}</p>
                                    @endforeach
                                </td>  
                                <td>{{$productStockPrice->stock}}</td>
                                <td>{{$productStockPrice->price}}</td>
                                <td>
                                    
                                            @foreach ($product->productGallery as $productGallery)
                                                @if ($productGallery->productGroupId == $linkVariant->productGroup)
                                                <a href="{{route('deleteProductGallery')}}/{{$productGallery->id}}"><img src="{{url('/gallery')}}/{{$productGallery->productGallery}}" alt="" height="100" width="100"></a>      
                                                @endif  
                                            @endforeach
                                    
                                </td>
                            </tr> 
                            @endforeach
                </tr>
                @endforeach       
            </tbody>
        </table>
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
    $(document).ready(function(e) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#productVarientForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var existingProductGroupId = $('#optionGroupData').val();
        var productGroupData = existingProductGroupId;
        
        var id=$('#id').val();
        if (productGroupData && id) {
            // Check if a record with the same productGroupId exists
            $.ajax({
                type: 'GET',
                url: "{{ url('product/checkProductExists')}}/" + productGroupData,
                success: function(response) {
                    if (response.exists) {
                        // If a record exists, ask for confirmation to delete it
                        
                                // AJAX request to delete the existing record
                                $.ajax({
                                    url: "{{ url('product/deleteProductStockPrice') }}" + '/' + id,
                                    method: 'GET',
                                    data: {
                                        _token: "{{ csrf_token() }}",
                                        id: id
                                    },
                                    success: function(response) {
                                            // Success message using SweetAlert
                                            $.ajax({
                                            type: 'POST',
                                            url: "{{ url('product/storeProductVarient')}}",
                                            data: formData,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(response) {
                                                if (response.success) {
                                                    // Success message using SweetAlert
                                                    Swal.fire({
                                                        icon: 'success',
                                                        title: 'Success',
                                                        text: response.message,
                                                    }, 200).then(function() {
                                                        // Reload the page after a successful record insertion
                                                        location.reload();
                                                    });
                                                } else {
                                                    // Error message using SweetAlert
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Error',
                                                        text: 'An error occurred!',
                                                    });
                                                }
                                            },
                                            error: function(xhr, status, error) {
                                                // Error message using SweetAlert
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Error',
                                                    text: 'An error occurred!',
                                                });
                                            }
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        // Error message using SweetAlert
                                        console.log("it Not Works");
                                    }
                                });
                            
                       
                    } else {
                        // If no existing record, just submit the new one
                        submitNewRecord(formData);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle any error here
                }
            });
        } else {
            // If id is not present, submit the new record
            submitNewRecord(formData);
        }
    });

    // Function to submit the new record
    function submitNewRecord(formData) {
        $.ajax({
            type: 'POST',
            url: "{{ url('product/storeProductVarient')}}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                    // Success message using SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                    }, 200).then(function() {
                        // Reload the page after a successful record insertion
                        location.reload();
                    });
                } else {
                    // Error message using SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred!',
                    });
                }
            },
            error: function(xhr, status, error) {
                // Error message using SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred!',
                });
            }
        });
    }
        $('#productGroupId').change(function() {
        var productGroupId = $(this).val();
        $('#optionGroupData').val(productGroupId);
        if (productGroupId !== '') {
            $.ajax({
                type: 'GET',
                url: "{{ url('product/getStockAndPrice')}}/" + productGroupId,
                success: function(response) {
                    if (response.success) {
                        // Update the stock and price input fields with the old values
                        $('#stock').val(response.stock);
                        $('#price').val(response.price);
                        $('#id').val(response.id);
                        
                        
                    } else {
                        // Handle the case where the productGroupId doesn't exist
                        $('#stock').val(''); // Clear the stock input
                        $('#price').val(''); // Clear the price input
                        $('#id').val('');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle any error here
                }
            });
        }
    });
    
    });
</script>
@stop