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
                                {{-- <h2 class="text-center">Display screen equipment assesment</h2> --}}

                                <h4>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24"><path fill="none" stroke="#f00000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 12V8a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2zm0 0l4-4v8zm-7-3v3m0 3v-3m0 0h3m-3 0H7"/></svg>

                                    <a href="https://youtu.be/liaBs1-Zz3I?si=S-2ONPb0u34GFWTs" target="blank">Workstation set up at home and in the office - good posture</a></h4>

                            
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