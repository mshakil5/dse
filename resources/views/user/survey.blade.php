@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
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

    #saveNExit {
        position: fixed;
        bottom: 80px;
        right: 240px;
        display: none;
    }

    .fixed-action-btn.spin-close .btn-large {
        position: relative;
    }
    .fixed-action-btn.spin-close .btn-large i {
        opacity: 1;
        transition: transform 0.3s, opacity 0.3s;
    }
    .fixed-action-btn.spin-close .btn-large:before {
        transition: transform 0.3s, opacity 0.3s;
        content: " ";
        position: absolute;
        top: 50%;
        left: 50%;
        width: 1.64rem;
        height: 2px;
        background: white;
        margin-top: -2px;
        margin-left: -0.82rem;
        transform: rotate(0);
        opacity: 0;
    }
    .fixed-action-btn.spin-close .btn-large:after {
        transition: transform 0.3s, opacity 0.3s;
        content: " ";
        position: absolute;
        top: 50%;
        left: 50%;
        width: 1.64rem;
        height: 2px;
        background: white;
        margin-top: -2px;
        margin-left: -0.82rem;
        transform: rotate(0);
        opacity: 0;
    }
    .fixed-action-btn.spin-close.active .btn-large i {
        opacity: 0;
    }
    .fixed-action-btn.spin-close.active .btn-large:before {
        opacity: 1;
        transform: rotate(135deg);
    }
    .fixed-action-btn.spin-close.active .btn-large:after {
        opacity: 1;
        transform: rotate(405deg);
    }

  </style>





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
                            <button class="btn btn-sm btn-success d-block float-end fs-5 d-flex align-items-center gap-2 mx-2 @if (empty($data)) d-none @endif" id="showWork"><iconify-icon icon="majesticons:eye" class=""></iconify-icon></button>
                            <button id="saveBtn2" class="btn btn-sm btn-warning d-block float-end fs-5 d-flex align-items-center gap-2">
                                <iconify-icon icon="majesticons:door-exit" class=""></iconify-icon>
                                Save & Exit
                            </button>
                        </div>
                    </div>
                    <div class="row @if (isset($data)) d-none @endif" id="workAssesmentDiv">
                        <div class="col-lg-12 border-md-end d-flex align-items-center justify-content-center">
                            <div class="py-3">

                                {{-- @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                                @endif --}}

                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif


                                <h2 class="text-danger text-center ">Display screen equipment assesment</h2>

                                <form action="{{route('user.workStationAssesmentStore')}}" method="POST">
                                    @csrf
                                    <div class="d-flex gap-3 flex-wrap justify-content-center mt-4">
                                        <input type="hidden" id="program_number" name="program_number"
                                            value="{{$programNumber}}">
                                        <input type="hidden" id="assesment_id" name="assesment_id"
                                            value="@if(isset($assesment)){{$assesment->id}}@endif">
                                        <input type="hidden" id="determinig_answer_id" name="determinig_answer_id"
                                            value="@if(isset($determiningans)){{$determiningans->id}}@endif">
                                        {{-- <div class="dropdown">
                                            <label for="">Work Station Number</label>
                                            <input type="text" id="work_station_number" name="work_station_number" class="form-control"
                                                value="@if(isset($data)){{$data->work_station_number}}@endif">
                                        </div> --}}
                                        <div class="dropdown" style="display: none">
                                            <label for="">Department</label><br>
                                            <input type="text" id="department" name="department" class="form-control" value="{{$departments->name}}"
                                                readonly>
                                        </div>
                                
                                
                                        <div class="dropdown" style="display: none">
                                            <label for="user_name">User Name</label>
                                            <input type="text" id="user_name" name="user_name" class="form-control" value="{{Auth::user()->name}}"
                                                readonly>
                                        </div>
                                
                                        <div class="dropdown" style="display: none">
                                            <label for="date">Date</label>
                                            <input type="date" id="date" name="date" class="form-control"
                                                value="@if(isset($data)){{$data->date}}@else{{ date('Y-m-d')}}@endif" readonly>
                                        </div>
                                
                                    </div>
                                
                                    <div class="row mt-3">
                                        <div class="col-lg-6">
                                            
                                            <h6 class="mb-3">Work Station Number</h6>
                                            <input type="text" id="work_station_number" name="work_station_number" class="form-control"
                                                    value="@if(isset($data)){{$data->work_station_number}}@endif">
                                        </div>
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
                                
                                
                                        {{-- <div class="col-lg-12 mb-4">
                                            <h6 class="mb-3">Do you normally use your DSE for continuous spells of an hour or more at a time?
                                            </h6>
                                            <label class="mx-2">
                                                <input type="radio" name="continuous_spell" class="form-check-input me-1" value="Yes" @if(isset($data)) @if ($data->continuous_spell == "Yes") checked @endif @endif>Yes
                                            </label>
                                            <label class="mx-2">
                                                <input type="radio" name="continuous_spell" class="form-check-input me-1" value="No" @if(isset($data)) @if ($data->continuous_spell == "No") checked @endif @endif>No
                                            </label>
                                        </div> --}}
                                
                                        {{-- <div class="col-lg-12 mb-4">
                                            <h6 class="mb-3">If ‘Yes’ do you do this more or less daily ?     
                                            </h6>
                                            <label class="mx-2">
                                                <input type="radio" name="continuous_spell_time" class="form-check-input me-1" value="Yes"@if(isset($data)) @if ($data->continuous_spell_time == "Yes") checked @endif @endif>Yes
                                            </label>
                                            <label class="mx-2">
                                                <input type="radio" name="continuous_spell_time" class="form-check-input me-1" value="No" @if(isset($data)) @if ($data->continuous_spell_time == "No") checked @endif @endif>No
                                            </label>
                                        </div> --}}
                                        <div class="col-lg-12"></div>
                                
                                        <div class="col-lg-6 mb-4">
                                            <h6 class="mb-3">How many hours on average daily do you spend using your DSE? </h6>
                                            <input id="average_using_dse" type="number" name="average_using_dse" class="form-control me-1"
                                                value="@if(isset($data)){{$data->average_using_dse}}@endif">
                                        </div>
                                
                                        <div class="col-lg-12 mb-4">
                                            <h6 class="mb-3">What Software do you use? </h6>
                                            <label class="mx-2">
                                                <input id="Msoffice" type="checkbox" name="software[]" class="form-check-input me-1" value="Msoffice" @if (isset($data->software)) @foreach (json_decode($data->software) as $software) @if ($software == "Msoffice") checked @endif @endforeach @endif>Microsoft office suit
                                            </label>
                                            <label class="mx-2">
                                                <input id="Cerner" type="checkbox" name="software[]" class="form-check-input me-1" value="Cerner" @if (isset($data->software)) @foreach (json_decode($data->software) as $software) @if ($software == "Cerner") checked @endif @endforeach @endif>Cerner
                                            </label>
                                            <label for="ESR" class="mx-2">
                                                <input id="ESR" type="checkbox" name="software[]" class="form-check-input me-1" value="ESR" @if (isset($data->software)) @foreach (json_decode($data->software) as $software) @if ($software == "ESR") checked @endif @endforeach @endif>ESR
                                            </label>
                                            {{-- <label for="ms_powerpoint" class="mx-2">
                                                <input id="ms_powerpoint" type="checkbox" name="software[]" class="form-check-input me-1" value="Powerpoint" @if (isset($data->software)) @foreach (json_decode($data->software) as $software) @if ($software == "Powerpoint") checked @endif @endforeach @endif>Powerpoint
                                            </label> --}}
                                            <label for="others" class="mx-2">
                                                <input id="others" type="checkbox" name="software[]" class="form-check-input me-1" value="Others" @if (isset($data->software)) @foreach (json_decode($data->software) as $software) @if ($software == "Others") checked @endif @endforeach @endif>Others
                                            </label>
                                            <label class="">
                                                <input id="others_software" type="text" name="others_software" class="form-control" placeholder="Somerset, EPT, Cerner" value="@if(isset($data)){{$data->others_software}}@endif">
                                            </label>
                                        </div>
                                
                                    </div>
                                
                                    @if(isset($data)) 
                                    
                                    @else 
                                    
                                    <div class="col-lg-12">
                                        <div class="row py-3 ">
                                            <div class="col-lg-5 d-flex align-items-center">
                                                <button type="submit" class="btn btn-warning d-flex align-items-center">
                                                    <iconify-icon icon="akar-icons:check-box-fill" class="me-1"></iconify-icon> @if(isset($data)) Update
                                                    @else Save & continue @endif
                                                </button>
                                            </div>
                                            <div class="col-lg-7 d-flex gap-3 justify-content-end"> </div>
                                        </div>
                                    </div>
                                    
                                    @endif
                                    
                                
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif


             @if($data)
            <form action="{{ route('add.assessment') }}" method="POST" id="myForm">
                @csrf

                <input type="hidden" name="line_manager_id" id="line_manager_id" for="myForm" value="{{ $selectedLineManager->id }}">
                <input type="hidden" name="department_id" id="department_id" value="{{ $departments->id }}">
                <input type="hidden" name="division_id" id="division_id" value="{{ $selectedDivision->id }}">
                
                <input type="hidden" id="pnumber" name="pnumber"
                value="{{$programNumber}}">

                    @foreach ($questions as $key => $question)

                        <div class="row mt-1">
                            <div class="col-lg-8 shadow-sm border rounded-0 bg-light">
                                <div class="row pt-5 px-4">
                                    <div class="col-lg-12 mb-4">
                                        <h6 class="mb-3">{{ $key + 1 }}. {{ $question->question }}</h6>
                                        <div class="d-flex">
                                            <label for="yes" class="mx-4 fw-bold text-success">
                                                YES <input type="radio" name="answers[{{ $question->id }}]" class="form-check-input" id="yes{{ $question->id }}" value="Yes" required="required" @if(isset($question->assesmentAnswers)) {{ $question->assesmentAnswers->answer == "Yes" ? 'checked' : '' }} @endif onclick="toggleFields(this)" data-qid="{{$question->id}}">
                                            </label>

                                            <label for="NO" class="me-3 fw-bold text-danger">
                                                NO <input type="radio" name="answers[{{ $question->id }}]" class="form-check-input" value="No" required="required" 
                                                 @if(isset($question->assesmentAnswers)) {{ $question->assesmentAnswers->answer == "No" ? 'checked' : '' }} @endif onclick="toggleFields(this)" data-qid="{{$question->id}}">
                                            </label>
                                        </div>

                                        <div class="row p-2 @if(isset($question->assesmentAnswers)) {{  $question->assesmentAnswers->answer == "No" ? '' : 'd-none' }}@else d-none @endif" id="subqnDiv{{$question->id}}" style="@if(isset($question->assesmentAnswers)) {{  $question->assesmentAnswers->answer == "No" ? '' : 'display:none' }} @endif">

                                            @if (isset($question->tips))
                                            <div class="col-lg-12 p-2 alert alert-warning mb-3 rounded-3 text-dark"><iconify-icon icon="flat-color-icons:idea"></iconify-icon> {{$question->tips}}</div>
                                            @endif
                                            
                                        </div>

                                       
                                        @if (isset($question->assesmentAnswers))
                                        
                                        @if ($question->assesmentAnswers->user_id == Auth::user()->id)
                                            @foreach ($question->assesmentAnswers->assesmentAnswerComments as $comment)
                                                @if ($comment->created_by == "Manager")
                                                    <div class="row">
                                                        <div class="col-lg-4"></div>
                                                        <div class="col-lg-8 p-2 alert alert-secondary mb-3 rounded-3 text-dark  align-items-right">{{$comment->comment}}
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
                                        

                                            @if ($question->assesmentAnswers->assesmentAnswerComments->count() > 0 && $question->assesmentAnswers->solved == 0)

                                                <div class="col-lg-12">
                                                    <textarea name="comment" id="comment{{$question->assesmentAnswers->id}}" class="form-control" placeholder="Comments Here" required></textarea>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="row py-3 ">
                                                        <div class="col-lg-7 d-flex gap-3">

                                                            <button type="button" class="btn btn-success d-flex align-items-center addcomment" for="commentForm{{$question->assesmentAnswers->id}}" qnid="{{$question->id}}" assans_id="{{ $question->assesmentAnswers->id }}" solved="1"> <iconify-icon icon="akar-icons:check-box-fill" class="me-1"></iconify-icon> accept as resolved</button>

                                                            <button type="button" class="btn btn-warning d-flex align-items-center sendmsg" qnid="{{$question->id}}" assans_id="{{ $question->assesmentAnswers->id }}" solved="0"> <iconify-icon icon="akar-icons:check-box-fill" class="me-1"></iconify-icon> send
                                                            </button>

                                                        </div>
                                                        
                                                        <div class="col-lg-5 d-flex align-items-center">
                                                            {{-- <small class="text-muted mb-0">76 charachter remaining</small> --}}
                                                        </div>
                                                    </div>
                                                </div>


                                            @endif
                                        
                                        @endif
                                        
                                        @endif

                                    



                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 shadow-sm border rounded-0 bg-light">
                                <div class="py-4">
                                    {{-- <img src="{{ asset('images/question/'.$question->image) }}" class="img-fluid" alt=""> --}}

                                    @if ($question->questionImage)
                                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                        @foreach ($question->questionImage as $key => $image)
                                            <div class="carousel-item {{ $key==0 ? 'active' : '' }}">
                                            <img src="{{asset('images/question/'.$image->image)}}"  height="120px" width="250px" alt="...">
                                            </div> 
                                        @endforeach
                                        </div>
                                    </div>
                                    @endif


                                </div>
                            </div>
                        </div>
                    @endforeach

                    
                <div class="row mt-2">
                    <div class="col-lg-12 shadow-sm border rounded-0 bg-light ">
                        <div class="row pt-5 px-4">
                            <div class="col-lg-12 mb-4">
                                <h6 class="mb-3">Any other question?
                                </h6>
                                <label for="otherqnyes" class="mx-2">
                                    <input id="otherqnyes" type="radio" name="otherqn" class="form-check-input me-1"
                                        value="Yes" @if(isset($opms)) @if ($opms->otherqn == "Yes") checked @endif @endif>Yes
                                </label>
                                <label for="otherqnno" class="mx-2">
                                    <input id="otherqnno" type="radio"  name="otherqn" class="form-check-input me-1" value="No" @if(isset($opms)) @if ($opms->otherqn == "No") checked @endif @endif>No
                                </label>

                                
                            </div>

                            
                            
                            <div id="additionalqn" @if(isset($opms)) @if ($opms->otherqn == "No") style="display:none" @else style="display:show"  @endif @endif>
                                <div class="col-lg-12 mb-4">
                                    @if(isset($opms)) 
                                    
                                    
                                    <h6 class="mb-3">{{$opms->question}}</h6>

                                    @foreach ($opms->assesmentHealthComment->where('question', 'question') as $opmscomment)
                                    <div class="row">
                                        <div class="col-lg-4"></div>
                                        <div class="col-lg-8 p-2 alert alert-secondary text-start rounded-3 text-dark"><b>{{$opmscomment->created_by}}:</b> {{$opmscomment->comment}}
                                            <br>
                                            <small>Date:{{$opmscomment->date}}</small>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="col-lg-12">
                                        <textarea name="newqn" id="newqn" class="form-control" placeholder="Make a question here"> </textarea>
                                    </div>
                                    @endif
                                    
                                </div>
                              </div>

                              
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
                                                @if (isset($opms) && $opms->lowback != 'null') 
                                                
                                                        @foreach (json_decode($opms->lowback) as $lowback) @if ($lowback == "None") checked @endif @endforeach
                                                        
                                                @endif></td>
                                            <td style="text-align: center"> <input type="checkbox" name="lowback[]" class="custom-checkbox lowbackItem" @if (isset($opms) && $opms->lowback != 'null') @foreach (json_decode($opms->lowback) as $lowback) @if ($lowback == "Ache") checked @endif @endforeach @endif value="Ache"></td>
                                            <td style="text-align: center"> <input type="checkbox" name="lowback[]" class="custom-checkbox lowbackItem" @if (isset($opms) && $opms->lowback != 'null') @foreach (json_decode($opms->lowback) as $lowback) @if ($lowback == "Pain") checked @endif @endforeach @endif value="Pain" ></td>
                                            <td style="text-align: center"> <input type="checkbox" name="lowback[]" class="custom-checkbox lowbackItem"  @if (isset($opms) && $opms->lowback != 'null') @foreach (json_decode($opms->lowback) as $lowback) @if ($lowback == "Pins and needles") checked @endif @endforeach @endif value="Pins and needles" ></td>
                                            <td style="text-align: center"> <input type="checkbox" name="lowback[]" class="custom-checkbox lowbackItem"  @if (isset($opms) && $opms->lowback != 'null') @foreach (json_decode($opms->lowback) as $lowback) @if ($lowback == "Numbness") checked @endif @endforeach @endif value="Numbness" ></td>
                                        </tr>
                                        @if (isset($opms->assesmentHealthComment))
                                        <tr>
                                            <td style="text-align: left" colspan="6">
                                                @foreach ($opms->assesmentHealthComment->where('question', 'lowback') as $opmscomment)
                                                <div class="row">
                                                    <div class="col-lg-4"></div>
                                                    <div class="col-lg-8 p-2 alert alert-secondary text-start rounded-3 text-dark"><b>{{$opmscomment->created_by}}:</b> {{$opmscomment->comment}}
                                                        <br>
                                                        <small>Date:{{$opmscomment->date}}</small>
                                                    </div>
                                                </div>
                                                @endforeach
                                                
                                            </td>
                                        </tr>
                                        @endif
                                        
                                        <tr>
                                            <td style="text-align: left">Upper back</td>
                                            <td style="text-align: center"> <input type="checkbox" name="upperback[]" value="None"   @if (isset($opms) && $opms->upperback != 'null') @foreach (json_decode($opms->upperback) as $upperback) @if ($upperback == "None") checked @endif @endforeach @endif  class="custom-checkbox upperbackItem" id="upperbackNone"></td>

                                            <td style="text-align: center"> <input type="checkbox" name="upperback[]" value="Ache" @if (isset($opms) && $opms->upperback != 'null') @foreach (json_decode($opms->upperback) as $upperback) @if ($upperback == "Ache") checked @endif @endforeach @endif  class="custom-checkbox upperbackItem"></td>

                                            <td style="text-align: center"> <input type="checkbox" name="upperback[]" value="Pain" @if (isset($opms) && $opms->upperback != 'null') @foreach (json_decode($opms->upperback) as $upperback) @if ($upperback == "Pain") checked @endif @endforeach @endif  class="custom-checkbox upperbackItem"></td>

                                            <td style="text-align: center"> <input type="checkbox" name="upperback[]" value="Pins and needles" @if (isset($opms) && $opms->upperback != 'null') @foreach (json_decode($opms->upperback) as $upperback) @if ($upperback == "Pins and needles") checked @endif @endforeach @endif  class="custom-checkbox upperbackItem"></td>

                                            <td style="text-align: center"> <input type="checkbox" name="upperback[]" value="Numbness" @if (isset($opms) && $opms->upperback != 'null') @foreach (json_decode($opms->upperback) as $upperback) @if ($upperback == "Numbness") checked @endif @endforeach @endif  class="custom-checkbox upperbackItem"></td>
                                        </tr>

                                        @if (isset($opms->assesmentHealthComment))
                                        <tr>
                                            <td style="text-align: left" colspan="6">
                                                @foreach ($opms->assesmentHealthComment->where('question', 'upperback') as $opmscomment)
                                                <div class="row">
                                                    <div class="col-lg-4"></div>
                                                    <div class="col-lg-8 p-2 alert alert-secondary text-start rounded-3 text-dark"><b>{{$opmscomment->created_by}}:</b> {{$opmscomment->comment}}
                                                        <br>
                                                        <small>Date:{{$opmscomment->date}}</small>
                                                    </div>
                                                </div>
                                                @endforeach
                                                
                                            </td>
                                        </tr>
                                            
                                        @endif
                                        
                                        <tr>
                                            <td style="text-align: left">Neck</td>
                                            <td style="text-align: center"> <input type="checkbox" name="neck[]" class="custom-checkbox neckItem"   @if (isset($opms) && $opms->neck != 'null') @foreach (json_decode($opms->neck) as $neck) @if ($neck == "None") checked @endif @endforeach @endif   value="None" id="neckNone"></td>
                                            <td style="text-align: center"> <input type="checkbox" name="neck[]" class="custom-checkbox neckItem"   @if (isset($opms) && $opms->neck != 'null') @foreach (json_decode($opms->neck) as $neck) @if ($neck == "Ache") checked @endif @endforeach @endif   value="Ache" ></td>
                                            <td style="text-align: center"> <input type="checkbox" name="neck[]" class="custom-checkbox neckItem"   @if (isset($opms) && $opms->neck != 'null') @foreach (json_decode($opms->neck) as $neck) @if ($neck == "Pain") checked @endif @endforeach @endif   value="Pain" ></td>
                                            <td style="text-align: center"> <input type="checkbox" name="neck[]" class="custom-checkbox neckItem"   @if (isset($opms) && $opms->neck != 'null') @foreach (json_decode($opms->neck) as $neck) @if ($neck == "Pins and needles") checked @endif @endforeach @endif   value="Pins and needles" ></td>
                                            <td style="text-align: center"> <input type="checkbox" name="neck[]" class="custom-checkbox neckItem" @if (isset($opms) && $opms->neck != 'null') @foreach (json_decode($opms->neck) as $neck) @if ($neck == "Numbness") checked @endif @endforeach @endif  value="Numbness"></td>
                                        </tr>

                                        @if (isset($opms->assesmentHealthComment))
                                        <tr>
                                            <td style="text-align: left" colspan="6">
                                                @foreach ($opms->assesmentHealthComment->where('question', 'neck') as $opmscomment)
                                                <div class="row">
                                                    <div class="col-lg-4"></div>
                                                    <div class="col-lg-8 p-2 alert alert-secondary text-start rounded-3 text-dark"><b>{{$opmscomment->created_by}}:</b> {{$opmscomment->comment}}
                                                        <br>
                                                        <small>Date:{{$opmscomment->date}}</small>
                                                    </div>
                                                </div>
                                                @endforeach
                                                
                                            </td>
                                        </tr>
                                        @endif
                                        
                                        <tr>
                                            <td style="text-align: left">Shoulders</td>
                                            <td style="text-align: center"> <input type="checkbox" name="shoulders[]" value="None"  @if (isset($opms) && $opms->shoulders != 'null') @foreach (json_decode($opms->shoulders) as $shoulders) @if ($shoulders == "Numbness") checked @endif @endforeach @endif   class="custom-checkbox shouldersItem" id="shouldersNone"></td>
                                            <td style="text-align: center"> <input type="checkbox" name="shoulders[]" value="Ache"  @if (isset($opms) && $opms->shoulders != 'null') @foreach (json_decode($opms->shoulders) as $shoulders) @if ($shoulders == "Ache") checked @endif @endforeach @endif   class="custom-checkbox shouldersItem"></td>
                                            <td style="text-align: center"> <input type="checkbox" name="shoulders[]" value="Pain"  @if (isset($opms) && $opms->shoulders != 'null') @foreach (json_decode($opms->shoulders) as $shoulders) @if ($shoulders == "Pain") checked @endif @endforeach @endif   class="custom-checkbox shouldersItem"></td>
                                            <td style="text-align: center"> <input type="checkbox" name="shoulders[]" value="Pins and needles"  @if (isset($opms) && $opms->shoulders != 'null') @foreach (json_decode($opms->shoulders) as $shoulders) @if ($shoulders == "Pins and needles") checked @endif @endforeach @endif   class="custom-checkbox shouldersItem"></td>
                                            <td style="text-align: center"> <input type="checkbox" name="shoulders[]" value="Numbness" @if (isset($opms) && $opms->shoulders != 'null') @foreach (json_decode($opms->shoulders) as $shoulders) @if ($shoulders == "Numbness") checked @endif @endforeach @endif   class="custom-checkbox shouldersItem"></td>
                                        </tr>

                                        
                                        @if (isset($opms->assesmentHealthComment))
                                            
                                        <tr>
                                            <td style="text-align: left" colspan="6">
                                                @foreach ($opms->assesmentHealthComment->where('question', 'shoulders') as $opmscomment)
                                                <div class="row">
                                                    <div class="col-lg-4"></div>
                                                    <div class="col-lg-8 p-2 alert alert-secondary text-start rounded-3 text-dark"><b>{{$opmscomment->created_by}}:</b> {{$opmscomment->comment}}
                                                        <br>
                                                        <small>Date:{{$opmscomment->date}}</small>
                                                    </div>
                                                </div>
                                                @endforeach
                                                
                                            </td>
                                        </tr>
                                        @endif

                                        <tr>
                                            <td style="text-align: left">Arms</td>
                                            <td style="text-align: center"> <input type="checkbox" name="arms[]" class="custom-checkbox armsItem"   @if (isset($opms) && $opms->arms != 'null') @foreach (json_decode($opms->arms) as $arms) @if ($arms == "None") checked @endif @endforeach @endif  value="None" id="armsNone"></td>
                                            <td style="text-align: center"> <input type="checkbox" name="arms[]" class="custom-checkbox armsItem"   @if (isset($opms) && $opms->arms != 'null') @foreach (json_decode($opms->arms) as $arms) @if ($arms == "Ache") checked @endif @endforeach @endif  value="Ache" ></td>
                                            <td style="text-align: center"> <input type="checkbox" name="arms[]" class="custom-checkbox armsItem"   @if (isset($opms) && $opms->arms != 'null') @foreach (json_decode($opms->arms) as $arms) @if ($arms == "Pain") checked @endif @endforeach @endif  value="Pain" ></td>
                                            <td style="text-align: center"> <input type="checkbox" name="arms[]" class="custom-checkbox armsItem" value="Pins and needles"  @if (isset($opms) && $opms->arms != 'null') @foreach (json_decode($opms->arms) as $arms) @if ($arms == "Pins and needles") checked @endif @endforeach @endif  ></td>
                                            <td style="text-align: center"> <input type="checkbox" name="arms[]" class="custom-checkbox armsItem"  @if (isset($opms) && $opms->arms != 'null') @foreach (json_decode($opms->arms) as $arms) @if ($arms == "Numbness") checked @endif @endforeach @endif value="Numbness" ></td>
                                        </tr>

                                        @if (isset($opms->assesmentHealthComment))
                                            
                                        <tr>
                                            <td style="text-align: left" colspan="6">
                                                @foreach ($opms->assesmentHealthComment->where('question', 'arms') as $opmscomment)
                                                <div class="row">
                                                    <div class="col-lg-4"></div>
                                                    <div class="col-lg-8 p-2 alert alert-secondary text-start rounded-3 text-dark"><b>{{$opmscomment->created_by}}: </b>{{$opmscomment->comment}}
                                                        <br>
                                                        <small>Date:{{$opmscomment->date}}</small>
                                                    </div>
                                                </div>
                                                @endforeach
                                                
                                            </td>
                                        </tr>
                                        @endif

                                        <tr>
                                            <td style="text-align: left">Hand/fingers</td>
                                            <td style="text-align: center"> <input type="checkbox" name="hand_fingers[]" class="custom-checkbox hand_fingersItem"  @if (isset($opms) && $opms->hand_fingers != 'null') @foreach (json_decode($opms->hand_fingers) as $hand_fingers) @if ($hand_fingers == "None") checked @endif @endforeach @endif  value="None" id="hand_fingersNone"></td>
                                            <td style="text-align: center"> <input type="checkbox" name="hand_fingers[]" class="custom-checkbox hand_fingersItem"  @if (isset($opms) && $opms->hand_fingers != 'null') @foreach (json_decode($opms->hand_fingers) as $hand_fingers) @if ($hand_fingers == "Ache") checked @endif @endforeach @endif  value="Ache"></td>
                                            <td style="text-align: center"> <input type="checkbox" name="hand_fingers[]" class="custom-checkbox hand_fingersItem"  @if (isset($opms) && $opms->hand_fingers != 'null') @foreach (json_decode($opms->hand_fingers) as $hand_fingers) @if ($hand_fingers == "Pain") checked @endif @endforeach @endif  value="Pain"></td>
                                            <td style="text-align: center"> <input type="checkbox" name="hand_fingers[]" class="custom-checkbox hand_fingersItem" value="Pins and needles"  @if (isset($opms) && $opms->hand_fingers != 'null') @foreach (json_decode($opms->hand_fingers) as $hand_fingers) @if ($hand_fingers == "Pins and needles") checked @endif @endforeach @endif ></td>
                                            <td style="text-align: center"> <input type="checkbox" name="hand_fingers[]" class="custom-checkbox hand_fingersItem" @if (isset($opms) && $opms->hand_fingers != 'null') @foreach (json_decode($opms->hand_fingers) as $hand_fingers) @if ($hand_fingers == "Numbness") checked @endif @endforeach @endif  value="Numbness"></td>
                                        </tr>

                                        @if (isset($opms->assesmentHealthComment))
                                        <tr>
                                            <td style="text-align: left" colspan="6">
                                                @foreach ($opms->assesmentHealthComment->where('question', 'hand_fingers') as $opmscomment)
                                                <div class="row">
                                                    <div class="col-lg-4"></div>
                                                    <div class="col-lg-8 p-2 alert alert-secondary text-start rounded-3 text-dark"><b>{{$opmscomment->created_by}}: </b>{{$opmscomment->comment}}
                                                        <br>
                                                        <small>Date:{{$opmscomment->date}}</small>
                                                    </div>
                                                </div>
                                                @endforeach
                                                
                                            </td>
                                        </tr>
                                        @endif

                                        <tr>
                                            <td style="text-align: left" colspan="6">
                                                <h6 class="mb-3">Do you do any stretching exercises during the day to prevent muscular tension? </h6>
                                                <label class="mx-2">
                                                    <input type="radio" name="exercise" class="form-check-input me-1" value="Yes" @if(isset($opms)) @if ($opms->exercise == "Yes") checked @endif @endif  required>Yes
                                                </label>
                                                <label class="mx-2">
                                                    <input type="radio"  name="exercise" class="form-check-input me-1" value="No" @if(isset($opms)) @if ($opms->exercise == "No") checked @endif @endif  required>No
                                                </label>

                                                @if (isset($opms))
                                                    @if ($opms->exercise == "Yes")
                                                        @foreach ($opms->assesmentHealthComment->where('question', 'exercise') as $opmscomment)
                                                        <div class="row">
                                                            <div class="col-lg-4"></div>
                                                            <div class="col-lg-8 p-2 alert alert-secondary text-start rounded-3 text-dark"><b>{{$opmscomment->created_by}}: </b>{{$opmscomment->comment}}
                                                                <br>
                                                                <small>Date:{{$opmscomment->date}}</small>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    @endif
                                                @endif


                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="text-align: left" colspan="6">
                                                <h6 class="mb-3"> Would you like to be taught some exercises? </h6>
                                                <label  class="mx-2">
                                                    <input type="radio" name="taught_exercise" class="form-check-input me-1" value="Yes" @if(isset($opms)) @if ($opms->taught_exercise == "Yes") checked @endif @endif  required>Yes
                                                </label>
                                                <label class="mx-2">
                                                    <input  type="radio"  name="taught_exercise" class="form-check-input me-1" value="No" @if(isset($opms)) @if ($opms->taught_exercise == "No") checked @endif @endif  required>No
                                                </label>

                                                @if (isset($opms))
                                                    @if ($opms->taught_exercise == "Yes")
                                                        @foreach ($opms->assesmentHealthComment->where('question', 'taught_exercise') as $opmscomment)
                                                        <div class="row">
                                                            <div class="col-lg-4"></div>
                                                            <div class="col-lg-8 p-2 alert alert-secondary text-start rounded-3 text-dark"><b>{{$opmscomment->created_by}}: </b>{{$opmscomment->comment}}
                                                                <br>
                                                                <small>Date:{{$opmscomment->date}}</small>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                    @if($determiningans->line_manager_notification == "0") 
                    <div class="col-lg-12">
                        <div class="row py-3 ">
                            <div class="ermsg"></div>
                            <div class="col-lg-5 d-flex align-items-center">
                                <button type="submit" class="btn btn-success d-flex align-items-center mx-2">
                                    <iconify-icon icon="akar-icons:check-box-fill" class="me-1 "></iconify-icon> Save & Submit
                                </button>

                                <button type="button" id="saveBtn" class="btn btn-warning d-flex align-items-center d-none">
                                    <iconify-icon icon="akar-icons:check-box-fill" class="me-1"></iconify-icon> Save & Exit
                                </button>
                            </div>
                            <div class="col-lg-7 d-flex gap-3 justify-content-end"> </div>
                        </div>
                    </div>
                    @endif 

                

            </form>
            @endif

        </div>
    </div>
