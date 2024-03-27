@extends('manager.layouts.master')
@section('content')

<section class="header-main py-5">
    <div class="container ">
        <div class="col-lg-10 mx-auto px-4 ">
            <div class="row">
                <div class="col-lg-12 shadow  border p-4 rounded-0 bg-light pt-0">
                    <div class="row border-bottom border-dashed">
                        <div class="col-6 col-sm-6 col-lg-10">
                            <div class="brand">
                                <img src="{{ asset('frontend/images/logo-design.gif')}}" width="90px" alt="">
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-lg-2 d-flex align-items-center justify-content-end">
                            
                            

                            <a href="{{route('linemanager.userlist')}}" class="btn btn-sm btn-danger d-block float-end fs-5 d-flex align-items-center gap-2"> <iconify-icon icon="majesticons:door-exit" class=""></iconify-icon>
                                Exit
                            </a>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 border-md-end d-flex align-items-center justify-content-center">

                            <div class="py-3">
                                
                                <h2 class="text-success text-left ">Appendix 3</h2>
                                <h2 class="text-danger text-left ">Display screen equipment (DSE) workstation
                                    self-assessment</h2>
                                <p>
                                    You are asked to complete the enclosed form to assess that you are using your
                                    computer and workstation in the ‘optimum’ way, so that you suffer no ill-effects
                                    from your work. Read the ‘things to consider’ column and assess yourself against the
                                    photographs. Try to adjust your position or items of equipment. Once you have
                                    completed your form, contact your manager to discuss your assessment who will
                                    complete the right hand column on the form and make additional notes for further
                                    action if this is required on the DSE Risk Assessment action plan.
                                </p>
                                <p>
                                    DSE = visual display unit (VDU) / screen, stand & central processing unit (CPU) /
                                    box. <br>
                                    Workstation = Dictaphone, telephone, table, chair, document holder, footstool,
                                    mouse.
                                </p>
                               
                                <div class="d-flex gap-3 flex-wrap justify-content-center mt-4">

                                    <div class="dropdown">
                                        <label for=""> Line Manager</label> <br>
                                        <select name="line_manager" id="line_manager" class="btn btn-secondary dropdown-toggle select2  @error('line_manager') is-invalid @enderror">
                                        <option value="{{Auth::user()->id}}">{{Auth::user()->name}}</option>
                                        </select>
                                    </div>
                                    <div class="dropdown">
                                        <label for=""> Department</label> <br>
                                        <select name="department_id" id="department_id" class="btn btn-secondary dropdown-toggle select2  @error('department_id') is-invalid @enderror">
                                            <option value="">Department</option>
                                            @foreach ($departments as $department)
                                                <option value="{{$department->id}}"  @if (isset($data))
                                                    @if ($data->department_id == $department->id) selected @endif
                                                @endif>{{$department->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="dropdown">
                                        <label for=""> Division</label> <br>
                                        <select name="division_id" id="division_id" class="btn btn-secondary dropdown-toggle select2 @error('division_id') is-invalid @enderror">
                                            <option value="">Division</option>
                                            @foreach ($divisions as $division)
                                                <option value="{{$division->id}}"  @if (isset($data))
                                                    @if ($data->division_id == $division->id) selected @endif
                                                @endif>{{$division->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="row ">
                <div class="col-lg-12 shadow-sm border rounded-0 bg-light ">
                    <div class="row pt-5 px-4">

                        

                            <div class="col-lg-12 mb-4">
                                <h6 class="mb-3">1. Do you work with DSE for 1 hrs or more ? </h6>
                                <label for="yes" class="mx-2">
                                    <input id="work_hour_yes" type="radio" name="work_hour"  class="form-check-input me-1" value="Yes" @if (isset($data)) @if ($data->work_hour == "Yes") checked @endif @endif>Yes
                                </label>
                                <label for="no" class="mx-2">
                                    <input id="work_hour_no" type="radio" name="work_hour" class="form-check-input me-1" value="No" @if (isset($data)) @if ($data->work_hour == "No") checked @endif @endif>No
                                </label>
                            </div>
                            <div class="col-lg-12 mb-4">
                                <h6 class="mb-3">2. Do you use WoW system through your shift ? </h6>
                                <label for="yes" class="mx-2">
                                    <input id="wow_system_yes" type="radio" name="wow_system" class="form-check-input me-1" value="Yes" @if (isset($data)) @if ($data->wow_system == "Yes") checked @endif @endif>Yes
                                </label>
                                <label for="no" class="mx-2">
                                    <input id="wow_system_no" type="radio" name="wow_system" class="form-check-input me-1" value="No" @if (isset($data)) @if ($data->wow_system == "No") checked @endif @endif>No
                                </label>

                                


                            </div>

                            <div class="col-lg-12">
                                <div class="row py-3 ">
                                    <div class="col-lg-7 d-flex align-items-center">
                                        
                                        


                                        @if ($data->work_hour == "Yes" || $data->wow_system == "Yes")
                                        <a href="{{route('health.assessment.details', $data->program_number)}}" class="btn btn-success d-flex align-items-center m-2" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M16 8v8M8 8v8l7-4z"/><circle cx="12" cy="12" r="10"/></g></svg> Go to Answer
                                        </a>
                                        @else

                                        @if ($schedule->status == 1)
                                        <a  class="btn btn-warning d-flex align-items-center m-2" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 4H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h3.188c1 0 1.812.811 1.812 1.812c0 .808.976 1.212 1.547.641l1.867-1.867A2 2 0 0 1 14.828 18H19a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2"/></svg> Approved
                                        </a>
                                        @elseif ($schedule->status == 2)
                                        <a  class="btn btn-warning d-flex align-items-center m-2" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 4H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h3.188c1 0 1.812.811 1.812 1.812c0 .808.976 1.212 1.547.641l1.867-1.867A2 2 0 0 1 14.828 18H19a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2"/></svg> Rejected
                                        </a>
                                        
                                        @else
                                        <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-warning d-flex align-items-center m-2" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 4H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h3.188c1 0 1.812.811 1.812 1.812c0 .808.976 1.212 1.547.641l1.867-1.867A2 2 0 0 1 14.828 18H19a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2"/></svg> Change Status
                                        </a>
                                        @endif

                                        @endif
                                        




                                    </div>
                                    <div class="col-lg-5 d-flex gap-3 justify-content-end"> </div>
                                </div>
                            </div>
                            

                    </div>
                </div>
                
            </div>


            


            
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade black-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Title will be there</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="ermsg"></div>
            
            <div class="dropdown">
                <label for="status">Select Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="">Select</option>
                    <option value="1">Approved</option>
                    <option value="2">Reject</option>
                </select>
            </div>

            <div class="dropdown">
                <label for="comment">Comment</label>
                <textarea name="comment" id="comment" class="form-control" cols="30" rows="3"></textarea>
            </div>
    
            <div class="dropdown">
                <label for="date">Next Assesment Date</label>
                <input type="date" class="form-control" id="date">
            </div>


            <input type="hidden" name="user_id" id="user_id" value="{{$data->user_id}}">
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary schedule" id="addcomment" uid="{{$data->user_id}}" data-id="{{$data->id}}" prgmnumber={{$data->program_number}}>Save</button>
        </div>
    </div>
    </div>
</div>
  
@endsection

@section('script')
    
<script>

    // header for csrf-token is must in laravel
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
       // 

       
       // comment store 
   $("body").delegate("#addcomment","click",function () {
    
        var status = $("#status").val();

        if (status == 1) {
        var commenturl = "{{URL::to('/manager/assesment-approved')}}";
        } else {
        var commenturl = "{{URL::to('/manager/assesment-reject')}}";
        }

       var prgmnumber = $(this).attr('prgmnumber');
       var user = $(this).attr('uid');
       var comment = $("#comment").val();
       var date = $("#date").val();
       console.log(user, comment, prgmnumber);
       var form_data = new FormData();		
       form_data.append("prgmnumber", prgmnumber);
       form_data.append("user_id", user);
       form_data.append("comment", comment);
       form_data.append("date", date);
       form_data.append("status", status);

       $.ajax({
           url:commenturl,
           method: "POST",
           type: "POST",
           contentType: false,
           processData: false,
           data:form_data,
           success: function(d){
                $(".ermsg").html(d.message);
               window.setTimeout(function(){location.reload()},2000)
               // console.log((d.min));
           },
           error:function(d){
               console.log(d);
           }
       });
   });
   // comment store 
</script>
@endsection