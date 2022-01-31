@extends('user.main')
<!-- Main content -->
@section('content') 

    <div class="content-wrapper">
        <form method="post" action="{{ route('carsmakes.store') }}">
        @csrf
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="validationServer01">Make name</label>
                    <input type="text" class="form-control is-valid" id="validationServer01" name="make_name" placeholder="Make name">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationServer02">Country</label>
                    <input type="text" class="form-control is-valid" id="validationServer02" name="country" placeholder="Country">
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
                    <h4 class="card-title">Car Makes</h4>
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
                                <th> Make Name </th>
                                <th> Country </th>
                                <th> Create Date </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($makes as $make)
                            <tr id="make">
                                <td>
                                    <div class="form-check form-check-muted m-0">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input">
                                    </label>
                                    </div>
                                </td>
                                <td>
                                    <span class="pl-2">{{ $make->make_name }}</span>
                                </td>
                                <td> {{ $make->country }} </td>
                                <td> {{ $make->created_at }} </td>
                                
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