</section>

{{-- <button type="button" class="btn btn-info" data-mdb-ripple-init>Info</button> --}}

{{-- <button type="button" class="btn btn-success btn-floating btn-lg" id="saveNExit">
    <iconify-icon icon="akar-icons:check-box-fill" class="me-1 "></iconify-icon> Save & Exit
</button> --}}



<!-- Back to top button -->

@if($data)
   
<button type="button" class="btn btn-warning btn-floating btn-lg" id="saveNExit">
    <iconify-icon icon="akar-icons:check-box-fill" class="me-1 "></iconify-icon> Save & Exit
</button> 
@endif



@endsection

@section('script')



<script>
    //Get the button
let mybutton = document.getElementById("saveNExit");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if ( document.body.scrollTop > 20 || document.documentElement.scrollTop > 20 ) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }

  
}
// When the user clicks on the button, scroll to the top of the document
// mybutton.addEventListener("click", backToTop);

// function backToTop() {
//   document.body.scrollTop = 0;
//   document.documentElement.scrollTop = 0;
// }
</script>



<script>
    function showFields() {
        var id = $(this).attr('qid');
        console.log(id);
        document.getElementById("additionalFields").classList.remove("hidden");
    }

    function hideFields() {
        document.getElementById("additionalFields").classList.add("hidden");
    }

    // $("#part_time_work_div").hide();
    // $("#others_software").hide();
    $("#others").click(function() {
        if($(this).is(":checked")) {
            $("#others_software").show();
        } else {
            $("#others_software").hide();
            $("#others_software").val('');
        }
    });

    $("#showWork").click(function() {

        $("#workAssesmentDiv").removeClass("d-none");
        $('#showWork').addClass("d-none");
    });

    $(document).ready(function(){
        $('input[name="job_type"]').change(function(){
        var value = $(this).val();
        if(value === 'Part time') {
            $('#part_time_work_div').show();
        } else {
            $('#part_time_work_div').hide();
            $("#part_time_work_hour").val('');
        }
        });

        $('input[name="otherqn"]').change(function(){
        var value = $(this).val();
        if(value === 'Yes') {
            $('#additionalqn').show();
        } else {
            $('#additionalqn').hide();
            $("#newqn").val('');
        }
        });
    });
    
