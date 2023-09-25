@extends('layouts.master') @section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="fs-4 fw-1">Product View</div>
            <div class="">
                <a href="{{route('product.create')}}" class="btn btn-success">Add New Product</a>
            </div>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table  table-bordered data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Photo</th>
                    <th>Detail</th>
                    <th>Tag</th>
                    <th>isTrending</th>
                    <th>isRecommend</th>
                    <th>startDate</th>
                    <th>endDate</th>
                    <th>discount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>


<script type="text/javascript">
    $(function() {
        var table = $(".data-table").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('product.getAllData') }}",
            columns: [{
                    data: "id",
                    name: "id",
                    orderable: false,
                },
                {
                    data: "title",
                    name: "title",
                    orderable: false,
                },
                {
                    data: "category.title",
                    name: "category.title",
                    orderable: false,
                },
                {
                    data: "photo",
                    name: "photo",
                    
                    render: function(data, type, full, meta) {
                        // Check if the "data" is empty or null
                        if (data) {
                            // return '<img src="{{url('/product')}}/' + data + '" alt="photo" style="max-width: 100px; max-height: 100px;">';
                            return '<img src="{{url('/product')}}/'+ data + '" alt="Logo" style="max-width: 100px; max-height: 100px;">';
                        }
                        return 'No photo'; // Display "No photo" if data is empty or null
                    }
                },
                {
                    data: "detail",
                    name: "detail",
                    orderable: false,
                    render: function(data, type, full, meta) {
                        if (data) {
                            var tempDiv = document.createElement("div");
                            tempDiv.innerHTML = data;
                            // Return the text content (without HTML tags)
                            return tempDiv.textContent || tempDiv.innerText || "";
                        }
                        return 'No detail';
                    }
                },
                {
                    data: "tag",
                    name: "tag",
                    render: function(data, type, full, meta) {
                        if (data) {
                            var tempDiv = document.createElement("div");
                            tempDiv.innerHTML = data;
                            // Return the text content (without HTML tags)
                            return tempDiv.textContent || tempDiv.innerText || "";
                        }
                        return 'No Tag';
                    }
                },
                {
                    data: "isTrending",
                    name: "isTrending",
                    orderable: false,
                },
                {
                    data: "isRecommend",
                    name: "isRecommend",
                    orderable: false,
                },
                {
                    data: "startDate",
                    name: "startDate",
                    orderable: false,
                },
                {
                    data: "endDate",
                    name: "endDate",
                    orderable: false,
                },
                {
                    data: "discount",
                    name: "discount",
                    orderable: false,
                },

                {
                    data: "action",
                    name: "action",
                    orderable: false,
                },
            ],
        });
        // delete function
        $('body').on('click', '.deleteProduct', function(e) {
            e.preventDefault();
            let productId = $(this).data('id');
            let csrf = '{{ csrf_token() }}';
            // // sweet alert for delete
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success',
                        $.ajax({
                            type: "get",
                            data: {
                                id: productId,
                                _token: csrf
                            },
                            url: "{{route('product.delete')}}" + "/" + productId,
                            success: function(data) {
                                table.draw();
                            },

                        })
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            })
        });
    });
</script>

@stop