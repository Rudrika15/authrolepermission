@extends('layouts.master') @section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="fs-4 fw-1">Option Group Add</div>
            <div class="">
                <a href="{{route('optionGroup.update')}}" class="btn btn-success">Back</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form id="updateOptionGrp" method="POST">
            @csrf
            <input type="hidden" name="optiongroup_id" id="optiongroup_id" value="{{$optionGroup->id}}">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Title</label>
                <input type="text" class="form-control" id="optionGroupName" name="optionGroupName"  value="{{$optionGroup->optionGroupName}}"/>
            </div>
            <div class="alert alert-danger print-error-msg" style="display: none">
                <ul></ul>
            </div>
            <button type="submit" value="submit" id="saveBtn" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $("#saveBtn").click(function(e) {
      e.preventDefault();
      $(this).html("sending..")
      var optiongroup_id = $('#optiongroup_id').val();
      $.ajax({
        data: $('#updateOptionGrp').serialize(),
        url: "{{route('optionGroup.update')}}",
        type: "POST",
        dataType: "json",
        success: function(response) {
          confirm("Are u sure u want to edit")
          if (response.success) {
            Swal.fire({
              icon: "success",
              title: "success",
              text: "record updated successfully",
            })
            window.location.href = "{{route('optionGroup.index')}}"
          } else {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "An Error Occured"
            })
          }
        },
        error: function(response) {
          console.log("Error:", response);
          Swal.fire({
            icon: "error",
            title: "Error",
            text: "unsuccessfull"
          })
          $("#saveBtn").html('save Changes');
        }
      })
    })
  })
</script> 

    
@stop