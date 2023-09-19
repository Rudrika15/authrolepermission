@extends('layouts.master') @section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="fs-4 fw-1">Cart View</div>
            <div class="">
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Product </th>
                    <th>Option</th>
                    <th>Quantity</th>
                    <th>User</th>
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
            ajax: "{{route('cart.getAllData')}}",
            columns: [
                {
                    data: "id",
                    name: "id",
                    orderable: false,
                },
                {
                    data: "productId",
                    name: "productId",
                    orderable: false,
                },
                {
                    data: "optionId",
                    name: "optionId",
                    orderable: false,
                },
                {
                    data: "qty",
                    name: "qty",
                    orderable: false,
                },
                {
                    data: "userId",
                    name: "userId",
                    orderable: false,
                },
                
                
          ],
        });
    });
</script>

@stop