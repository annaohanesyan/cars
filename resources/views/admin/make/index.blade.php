@extends('layouts.main')
<!-- Main content -->
@section('content') 
<div class="content-wrapper">
    <form method="post" action="{{ route('make.store') }}">
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

    <div class="row ">
        <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Car Makes</h4>
            <div class="table-responsive">
                <table class="table">
                <thead>
                    <tr>
                    <th> Make Name </th>
                    <th> Country </th>
                    <th> Create Date </th>
                    <th> Confirm </th>
                    <th> Action </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($makes as $make)
                    <tr id="make">
                        <td>
                            <span class="pl-2">{{ $make->make_name }}</span>
                        </td>
                        <td> {{ $make->country }} </td>
                        <td> {{ $make->created_at }} </td>
                        <td>
                            <div class="form-check form-check-muted m-0">
                            <label class="form-check-label">
                                @if($make->confirmed === 1)
                                    <input type="checkbox" class="confirmed" checked data-id = '{{ $make->id }}' data-confirmed = '{{ $make->confirmed }}'>
                                @else
                                    <input type="checkbox" class="confirmed" data-id = '{{ $make->id }}' data-confirmed = '{{ $make->confirmed }}'>
                                @endif
                            </label>
                            </div>
                        </td>
                        <td>
                            <form action="{{ route('make.destroy', $make->id) }}" method="POST">
                                <button type="button" class="badge badge-outline-success btnEdit" data-toggle="modal" data-target="#exampleModal" 
                                                    data-id="{{$make->id}}"
                                                    data-name="{{$make->make_name}}"
                                                    data-country="{{$make->country}}">Edit</button>
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

@include('admin.make.modal')

@endsection

@section('js_scripts')

    @if(Session::has('success'))
        <script>
            toastr.success("{!! Session::get('success') !!}");
        </script>
    @endif

    <script>

        $(".modal").on('show.bs.modal', function (event){
            var button       = $(event.relatedTarget)
            var id           = button.data('id');
            var make_name    = button.data('name')
            var country      = button.data('country')
        
            $("#id").val(id);
            $("#make_name").val(make_name);
            $("#country").val(country);
        
        });

        $('.confirmed').change(function() {
            let id = $(this).data('id');
            let confirm = $(this).data('confirmed');
            
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                method: 'POST',
                url: "{{route('confirmMake')}}",
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
