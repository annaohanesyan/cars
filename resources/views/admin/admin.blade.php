@extends('layouts.main')
<!-- Main content -->
@section('content')     
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card corona-gradient-card">
        <div class="card-body py-0 px-0 px-sm-3">
          <div class="row align-items-center">
            <div class="col-4 col-sm-3 col-xl-2">
              <img src="adminpage/images/dashboard/Group126@2x.png" class="gradient-corona-img img-fluid" alt="">
            </div>
            <div class="col-5 col-sm-7 col-xl-8 p-0">
              
            </div>
            <div class="col-3 col-sm-2 col-xl-2 pl-0 text-center">
              <span>
                <a href="{{ route('cars.index') }}" class="btn btn-outline-light btn-rounded get-started-btn">Create New Car</a>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
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
                  <th> Car ID</th>
                  <th> Image </th>
                  <th> Model </th>
                  <th> Make </th>
                  <th> Publish </th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>
                @foreach($cars as $car)
                <tr>
                  <td>
                    <span class="pl-2">{{ $car->id }}</span>
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
                  <td>
                    <div class="form-check form-check-muted m-0">
                      <label class="form-check-label">
                        @if($car->public === 1)
                        <input type="checkbox" class="publish_checked" data-id="{{ $car->id }}" data-name="{{ $car->public }}" checked>
                        @else
                        <input type="checkbox" class="publish_checked" data-id="{{ $car->id }}" data-name="{{ $car->public }}">
                        @endif
                      </label>
                    </div>
                  </td>
                  <td>
                      <a href="{{ route('cars.edit',$car->id) }}">
                        <button class="badge badge-outline-success">Edit</button>
                      </a>
                    <form action="{{ route('cars.destroy',$car->id) }}" method="POST">
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
<!-- content-wrapper ends -->
@endsection

@section('js_scripts')

@if(Session::has('success'))
  <script>
      toastr.success("{!! Session::get('success') !!}");
  </script>
@endif

<script>
   $('.publish_checked').change(function() {
    let id = $(this).data('id');
    let public = $(this).data('name');
    console.log(id, public);
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              method: 'POST',
          url: "{{route('public')}}",
          data: {id:id,public:public},
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