@extends('manager.layouts.manager')
@section('content')

  {{-- <h1>Dashboard Coming Soon ..</h1>   --}}

  
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
                </div> 
              </div>
              <div class="col-lg-12 text-center">
                <div class="card h-100 bg-warning shadow-sm mb-2 p-3 border rounded-3 d-flex flex-row align-items-center justify-content-around">
                  <h4 class="mb-0 text-light text-uppercase">your Team Assesment </h4>
                  <div class="display-6 text-light text-uppercase fw-bold rounded-circle p-2 border">{{$allAssesments->count()}}
                  </div>
                </div>
              </div>
            </div>

        </div>
        <div class="col-lg-6 text-center">
            <div class="card border p-4">
              <!-- Pie Chart -->
              <div id="pieChart"></div>
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
            <table class="table">
              <thead>
                <tr>
                   <th scope="col">#</th>
                   <th scope="col">Date</th>
                   <th scope="col">Email</th>
                   <th scope="col">Name</th>
                   <th scope="col">Surname</th>
                   <th scope="col">Location</th>
                   <th scope="col" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>


               @foreach ($newAssesments as $key => $data)
                   
                   @php
                   $chkSchedule = \App\Models\AssesmentSchedule::where('program_number', $data->program_number)->first();
                   $count = \App\Models\AssesmentAnswer::where('program_number', $data->program_number)->where('answer', 'No')->count();
                   @endphp


                   <tr>
                       <th scope="row">{{$key+1}}</th>
                       <td>{{$data->date}}</td>
                       <td>{{$data->user->email}}</td>
                       <td>{{$data->user->name}}</td>
                       <td>{{$data->user->surname}}</td>
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
             <table class="table">
               <thead>
                 <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Email</th>
                    <th scope="col">Name</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Location</th>
                    <th scope="col" class="text-center">Action</th>
                 </tr>
               </thead>
               <tbody>
                @foreach ($newAssesments as $key => $data)
                    
                    @php
                    $chkSchedule = \App\Models\AssesmentSchedule::where('program_number', $data->program_number)->first();
                    $count = \App\Models\AssesmentAnswer::where('program_number', $data->program_number)->where('answer', 'No')->count();
                    @endphp


                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$data->date}}</td>
                        <td>{{$data->user->email}}</td>
                        <td>{{$data->user->name}}</td>
                        <td>{{$data->user->surname}}</td>
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
             <!-- End Default Table Example -->
           </div>
         </div>
       </div>
     </div>
    </div>
</section>
  
@endsection