@extends('layouts.user')
@section('content')

@php
    $danswer = \App\Models\DeterminigAnswer::where('user_notification', 1)->first();
    $nxtassesmentdate = \App\Models\AssesmentSchedule::where('user_id', Auth::user()->id)->first();
    $qncount = \App\Models\Question::count();
@endphp
<section class="header-main py-5">
  <div class="container ">
      <div class="col-lg-10 mx-auto px-4 ">
          <div class="row">
            @if (isset($danswer))
            {{-- <div class="alert alert-warning" role="alert">
                <iconify-icon icon="flat-color-icons:idea"></iconify-icon>  Some text will be there for user notification when manager reject assesment. <em class="text-dark fw-bold"></em>
            </div> --}}
            @endif

            @if (isset($dueRecords))
            <div class="alert alert-warning" role="alert">
                <iconify-icon icon="flat-color-icons:idea"></iconify-icon>  Some text will be there for user notification when due assesment. <em class="text-dark fw-bold"></em>
            </div>
            @endif
                
              <div class="col-lg-12 shadow  border p-4 rounded-0 bg-light  ">
                  <div class="row ">
                    {{-- @if (isset($assesment))

                    @foreach ($assesment as $item)
                    <a href="{{route('user.survey',$item->program_number)}}">
                        <div class="col-lg-4">
                            <label class="card position-relative rounded-3 shadow-sm border border-2 overflow-hidden">
                                <img src="https://picsum.photos/300/150" class="img-responsive opacity-75" alt="">
                                <div class="p-1 text-center fs-3 position-absolute bottom-0 w-100 bg-white">
                                    Ongoing
                                </div>
                            </label>
                        </div>
                      </a>
                    @endforeach
                        
                    @endif --}}

                        <div class="col-lg-4">
                            <a href="{{route('user.determinigQn')}}">
                                <label class="card position-relative rounded-3 shadow-sm border border-2 overflow-hidden">
                                    {{-- <img src="https://picsum.photos/300/150" class="img-responsive opacity-75" alt=""> --}}
                                    <img src="{{ asset('assesment.jpg')}}"  class="img-responsive opacity-75">
                                    <div class="p-1 text-center fs-3 position-absolute bottom-0 w-100 bg-white">
                                        
                                        @if (isset($danswer))
                                            Outstanding Task
                                        @else
                                            DSE Self Assesment 
                                        @endif
                                    </div>
                                </label>
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <a href="{{route('trainingModule')}}">
                              <label class="card position-relative rounded-3 shadow-sm border border-2 overflow-hidden">
                                <img src="{{ asset('assets/admin/img/training.png')}}"  class="img-responsive opacity-75">
                                  <div class="p-1 text-center fs-3 position-absolute bottom-0 w-100 bg-white">
                                      Training Module
                                  </div>
                              </label>
                            </a>
                        </div>
                        <div class="col-lg-4">
                          <a href="{{route('policyDocument')}}">
                            <label class="card position-relative rounded-3 shadow-sm border border-2 overflow-hidden">
                              <img src="{{ asset('Policy.jpg')}}"  class="img-responsive opacity-75">

                                <div class="p-1 text-center fs-3 position-absolute bottom-0 w-100 bg-white">
                                    Policy Document
                                </div>
                            </label>
                          </a>
                        </div>

                    
                  </div>
              </div>
          </div>


          
          <div class="row mt-4">
            <div class="col-lg-6">
              
                <div class="row g-2">
                  <div class="col-lg-12 ">
                    <div class="card bg-primary shadow-sm mb-2 p-3 border rounded-3 d-flex flex-row">

                        <div class="col-lg-8">
                            <p class="mb-0 text-light">1. Your Self-Assessment status </p>
                        </div>
                        <div class="col-lg-4">
                          <div class="text-light text-center fw-bold rounded-3 p-1 border align-items-center">
                            Complaint
                            {{-- None Complaint --}}
                          </div>
                        </div>
                      
                      
                    </div>
                  </div>
                  <div class="col-lg-12 ">
                    <a href="{{route('user.determinigQn')}}" style="text-decoration: none">
                      <div class="card bg-success shadow-sm mb-2  p-3 border rounded-3 d-flex flex-row">
                        <div class="col-lg-8">
                          <p class="mb-0 text-light">2. Outstanding action </p>
                        </div>
                        <div class="col-lg-4">
                          <div class="text-light text-center fw-bold rounded-3 p-1 border align-items-center">
                            {{$qncount + 9 - $anscount}}
                          </div>
                        </div>

                      </div>
                    </a> 
                  </div>

                  {{-- <div class="col-lg-12 ">
                    <div class="card bg-warning shadow-sm mb-2 p-3 border rounded-3 d-flex flex-row">
                      <p class="mb-0 text-light">3. Your Self-Assessment </p>
                      <div class="display-6 text-light text-uppercase fw-bold rounded-circle p-2 border">
                      </div> 
                    </div>
                  </div> --}}

                  
                  
                  <div class="col-lg-12 ">
                    <div class="card bg-success shadow-sm mb-2  p-3 border rounded-3 d-flex flex-row">
                      
                      <div class="col-lg-8">
                        <p class="mb-0 text-light">3. Next assesent due date </p>
                      </div>
                      <div class="col-lg-4">
                        @if (isset($nxtassesmentdate->end_date))
                          <div class="text-light text-center fw-bold rounded-3 p-1 border align-items-center">
                              {{$nxtassesmentdate->end_date}}
                          </div>
                        @endif
                        

                      </div>

                    </div> 
                  </div>


                  <div class="col-lg-12 ">
                    <div class="card bg-primary shadow-sm mb-2 p-3 border rounded-3 d-flex flex-row">

                    <div class="col-lg-8">
                      <p class="mb-0 text-light">4. Support request </p>
                    </div>
                    <div class="col-lg-4">
                      <div class="text-light text-center fw-bold rounded-3 p-1 border align-items-center">
                        <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"> </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                              <li><a class="dropdown-item" href="{{route('supportRequestSafety')}}">Health & Safety  </a></li>
                              <li><a class="dropdown-item" href="{{route('supportRequest')}}">Occupational Health </a></li>
                              <li><a class="dropdown-item" href="{{route('supportRequest')}}">Self Refferal Form  </a></li>
                              <li><a class="dropdown-item" href="{{route('supportRequest')}}">Eye Test Voucher  </a></li>
                            </ul>
                        </div>
                      </div>
                    </div>


                  </div>
                  </div>


                  {{-- <div class="col-lg-12">
                    <div class="card  bg-warning shadow-sm mb-2 p-3 border rounded-3 d-flex flex-row">
                      <div class="col-lg-8">
                        <p class="mb-0 text-light">5. Archived Assesment</p>
                      </div>
                    </div>
                  </div> --}}

                  
                </div>

            </div>
            

            
            {{-- <div class="col-lg-3 text-center">
              
                <div class="row g-2">
                </div>

            </div> --}}

            <div class="col-lg-6 text-center">
                <div class="card border p-4">
                  <input type="hidden" id="outstanding" value="{{$qncount + 9 - $anscount}}">
                  <input type="hidden" id="complete" value="{{$anscount}}">
                  <!-- Pie Chart -->
                  <div id="pieChart" class="table-responsive"></div>
                </div>
            </div>

        </div>

        <div class="row mt-4"> 
          <div class="col-lg-12">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title mt-3 text-center">Self Assessment List</h5>
                <hr>
    
                <!-- Default Table -->
                <div class="table-responsive">
                  
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
                            {{-- <div class="d-flex gap-2 align-items-center justify-content-center">
                                <a href="{{ route('linemanager.determiniganswer', $data->id) }}">
                                    <iconify-icon class="text-primary" icon="bi:eye"></iconify-icon>
                                </a>
                            </div> --}}
    
                            
                        
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
<script src="{{ asset('frontend/vendor/js/apexcharts.min.js')}}"></script>
{{-- <script src="{{ asset('frontend/vendor/js/chart.umd.js')}}"></script> --}}
{{-- <script src="{{ asset('frontend/vendor/js/echarts.min.js')}}"></script> --}}

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
            $('#exdatatable').DataTable();
        });
  </script>
@endsection