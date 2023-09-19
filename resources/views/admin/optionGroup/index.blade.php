@extends('layouts.master') @section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="fs-4 fw-1">Option Group View</div>
            <div class="">
                <a href="{{route('optionGroup.create')}}" class="btn btn-success">Add New Option Group</a>
                <a href="{{route('link.create')}}" class="btn btn-info">Add New Link Product</a>
            </div>
           
               
          
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Option Group Name</th>
                    <th>option</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table = $(".data-table").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('optionGroup.getAllData')}}",
            columns: [{
                    data: "id",
                    name: "id",
                    orderable: false,
                },
                {
                    data: "optionGroupName",
                    name: "optionGroupName",
                    orderable: false,
                //    render: function(data, type, row) {
                //         if (row.option && row.option.length > 0) {
                //             let optionNames = row.option.map(function(option) {
                //                 return option.option;
                //             }).join(", ");
                //             console.log(optionNames); 
                //             return  optionNames;
                //         } else {
                //             return ""; // Handle the case when there are no options
                //         }
                //     },

                },
                {
                    data: null,
                    render: function(data, type, row) {
                        if (row.option && row.option.length > 0) {
                            let optionNames = row.option.map(function(option) {
                                return option.option;
                            }).join(", ");
                            console.log(optionNames); 
                            return  optionNames;
                        } else {
                            return ""; // Handle the case when there are no options
                        }
                    },
                    orderable: false,
                },
                // {
                //     data: "options.option",
                //     name: "options.option",
                //     orderable: false,
                // },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                },
            ],
        });
        // delete function
        $('body').on('click', '.deleteOption', function(e) {
            e.preventDefault();
            let optiongroupId = $(this).data('id');
            let csrf = '{{ csrf_token() }}';
            var confirmation = confirm("Are You sure want to delete !");
            if (confirmation) {
                $.ajax({
                    type: "get",
                    data: {
                        id: optiongroupId,
                        _token: csrf
                    },
                    url: "{{route('optionGroup.delete')}}" + "/" + optiongroupId,
                    success: function(data) {
                        table.draw();
                    },
                    error: function(data) {
                        console.log("Error", data);
                        console.log("Deleting category with ID: " + optiongroupId);
                    }
                });
            };
        });
    });
</script>

@stop