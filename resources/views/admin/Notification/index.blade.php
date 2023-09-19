@extends('layouts.master') @section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="fs-4 fw-1">Notification View</div>
            <div class="">
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>UserDetail</th>
                    <th>Product Details</th>

                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(function() {

        var table = $(".data-table").DataTable({
            ajax: "{{ route('notification.getAllData') }}",
            columns: [{
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

            ],
        });
    });
</script>

@stop