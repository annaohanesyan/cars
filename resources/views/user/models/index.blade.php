@extends('user.main')
<!-- Main content -->
@section('content') 

    <div class="content-wrapper">
        <form method="post" action="{{ route('carsmodels.store') }}">
            @csrf
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="validationServer03">Make name</label>
                    <select class="form-control is-valid" id="validationServer02"  name="make_id" aria-label=".form-select-lg example">
                        <option selected value="">Select Make</option>
                        @foreach( $makes as $make)
                        <option value="{{ $make->id }}">{{ $make->make_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationServer01">Model name</label>
                    <input type="text" class="form-control is-valid" id="validationServer01" name="model_name" placeholder="Model name">
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="validationServer02">Color</label>
                    <input type="text" class="form-control is-valid" id="validationServer02" name="color" placeholder="Color">
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
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
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
                            <th>
                                <div class="form-check form-check-muted m-0">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input">
                                </label>
                                </div>
                            </th>
                            <th> Model Name </th>
                            <th> Color </th>
                            <th> Make name </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($models as $model)
                            <tr id="make">
                                <td>
                                    <div class="form-check form-check-muted m-0">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input">
                                    </label>
                                    </div>
                                </td>
                                <td>
                                    <span class="pl-2">{{ $model->model_name }}</span>
                                </td>
                                <td> {{ $model->color }} </td>
                                <td> {{ $model->makes->make_name }} </td>
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