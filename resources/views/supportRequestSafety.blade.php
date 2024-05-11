@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>



<section class="header-main py-5">
    <div class="container ">
        <div class="col-lg-10 mx-auto px-4 ">
            <div class="row">
                <div class="col-lg-12 shadow  border p-4 rounded-0 bg-white pt-0">
                    <div class="row border-bottom border-dashed">
                        <div class="col-6 col-sm-6 col-lg-4">
                            <div class="brand p-3">
                                <img src="{{ asset('nhs.png')}}" width="200px" alt="">
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-lg-8 d-flex align-items-center justify-content-end">
                           
                            <a href="{{route('user.dashboard')}}" class="btn btn-sm btn-warning d-block float-end fs-5 d-flex align-items-center gap-2"> <iconify-icon icon="majesticons:door-exit" class=""></iconify-icon> Exit</a>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 border-md-end d-flex align-items-center justify-content-center">


                            
                            <div class="py-3">

                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif


                                {{-- <h2 class="text-center">Display screen equipment assesment</h2> --}}

                                <p>Please use the form below to refer yourself to occupational health.</p>

                                <p>The information entered is <b>STRICKLY CONFIDENTIAL.</b></p>
                                <p>If you are a manager and need to refer a member of staff, please use the management referral form.</p>



                                <form action="{{route('supportRequestStore')}}" method="POST" class="mt-3">
                                    @csrf

                                
                                    <div class="row mt-3">
                                        <div class="col-lg-12  mx-auto">
                                            <input type="hidden" name="assign" value="safety"> 
                                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}"> 
                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <label for="employee_name" >Employee Name</label>
                                                </div>
                                                <div class="col-8">
                                                    <input id="employee_name" type="text" class="form-control @error('employee_name') is-invalid @enderror" name="employee_name" value="{{ old('employee_name') }}"  autocomplete="employee_name" autofocus>
                                                    @error('employee_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <label for="dob" >Date of birth </label>
                                                </div>
                                                <div class="col-8">
                                                    <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" autocomplete="dob" autofocus>
                                                    @error('dob')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <label for="address_first_line" >Address First Line </label>
                                                </div>
                                                <div class="col-8">
                                                    <input id="address_first_line" type="text" class="form-control @error('address_first_line') is-invalid @enderror" name="address_first_line" value="{{ old('address_first_line') }}"  autocomplete="address"   autofocus>
                                                    @error('address_first_line')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <label for="address_second_line" >Address Second Line </label>
                                                </div>
                                                <div class="col-8">
                                                    <input id="address_second_line" type="text" class="form-control @error('address_second_line') is-invalid @enderror" name="address_second_line" value="{{ old('address_second_line') }}"  autocomplete="address_second_line"  autofocus>
                                                    @error('address_second_line')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <label for="city" >City </label>
                                                </div>
                                                <div class="col-8">
                                                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}"  autocomplete="city" autofocus>
                                                    @error('city')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <label for="country" >Country </label>
                                                </div>
                                                <div class="col-8">
                                                    <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}"  autocomplete="country" autofocus>
                                                    @error('country')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <label for="postcode" >Postal Code </label>
                                                </div>
                                                <div class="col-8">
                                                    <input id="postcode" type="text" class="form-control @error('postcode') is-invalid @enderror" name="postcode" value="{{ old('postcode') }}"  autocomplete="postcode" autofocus>
                                                    @error('postcode')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            

                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <label for="home_contact_number" >Home Contact Number </label>
                                                </div>
                                                <div class="col-8">
                                                    <input id="home_contact_number" type="text" class="form-control @error('home_contact_number') is-invalid @enderror" name="home_contact_number" value="{{ old('home_contact_number') }}"  autocomplete="home_contact_number" autofocus>
                                                    @error('home_contact_number')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            

                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <label for="work_contact_number" >Work Contact Number </label>
                                                </div>
                                                <div class="col-8">
                                                    <input id="work_contact_number" type="text" class="form-control @error('work_contact_number') is-invalid @enderror" name="work_contact_number" value="{{ old('work_contact_number') }}"  autocomplete="work_contact_number" autofocus>
                                                    @error('work_contact_number')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            

                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <label for="employee_email" >Employee Email Address </label>
                                                </div>
                                                <div class="col-8">
                                                    <input id="employee_email" type="text" class="form-control @error('employee_email') is-invalid @enderror" name="employee_email" value="{{ old('employee_email') }}"  autocomplete="employee_email" autofocus>
                                                    @error('employee_email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            
                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <label for="division" >Division </label>
                                                </div>
                                                <div class="col-8">
                                                    <input id="division" type="text" class="form-control @error('division') is-invalid @enderror" name="division" value="{{ old('division') }}"  autocomplete="division" autofocus>
                                                    @error('division')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            
                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <label for="department" >Ward/Department </label>
                                                </div>
                                                <div class="col-8">
                                                    <input id="department" type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{ old('department') }}"  autocomplete="department" autofocus>
                                                    @error('department')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            
                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <label for="job_title" >Job Title </label>
                                                </div>
                                                <div class="col-8">
                                                    <input id="job_title" type="text" class="form-control @error('job_title') is-invalid @enderror" name="job_title" value="{{ old('job_title') }}"  autocomplete="job_title" autofocus>
                                                    @error('job_title')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            
                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <label for="length_post_time" >Length of time in post  </label>
                                                </div>
                                                <div class="col-8">
                                                    <input id="length_post_time" type="text" class="form-control @error('length_post_time') is-invalid @enderror" name="length_post_time" value="{{ old('length_post_time') }}"  autocomplete="length_post_time" autofocus>
                                                    @error('length_post_time')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            
                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <label for="referral_reason" >Reason for referral </label>
                                                </div>
                                                <div class="col-8">
                                                    <input id="referral_reason" type="text" class="form-control @error('referral_reason') is-invalid @enderror" name="referral_reason" value="{{ old('referral_reason') }}"  autocomplete="referral_reason" autofocus>
                                                    @error('referral_reason')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            
                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <label for="signature" >Electronic Signature </label>
                                                </div>
                                                <div class="col-8">
                                                    <input id="signature" type="text" class="form-control @error('signature') is-invalid @enderror" name="signature" value="{{ old('signature') }}" autocomplete="signature" autofocus>
                                                    @error('signature')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            


                                        </div>
                                    </div>
                    
                    
                  
                                
                                    <div class="col-lg-12">
                                        <div class="row py-3 ">
                                            <div class="col-lg-5 d-flex align-items-center">
                                                <button type="submit" class="btn btn-warning d-flex align-items-center">
                                                    <iconify-icon icon="akar-icons:check-box-fill" class="me-1"></iconify-icon> Save
                                                </button>
                                            </div>
                                            <div class="col-lg-7 d-flex gap-3 justify-content-end"> </div>
                                        </div>
                                    </div>
                                    
                                    
                                
                                </form>


                            </div>
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
    //header for csrf-token is must in laravel
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    //


    // data store
    var redurl = "{{URL::to('/user/dashboard')}}";
    $("body").delegate("#saveBtn, #saveBtn2, #saveNExit","click",function () {


        var storeurl = "{{URL::to('/user/add-new-assesment')}}";
        var answers = $("input[name='answers[]']")
            .map(function(){return $(this).val();}).get();
        var lowback = $("input[name='lowback[]']")
            .map(function(){return $(this).val();}).get();
        var upperback = $("input[name='upperback[]']")
            .map(function(){return $(this).val();}).get();
        var neck = $("input[name='neck[]']")
            .map(function(){return $(this).val();}).get();
        var shoulders = $("input[name='shoulders[]']")
            .map(function(){return $(this).val();}).get();
        var arms = $("input[name='arms[]']")
            .map(function(){return $(this).val();}).get();
        var hand_fingers = $("input[name='hand_fingers[]']")
            .map(function(){return $(this).val();}).get();
        //   console.log(answers);
        //   console.log(qtys);

        var line_manager_id = $("#line_manager_id").val();
        var department_id = $("#department_id").val();
        var division_id = $("#division_id").val();
        var program_number = $("#pnumber").val();

        var newqn = $("#newqn").val();
        var otherqn = $('#otherqn').prop('checked');
        var exercise = $('#exercise').prop('checked');
        var taught_exercise = $('#taught_exercise').prop('checked');

        var formData = $('#myForm').serializeArray();
        console.log(formData);

        $.ajax({
            url:storeurl,
            method: "POST",
            type: "POST",
            data: formData,
            success: function(d){
                
                console.log((d));

                if (d.status == 303) {
                    $(".ermsg").html(d.message);
                }else if(d.status == 300){
                    // $(".ermsg").html(d.message);
                    swal.fire("Done!", "success");
                    window.setTimeout(function(){window.location.href = redurl},2000)
                }
            },
            error:function(d){
                console.log(d);
            }
        });
    });
    

       
</script>
@endsection