@extends('layouts.master') @section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="fs-4 fw-1">Rating View</div>
            <div class="">
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User Detail</th>
                    <th>Product </th>
                    <th>Star</th>
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
            ajax: "{{ route('rating.getAllData') }}",
            columns: [
                {
                    data: "id",
                    name: "id",
                    orderable: false,
                },
                {
                    "targets": 2,
                    "data": 'name',
                    "render": function(data, type, row) {
                        return row.name + '<br/> ' + row.email;
                    }

                },
                {
                    data: "title",
                    name: "title",
                    orderable: false,
                },
                {
                    data: "star",
                    name: "star",
                    orderable: false,
                },
            ],
        });
    });
</script>

@stop
