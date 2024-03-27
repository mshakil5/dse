@extends('layouts.master')
@section('content')

<section class="header-main py-5">
        <div class="container ">
            <div class="col-lg-10 mx-auto px-4">
                <div class="row">
                    <div class="col-lg-12 shadow  border p-4 rounded-0 bg-light pt-0">
                        <div class="row border-bottom border-dashed">
                            <div class="col-6 col-sm-6 col-lg-6">
                                <div class="brand">
                                    <img src="{{ asset('frontend/images/logo-design.gif')}}" width="90px" alt="">
                                </div>
                            </div>
                            <div class="col-6 col-sm-6 col-lg-6 d-flex align-items-center justify-content-end">
                                
                                <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-warning d-flex align-items-center m-2" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 4H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h3.188c1 0 1.812.811 1.812 1.812c0 .808.976 1.212 1.547.641l1.867-1.867A2 2 0 0 1 14.828 18H19a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2"/></svg> Change Status
                                </a>

                                <a href="{{route('manager.assesment')}}" class="btn btn-sm btn-danger d-block float-end fs-5 d-flex align-items-center gap-2"> <iconify-icon icon="majesticons:door-exit" class=""></iconify-icon>
                                    Exit
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 border-md-end d-flex align-items-center justify-content-center">
                                <div class="py-3">

                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif


                                    <h2 class="text-success text-left ">Appendix 3</h2>
                                    <h2 class="text-danger text-left ">Display screen equipment (DSE) workstation self-assessment</h2>
                                        <p>
                                            You are asked to complete the enclosed form to assess that you are using your computer and workstation in the ‘optimum’ way, so that you suffer no ill-effects from your work.  Read the ‘things to consider’ column and assess yourself against the photographs.  Try to adjust your position or items of equipment.  Once you have completed your form, contact your manager to discuss your assessment who will complete the right hand column on the form and make additional notes for further action if this is required on the DSE Risk Assessment action plan.
                                        </p>
                                        <p>
                                            DSE = 	visual display unit (VDU) / screen, stand & central processing unit (CPU) / box. <br>
                                            Workstation  = 	Dictaphone, telephone, table, chair, document holder, footstool, mouse.
                                        </p>
                                        
                                    <div class="d-flex gap-3 flex-wrap justify-content-center mt-4">


                                        <div class="dropdown">
                                            <label for="work_station_number">Work Station Number</label>
                                            <input type="number" id="work_station_number" name="work_station_number" class="form-control" value="@if(isset($data)){{$data->work_station_number}}@endif" readonly>
                                        </div>

                                        <div class="dropdown">
                                            <label for="department">Department</label><br>
                                            <input type="text" id="department" name="department" class="form-control" value="{{ $department->name }}" readonly>
                                        </div>

                                        <div class="dropdown">
                                            <label for="user_name">User Name</label>
                                            <input type="text" id="user_name" name="user_name" class="form-control" value="{{ $user->name }}" readonly>
                                        </div>

                                        <div class="dropdown">
                                            <label for="date">Date</label>
                                            <input type="date" id="date" name="date" class="form-control" value="{{ $assesment->date }}" readonly>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                        <div id="questions-container" class="col-lg-8 shadow-sm border rounded-0 bg-light">
                            
                            @php
                                $sl = 1;
                            @endphp

                            @foreach ($assesmentanswers as $key => $assanswer)
                            @if($assanswer->answer != "Yes" && $assanswer->solved == 0)
                            <div class="row pt-5 px-4" data-category="{{ $assanswer->question->qn_category_id }}">
                                <div class="col-lg-12 mb-4">
                                    <h6 class="mb-3">{{ $sl }}. {{ $assanswer->question->question }}</h6>
                                    <div class="d-flex">
                                        <label for="yes" class="mx-4 fw-bold text-success">
                                            YES <input type="radio" name="answers[{{ $assanswer->id }}]" class="form-check-input" id="yes{{ $assanswer->id }}" value="Yes" required="required" @if(isset($assanswer->answer)) {{ $assanswer->answer == 'Yes' ? 'checked' : '' }} @endif >
                                        </label>

                                        <label for="NO" class="me-3 fw-bold text-danger">
                                            NO <input type="radio" name="answers[{{ $assanswer->id }}]" class="form-check-input" value="No" required="required" 
                                            @if(isset($assanswer->answer)) {{ $assanswer->answer == 'No' ? 'checked' : '' }} @endif>
                                        </label>
                                    </div>
                                </div>

                                @foreach ($assanswer->assesmentAnswerComments as $comment)
                                    @if ($comment->created_by == "Manager")
                                        <div class="row">
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-8 p-2 alert alert-secondary mb-3 rounded-3 text-dark text-right">{{$comment->comment}}
                                                <br>
                                            <small>Date: {{$comment->date}}</small>
                                            </div>
                                        </div>
                                    @else

                                        <div class="row">
                                            <div class="col-lg-8 p-2 alert alert-secondary text-start mb-3 rounded-3 text-dark">{{$comment->comment}}
                                                <br>
                                                <small>Date: {{$comment->date}}</small>
                                            </div>
                                            <div class="col-lg-4"></div>
                                        </div>
                                        
                                    @endif
                                @endforeach

                                <div class="row" id="reply{{$assanswer->id}}">

                                </div>

                                
                                

                                @if ($assanswer->solved == 0)
                                
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                    <div class="col-lg-12" id="replycmnt{{$assanswer->id}}">
                                        <textarea name="manager_comment" id="comment{{$assanswer->id}}" class="form-control" placeholder="Comments Here" required></textarea>
                                        <input type="hidden" name="assans_id" value="{{ $assanswer->id }}">
                                    </div>
                                    <div class="col-lg-12" id="replybtn{{$assanswer->id}}">
                                        <div class="row py-3 ">
                                            <div class="col-lg-5 d-flex align-items-center">
                                                {{-- <small class="text-muted mb-0">76 charachter remaining</small> --}}
                                            </div>
                                            <div class="col-lg-7 d-flex gap-3 justify-content-end">
                                                <button type="button" class="btn btn-success d-flex align-items-center addcomment" user="{{$user->id}}" assans_id="{{ $assanswer->id }}" solved="1"> <iconify-icon icon="akar-icons:check-box-fill" class="me-1"></iconify-icon> accept as resolved</button>


                                                <button type="button" class="btn btn-warning d-flex align-items-center addcomment" user="{{$user->id}}" assans_id="{{ $assanswer->id }}" solved="0"> <iconify-icon icon="akar-icons:check-box-fill" class="me-1"></iconify-icon> send
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                @endif
                                    @php
                                        $sl = $sl + 1;
                                    @endphp
                            </div>
                            @endif
                            @endforeach

                            @foreach ($assesmentanswers as $key => $assanswer)
                            @if ($assanswer->answer != "No" || $assanswer->solved == 1)
                            <div class="row pt-5 px-4">
                                <div class="col-lg-12 mb-4">
                                    <h6 class="mb-3">{{ $sl}}. {{ $assanswer->question->question }}</h6>
                                    <div class="d-flex">
                                        <label for="yes" class="mx-4 fw-bold text-success">
                                            YES <input type="radio" name="answers[{{ $assanswer->id }}]" class="form-check-input" id="yes{{ $assanswer->id }}" value="Yes" required="required" @if(isset($assanswer->answer)) {{ $assanswer->answer == 'Yes' ? 'checked' : '' }} @endif >
                                        </label>

                                        <label for="NO" class="me-3 fw-bold text-danger">
                                            NO <input type="radio" name="answers[{{ $assanswer->id }}]" class="form-check-input" value="No" required="required" 
                                            @if(isset($assanswer->answer)) {{ $assanswer->answer == 'No' ? 'checked' : '' }} @endif>
                                        </label>
                                    </div>
                                </div>

                                @foreach ($assanswer->assesmentAnswerComments as $comment)
                                    @if ($comment->created_by == "Manager")
                                        <div class="row">
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-8 p-2 alert alert-secondary mb-3 rounded-3 text-dark text-right">{{$comment->comment}}
                                                <br>
                                            <small>Date: {{$comment->date}}</small>
                                            </div>
                                        </div>
                                    @else

                                        <div class="row">
                                            <div class="col-lg-8 p-2 alert alert-secondary text-start mb-3 rounded-3 text-dark">{{$comment->comment}}
                                                <br>
                                                <small>Date: {{$comment->date}}</small>
                                            </div>
                                            <div class="col-lg-4"></div>
                                        </div>
                                        
                                    @endif
                                @endforeach




                            </div>
                            @endif
                            @php
                                $sl = $sl + 1;
                            @endphp
                            @endforeach

                    
                            
                        </div>
                        <!-- Categories -->
                            <div class="col-lg-4 shadow-sm border rounded-0 bg-light">
                                <div class="py-4">
                                    <ol class="custom-list w-100">
                                        @foreach($questionCategories as $key => $category)
                                            <li class="d-flex justify-content-between align-items-center pe-2 rounded-2 @if ($category->id == $catid) active @endif"><a href="{{route('assessment.details.category', ['uid' => $pnumber, 'cat_id' => $category->id ])}}" class="d-block category-link getsrchval" style="cursor: pointer;">{{ $key + 1 }}. {{ $category->name }}</a><span class="badge text-bg-warning">{{$category->no_count}}</span>
                                            </li>

                                            {{-- <li class="d-flex justify-content-between align-items-center pe-2 rounded-2 d-block category-link getsrchval" data-category="{{$category->id}}" style="cursor: pointer;">{{ $key + 1 }}. {{ $category->name }}<span class="badge text-bg-warning">{{$category->no_count}}</span>
                                            </li> --}}
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                </div>
            </div>
        </div>



