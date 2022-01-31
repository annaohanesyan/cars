@extends('layouts.main')
<!-- Main content -->
@section('content')

<div class="content-wrapper">
    <form method="post" action="{{ route('cars.update', $car->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="validationServer01">Make</label>
                <select class="form-control is-valid" id="update_make"  name="make_id" aria-label=".form-select-lg example">
                    <option selected value="">Select Make</option>
                    @foreach($makes as $make)
                    <option value="{{ $make->id}}" {{ $make->id == $car->make_id ? 'selected' : '' }} >{{ $make->make_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="validationServer02">Model</label>
                <select class="form-control is-valid" id="update_model"  name="model_id" aria-label=".form-select-lg example">
                    @foreach($makes as $make)
                        @if($make->id == $car->make_id)
                            @foreach($make->carmodels as $carmodel)
                                <option value="{{ $carmodel->id}}" {{ $carmodel->id == $car->model_id ? 'selected' : '' }}>{{ $carmodel->model_name}}</option>
                            @endforeach
                        @endif
                    @endforeach
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
</div>
@endsection

@section('js_scripts')

@if(Session::has('success'))
    <script>
        toastr.success("{!! Session::get('success') !!}");
    </script>
@endif

<script>
     $("#update_make").change(function () {
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
                    html += "<option> Select Model </option>";
                    $.each(response, function(index, value) {
                        html += `<option value='${value.id}'>${value.model_name}</option>`;
                    }); 
        
                    $("#update_model").html(html);
                }
            })
        
        });
</script>

@endsection