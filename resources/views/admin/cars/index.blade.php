@extends('layouts.main')
<!-- Main content -->
@section('content')

<div class="content-wrapper">
    <form method="post" action="{{ route('cars.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="validationServer01">Make</label>
                <select class="form-control is-valid" id="car_make"  name="make_id" aria-label=".form-select-lg example">
                    <option selected value="">Select Make</option>
                    @foreach($makes as $make)
                    <option value="{{ $make->id}}">{{ $make->make_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="validationServer02">Model</label>
                <select class="form-control is-valid" id="car_model"  name="model_id" aria-label=".form-select-lg example">
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <input type="file" name="image" id="fileToUpload">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</div>

@endsection

@section('js_scripts')

@if(Session::has('success'))
    <script>
        toastr.success("{!! Session::get('success') !!}");
    </script>
@endif

<script>
    $("#car_make").change(function () {
        var id = $(this).val();
        console.log(id)
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"{{route('getModelByMark')}}",
            type:"post",
            data:{
                _token:$("input[name=_token]").val(),
                id:id
            },
            success:function(response){
                var html = "";
                html += "<option value=''> Select Model </option>";
                $.each(response, function(index, value) {
                    html += `<option value='${value.id}'>${value.model_name}</option>`;
                }); 

                $("#car_model").html(html);
            }
        })
       
    });
</script>
@endsection
