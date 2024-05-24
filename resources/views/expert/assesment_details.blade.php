@extends('layouts.master')
@section('content')
@php
    $chksts = \App\Models\DeterminigAnswer::where('program_number', $pnumber)->first();
@endphp

<style>
    input.custom-checkbox {
      width: 25px;
      height: 25px;
    }

    input.custom-checkbox {
        width: 25px;
        height: 25px;
        background-color: white;
        border-radius: 5%;
        vertical-align: middle;
        border: 1px solid #9c9999;
        appearance: none;
        -webkit-appearance: none;
        outline: none;
        cursor: pointer;
    }

    .custom-checkbox:checked {
        background-color: #193d5b;
    }

    #btn-back-to-top {
        position: fixed;
        bottom: 40px;
        right: 40px;
        display: none;
    }

  </style>

<section class="header-main py-5">
        <div class="container ">
            <div class="col-lg-10 mx-auto px-4">
                
                <div class="row">
                    <div class="col-lg-12 shadow  border p-4 rounded-0 bg-light pt-0">
                        <div class="row border-bottom border-dashed">
                            <div class="col-6 col-sm-6 col-lg-3">
                                <div class="brand">
                                    {{-- <img src="{{ asset('frontend/images/dselogo.PNG')}}" width="90px" alt=""> --}}
                                    
                                    <img src="{{ asset('nhs.png')}}" width="200px" alt="">
                                </div>
                            </div>
                            <div class="col-6 col-sm-6 col-lg-9 d-flex align-items-center justify-content-end">
                                <button class="btn btn-sm btn-success d-block float-end fs-5 d-flex align-items-center gap-2 mx-2 @if (empty($data)) d-none @endif" id="showWork"><iconify-icon icon="majesticons:eye" class=""></iconify-icon>Full Assesment</button>
                                
                                <button type="button" class="btn btn-secondary d-flex align-items-center m-2 transferbtn" uid="{{$data->user_id}}" data-id="{{$data->id}}" prgmnumber="{{$data->program_number}}"><iconify-icon class="text-primary" icon="bi:plus"></iconify-icon>  Transfer</button>

                                @if (isset($chksts))

                                @if ($chksts->line_manager_notification == 1)
                                {{-- <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-warning d-flex align-items-center m-2" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 4H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h3.188c1 0 1.812.811 1.812 1.812c0 .808.976 1.212 1.547.641l1.867-1.867A2 2 0 0 1 14.828 18H19a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2"/></svg> Change Status
                                </a> --}}
                                @endif
                                    
                                @endif
                                

                                <a href="{{route('manager.dashboard')}}" class="btn btn-sm btn-danger d-block float-end fs-5 d-flex align-items-center gap-2"> <iconify-icon icon="majesticons:door-exit" class=""></iconify-icon>
                                    Exit
                                </a>
                            </div>
                        </div>

                        <div class="ermsgod"></div>
                        
                        <div class="row @if (isset($data)) d-none @endif" id="workAssesmentDiv">
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


                                    {{-- <h2 class="text-success text-left ">Appendix 3</h2> --}}
                                    <h2 class="text-danger text-left ">Display screen equipment (DSE) workstation self-assessment</h2>
                                        <p>
                                            You are asked to complete the enclosed form to assess that you are using your computer and workstation in the ‘optimum’ way, so that you suffer no ill-effects from your work.  Read the ‘things to consider’ column and assess yourself against the photographs.  Try to adjust your position or items of equipment.  Once you have completed your form, contact your manager to discuss your assessment who will complete the right hand column on the form and make additional notes for further action if this is required on the DSE Risk Assessment action plan.
                                        </p>
                                        <p>
                                            DSE = 	visual display unit (VDU) / screen, stand & central processing unit (CPU) / box. <br>
                                            Workstation  = 	Dictaphone, telephone, table, chair, document holder, footstool, mouse.
                                        </p>
                                        <p><b>Date of Assesment: </b> {{ $assesment->date }}</p>
                                        <p><b>User Name: </b> {{ $user->name }}</p>
                                        <p><b>User Email: </b> {{ $user->email }}</p>
                                        <p><b>Work Station Number: </b> {{$data->work_station_number}}</p>
                                        <p><b>Department: </b> {{ $department->name }}</p>


                                    <div class="d-flex gap-3 flex-wrap justify-content-center">

                                        
                                        

                                        {{-- <div class="dropdown">
                                            <label for="date">Date</label>
                                            <input type="date" id="date" name="date" class="form-control" value="" readonly>
                                        </div>

                                        <div class="dropdown">
                                            <label for="user_name">User Name</label>
                                            <input type="text" id="user_name" name="user_name" class="form-control" value="{{ $user->name }}" readonly>
                                        </div>

                                        <div class="dropdown">
                                            <label for="user_name">Email</label>
                                            <input type="text" id="user_name" name="user_name" class="form-control" value="{{ $user->email }}" readonly>
                                        </div>

                                        <div class="dropdown">
                                            <label for="work_station_number">Work Station Number</label>
                                            <input type="number" id="work_station_number" name="work_station_number" class="form-control" value="@if(isset($data)){{$data->work_station_number}}@endif" readonly>
                                        </div>

                                        <div class="dropdown">
                                            <label for="department">Department</label><br>
                                            <input type="text" id="department" name="department" class="form-control" value="{{ $department->name }}" readonly>
                                        </div> --}}

                                    </div>

                                    
                                    <div class="row mt-3">
                                        <div class="col-lg-12">
                                            <p for="">Are you Full time <input type="radio" class="form-check-input" name="job_type" value="Full time" @if(isset($data)) @if ($data->job_type == "Full time") checked @endif @endif> or Part time <input type="radio" id="part_time" class="form-check-input" name="job_type" value="Part time" @if(isset($data)) @if ($data->job_type == "Part time") checked @endif @endif> ? 
                                            </p>
                                        </div>
                                
                                        <div class="col-lg-6 mb-4" id="part_time_work_div" @if (isset($data)) @if ($data->job_type == "Part time") @else
                                            style="display:none" @endif
                                            @endif>
                                            <h6 class="mb-3">If part time how many hours a week do you work? </h6>
                                            <input id="part_time_work_hour" type="number" name="part_time_work_hour" class="form-control me-1"
                                                value="@if(isset($data)){{$data->part_time_work_hour}}@endif">
                                        </div>
                                
                                
                                        <div class="col-lg-12 mb-4">
                                            <h6 class="mb-3">Do you normally use your DSE for continuous spells of an hour or more at a time?
                                            </h6>
                                            <label class="mx-2">
                                                <input type="radio" name="continuous_spell" class="form-check-input me-1" value="Yes" @if(isset($data)) @if ($data->continuous_spell == "Yes") checked @endif @endif>Yes
                                            </label>
                                            <label class="mx-2">
                                                <input type="radio" name="continuous_spell" class="form-check-input me-1" value="No" @if(isset($data)) @if ($data->continuous_spell == "No") checked @endif @endif>No
                                            </label>
                                        </div>
                                
                                        <div class="col-lg-12 mb-4">
                                            <h6 class="mb-3">If ‘Yes’ do you do this more or less daily ?     
                                            </h6>
                                            <label class="mx-2">
                                                <input type="radio" name="continuous_spell_time" class="form-check-input me-1" value="Yes"@if(isset($data)) @if ($data->continuous_spell_time == "Yes") checked @endif @endif>Yes
                                            </label>
                                            <label class="mx-2">
                                                <input type="radio" name="continuous_spell_time" class="form-check-input me-1" value="No" @if(isset($data)) @if ($data->continuous_spell_time == "No") checked @endif @endif>No
                                            </label>
                                        </div>
                                
                                        <div class="col-lg-6 mb-4">
                                            <h6 class="mb-3">How many hours on average daily do you spend using your DSE? </h6>
                                            <input id="average_using_dse" type="number" name="average_using_dse" class="form-control me-1"
                                                value="@if(isset($data)){{$data->average_using_dse}}@endif">
                                        </div>
                                
                                        <div class="col-lg-12 mb-4">
                                            <h6 class="mb-3">What Software do you use? </h6>
                                            <label class="mx-2">
                                                <input id="ms_word" type="checkbox" name="software[]" class="form-check-input me-1" value="Word" @if (isset($data->software)) @foreach (json_decode($data->software) as $software) @if ($software == "Word") checked @endif @endforeach @endif>Word
                                            </label>
                                            <label class="mx-2">
                                                <input id="ms_excel" type="checkbox" name="software[]" class="form-check-input me-1" value="Excel" @if (isset($data->software)) @foreach (json_decode($data->software) as $software) @if ($software == "Excel") checked @endif @endforeach @endif>Excel
                                            </label>
                                            <label for="ms_access" class="mx-2">
                                                <input id="ms_access" type="checkbox" name="software[]" class="form-check-input me-1" value="Access" @if (isset($data->software)) @foreach (json_decode($data->software) as $software) @if ($software == "Access") checked @endif @endforeach @endif>Access
                                            </label>
                                            <label for="ms_powerpoint" class="mx-2">
                                                <input id="ms_powerpoint" type="checkbox" name="software[]" class="form-check-input me-1" value="Powerpoint" @if (isset($data->software)) @foreach (json_decode($data->software) as $software) @if ($software == "Powerpoint") checked @endif @endforeach @endif>Powerpoint
                                            </label>
                                            <label for="others" class="mx-2">
                                                <input id="others" type="checkbox" name="software[]" class="form-check-input me-1" value="Others" @if (isset($data->software)) @foreach (json_decode($data->software) as $software) @if ($software == "Others") checked @endif @endforeach @endif>Others
                                            </label>
                                            <label class="">
                                                <input id="others_software" type="text" name="others_software" class="form-control" placeholder="Somerset, EPT, ERS, Cerner" value="@if(isset($data)){{$data->others_software}}@endif">
                                            </label>
                                        </div>
                                
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-none" id="QnAnsDiv">
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
                                @if ($comment->created_by == "User")
                                    
                                    <div class="row">
                                        <div class="col-lg-8 p-2 alert alert-secondary text-start mb-3 rounded-3 text-dark"> <b>{{$comment->created_by}}: </b> {{$comment->comment}}
                                            <br>
                                            <small>Date: {{$comment->date}}</small>
                                        </div>
                                        <div class="col-lg-4"></div>
                                    </div>

                                @else

                                    <div class="row">
                                        <div class="col-lg-4"></div>
                                        <div class="col-lg-8 p-2 alert alert-secondary mb-3 rounded-3 text-dark text-right"> <b>{{$comment->created_by}} ({{$comment->name}}): </b>{{$comment->comment}}
                                            <br>
                                        <small>Date: {{$comment->date}}</small>
                                        </div>
                                    </div>
                                    
                                @endif
                            @endforeach

                            <div class="row" id="reply{{$assanswer->id}}"> </div>
                            @if ($assanswer->solved == 0)
                            
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                <div class="col-lg-12" id="replycmnt{{$assanswer->id}}">
                                    <input type="text" name="health_name" id="health_name{{$assanswer->id}}"  placeholder="Name Here" class="form-control mb-1">
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
                                @if ($comment->created_by == "User")

                                
                                        <div class="row">
                                            <div class="col-lg-8 p-2 alert alert-secondary text-start mb-3 rounded-3 text-dark"><b>{{$comment->created_by}} ({{$comment->name}}): </b>{{$comment->comment}}
                                                <br>
                                                <small>Date: {{$comment->date}}</small>
                                            </div>
                                            <div class="col-lg-4"></div>
                                        </div>
                                @else
                                    
                                    <div class="row">
                                        <div class="col-lg-4"></div>
                                        <div class="col-lg-8 p-2 alert alert-secondary mb-3 rounded-3 text-dark text-right"><b>{{$comment->created_by}} ({{$comment->name}}): </b>{{$comment->comment}}
                                            <br>
                                        <small>Date: {{$comment->date}}</small>
                                        </div>
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
                                    <li class="d-flex justify-content-between align-items-center pe-2 rounded-2 @if ($category->id == $catid) active @endif"><a href="{{route('health.assessment.details.category', ['uid' => $pnumber, 'cat_id' => $category->id ])}}" class="d-block category-link getsrchval" style="cursor: pointer;">{{ $key + 1 }}. {{ $category->name }}</a><span class="badge text-bg-warning">{{$category->no_count}}</span>
                                    </li>

                                    {{-- <li class="d-flex justify-content-between align-items-center pe-2 rounded-2 d-block category-link getsrchval" data-category="{{$category->id}}" style="cursor: pointer;">{{ $key + 1 }}. {{ $category->name }}<span class="badge text-bg-warning">{{$category->no_count}}</span>
                                    </li> --}}
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>

                

                <h4>Tick to confirm location & type of health problem's experienced</h4>

                <div class="row mt-2">
                    <div class="col-lg-12 shadow-sm border rounded-0 bg-light ">
                        <div class="row pt-5 px-4">
                            <div class="col-lg-12 mb-4">
                                
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>(Tick if present)</th>
                                            <th style="text-align: center">None</th>
                                            <th style="text-align: center">Ache</th>
                                            <th style="text-align: center">Pain</th>
                                            <th style="text-align: center">Pins and needles</th>
                                            <th style="text-align: center">Numbness</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        <tr>
                                            <td style="text-align: left">Low back</td>
                                            <td style="text-align: center"> <input type="checkbox" name="lowback[]" class="custom-checkbox lowbackItem" value="None" id="lowbackNone" 
                                                @if (isset($healthans)) 
                                                        @foreach ($healthans as $lowback) @if ($lowback->result == "None" && $lowback->catname == "lowback") checked @endif @endforeach
                                                @endif>
                                            </td>
                                            <td style="text-align: center"> <input type="checkbox" name="lowback[]" class="custom-checkbox lowbackItem" value="Ache" 
                                                @if (isset($healthans)) 
                                                        @foreach ($healthans as $lowback) @if ($lowback->result == "Ache" && $lowback->catname == "lowback") checked @endif @endforeach
                                                @endif >
                                            </td>


                                            <td style="text-align: center"> <input type="checkbox" name="lowback[]" class="custom-checkbox lowbackItem" value="Pain" 
                                                @if (isset($healthans)) 
                                                    @foreach ($healthans as $lowback) @if ($lowback->result == "Pain" && $lowback->catname == "lowback") checked @endif @endforeach
                                                @endif >
                                            </td>

                                            <td style="text-align: center"> <input type="checkbox" name="lowback[]" class="custom-checkbox lowbackItem" value="Pins and needles" 
                                                @if (isset($healthans)) 
                                                    @foreach ($healthans as $lowback) @if ($lowback->result == "Pins and needles" && $lowback->catname == "lowback") checked @endif @endforeach
                                                @endif >
                                            </td>

                                            <td style="text-align: center"> <input type="checkbox" name="lowback[]" class="custom-checkbox lowbackItem" value="Numbness" 
                                                @if (isset($healthans)) 
                                                    @foreach ($healthans as $lowback) @if ($lowback->result == "Numbness" && $lowback->catname == "lowback") checked @endif @endforeach
                                                @endif >
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="text-align: left">Upper back</td>
                                            <td style="text-align: center"> <input type="checkbox" name="upperback[]" value="None" class="custom-checkbox upperbackItem" id="upperbackNone"   
                                                @if (isset($healthans)) 
                                                    @foreach ($healthans as $upperback) @if ($upperback->result == "None" && $upperback->catname == "upperback") checked @endif @endforeach
                                                @endif >
                                            </td>

                                            <td style="text-align: center"> <input type="checkbox" name="upperback[]" class="custom-checkbox upperbackItem" value="Ache" 
                                                @if (isset($healthans)) 
                                                    @foreach ($healthans as $upperback) @if ($upperback->result == "Ache" && $upperback->catname == "upperback") checked @endif @endforeach
                                                @endif >
                                            </td>

                                            <td style="text-align: center"> <input type="checkbox" name="upperback[]"class="custom-checkbox upperbackItem" value="Pain" 
                                                @if (isset($healthans)) 
                                                    @foreach ($healthans as $upperback) @if ($upperback->result == "Pain" && $upperback->catname == "upperback") checked @endif @endforeach
                                                @endif >
                                            </td>

                                            <td style="text-align: center"> <input type="checkbox" name="upperback[]"  class="custom-checkbox upperbackItem" value="Pins and needles" 
                                                @if (isset($healthans)) 
                                                    @foreach ($healthans as $upperback) @if ($upperback->result == "Pins and needles" && $upperback->catname == "upperback") checked @endif @endforeach
                                                @endif>
                                            </td>

                                            <td style="text-align: center"> <input type="checkbox" name="upperback[]"  class="custom-checkbox upperbackItem" value="Numbness" 
                                                @if (isset($healthans)) 
                                                    @foreach ($healthans as $upperback) @if ($upperback->result == "Numbness" && $upperback->catname == "upperback") checked @endif @endforeach
                                                @endif>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td style="text-align: left">Neck</td>
                                            <td style="text-align: center"> <input type="checkbox" name="neck[]" class="custom-checkbox neckItem"  value="None" id="neckNone"  
                                                @if (isset($healthans)) 
                                                    @foreach ($healthans as $neck) @if ($neck->result == "None" && $neck->catname == "neck") checked @endif @endforeach
                                                @endif >
                                            </td>
                                            <td style="text-align: center"> <input type="checkbox" name="neck[]" class="custom-checkbox neckItem"  value="Ache"  
                                                @if (isset($healthans)) 
                                                    @foreach ($healthans as $neck) @if ($neck->result == "Ache" && $neck->catname == "neck") checked @endif @endforeach
                                                @endif>
                                            </td>
                                            <td style="text-align: center"> <input type="checkbox" name="neck[]" class="custom-checkbox neckItem"  value="Pain"  
                                                @if (isset($healthans)) 
                                                    @foreach ($healthans as $neck) @if ($neck->result == "Pain" && $neck->catname == "neck") checked @endif @endforeach
                                                @endif>
                                            </td>
                                            <td style="text-align: center"> <input type="checkbox" name="neck[]"  value="Pins and needles" class="custom-checkbox neckItem"  
                                                @if (isset($healthans)) 
                                                    @foreach ($healthans as $neck) @if ($neck->result == "Pins and needles" && $neck->catname == "neck") checked @endif @endforeach
                                                @endif >
                                            </td>

                                            <td style="text-align: center"> <input type="checkbox" name="neck[]" value="Numbness" class="custom-checkbox neckItem" 
                                                @if (isset($healthans)) 
                                                    @foreach ($healthans as $neck) @if ($neck->result == "Numbness" && $neck->catname == "neck") checked @endif @endforeach
                                                @endif >
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td style="text-align: left">Shoulders</td>
                                            <td style="text-align: center"> <input type="checkbox" name="shoulders[]" class="custom-checkbox shouldersItem" id="shouldersNone" value="None"  
                                                @if (isset($healthans)) 
                                                    @foreach ($healthans as $shoulders) @if ($shoulders->result == "None" && $shoulders->catname == "shoulders") checked @endif @endforeach
                                                @endif >
                                            </td>
                                            <td style="text-align: center"> <input type="checkbox" name="shoulders[]" class="custom-checkbox shouldersItem" value="Ache"  
                                                @if (isset($healthans)) 
                                                    @foreach ($healthans as $shoulders) @if ($shoulders->result == "Ache" && $shoulders->catname == "shoulders") checked @endif @endforeach
                                                @endif>
                                            </td>
                                            <td style="text-align: center"> <input type="checkbox" name="shoulders[]" value="Pain" class="custom-checkbox shouldersItem"  
                                                @if (isset($healthans)) 
                                                    @foreach ($healthans as $shoulders) @if ($shoulders->result == "Ache" && $shoulders->catname == "shoulders") checked @endif @endforeach
                                                @endif >
                                            </td>
                                            <td style="text-align: center"> <input type="checkbox" name="shoulders[]" value="Pins and needles" class="custom-checkbox shouldersItem"  
                                                @if (isset($healthans)) 
                                                    @foreach ($healthans as $shoulders) @if ($shoulders->result == "Pins and needles" && $shoulders->catname == "shoulders") checked @endif @endforeach
                                                @endif >
                                            </td>
                                            <td style="text-align: center"> <input type="checkbox" name="shoulders[]" value="Numbness" class="custom-checkbox shouldersItem" 
                                                @if (isset($healthans)) 
                                                    @foreach ($healthans as $shoulders) @if ($shoulders->result == "Numbness" && $shoulders->catname == "shoulders") checked @endif @endforeach
                                                @endif >
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="text-align: left">Arms</td>
                                            <td style="text-align: center"> <input type="checkbox" name="arms[]" class="custom-checkbox armsItem" value="None" id="armsNone"
                                                @if (isset($healthans)) 
                                                    @foreach ($healthans as $arms) @if ($arms->result == "None" && $arms->catname == "arms") checked @endif @endforeach
                                                @endif >
                                            </td>
                                            <td style="text-align: center"> <input type="checkbox" name="arms[]"  value="Ache" class="custom-checkbox armsItem" 
                                                @if (isset($healthans)) 
                                                    @foreach ($healthans as $arms) @if ($arms->result == "Ache" && $arms->catname == "arms") checked @endif @endforeach
                                                @endif >
                                            </td>
                                            <td style="text-align: center"> <input type="checkbox" name="arms[]" value="Pain" class="custom-checkbox armsItem"   
                                                @if (isset($healthans)) 
                                                    @foreach ($healthans as $arms) @if ($arms->result == "Pain" && $arms->catname == "arms") checked @endif @endforeach
                                                @endif   >
                                            </td>

                                            <td style="text-align: center"> <input type="checkbox" name="arms[]" class="custom-checkbox armsItem" value="Pins and needles"  
                                                @if (isset($healthans)) 
                                                    @foreach ($healthans as $arms) @if ($arms->result == "Pins and needles" && $arms->catname == "arms") checked @endif @endforeach
                                                @endif >
                                            </td>

                                            <td style="text-align: center"> <input type="checkbox" name="arms[]" value="Numbness" class="custom-checkbox armsItem"  
                                                @if (isset($healthans)) 
                                                    @foreach ($healthans as $arms) @if ($arms->result == "Numbness" && $arms->catname == "arms") checked @endif @endforeach
                                                @endif  >
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="text-align: left">Hand/fingers</td>
                                            <td style="text-align: center"> <input type="checkbox" name="hand_fingers[]" class="custom-checkbox hand_fingersItem"  value="None" id="hand_fingersNone"  
                                                @if (isset($healthans)) 
                                                    @foreach ($healthans as $hand_fingers) @if ($hand_fingers->result == "None" && $hand_fingers->catname == "hand_fingers") checked @endif @endforeach
                                                @endif >
                                            </td>


                                            <td style="text-align: center"> <input type="checkbox" name="hand_fingers[]" class="custom-checkbox hand_fingersItem" value="Ache"  
                                                @if (isset($healthans)) 
                                                    @foreach ($healthans as $hand_fingers) @if ($hand_fingers->result == "Ache" && $hand_fingers->catname == "hand_fingers") checked @endif @endforeach
                                                @endif >
                                            </td>


                                            <td style="text-align: center"> <input type="checkbox" name="hand_fingers[]"  value="Pain" class="custom-checkbox hand_fingersItem"  
                                                @if (isset($healthans)) 
                                                    @foreach ($healthans as $hand_fingers) @if ($hand_fingers->result == "Pain" && $hand_fingers->catname == "hand_fingers") checked @endif @endforeach
                                                @endif>
                                            </td>


                                            <td style="text-align: center"> <input type="checkbox" name="hand_fingers[]" class="custom-checkbox hand_fingersItem" value="Pins and needles"  
                                                @if (isset($healthans)) 
                                                    @foreach ($healthans as $hand_fingers) @if ($hand_fingers->result == "Pins and needles" && $hand_fingers->catname == "hand_fingers") checked @endif @endforeach
                                                @endif>
                                            </td>


                                            <td style="text-align: center"> <input type="checkbox" name="hand_fingers[]" value="Numbness" class="custom-checkbox hand_fingersItem" 
                                                @if (isset($healthans)) 
                                                    @foreach ($healthans as $hand_fingers) @if ($hand_fingers->result == "Numbness" && $hand_fingers->catname == "hand_fingers") checked @endif @endforeach
                                                @endif >
                                            </td>

                                        </tr>

                                        {{-- manager and health comment  --}}
                                        @if (isset($chkboxitemNone) && $chkboxitemNone > 0)
                                        <tr>
                                            <td style="text-align: left" colspan="6">
                                                @if (isset($otheranscmmnts))
                                                <div class="row"> 
                                                    @foreach ($otheranscmmnts as $heathcmt)
                                                    @if ($heathcmt->catname == "checkitem")
                                                    <div class="col-lg-4"></div>
                                                    <div class="col-lg-8 p-2 alert alert-secondary text-start rounded-3 text-dark">
                                                        <b> {{$heathcmt->created_by}}: </b>{{$heathcmt->comment}} <br>
                                                        
                                                        <small><b>Name</b>: {{$heathcmt->name}}</small><br>
                                                        <small><b>Date</b>: {{$heathcmt->date}}</small>
                                                    </div>  
                                                    @endif
                                                    @endforeach
                                                    
                                                </div>
                                                @endif
                                                
                                                <div id="replycheckitem"></div>
                                                <div class="cmntermsgcheckitem"></div>

                                                <div class="col-lg-12" id="replycmnt">
                                                    <input type="text" name="health_namecheckitem" id="health_namecheckitem"  placeholder="Name Here" class="form-control mb-1">
                                                    <textarea id="commentcheckitem" class="form-control" placeholder="Comments Here"></textarea>
                                                </div>
                                                <div class="col-lg-12" id="replybtn">
                                                    <div class="row py-3 ">
                                                        <div class="col-lg-5 d-flex align-items-center">
                                                            <button type="button" class="btn btn-warning d-flex align-items-center addOpmsComment" catname="checkitem" solved="1" prgmnumber="{{$data->program_number}}"> <iconify-icon icon="akar-icons:check-box-fill" class="me-1"></iconify-icon> Send
                                                            </button>
                                                        </div>
                                                        <div class="col-lg-7 d-flex gap-3 justify-content-end">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                        {{-- manager and health comment end --}}

                                        
                                        
                                        
                                        <tr>
                                            <td style="text-align: left" colspan="6">
                                                <h6 class="mb-3">Do you do any stretching exercises during the day to prevent muscular tension? </h6>
                                                <label class="mx-2">
                                                    <input type="radio" name="exercise" class="form-check-input me-1" value="Yes" 
                                                    @if (isset($healthans)) 
                                                        @foreach ($healthans as $exercise) @if ($exercise->result == "Yes" && $exercise->catname == "exercise") checked @endif @endforeach
                                                    @endif required>Yes
                                                </label>
                                                <label class="mx-2">
                                                    <input type="radio"  name="exercise" class="form-check-input me-1" value="No" 
                                                    @if (isset($healthans)) 
                                                        @foreach ($healthans as $exercise) @if ($exercise->result == "No" && $exercise->catname == "exercise") checked @endif @endforeach
                                                    @endif required>No
                                                </label>
                                            </td>
                                        </tr>

                                        {{-- cmmnt start  --}}
                                        {{-- manager and health comment  --}}
                                        @if (isset($exerciseAns) && $exerciseAns > 0)
                                            
                                        <tr>
                                            <td style="text-align: left" colspan="6">
                                                @if (isset($otheranscmmnts))
                                                <div class="row"> 
                                                    @foreach ($otheranscmmnts as $heathcmt)
                                                    @if ($heathcmt->catname == "exercise")
                                                    <div class="col-lg-4"></div>
                                                    <div class="col-lg-8 p-2 alert alert-secondary text-start rounded-3 text-dark">
                                                        <b> {{$heathcmt->created_by}}: </b>{{$heathcmt->comment}} <br>
                                                        
                                                        <small><b>Name</b>: {{$heathcmt->name}}</small><br>
                                                        <small><b>Date</b>: {{$heathcmt->date}}</small>
                                                    </div>  
                                                    @endif
                                                    @endforeach
                                                    
                                                </div>
                                                @endif
                                                
                                                <div id="replyexercise"></div>
                                                
                                                <div class="cmntermsgexercise"></div>
                                                <div class="col-lg-12" id="replycmnt">
                                                    <textarea id="commentexercise" class="form-control" placeholder="Comments Here"></textarea>
                                                </div>
                                                <div class="col-lg-12" id="replybtn">
                                                    <div class="row py-3 ">
                                                        <div class="col-lg-5 d-flex align-items-center">
                                                            <button type="button" class="btn btn-warning d-flex align-items-center addOpmsComment" catname="exercise" opmsname="question" solved="0" prgmnumber="{{$data->program_number}}"> <iconify-icon icon="akar-icons:check-box-fill" class="me-1"></iconify-icon> send
                                                            </button>
                                                        </div>
                                                        <div class="col-lg-7 d-flex gap-3 justify-content-end">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                        {{-- cmmnt end  --}}

                                        <tr>
                                            <td style="text-align: left" colspan="6">
                                                <h6 class="mb-3"> Would you like to be taught some exercises? </h6>
                                                <label  class="mx-2">
                                                    <input type="radio" name="taught_exercise" class="form-check-input me-1" value="Yes"
                                                    @if (isset($healthans)) 
                                                        @foreach ($healthans as $taught_exercise) @if ($taught_exercise->result == "Yes" && $taught_exercise->catname == "taught_exercise") checked @endif @endforeach
                                                    @endif required>Yes
                                                </label>
                                                <label class="mx-2">
                                                    <input  type="radio"  name="taught_exercise" class="form-check-input me-1" value="No" 
                                                    @if (isset($healthans)) 
                                                        @foreach ($healthans as $taught_exercise) @if ($taught_exercise->result == "No" && $taught_exercise->catname == "taught_exercise") checked @endif @endforeach
                                                    @endif  required> No
                                                </label>
                                            </td>
                                        </tr>

                                        {{-- cmmnt start  --}}
                                        {{-- manager and health comment  --}}
                                        @if (isset($texerciseAns) && $texerciseAns > 0)
                                            
                                        <tr>
                                            <td style="text-align: left" colspan="6">
                                                @if (isset($otheranscmmnts))
                                                <div class="row"> 
                                                    @foreach ($otheranscmmnts as $heathcmt)
                                                    @if ($heathcmt->catname == "taught_exercise")
                                                    <div class="col-lg-4"></div>
                                                    <div class="col-lg-8 p-2 alert alert-secondary text-start rounded-3 text-dark">
                                                        <b> {{$heathcmt->created_by}}: </b>{{$heathcmt->comment}} <br>
                                                        <small><b>Date</b>: {{$heathcmt->date}}</small>
                                                    </div>  
                                                    @endif
                                                    @endforeach
                                                    
                                                </div>
                                                @endif
                                                
                                                <div id="replytaught_exercise"></div>
                                                
                                                <div class="cmntermsgtaught_exercise"></div>
                                                <div class="col-lg-12" id="replycmnt">
                                                    <textarea id="commenttaught_exercise" class="form-control" placeholder="Comments Here"></textarea>
                                                </div>
                                                <div class="col-lg-12" id="replybtn">
                                                    <div class="row py-3 ">
                                                        <div class="col-lg-5 d-flex align-items-center">
                                                            <button type="button" class="btn btn-warning d-flex align-items-center addOpmsComment" catname="taught_exercise" opmsname="question" solved="0" prgmnumber="{{$data->program_number}}"> <iconify-icon icon="akar-icons:check-box-fill" class="me-1"></iconify-icon> send
                                                            </button>
                                                        </div>
                                                        <div class="col-lg-7 d-flex gap-3 justify-content-end">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                        {{-- cmmnt end  --}}


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- additional assesment add  --}}



                {{-- additional assesment add  --}}
                
                <div class="row mt-2">
                    <div class="col-lg-12 shadow-sm border rounded-0 bg-light ">
                        <div class="row pt-5 px-4">
                            <div class="col-lg-12 mb-4">
                                <h6 class="mb-3">Do you have any other concern or comments ?
                                </h6>
                                <label for="otherqnyes" class="mx-2">
                                    <input id="otherqnyes" type="radio" name="otherqn" class="form-check-input me-1" value="Yes" 
                                        @if (isset($healthans)) 
                                            @foreach ($healthans as $otherqn) @if ($otherqn->result == "Yes" && $otherqn->catname == "otherqn") checked @endif @endforeach
                                        @endif > Yes
                                </label>
                                <label for="otherqnno" class="mx-2">
                                    <input id="otherqnno" type="radio"  name="otherqn" class="form-check-input me-1" value="No"
                                    @if (isset($healthans)) 
                                            @foreach ($healthans as $otherqn) @if ($otherqn->result == "No" && $otherqn->catname == "otherqn") checked @endif @endforeach
                                        @endif >No
                                </label>

                            </div>

                            

                            <div id="additionalqn" @if (isset($healthans)) @foreach ($healthans as $otherqn) @if ($otherqn->result == "No" && $otherqn->catname == "otherqn") style="display:none" @endif @endforeach @endif>
                                <div class="col-lg-12 mb-4">
                                    @if (isset($healthans)) 
                                            
                                    
                                        <h6 class="mb-3">@foreach ($healthans as $newqn) @if ($newqn->result == "Yes" && $newqn->catname == "newqn") Question: {{$newqn->newquestion}} @endif @endforeach</h6>


                                        {{-- manager and health comment  --}}
                                        @if (isset($otherqnAns) && $otherqnAns > 0)
                                            
                                        <tr>
                                            <td style="text-align: left" colspan="6">
                                                @if (isset($otheranscmmnts))
                                                <div class="row"> 
                                                    @foreach ($otheranscmmnts as $heathcmt)
                                                    @if ($heathcmt->catname == "newqn")
                                                    <div class="col-lg-4"></div>
                                                    <div class="col-lg-8 p-2 alert alert-secondary text-start rounded-3 text-dark">
                                                        <b> {{$heathcmt->created_by}}: </b>{{$heathcmt->comment}} <br>
                                                        <small><b>Date</b>: {{$heathcmt->date}}</small>
                                                    </div>  
                                                    @endif
                                                    @endforeach
                                                    
                                                </div>
                                                @endif
                                                
                                                <div id="replynewqn"></div>
                                                
                                                <div class="cmntermsgnewqn"></div>
                                                <div class="col-lg-12" id="replycmnt">
                                                    <textarea id="commentnewqn" class="form-control" placeholder="Comments Here"></textarea>
                                                </div>
                                                <div class="col-lg-12" id="replybtn">
                                                    <div class="row py-3 ">
                                                        <div class="col-lg-5 d-flex align-items-center">
                                                            <button type="button" class="btn btn-warning d-flex align-items-center addOpmsComment" catname="newqn" opmsname="question" solved="0" prgmnumber="{{$data->program_number}}"> <iconify-icon icon="akar-icons:check-box-fill" class="me-1"></iconify-icon> send
                                                            </button>
                                                        </div>
                                                        <div class="col-lg-7 d-flex gap-3 justify-content-end">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                        {{-- cmmnt end  --}}

                                        
                                    @endif
                                    
                                </div>
                              </div>

                              
                        </div>
                    </div>
                </div>

            </div>
        </div>



