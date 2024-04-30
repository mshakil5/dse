@extends('layouts.user')
@section('content')

@php
    $danswer = \App\Models\DeterminigAnswer::where('user_notification', 1)->first();
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
                                    <img src="https://picsum.photos/300/150" class="img-responsive opacity-75" alt="">
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
                            <label class="card position-relative rounded-3 shadow-sm border border-2 overflow-hidden">
                                <img src="https://picsum.photos/300/150" class="img-responsive opacity-75" alt="">
                                <div class="p-1 text-center fs-3 position-absolute bottom-0 w-100 bg-white">
                                    Training Module
                                </div>
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label class="card position-relative rounded-3 shadow-sm border border-2 overflow-hidden">
                                <img src="https://picsum.photos/300/150" class="img-responsive opacity-75" alt="">
                                <div class="p-1 text-center fs-3 position-absolute bottom-0 w-100 bg-white">
                                    Policy Document
                                </div>
                            </label>
                        </div>

                    
                  </div>
              </div>
          </div>

      </div>
      <div class="row mt-4">
        <div class="col-lg-3 text-center">
          
            <div class="row g-2">
              <div class="col-lg-12 text-center">
                  <div class="card bg-primary h-100 shadow-sm mb-2 p-3 border rounded-3 d-flex flex-row align-items-center justify-content-around">

                  <p class="mb-0 text-uppercase text-light">1. Your Self-Assessment Status </p>

                  <div class="display-6 text-light fw-bold rounded-3 p-1 border">
                    <div class="dropdown">
                      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"> </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                          <li><a class="dropdown-item" href="#">Complaint </a></li>
                          <li><a class="dropdown-item" href="#">None Complaint  </a></li>
                        </ul>
                    </div>
                  </div>
                  
                </div>
              </div>
              <div class="col-lg-12 text-center">
                <a href="{{route('user.determinigQn')}}" style="text-decoration: none">
                  <div class="card h-100 bg-success shadow-sm mb-2  p-3 border rounded-3 d-flex flex-row align-items-center justify-content-around">
                    <p class="mb-0 text-light text-uppercase">2. Outstanding Action </p>

                    <div class="display-6 text-light fw-bold rounded-3 p-1 border"> {{$qncount - $anscount}}</div>

                  </div>
                </a> 
              </div>
              <div class="col-lg-12 text-center">
                <div class="card h-100 bg-warning shadow-sm mb-2 p-3 border rounded-3 d-flex flex-row align-items-center justify-content-around">
                  <p class="mb-0 text-light text-uppercase">3. Your Self-Assessment </p>
                  {{-- <div class="display-6 text-light text-uppercase fw-bold rounded-circle p-2 border">
                  </div> --}}
                </div>
              </div>

              
            </div>

        </div>
        

        
        <div class="col-lg-3 text-center">
          
            <div class="row g-2">
              <div class="col-lg-12 text-center">
                <div class="card bg-primary h-100 shadow-sm mb-2 p-3 border rounded-3 d-flex flex-row align-items-center justify-content-around">
                <p class="mb-0 text-light text-uppercase">4. Support request </p>
                <div class="display-6 text-light fw-bold rounded-3 p-1 border">
                  <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"> </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Occupational Health </a></li>
                        <li><a class="dropdown-item" href="#">Health & Safety  </a></li>
                        <li><a class="dropdown-item" href="#">Self Refferal Form  </a></li>
                        <li><a class="dropdown-item" href="#">Eye Test Voucher  </a></li>
                      </ul>
                  </div>
                </div>
              </div>
              </div>
              <div class="col-lg-12 text-center">
                <div class="card h-100 bg-success shadow-sm mb-2  p-3 border rounded-3 d-flex flex-row align-items-center justify-content-around">
                  <p class="mb-0 text-light text-uppercase">5. Next Assesent Due Date </p>
                </div> 
              </div>
              <div class="col-lg-12 text-center">
                <div class="card h-100 bg-warning shadow-sm mb-2 p-3 border rounded-3 d-flex flex-row align-items-center justify-content-around">
                  <p class="mb-0 text-light">6. Archived Date</p>
                  <div class="display-6 text-light text-uppercase fw-bold rounded-circle p-2 border">
                  </div>
                </div>
              </div>
            </div>

        </div>

        <div class="col-lg-6 text-center">
            <div class="card border p-4">
              <input type="hidden" id="outstanding" value="{{$qncount - $anscount}}">
              <input type="hidden" id="complete" value="{{$anscount}}">
              <!-- Pie Chart -->
              <div id="pieChart"></div>
            </div>
        </div>

     </div>
  </div>
</section>

  
@endsection
@section('script')
<script src="{{ asset('frontend/vendor/js/apexcharts.min.js')}}"></script>
<script src="{{ asset('frontend/vendor/js/chart.umd.js')}}"></script>
<script src="{{ asset('frontend/vendor/js/echarts.min.js')}}"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {

      var outstanding = parseFloat($("#outstanding").val());
      var complete = parseFloat($("#complete").val());
      
      new ApexCharts(document.querySelector("#pieChart"), {
        series: [outstanding, complete],
        chart: {
          height: 350,
          type: 'pie',
          toolbar: {
            show: true
          }
        },
        labels: ['Outstanding Answer','Complete Answer']
      }).render();
    });
  </script>
  <script>
    $(document).ready(function () {
            $('#exdatatable').DataTable();
        });
  </script>
@endsection