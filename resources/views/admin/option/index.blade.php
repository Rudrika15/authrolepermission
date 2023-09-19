@extends('layouts.master') @section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="fs-4 fw-1">Option View</div>
            <div class="">
                <a href="{{route('option.create')}}" class="btn btn-success">Add New Option</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Option Group Name</th>
                    <th>Option </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        var table = $(".data-table").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('option.getAllData') }}",
            columns: [
                {
                    data: "id",
                    name: "id",
                    orderable: false,
                },
                {
                    data: "optiongroup.optionGroupName",
                    name: "optiongroup.optionGroupName",
                    orderable: false,
                },
                {
                    data: "option",
                    name: "option",
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
         $('body').on('click', '.deleteOpt',function(e){
            e.preventDefault();
            let optionId = $(this).data('id');
            let csrf = '{{ csrf_token() }}';
            var confirmation = confirm("Are You sure want to delete !");
            if (confirmation){
                $.ajax({
                    type:"get",
                    data: {
                        id: optionId,
                        _token: csrf
                    },
                    url:"{{route('option.delete')}}" + "/" + optionId,
                    success:function(data){
                        table.draw();
                    },
                    error:function(data){
                        console.log("Error", data);
                        console.log("Deleting category with ID: " + optionId);
                    }
                });
            };
        });
    });
</script>

@stop
