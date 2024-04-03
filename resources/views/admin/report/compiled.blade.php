@extends('admin.layouts.admin')

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
                          <th scope="col">Report</th>
                          
                          <th scope="col" class="text-center">Action</th>
                      </tr>
                  </thead>
                  <tbody>

                    @foreach ($data as $key => $data)

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
                            <a href="{{ route('admin.assesment.report', $data->program_number) }}" class="nav-link text-warning d-flex align-items-center"> <iconify-icon  class="me-1 fs-3" icon="ph:gear-light"></iconify-icon> Report
                            </a>
                        </td>
                        <td>
                            <div class="d-flex gap-2 align-items-center justify-content-center">
                                <a href="{{ route('linemanager.determiniganswer', $data->id) }}">
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
    
</script>

@endsection
