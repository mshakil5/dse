@extends('expert.layouts.health')
@section('content')

@php
    // $danswer = \App\Models\DeterminigAnswer::where('user_notification', 1)->first();
    $qncount = \App\Models\Question::count();
@endphp
  
<section class="header-main py-3">
  <div class="container ">
    {{-- <div class="row">
      <div class="col-12">
       <h3 class="text-center text-capitalize border p-3 text-info">Line maneger / Occupationonal Health dashboard info</h3>
      </div>
   </div> --}}

   
   <div class="row mt-4">
      <div class="col-lg-6 text-center">
        
          <div class="row g-2">
            <div class="col-lg-12 text-center">
              <div class="card bg-primary h-100 shadow-sm mb-2 p-3 border rounded-3 d-flex flex-row align-items-center justify-content-around">
              <h5 class="mb-0 text-uppercase text-light">New Assesment submitted number </h5>
              <div class="display-6 text-light fw-bold rounded-circle p-2 border">{{$newAssesments->count()}}
              </div>
            </div>
            </div>
            <div class="col-lg-12 text-center">
              <div class="card h-100 bg-success shadow-sm mb-2  p-3 border rounded-3 d-flex flex-row align-items-center justify-content-around">
                <h5 class="mb-0 text-light text-uppercase">Due Assesment</h5>
                <div class="display-6 text-light text-uppercase fw-bold rounded-circle p-2 border">{{$dueAssesment}}
                </div>
              </div> 
            </div>
            <div class="col-lg-12 text-center">
              <div class="card h-100 bg-warning shadow-sm mb-2 p-3 border rounded-3 d-flex flex-row align-items-center justify-content-around">
                <h4 class="mb-0 text-light text-uppercase">Your Team Assesment </h4>
                <div class="display-6 text-light text-uppercase fw-bold rounded-circle p-2 border">{{$allAssesments->count()}}
                </div>
              </div>
            </div>
          </div>

      </div>
      <div class="col-lg-6 text-center">
          <div class="card border p-4">
            <input type="hidden" id="outstanding" value="{{$qncount + 9 - $anscount}}">
            <input type="hidden" id="complete" value="{{$anscount}}">
            <!-- Pie Chart -->
            <div id="pieChart"></div>
          </div>
        
      </div>
   </div>

   
   <div class="row mt-4"> 
    <div class="col-lg-12">
      
      <div class="card h-100">
        <div class="card-body">
          <form action="{{route('linemanager.search')}}" method="POST">
            @csrf
          <div class="d-flex gap-3 flex-wrap justify-content-center mt-4">

            

              <div class="dropdown">
                <label for="fromDate">From Date</label>
                <input type="date" id="fromDate" name="fromDate" class="form-control">
            </div>
            <div class="dropdown">
                <label for="toDate">To Date</label><br>
                <input type="date" id="toDate" name="toDate" class="form-control" value="">
            </div>
    
    
            <div class="dropdown">
                <label for="user_id">User Name</label><br>
                <select name="user_id" id="user_id" class="form-control">
                  <option value="">Select</option>
                  @foreach ($userlist as $user)
                      <option value="{{$user->id}}">{{$user->name}}</option>
                  @endforeach
                </select>
            </div>
    
            <div class="dropdown">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                  <option value="">Select</option>
                  <option value="Compiled">Compiled</option>
                  <option value="Due">Due</option>
                </select>
            </div>

            <div class="dropdown">
              <label>Action</label> <br>
              <button type="submit" class="btn btn-success">Search</button>
          </div>

        </div>
      </form>
        </div>
      </div>
    </div>
  </div>



     <div class="row mt-4"> 
      <div class="col-lg-12">
        
        <div class="card h-100">
          <div class="card-body">
            <h5 class="card-title mt-3 text-center">Review List of New Assesment</h5>
            <hr>

            <!-- Default Table -->
            <table class="table" id="exdatatable2">
              <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Email</th>
                    <th scope="col">Name</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Count</th>
                    <th scope="col">Health</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Location</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>


               @foreach ($newAssesments as $key => $data)
                   
                  @php
                  $chkSchedule = \App\Models\AssesmentSchedule::where('program_number', $data->program_number)->first();
                  $count = \App\Models\AssesmentAnswer::where('program_number', $data->program_number)->whereNotNull('qn_category_id')->where('answer', 'No')->where('solved', 0)->count();
                
                  $healthcount = \App\Models\AssesmentAnswer::where('program_number', $data->program_number)->whereNull('qn_category_id')->where('answer', 'Yes')->where('solved', 0)->count();

                  $counts = \App\Models\AssesmentAnswer::whereIn('catname', ['lowback', 'upperback', 'neck', 'shoulders', 'arms', 'hand_fingers', 'taught_exercise', 'otherqn'])
                              ->where('program_number', $data->program_number)
                              ->groupBy('catname')->where('answer', 'Yes')->where('solved', 0)
                              ->selectRaw('catname, COUNT(*) as count')
                              ->pluck('count', 'catname');

                  $excounts = \App\Models\AssesmentAnswer::whereIn('catname', ['exercise'])
                            ->where('program_number', $data->program_number)
                            ->groupBy('catname')->where('answer', 'No')->where('solved', 0)
                            ->selectRaw('catname, COUNT(*) as count')
                            ->pluck('count', 'catname');

                  $numKeys = count($counts);
                  $exnumKeys = count($excounts);



                  @endphp


                  <tr>
                      <th scope="row">{{$data->program_number}}</th>
                      <td>{{$data->date}}</td>
                      <td>{{$data->user->email}}</td>
                      <td>{{$data->user->name}}</td>
                      <td>{{$data->user->surname}}</td>
                      <td>
                          <span class="badge text-bg-warning">{{$count}}</span>
                      </td>
                      <td>
                          <span class="badge text-bg-warning">{{$numKeys + $exnumKeys}}</span>
                      </td>
                      <td><span class="badge text-bg-warning">{{$chkSchedule->risk_rating_point}}</span></td>
                      
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
            <!-- End Default Table Example -->
          </div>
        </div>
      </div>
    </div>
    
    <div class="row mt-4"> 
      <div class="col-lg-12">
        <div class="card h-100">
          <div class="card-body">
            <h5 class="card-title mt-3 text-center">All List of Assesment</h5>
            <hr>

            <!-- Default Table -->
            
            <table class="table table-striped table-dark " id="exdatatable">
              <thead>
                  <tr>
                      <th scope="col">#</th>
                      <th scope="col">Date</th>
                      <th scope="col">Email</th>
                      <th scope="col">Name</th>
                      <th scope="col">Surname</th>
                      <th scope="col">Count</th>
                      <th scope="col">Health</th>
                      <th scope="col">Rating</th>
                      <th scope="col">Location</th>
                      <th scope="col" class="text-center">Action</th>
                  </tr>
              </thead>
              <tbody>

                @foreach ($allAssesments as $key => $data)
                
                @php
                $chkSchedule = \App\Models\AssesmentSchedule::where('program_number', $data->program_number)->first();
                $count = \App\Models\AssesmentAnswer::where('program_number', $data->program_number)->whereNotNull('qn_category_id')->where('answer', 'No')->where('solved', 0)->count();
                
                $healthcount = \App\Models\AssesmentAnswer::where('program_number', $data->program_number)->whereNull('qn_category_id')->where('answer', 'Yes')->where('solved', 0)->count();

                
                $counts = \App\Models\AssesmentAnswer::whereIn('catname', ['lowback', 'upperback', 'neck', 'shoulders', 'arms', 'hand_fingers', 'taught_exercise', 'otherqn'])
                              ->where('program_number', $data->program_number)
                              ->groupBy('catname')->where('answer', 'Yes')->where('solved', 0)
                              ->selectRaw('catname, COUNT(*) as count')
                              ->pluck('count', 'catname');

                $excounts = \App\Models\AssesmentAnswer::whereIn('catname', ['exercise'])
                          ->where('program_number', $data->program_number)
                          ->groupBy('catname')->where('answer', 'No')->where('solved', 0)
                          ->selectRaw('catname, COUNT(*) as count')
                          ->pluck('count', 'catname');

                $numKeys = count($counts);
                $exnumKeys = count($excounts);

                @endphp


                <tr>
                    <th scope="row">{{$data->program_number}}</th>
                    <td>{{$data->date}}</td>
                    <td>{{$data->user->email}}</td>
                    <td>{{$data->user->name}}</td>
                    <td>{{$data->user->surname}}</td>
                    <td>
                        <span class="badge text-bg-warning">{{$count}}</span>
                    </td>
                    <td>
                        <span class="badge text-bg-warning">{{$numKeys + $exnumKeys}}</span>
                    </td>
                    <td><span class="badge text-bg-warning">{{$chkSchedule->risk_rating_point}}</span></td>
                    
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
            <!-- End Default Table Example -->
          </div>
        </div>
      </div>
    </div>
  
   
  </div>
</section>




@endsection

@section('script')
<script>
  var outstanding = parseFloat($("#outstanding").val());
  var complete = parseFloat($("#complete").val());
  var options = {
          series: [outstanding, complete],
          chart: {
            type: 'donut',
          },
          labels: ['Outstanding Answer','Complete Answer'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 900
            },
            legend: {
              position: 'bottom',
              width: 900
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#pieChart"), options);
        chart.render();
</script>

<script>
  $(document).ready(function () {
      $('#exdatatable, #exdatatable2').DataTable();
  });
</script>
<script>
  $(document).ready(function() {
      // Select2 Multiple
      $('#user_id').select2({
          placeholder: "Users",
          allowClear: true
      });
  
  });
  
  </script>
@endsection
