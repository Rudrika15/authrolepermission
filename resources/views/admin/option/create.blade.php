@extends('layouts.master') @section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="fs-4 fw-1">Option Add/variant Add</div>
            <div class="">
                <a href="{{route('option.index')}}" class="btn btn-success">Back</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form id="create" method="POST">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Option</label>
                <input type="text" class="form-control" id="option" name="option" />
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Option Group</label>
                <select class="form-control" id="optionGroupId" name="optionGroupId">
                    @foreach($optionGroup as $optionGroup)
                    <option value="{{$optionGroup->id}}">{{$optionGroup->optionGroupName}}</option>
                    @endforeach
                </select>
            </div>

            <div class="alert alert-danger print-error-msg" style="display: none">
                <ul></ul>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<script>
    $(function() {
        $("#create").on("submit", function(e) {
            console.log("successfull");
            e.preventDefault();
            var formData = new FormData();
            formData.append("_token", "{{csrf_token()}}");
            formData.append("optionGroupId", $("#optionGroupId").val());
            formData.append("option", $("#option").val());

            $.ajax({
                url: "{{route('option.store')}}",
                data: formData,
                contentType: false,
                processData: false,
                type: "post",
                    success: function(response) {
                    if (response.status == 200) {
                        Swal.fire(
                            'Added!',
                            'Option  Added Successfully!',
                            'success'
                        )
                    }
                    window.location.href = "{{route('optionGroup.index') }}";

                },
            });
        });
    });
</script>
@stop