</section>

<!-- Modal -->
<div class="modal fade black-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add next assesment date</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="ermsg"></div>


            <div class="row">

                <div class="col-lg-6">
                    <img src="{{ asset('risk.png')}}" class="img-responsive opacity-75" alt="" style="width: 370px;">
                </div>

                <div class="col-lg-6">
                    <div class="dropdown">
                        <label for="risk_rating_point">Risk rating number</label>
                        <input type="number" id="risk_rating_point" name="risk_rating_point" class="form-control">
                    </div>
        
                    <div class="dropdown">
                        <label for="comment">Comment</label>
                        <textarea name="comment" id="comment" class="form-control" cols="30" rows="3"></textarea>
                    </div>
            
                    <div class="dropdown">
                        <label for="date">Next Assesment Date</label>
                        <input type="date" class="form-control" id="date">
                    </div>
        
                </div>


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
    $("body").delegate(".addcomment","click",function () {
        var commenturl = "{{URL::to('/manager/managers-comment')}}";

        var assans_id = $(this).attr('assans_id');
        var user = $(this).attr('user');
        var solved = $(this).attr('solved');
        var comment = $("#comment"+assans_id).val();
        

        var form_data = new FormData();		
        form_data.append("assans_id", assans_id);
        form_data.append("user_id", user);
        form_data.append("comment", comment);
        form_data.append("solved", solved);

        $.ajax({
            url:commenturl,
            method: "POST",
            type: "POST",
            contentType: false,
            processData: false,
            data:form_data,
            success: function(d){
                // window.setTimeout(function(){location.reload()},2000)
                // console.log((d.min));
                     var newcmnt = $("#reply"+assans_id);
                     newcmnt.append('<div class="col-lg-4"></div><div class="col-lg-8 p-2 alert alert-secondary text-start mb-3 rounded-3 text-dark">'+comment+'<br><small>Date: '+d.date+'</small></div>'); 
                    $("#comment"+assans_id).val('');
                    if (solved == 1) {
                        $("#replycmnt"+assans_id).html('');
                        $("#replybtn"+assans_id).html('');
                    }
            },
            error:function(d){
                console.log(d);
            }
        });
    });
    // comment store 



    
</script>
    
@endsection