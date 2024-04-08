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
     <div class="row g-2">
       <div class="col-lg-4 text-center">
         <div
         class="card bg-primary h-100 shadow-sm mb-2 p-3 border rounded-3 d-flex flex-row align-items-center justify-content-around">
         <h5 class="mb-0 text-uppercase text-light">New Assesment submitted number </h5>
         <div class="display-6 text-light fw-bold rounded-circle p-2 border">15
         </div>
       </div>
       </div>
       <div class="col-lg-4 text-center">
         <div
           class="card h-100 bg-success shadow-sm mb-2  p-3 border rounded-3 d-flex flex-row align-items-center justify-content-around">
           <h5 class="mb-0 text-light text-uppercase">your Assesment : <br> Complient / Not complient</h5>
         </div> 
       </div>
       <div class="col-lg-4 text-center">
         <div
           class="card h-100 bg-warning shadow-sm mb-2 p-3 border rounded-3 d-flex flex-row align-items-center justify-content-around">
           <h4 class="mb-0 text-light text-uppercase">your Team Assesment </h4>
           <div class="display-6 text-light text-uppercase fw-bold rounded-circle p-2 border">11
           </div>
         </div>
       </div>
     </div>
     <div class="row mt-4">
       <div class="col-lg-6 text-center">
         
         <div class="card">
           <div class="card-body">
             <h5 class="card-title mt-3 text-center">Review List of Assesment Panel</h5>
             <hr>
 
             <!-- Default Table -->
             <table class="table">
               <thead>
                 <tr>
                   <th scope="col">#</th>
                   <th scope="col">Name</th>
                   <th scope="col">Position</th>
                   <th scope="col">Age</th>
                   <th scope="col">Start Date</th>
                 </tr>
               </thead>
               <tbody>
                 <tr>
                   <th scope="row">1</th>
                   <td>Brandon Jacob</td>
                   <td>Designer</td>
                   <td>28</td>
                   <td>2016-05-25</td>
                 </tr>
                 <tr>
                   <th scope="row">2</th>
                   <td>Bridie Kessler</td>
                   <td>Developer</td>
                   <td>35</td>
                   <td>2014-12-05</td>
                 </tr>
                 <tr>
                   <th scope="row">3</th>
                   <td>Ashleigh Langosh</td>
                   <td>Finance</td>
                   <td>45</td>
                   <td>2011-08-12</td>
                 </tr>
                 <tr>
                   <th scope="row">4</th>
                   <td>Angus Grady</td>
                   <td>HR</td>
                   <td>34</td>
                   <td>2012-06-11</td>
                 </tr>
                 <tr>
                   <th scope="row">5</th>
                   <td>Raheem Lehner</td>
                   <td>Dynamic Division Officer</td>
                   <td>47</td>
                   <td>2011-04-19</td>
                 </tr>
               </tbody>
             </table>
             <!-- End Default Table Example -->
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
             <h5 class="card-title mt-3 text-center">All List of Assesment Panel</h5>
             <hr>
 
             <!-- Default Table -->
             <table class="table">
               <thead>
                 <tr>
                   <th scope="col">#</th>
                   <th scope="col">Name</th>
                   <th scope="col">Position</th>
                   <th scope="col">Age</th>
                   <th scope="col">Start Date</th>
                 </tr>
               </thead>
               <tbody>
                 <tr>
                   <th scope="row">1</th>
                   <td>Brandon Jacob</td>
                   <td>Designer</td>
                   <td>28</td>
                   <td>2016-05-25</td>
                 </tr>
                 <tr>
                   <th scope="row">2</th>
                   <td>Bridie Kessler</td>
                   <td>Developer</td>
                   <td>35</td>
                   <td>2014-12-05</td>
                 </tr>
                 <tr>
                   <th scope="row">3</th>
                   <td>Ashleigh Langosh</td>
                   <td>Finance</td>
                   <td>45</td>
                   <td>2011-08-12</td>
                 </tr>
                 <tr>
                   <th scope="row">4</th>
                   <td>Angus Grady</td>
                   <td>HR</td>
                   <td>34</td>
                   <td>2012-06-11</td>
                 </tr>
                 <tr>
                   <th scope="row">5</th>
                   <td>Raheem Lehner</td>
                   <td>Dynamic Division Officer</td>
                   <td>47</td>
                   <td>2011-04-19</td>
                 </tr>
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