</section>

<!--Transfer  Modal -->
<!-- Modal -->
<!--Transfer Modal -->
<!-- Modal -->
<div class="modal fade black-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Title will be there</h1>
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
                        <label for="next_date">Next Assesment Date</label>
                        <input type="date" class="form-control" id="next_date">
                    </div>
        
                </div>


            </div>

            <input type="hidden" name="user_id" id="user_id" value="{{$data->user_id}}">
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary schedule" id="addriskpoint" uid="{{$data->user_id}}" data-id="{{$data->id}}" prgmnumber={{$data->program_number}}>Save</button>
        </div>
    </div>
    </div>
</div>





<!-- Back to top button -->
<button type="button" class="btn btn-success btn-floating btn-lg" id="btn-back-to-top">
    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M3 19h18a1.002 1.002 0 0 0 .823-1.569l-9-13c-.373-.539-1.271-.539-1.645 0l-9 13A.999.999 0 0 0 3 19"/></svg>
</button>
@endsection

@section('script')

<script>
    //Get the button
    let mybutton = document.getElementById("btn-back-to-top");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function () {
    scrollFunction();
    };

    function scrollFunction() {
    if (
        document.body.scrollTop > 20 ||
        document.documentElement.scrollTop > 20
    ) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
    }
    // When the user clicks on the button, scroll to the top of the document
    mybutton.addEventListener("click", backToTop);

    function backToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
    }
