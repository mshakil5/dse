@extends('expert.layouts.health')
@section('content')
<style>
    /* Custom CSS to style the black modal */
    .black-modal .modal-content {
      background-color: black;
      color: white;
    }
    .black-modal .modal-header {
      border-bottom: none;
    }
    .black-modal .modal-footer {
      border-top: none;
    }
  </style>
<section>
  <div class="container-fluid">

      <div class="row">
          <div class="col-lg-12 table-responsive">
              <table class="table table-striped table-dark ">
                  <thead>
                      <tr>
                          <th scope="col">#</th>
                          <th scope="col">Date</th>
                          <th scope="col">Email</th>
                          <th scope="col">Name</th>
                          <th scope="col">Surname</th>
                          <th scope="col" class="text-center">Action</th>
                      </tr>
                  </thead>
                  <tbody>

                    @foreach ($users as $key => $data)

                      <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{ \Carbon\Carbon::parse($data->date)->format('d/m/Y')}}</td>
                        <td>{{$data->user->email}}</td>
                        <td>{{$data->user->name}}</td>
                        <td>{{$data->user->surname}}</td>
                        <td>
                            

                        </td>
                    </tr>
                    @endforeach
                      
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</section>
  
@endsection

@section('script')

<script>

$(document).ready(function () {

    //header for csrf-token is must in laravel
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    //



});
</script>
    
@endsection