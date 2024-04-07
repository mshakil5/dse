@extends('layouts.master')
@section('content')
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

  </style>
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
                            <a href="{{route('user.dashboard')}}"
                                class="btn btn-sm btn-danger d-block float-end fs-5 d-flex align-items-center gap-2">
                                <iconify-icon icon="majesticons:door-exit" class=""></iconify-icon>
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
                                        <div class="dropdown">
                                            <label for="">Work Station Number</label>
                                            <input type="number" id="work_station_number" name="work_station_number" class="form-control"
                                                value="@if(isset($data)){{$data->work_station_number}}@endif">
                                        </div>
                                        <div class="dropdown">
                                            <label for="">Department</label><br>
                                            <input type="text" id="department" name="department" class="form-control" value="{{$departments->name}}"
                                                readonly>
                                        </div>
                                
                                
                                        <div class="dropdown">
                                            <label for="user_name">User Name</label>
                                            <input type="text" id="user_name" name="user_name" class="form-control" value="{{Auth::user()->name}}"
                                                readonly>
                                        </div>
                                
                                        <div class="dropdown">
                                            <label for="date">Date</label>
                                            <input type="date" id="date" name="date" class="form-control"
                                                value="@if(isset($data)){{$data->date}}@else{{ date('Y-m-d')}}@endif" readonly>
                                        </div>
                                
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

             @if($data)
            <form action="{{ route('add.assessment') }}" method="POST">
                @csrf

                <input type="hidden" name="line_manager_id" id="line_manager_id" value="{{ $selectedLineManager->id }}">
                <input type="hidden" name="department_id" value="{{ $departments->id }}">
                <input type="hidden" name="division_id" value="{{ $selectedDivision->id }}">
                
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

                                        <div class="row @if(isset($question->assesmentAnswers)) {{  $question->assesmentAnswers->answer == "No" ? '' : 'd-none' }}@else d-none @endif" id="subqnDiv{{$question->id}}" style="@if(isset($question->assesmentAnswers)) {{  $question->assesmentAnswers->answer == "No" ? '' : 'display:none' }} @endif">
                                            <div class="col-lg-12 p-2 alert alert-danger mb-3 rounded-3 text-dark">{{$question->tips ? $question->tips : 'Tips coming soon...'}}</div>
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
                                    <img src="{{ asset('images/question/'.$question->image) }}" class="img-fluid" alt="">
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

                            
                            
                            <div id="additionalqn" style="@if(isset($opms)) @if($opms->otherqn == "Yes") @else display:none @endif @else display:none @endif">
                                <div class="col-lg-12 mb-4">
                                    @if(isset($opms)) 
                                    <h6 class="mb-3">{{$opms->question}}</h6>
                                    @else
                                    <div class="col-lg-12">
                                        <textarea name="newqn" id="newqn" class="form-control" placeholder="Make a question here"> </textarea>
                                    </div>
                                    @endif
                                    
                                </div>
                              </div>
                            
                              {{-- <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-8 p-2 alert alert-secondary   mb-3 rounded-3 text-dark">user side message</div>
                              </div>
                              <div class="row">
                                  <div class="col-lg-8 p-2 alert alert-secondary text-start mb-3 rounded-3 text-dark">line manager side message</div>
                                <div class="col-lg-4"></div>
                              </div> --}}
                              
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
                                            <td style="text-align: center"> <input type="checkbox" name="lowback[]" class="custom-checkbox" value="None" @if (isset($opms)) @foreach (json_decode($opms->lowback) as $lowback) @if ($lowback == "None") checked @endif @endforeach @endif ></td>
                                            <td style="text-align: center"> <input type="checkbox" name="lowback[]" class="custom-checkbox" @if (isset($opms)) @foreach (json_decode($opms->lowback) as $lowback) @if ($lowback == "Ache") checked @endif @endforeach @endif value="Ache"></td>
                                            <td style="text-align: center"> <input type="checkbox" name="lowback[]" class="custom-checkbox" @if (isset($opms)) @foreach (json_decode($opms->lowback) as $lowback) @if ($lowback == "Pain") checked @endif @endforeach @endif value="Pain" ></td>
                                            <td style="text-align: center"> <input type="checkbox" name="lowback[]" class="custom-checkbox"  @if (isset($opms)) @foreach (json_decode($opms->lowback) as $lowback) @if ($lowback == "Pins and needles") checked @endif @endforeach @endif value="Pins and needles" ></td>
                                            <td style="text-align: center"> <input type="checkbox" name="lowback[]" class="custom-checkbox"  @if (isset($opms)) @foreach (json_decode($opms->lowback) as $lowback) @if ($lowback == "Numbness") checked @endif @endforeach @endif value="Numbness" ></td>
                                        </tr>
                                        
                                        <tr>
                                            <td style="text-align: left">Upper back</td>
                                            <td style="text-align: center"> <input type="checkbox" name="upperback[]" value="None"   @if (isset($opms)) @foreach (json_decode($opms->upperback) as $upperback) @if ($upperback == "None") checked @endif @endforeach @endif  class="custom-checkbox"></td>

                                            <td style="text-align: center"> <input type="checkbox" name="upperback[]" value="Ache" @if (isset($opms)) @foreach (json_decode($opms->upperback) as $upperback) @if ($upperback == "Ache") checked @endif @endforeach @endif  class="custom-checkbox"></td>

                                            <td style="text-align: center"> <input type="checkbox" name="upperback[]" value="Pain" @if (isset($opms)) @foreach (json_decode($opms->upperback) as $upperback) @if ($upperback == "Pain") checked @endif @endforeach @endif  class="custom-checkbox"></td>

                                            <td style="text-align: center"> <input type="checkbox" name="upperback[]" value="Pins and needles" @if (isset($opms)) @foreach (json_decode($opms->upperback) as $upperback) @if ($upperback == "Pins and needles") checked @endif @endforeach @endif  class="custom-checkbox"></td>

                                            <td style="text-align: center"> <input type="checkbox" name="upperback[]" value="Numbness" @if (isset($opms)) @foreach (json_decode($opms->upperback) as $upperback) @if ($upperback == "Numbness") checked @endif @endforeach @endif  class="custom-checkbox"></td>
                                        </tr>
                                        
                                        <tr>
                                            <td style="text-align: left">Neck</td>
                                            <td style="text-align: center"> <input type="checkbox" name="neck[]" class="custom-checkbox"   @if (isset($opms)) @foreach (json_decode($opms->neck) as $neck) @if ($neck == "None") checked @endif @endforeach @endif   value="None" ></td>
                                            <td style="text-align: center"> <input type="checkbox" name="neck[]" class="custom-checkbox"   @if (isset($opms)) @foreach (json_decode($opms->neck) as $neck) @if ($neck == "Ache") checked @endif @endforeach @endif   value="Ache" ></td>
                                            <td style="text-align: center"> <input type="checkbox" name="neck[]" class="custom-checkbox"   @if (isset($opms)) @foreach (json_decode($opms->neck) as $neck) @if ($neck == "Pain") checked @endif @endforeach @endif   value="Pain" ></td>
                                            <td style="text-align: center"> <input type="checkbox" name="neck[]" class="custom-checkbox"   @if (isset($opms)) @foreach (json_decode($opms->neck) as $neck) @if ($neck == "Pins and needles") checked @endif @endforeach @endif   value="Pins and needles" ></td>
                                            <td style="text-align: center"> <input type="checkbox" name="neck[]" class="custom-checkbox" @if (isset($opms)) @foreach (json_decode($opms->neck) as $neck) @if ($neck == "Numbness") checked @endif @endforeach @endif  value="Numbness"></td>
                                        </tr>
                                        
                                        <tr>
                                            <td style="text-align: left">Shoulders</td>
                                            <td style="text-align: center"> <input type="checkbox" name="shoulders[]" value="None"  @if (isset($opms)) @foreach (json_decode($opms->shoulders) as $shoulders) @if ($shoulders == "Numbness") checked @endif @endforeach @endif   class="custom-checkbox"></td>
                                            <td style="text-align: center"> <input type="checkbox" name="shoulders[]" value="Ache"  @if (isset($opms)) @foreach (json_decode($opms->shoulders) as $shoulders) @if ($shoulders == "Ache") checked @endif @endforeach @endif   class="custom-checkbox"></td>
                                            <td style="text-align: center"> <input type="checkbox" name="shoulders[]" value="Pain"  @if (isset($opms)) @foreach (json_decode($opms->shoulders) as $shoulders) @if ($shoulders == "Pain") checked @endif @endforeach @endif   class="custom-checkbox"></td>
                                            <td style="text-align: center"> <input type="checkbox" name="shoulders[]" value="Pins and needles"  @if (isset($opms)) @foreach (json_decode($opms->shoulders) as $shoulders) @if ($shoulders == "Pins and needles") checked @endif @endforeach @endif   class="custom-checkbox"></td>
                                            <td style="text-align: center"> <input type="checkbox" name="shoulders[]" value="Numbness" @if (isset($opms)) @foreach (json_decode($opms->shoulders) as $shoulders) @if ($shoulders == "Numbness") checked @endif @endforeach @endif   class="custom-checkbox"></td>
                                        </tr>

                                        <tr>
                                            <td style="text-align: left">Arms</td>
                                            <td style="text-align: center"> <input type="checkbox" name="arms[]" class="custom-checkbox"   @if (isset($opms)) @foreach (json_decode($opms->arms) as $arms) @if ($arms == "None") checked @endif @endforeach @endif  value="None" ></td>
                                            <td style="text-align: center"> <input type="checkbox" name="arms[]" class="custom-checkbox"   @if (isset($opms)) @foreach (json_decode($opms->arms) as $arms) @if ($arms == "Ache") checked @endif @endforeach @endif  value="Ache" ></td>
                                            <td style="text-align: center"> <input type="checkbox" name="arms[]" class="custom-checkbox"   @if (isset($opms)) @foreach (json_decode($opms->arms) as $arms) @if ($arms == "Pain") checked @endif @endforeach @endif  value="Pain" ></td>
                                            <td style="text-align: center"> <input type="checkbox" name="arms[]" class="custom-checkbox" value="Pins and needles"  @if (isset($opms)) @foreach (json_decode($opms->arms) as $arms) @if ($arms == "Pins and needles") checked @endif @endforeach @endif  ></td>
                                            <td style="text-align: center"> <input type="checkbox" name="arms[]" class="custom-checkbox"  @if (isset($opms)) @foreach (json_decode($opms->arms) as $arms) @if ($arms == "Numbness") checked @endif @endforeach @endif value="Numbness" ></td>
                                        </tr>

                                        <tr>
                                            <td style="text-align: left">Hand/fingers</td>
                                            <td style="text-align: center"> <input type="checkbox" name="hand_fingers[]" class="custom-checkbox"  @if (isset($opms)) @foreach (json_decode($opms->hand_fingers) as $hand_fingers) @if ($hand_fingers == "None") checked @endif @endforeach @endif  value="None" ></td>
                                            <td style="text-align: center"> <input type="checkbox" name="hand_fingers[]" class="custom-checkbox"  @if (isset($opms)) @foreach (json_decode($opms->hand_fingers) as $hand_fingers) @if ($hand_fingers == "Ache") checked @endif @endforeach @endif  value="Ache"></td>
                                            <td style="text-align: center"> <input type="checkbox" name="hand_fingers[]" class="custom-checkbox"  @if (isset($opms)) @foreach (json_decode($opms->hand_fingers) as $hand_fingers) @if ($hand_fingers == "Pain") checked @endif @endforeach @endif  value="Pain"></td>
                                            <td style="text-align: center"> <input type="checkbox" name="hand_fingers[]" class="custom-checkbox" value="Pins and needles"  @if (isset($opms)) @foreach (json_decode($opms->hand_fingers) as $hand_fingers) @if ($hand_fingers == "Pins and needles") checked @endif @endforeach @endif ></td>
                                            <td style="text-align: center"> <input type="checkbox" name="hand_fingers[]" class="custom-checkbox" @if (isset($opms)) @foreach (json_decode($opms->hand_fingers) as $hand_fingers) @if ($hand_fingers == "Numbness") checked @endif @endforeach @endif  value="Numbness"></td>
                                        </tr>

                                        <tr>
                                            <td style="text-align: left" colspan="6">
                                                <h6 class="mb-3">Do you do any stretching exercises during the day to prevent muscular tension? </h6>
                                                <label class="mx-2">
                                                    <input type="radio" name="exercise" class="form-check-input me-1" value="Yes" @if(isset($opms)) @if ($opms->exercise == "Yes") checked @endif @endif  required>Yes
                                                </label>
                                                <label class="mx-2">
                                                    <input type="radio"  name="exercise" class="form-check-input me-1" value="No" @if(isset($opms)) @if ($opms->exercise == "No") checked @endif @endif  required>No
                                                </label>
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
                            <div class="col-lg-5 d-flex align-items-center">
                                <button type="submit" class="btn btn-success d-flex align-items-center">
                                    <iconify-icon icon="akar-icons:check-box-fill" class="me-1"></iconify-icon> Save
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



@endsection

@section('script')
<script language="JavaScript" type="text/javascript" src="/js/jquery-1.2.6.min.js"></script>
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
       
</script>
@endsection