</script>

<script>

     // header for csrf-token is must in laravel
     $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        // 

        
        // comment store 
    $("body").delegate(".addcomment","click",function () {
        var commenturl = "{{URL::to('/expert/occhealth-comment')}}";

        var assans_id = $(this).attr('assans_id');
        var user = $(this).attr('user');
        var solved = $(this).attr('solved');
        var comment = $("#comment"+assans_id).val();
        var name = $("#health_name"+assans_id).val();
        
        console.log(assans_id,  user, solved, comment, name);

        var form_data = new FormData();		
        form_data.append("assans_id", assans_id);
        form_data.append("user_id", user);
        form_data.append("comment", comment);
        form_data.append("solved", solved);
        form_data.append("name", name);

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


    $("body").delegate(".addOpmsComment","click",function () {
        var opmsurl = "{{URL::to('/expert/health-suggestion')}}";

        var catname = $(this).attr('catname');
        var user = $("#user_id").val();
        var solved = $(this).attr('solved');
        var codeid = $(this).attr('codeid');
        var prgmnumber = $(this).attr('prgmnumber');
        var comment = $("#comment"+catname).val();
        var name = $("#health_name"+catname).val();
        
        console.log(catname, user, solved, comment, prgmnumber);


        var form_data = new FormData();		
        form_data.append("catname", catname);
        form_data.append("user_id", user);
        form_data.append("comment", comment);
        form_data.append("solved", solved);
        form_data.append("prgmnumber", prgmnumber);
        form_data.append("name", name);
        form_data.append("codeid", codeid);

        $.ajax({
            url:opmsurl,
            method: "POST",
            type: "POST",
            contentType: false,
            processData: false,
            data:form_data,
            success: function(d){

                if (d.status == 303) {
                    $(".cmntermsg"+catname).html(d.message);
                }else if(d.status == 300){
                    var newcmnt = $("#reply"+catname);
                    newcmnt.append('<div class="col-lg-4"></div><div class="col-lg-8 p-2 alert alert-secondary text-start mb-3 rounded-3 text-dark">'+comment+'<br><small>Date: '+d.date+'</small></div>'); 
                    $("#comment"+catname).val('');
                    if (solved == 1) {
                        $("#replycmnt"+catname).html('');
                        $("#replybtn"+catname).html('');
                    }
                    window.setTimeout(function(){location.reload()},2000)
                }
            },
            error:function(d){
                console.log(d);
            }
        });
    });



    // comment store 



       // comment store 
    $("body").delegate("#addriskpoint","click",function () {
    
        var status = $("#status").val();

        var commenturl = "{{URL::to('/expert/add-rating')}}";
        

        var prgmnumber = $(this).attr('prgmnumber');
        var user = $(this).attr('uid');
        var comment = $("#comment").val();
        var date = $("#next_date").val();
        var risk_rating_point = $("#risk_rating_point").val();
        console.log(user, comment, prgmnumber);

        var form_data = new FormData();		
        form_data.append("prgmnumber", prgmnumber);
        form_data.append("user_id", user);
        form_data.append("comment", comment);
        form_data.append("date", date);
        form_data.append("risk_rating_point", risk_rating_point);

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

    var expurl = "{{URL::to('/expert/transfer-to-manager')}}";
    var redurl = "{{URL::to('/expert/dashboard')}}";

    $(".transferbtn").click(function(){

            var determiningAnswerId = $(this).attr("data-id");
            var uid = $(this).attr("uid");
            var prgm = $(this).attr("prgmnumber");
            
            console.log(determiningAnswerId, uid, prgm);

            $.ajax({
                url: expurl,
                method: "POST",
                data: {determiningAnswerId:determiningAnswerId,uid:uid,prgm:prgm},
                success: function (d) {
                    console.log(d);
                    if (d.status == 303) {
                        $(".ermsgod").html(d.message);
                    }else if(d.status == 300){
                        $(".ermsgod").html(d.message);
                        window.setTimeout(function(){window.location.href = redurl},2000)
                    }
                },
                error: function (d) {
                    console.log(d);
                }
            });

    });

    $("#showWork").click(function() {

        $("#workAssesmentDiv").removeClass("d-none");
        $("#QnAnsDiv").removeClass("d-none");
        $('#showWork').addClass("d-none");

    });
    
</script>
    
@endsection