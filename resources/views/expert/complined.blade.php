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
                          <th scope="col">Email</th>
                          <th scope="col">Name</th>
                          <th scope="col">Surname</th>
                          <th scope="col">Count</th>
                          <th scope="col">Risk Rating</th>
                          <th scope="col">Position</th>
                          
                          <th scope="col" class="text-center">Action</th>
                      </tr>
                  </thead>
                  <tbody>

                    @foreach ($users as $key => $data)

                    @php
                    $count = \App\Models\AssesmentAnswer::where('program_number', $data->program_number)->where('answer', 'No')->where('solved', 0)->count();
                    $risk = \App\Models\AssesmentSchedule::where('program_number', $data->program_number)->first();
                    @endphp


                      <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$data->user->email}}</td>
                        <td>{{$data->user->name}}</td>
                        <td>{{$data->user->surname}}</td>
                        <td><span class="badge text-bg-warning">{{$count}}</span></td>
                        <td><span class="badge text-bg-warning">{{$risk->risk_rating_point}}</span></td>
                        <td>{{$data->assign_account}}</td>
                        
                        <td>
                            <div class="d-flex gap-2 align-items-center justify-content-center">
                                <a href="{{ route('health.determiniganswer', $data->id) }}">
                                    <iconify-icon class="text-primary" icon="bi:eye"></iconify-icon>
                                </a>
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