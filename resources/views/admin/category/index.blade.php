@extends('layouts.master')
@section('title')
Category View || Shop
@endsection

@section('content')

<div class="card">
    <h1>hello</h1>
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="fs-4 fw-1">Category View</div>
            <div class="">
                <a href="{{route('category.create')}}" class="btn btn-success">Add New Category</a>
                <a href="{{route('category.export')}}" class="btn btn-success">Export Excel</a>
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

        <table class="table table-bordered data-table" style="color: black;">
            <thead>
                <tr>
                    <th>Sr No</th>
                    <th>Title</th>
                    <th>icon</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table = $(".data-table").DataTable({
            serverSide: true,
            processing: true,
            ajax: "{{route('category.index')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },

                {
                    data: 'title',
                    name: "title"
                },
                {
                    data: 'icon',
                    name: 'icon',
                    render: function(data, type, full, meta) {
                        // Check if the "data" is empty or null
                        if (data) {
                            return '<img src="{{url(' / category ')}}/' + data + '" alt="Logo" style="max-width: 100px; max-height: 100px;">';
                        }
                        return 'No icon'; // Display "No Logo" if data is empty or null
                    }
                },
                {
                    data: 'action',
                    name: "action",
                    orderable: true,
                    searchable: true
                },
            ],
        });


        // delete function
        $('body').on('click', '.deleteCategory', function(e) {
            e.preventDefault();
            let categoryId = $(this).data('id');
            let csrf = '{{ csrf_token() }}';

            // sweet alert for delete
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
                                id: categoryId,
                                _token: csrf
                            },
                            url: "{{route('category.delete')}}" + "/" + categoryId,
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
@endsection