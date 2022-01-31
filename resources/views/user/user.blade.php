@extends('user.main')
<!-- Main content -->
@section('content') 

    <div class="content-wrapper">
        <ul class="navbar-nav w-100">
            <div class="nav-link mt-2 mt-md-0 d-none d-lg-flex search"> 
                <div class="col-md-4 mb-3">
                    <li class="nav-item ">
                        <label for="validationServer03">Make</label>
                        <select class="form-control is-valid" id="makename" name="make_id" aria-label=".form-select-lg example">
                            <option selected value="">Select Make</option>
                            @foreach( $makes as $make)
                            <option value="{{ $make->id }}" data-name='{{ $make->make_name }}'>{{ $make->make_name }}</option>
                            @endforeach
                        </select>
                    </li>
                </div>
                <div class="col-md-4 mb-3">
                    <li class="nav-item" style="margin-left:40px">
                        <label for="validationServer03">Model</label>
                        <select class="form-control is-valid" id="selectedmodel"  name="model_id" aria-label=".form-select-lg example">
                        </select>
                    </li>
                   
                </div>
                <div class="col-md-4 mb-3">
                    <li class="nav-item w-30">
                        <button id="filter" style="background:black; margin:33px 20px; color:#00d25b; padding:5px">Search</button>
                    </li>
                </div>
            </div> 
        </ul>
        <div class="alert alert-danger" id="error" style="display:none">
            <strong >'Whoops! Please select make name'</strong>
        </div>
        <div class="row ">
            <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">CARS  <<<<</h4>
                <div class="table-responsive">
                    <table class="table">
                    <thead>
                        <tr>
                            <th> Car </th>
                            <th> Image </th>
                            <th> Make </th>
                            <th> Model </th>
                        </tr>
                    </thead>
                    <tbody id="table_body">
                        @foreach($cars as $car)
                        <tr>
                            <td>
                                <span class="pl-2">{{ $count++ }}</span>
                            </td>
                            <td> 
                                @if($car->image)
                                <img src="../images/{{ $car->image}}" alt="image" />
                                @else
                                <img src="../images/no-image.jpg" alt="image" />
                                @endif
                            </td>
                            <td> {{ $car->make_name }} </td>
                            <td> {{ $car->model_name }} </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>

@endsection

@section('js_scripts')

<script>
    $("#makename").change(function () {
        var id = $(this).val();
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"{{route('carmodels')}}",
            type:"post",
            data:{
                _token:$("input[name=_token]").val(),
                id:id
            },
            success:function(response){
                var html = "";
                html += "<option value=''> Select Model </option>";
                $.each(response, function(index, value) {
                    html += `<option value='${value.model_name}'>${value.model_name}</option>`;
                }); 

                $("#selectedmodel").html(html);
            }
        })
       
    });

    $("#filter").click(function () {
        var make = $('#makename').find('option:selected').data('name');
        var model = $('#selectedmodel').val();
        console.log(make, model);
        if(make !== undefined){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:"{{route('filter')}}",
                type:"post",
                data:{
                    _token:$("input[name=_token]").val(),
                    make:make,
                    model:model
                },
                success:function(response){
                    var html = "";
                    var count = 1;
                    console.log(response.filterData);
                     $.each(response.filterData, function(index, value) {
                        
                        
                            console.log(value);
                        
                        html += `<tr>
                            <td>
                                <span class="pl-2">${count++ }</span>
                            </td>
                            <td>
                                <img src="../images/${ value.image ? value.image : 'no-image.jpg'}" alt="image" /> 
                            </td>
                            <td> ${value.make_name} </td>
                            <td> ${value.model_name} </td>
                        </tr>`
                     }); 

                    $("#table_body").html(html);
                }
            })
        }else{
            console.log(11111111);
            $("#error").css("display", "block");
        }
       
       
    });

</script>

@endsection