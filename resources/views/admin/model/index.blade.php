@extends('layouts.main')
<!-- Main content -->
@section('content') 

    <div class="content-wrapper">
        <form method="post" action="{{ route('model.store') }}">
        @csrf
            <div class="form-row">
                <div class="col-md-4 mb-3">
                <label for="validationServer01">Make name</label>
                    <select class="form-control is-valid" id="validationServer01"  name="make_id" aria-label=".form-select-lg example">
                        <option selected value="">Select Make</option>
                        @foreach( $makes as $make)
                        <option value="{{ $make->id }}">{{ $make->make_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationServer02">Model name</label>
                    <input type="text" class="form-control is-valid" id="validationServer02" name="model_name" placeholder="Model name">
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="validationServer03">Color</label>
                    <input type="text" class="form-control is-valid" id="validationServer03" name="color" placeholder="Color">
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

        <div class="row ">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Car Models</h4>
                    <div class="table-responsive">
                        <table class="table">
                        <thead>
                            <tr>
                            <th> Model Name </th>
                            <th> Make name </th>
                            <th> Color </th>
                            <th> Confirm </th>
                            <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($models as $model)
                            <tr id="make">
                                <td>
                                    <span class="pl-2">{{ $model->model_name }}</span>
                                </td>
                                <td> {{ $model->make_name }} </td>
                                <td> {{ $model->color }} </td>
                                <td>
                                    <div class="form-check form-check-muted m-0">
                                    <label class="form-check-label">
                                        @if($model->confirmed === 1)
                                            <input type="checkbox" class="confirmModel" checked data-id = '{{ $model->id }}' data-confirmed = '{{ $model->confirmed }}'>
                                        @else
                                            <input type="checkbox" class="confirmModel" data-id = '{{ $model->id }}' data-confirmed = '{{ $model->confirmed }}'>
                                        @endif
                                    </label>
                                    </div>
                                </td>
                                <td>
                                    <form action="{{ route('model.destroy', $model->id) }}" method="POST">
                
                                        @csrf
                                        @method('DELETE')
                                        
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
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

        $('.confirmModel').change(function() {
            let id = $(this).data('id');
            let confirm = $(this).data('confirmed');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                method: 'POST',
                url: "{{route('confirmModel')}}",
                data: {id:id,confirm:confirm},
                dataType: 'JSON',
                success: function (response) { 
                    if(response['data'] == 1){
                        $(this).checked = true;
                    }else{
                        $(this).checked = false;
                    }

                }
                    
            })
        })

</script>

@endsection