@extends('manager.layouts.manager')
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
                          <th scope="col">Assesment Start Date</th>
                          <th scope="col" class="text-center">Action</th>
                      </tr>
                  </thead>
                  <tbody>

                    @foreach ($users as $key => $data)

                    @php
                        $chkschedule = \App\Models\AssesmentSchedule::where('user_id', $data->user_id)->first();
                    @endphp


                      <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$data->date}}</td>
                        <td>{{$data->user->email}}</td>
                        <td>{{$data->user->name}}</td>
                        <td>{{$data->user->surname}}</td>
                        <td> @if (isset($chkschedule)){{$chkschedule->start_date }}@endif</td>
                        <td>
                            <div class="d-flex gap-2 align-items-center justify-content-center">
                                <a href="{{ route('linemanager.determiniganswer', $data->id) }}">
                                    <iconify-icon class="text-primary" icon="bi:eye"></iconify-icon>
                                </a>
                                @if (empty($chkschedule))
                                    <button type="button" class="" data-bs-toggle="modal" data-bs-target="#exampleModal{{$data->id}}">
                                        <iconify-icon class="text-primary" icon="bi:plus"></iconify-icon>
                                    </button>
                                @endif
                            </div>

                            <!-- Modal -->
                            <div class="modal fade black-modal" id="exampleModal{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add next assesment date</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="user_id" id="user_id{{$data->id}}" value="{{$data->user_id}}">
                                        <input type="date" class="form-control" id="date{{$data->id}}">
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary schedule" uid="{{$data->user_id}}" data-id="{{$data->id}}">Save</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                        
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



    var url = "{{URL::to('/manager/add-new-schedule')}}";

    $(".schedule").click(function(){

        var did = $(this).attr("data-id");
        var uid = $(this).attr("uid");
        var date = $("#date"+did).val();
        
        
        $.ajax({
            url: url,
            method: "POST",
            data: {uid:uid,date:date},
            success: function (d) {
                if (d.status == 303) {
                    $(".ermsgod").html(d.message);
                }else if(d.status == 300){
                    $(".ermsgod").html(d.message);
                    location.reload();
                }
            },
            error: function (d) {
                console.log(d);
            }
        });

    });
});
</script>
    
@endsection