@extends('admin.layouts.admin')
@section('content')



<section class="header-main py-3">
    <div class="container ">
        
     <div class="row mt-4"> 
      <div class="col-lg-12">
        
        <div class="card h-100">
          <div class="card-body">
            <form action="" method="POST">
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
                  <select name="user_id" id="user_id" class="form-control select2">
                    {{-- <option value="">Select</option> --}}
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
            <h5 class="card-title mt-3 text-center">All List of Assesment</h5>
            <hr>

            <!-- Default Table -->
            <table class="table" id="exdatatable">
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
               @foreach ($allAssesments as $key => $data)
                   
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
@section('script')

<script>
    $(document).ready(function () {
        $('#exdatatable').DataTable();
    });
</script>

@endsection