</script>


<script>
    //header for csrf-token is must in laravel
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    //

    function toggleFields(element) {
        var id = element.getAttribute('data-qid');
        var key = element.getAttribute('data-key');
        var value = element.getAttribute('value');
        if (value == "No") {
            $("#subqnDiv"+id).show();
            $("#subqnDiv"+id).removeClass("d-none");
        } else {
            $("#subqnDiv"+id).hide();
            $("#subqnDiv"+id).addClass("d-none");
        }
    }


    // comment store 
    $("body").delegate(".addcomment, .sendmsg","click",function () {
        var commenturl = "{{URL::to('/user/user-comment')}}";

        var solved = $(this).attr('solved');
        var qnid = $(this).attr('qnid');
        var assans_id = $(this).attr('assans_id');
        var line_manager_id = $("#line_manager_id").val();
        var comment = $("#comment"+assans_id).val();
        console.log(qnid, line_manager_id, comment);
        var form_data = new FormData();			
        form_data.append("qnid", qnid);
        form_data.append("solved", solved);
        form_data.append("assans_id", assans_id);
        form_data.append("line_manager_id", line_manager_id);
        form_data.append("comment", comment);

        $.ajax({
            url:commenturl,
            method: "POST",
            type: "POST",
            contentType: false,
            processData: false,
            data:form_data,
            success: function(d){
                window.setTimeout(function(){location.reload()},2000)
                // console.log((d.min));
            },
            error:function(d){
                console.log(d);
            }
        });
    });
    // comment store 



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
    
    // data:{answers,lowback,upperback,neck,shoulders,arms,hand_fingers,line_manager_id,division_id,program_number,department_id,newqn,otherqn,exercise,taught_exercise},
    // data store end

    // $(document).ready(function() {
    //     $('input[name="lowback[]"]').click(function() {
    //         var value = $(this).attr('value');
    //         console.log(value);
    //         // $("#sel input:checkbox").attr('checked', $(this).is(':checked'));
    //     });
    // });

     // enable disable checkbox item start
        $("body").delegate(".lowbackItem","click",function () {
            var value = $(this).attr('value');
            if (value == "None") {
                if ($(this).prop("checked")) {
                    // Uncheck all other checkboxes
                    $(".lowbackItem").not(this).prop("checked", false);
                }else{
                    $(this).prop("checked", false);
                }
            } else if (value == "Pain" || value == "Pins and needles" || value == "Numbness" || value == "Ache"){
                $("#lowbackNone").prop("checked", false);
            } else {
                $("#lowbackNone").prop("checked", false);
            }
            
        });

        $("body").delegate(".upperbackItem","click",function () {
            var value = $(this).attr('value');
            if (value == "None") {
                if ($(this).prop("checked")) {
                    // Uncheck all other checkboxes
                    $(".upperbackItem").not(this).prop("checked", false);
                }else{
                    $(this).prop("checked", false);
                }
            } else if (value == "Pain" || value == "Pins and needles" || value == "Numbness" || value == "Ache"){
                $("#upperbackNone").prop("checked", false);
            } else {
                $("#upperbackNone").prop("checked", false);
            }
        });

        $("body").delegate(".neckItem","click",function () {
            var value = $(this).attr('value');
            if (value == "None") {
                if ($(this).prop("checked")) {
                    // Uncheck all other checkboxes
                    $(".neckItem").not(this).prop("checked", false);
                }else{
                    $(this).prop("checked", false);
                }
            } else if (value == "Pain" || value == "Pins and needles" || value == "Numbness" || value == "Ache"){
                $("#neckNone").prop("checked", false);
            } else {
                $("#neckNone").prop("checked", false);
            }
        });

        $("body").delegate(".shouldersItem","click",function () {
            var value = $(this).attr('value');
            if (value == "None") {
                if ($(this).prop("checked")) {
                    // Uncheck all other checkboxes
                    $(".shouldersItem").not(this).prop("checked", false);
                }else{
                    $(this).prop("checked", false);
                }
            } else if (value == "Pain" || value == "Pins and needles" || value == "Numbness" || value == "Ache"){
                $("#shouldersNone").prop("checked", false);
            } else {
                $("#shouldersNone").prop("checked", false);
            }
        });

        
        $("body").delegate(".armsItem","click",function () {
            var value = $(this).attr('value');
            if (value == "None") {
                if ($(this).prop("checked")) {
                    // Uncheck all other checkboxes
                    $(".armsItem").not(this).prop("checked", false);
                }else{
                    $(this).prop("checked", false);
                }
            } else if (value == "Pain" || value == "Pins and needles" || value == "Numbness" || value == "Ache"){
                $("#armsNone").prop("checked", false);
            } else {
                $("#armsNone").prop("checked", false);
            }
        });

        $("body").delegate(".hand_fingersItem","click",function () {
            var value = $(this).attr('value');
            if (value == "None") {
                if ($(this).prop("checked")) {
                    // Uncheck all other checkboxes
                    $(".hand_fingersItem").not(this).prop("checked", false);
                }else{
                    $(this).prop("checked", false);
                }
            } else if (value == "Pain" || value == "Pins and needles" || value == "Numbness" || value == "Ache"){
                $("#hand_fingersNone").prop("checked", false);
            } else {
                $("#hand_fingersNone").prop("checked", false);
            }
        });
       
</script>
@endsection