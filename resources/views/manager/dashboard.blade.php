@extends('manager.layouts.manager')
@section('content')
<style>
  /* Custom CSS for Select2 Input Field */
  .select2-container .select2-selection--single .select2-selection__rendered {
      height: 37px; /* Adjust the height as needed */
      line-height: 37px; /* Ensure the text is vertically centered */
  }

  .select2-container .select2-selection--single {
      height: 37px; /* Adjust the height as needed */
  }

  .select2-container .select2-selection--single .select2-selection__arrow {
      height: 37px; /* Match the height of the input field */
  }

  /* Custom CSS for Select2 Dropdown Options */
  .select2-container .select2-results__option {
      height: 37px; /* Adjust the height as needed */
      line-height: 37px; /* Ensure the text is vertically centered */
  }
</style>
  <section class="header-main py-3">
    <div class="container ">
      {{-- <div class="row">
        <div class="col-12">
         <h3 class="text-center text-capitalize border p-3 text-info">Line maneger / Occupationonal Health dashboard info</h3>
        </div>
     </div> --}}

     
     <div class="col-lg-10 mx-auto px-4 ">
      <div class="row mt-4">
        <div class="col-lg-6">
          
            <div class="row g-2">
              
              <div class="col-lg-12 ">
                <div class="card bg-primary shadow-sm mb-2 p-3 border rounded-3 d-flex flex-row">
                    <div class="col-lg-8">
                        <p class="mb-0 text-light">New Assesment Submitted </p>
                    </div>
                    <div class="col-lg-4">
                      <div class="text-light text-center fw-bold rounded-3 p-1 border align-items-center">
                        {{$newAssesments->count()}}
                      </div>
                    </div>
                </div>
              </div>
              
              <div class="col-lg-12 ">
                  <div class="card bg-success shadow-sm mb-2  p-3 border rounded-3 d-flex flex-row">
                    <div class="col-lg-8">
                      <p class="mb-0 text-light">Your Team Assesment</p>
                    </div>
                    <div class="col-lg-4">
                      <div class="text-light text-center fw-bold rounded-3 p-1 border align-items-center">
                        {{$allAssesments->count()}}
                      </div>
                    </div>
                  </div>
              </div>

              <div class="col-lg-12 ">
                <div class="card bg-danger shadow-sm mb-2  p-3 border rounded-3 d-flex flex-row">
                  <div class="col-lg-8">
                    <p class="mb-0 text-light">High Risk Rating List </p>
                  </div>
                  <div class="col-lg-4">
                    <div class="text-light text-center fw-bold rounded-3 p-1 border align-items-center">
                      {{$highrisk}}
                    </div>
                  </div>
                </div>
            </div>

            <div class="col-lg-12 ">
              <div class="card bg-warning shadow-sm mb-2  p-3 border rounded-3 d-flex flex-row">
                <div class="col-lg-8">
                  <p class="mb-0 text-light">DSE Self assessment Renewal Due </p>
                </div>
                <div class="col-lg-4">
                  <div class="text-light text-center fw-bold rounded-3 p-1 border align-items-center">
                    {{$dueAssesment}}
                  </div>
                </div>
              </div>
          </div>

            </div>

        </div>
        <div class="col-lg-6 text-center">
            <div class="card border p-4">
              <input type="hidden" id="reviewcount" value="{{$reviewcount}}">
              <input type="hidden" id="compiledcount" value="{{$compiledcount}}">
              <!-- Pie Chart -->
                  <div id="pieChart" class="table-responsive"></div>
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
                  <label for="user_id">User Name</label> <br>
                  <select name="user_id" id="user_id" class="form-control select2" style="width: 150px;">
                    <option value="">Select</option>
                    @foreach ($userlist as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                  </select>
              </div>
      
              <div class="dropdown">
                  <label for="status">Status</label>
                  <select name="status" id="status" class="form-control" style="width: 150px;">
                    <option value="">Select</option>
                    <option value="Compiled">Compliant</option>
                    <option value="Due">Renewal  </option>
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
            <div class="table-responsive">
              <table class="table" id="exdatatable2">
                <thead>
                  <tr>
                      <th scope="col">DSE ID</th>
                      <th scope="col">Date</th>
                      <th scope="col">Email</th>
                      <th scope="col">Name</th>
                      <th scope="col">Surname</th>
                      <th scope="col">Count</th>
                      <th scope="col">Health</th>
                      <th scope="col">Assign to</th>
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
                        <td> {{ \Carbon\Carbon::parse($data->date)->format('d/m/Y')}}</td>
                        <td>{{$data->user->email}}</td>
                        <td>{{$data->user->name}}</td>
                        <td>{{$data->user->surname}}</td>
                        <td>
                            <span class="badge text-bg-warning">{{$count}}</span>
                        </td>
                        <td>
                            <span class="badge text-bg-warning">{{$numKeys + $exnumKeys}}</span>
                        </td>
                        
                        <td>{{$data->assign_account}}</td>
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
            <!-- Default Table -->
            
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
            <div class="table-responsive">
              <table class="table table-striped table-dark " id="exdatatable">
                <thead>
                    <tr>
                        <th scope="col">DSE ID</th>
                        <th scope="col">Date</th>
                        <th scope="col">Email</th>
                        <th scope="col">Name</th>
                        <th scope="col">Surname</th>
                        <th scope="col">Count</th>
                        <th scope="col">Health</th>
                        <th scope="col">Risk rating point</th>
                        <th scope="col">Assign to</th>
                        <th scope="col">Report</th>
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
                      <td> {{ \Carbon\Carbon::parse($data->date)->format('d/m/Y')}} </td>
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
                        <a href="{{ route('manager.assesment.report', $data->program_number) }}" class="nav-link text-warning d-flex align-items-center"> <iconify-icon  class="me-1 fs-3" icon="ph:gear-light"></iconify-icon> Report
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
            
            <!-- End Default Table Example -->
          </div>
        </div>
      </div>
    </div>
     </div>
     
      
     
    </div>
</section>
  
@endsection

@section('script')


<script>
  var reviewcount = parseFloat($("#reviewcount").val());
  var compiledcount = parseFloat($("#compiledcount").val());

  var options = {
  series: [reviewcount, compiledcount],
  chart: {
    type: 'donut'
  },
  labels: ['Outstanding', 'reviewed'], // Your custom labels
  dataLabels: {
    enabled: true,
    formatter: function (val) {
      return Math.round(val) + "%";
    }
  },
  plotOptions: {
    pie: {
      donut: {
        labels: {
          show: false,
          total: {
            show: false,
            label: 'Total',
            formatter: function (w) {
              return w.globals.seriesTotals.reduce((a, b) => {
                return a + b
              }, 0);
            }
          }
        }
      }
    }
  }
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
          placeholder: "Select Users",
          allowClear: true
      });
  
  });
  
  </script>
@endsection