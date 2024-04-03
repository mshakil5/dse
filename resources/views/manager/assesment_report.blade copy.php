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

  </style>
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
                               
                                <a href="{{route('manager.dashboard')}}" class="btn btn-sm btn-danger d-block float-end fs-5 d-flex align-items-center gap-2"> <iconify-icon icon="majesticons:door-exit" class=""></iconify-icon>
                                    Exit
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 border-md-end d-flex align-items-center justify-content-center">
                                <div class="py-3">

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

                                        <p>Work Station Number: {{$data->work_station_number}}</p>

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
                                    <div class="cmntermsg{{ $assanswer->id }}"></div>
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
                
                {{-- additional assesment add  --}}
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

                <h2>Tick to confirm location & type of health problem's experienced</h2>

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
                                            <td style="text-align: center"> <input type="radio" name="lowback" class="custom-checkbox"  @if(isset($opms)) @if ($opms->lowback == "None") checked @endif @endif value="None" required></td>
                                            <td style="text-align: center"> <input type="radio" name="lowback" class="custom-checkbox"  @if(isset($opms)) @if ($opms->lowback == "Ache") checked @endif @endif value="Ache" required></td>
                                            <td style="text-align: center"> <input type="radio" name="lowback" class="custom-checkbox"  @if(isset($opms)) @if ($opms->lowback == "Pain") checked @endif @endif value="Pain" required></td>
                                            <td style="text-align: center"> <input type="radio" name="lowback" class="custom-checkbox"  @if(isset($opms)) @if ($opms->lowback == "Pins and needles") checked @endif @endif value="Pins and needles" required></td>
                                            <td style="text-align: center"> <input type="radio" name="lowback" class="custom-checkbox"  @if(isset($opms)) @if ($opms->lowback == "Numbness") checked @endif @endif value="Numbness" required></td>
                                        </tr>
                                        
                                        <tr>
                                            <td style="text-align: left">Upper back</td>
                                            <td style="text-align: center"> <input type="radio" name="upperback" value="None"  @if(isset($opms)) @if ($opms->upperback == "None") checked @endif @endif  required class="custom-checkbox"></td>
                                            <td style="text-align: center"> <input type="radio" name="upperback" value="Ache"  @if(isset($opms)) @if ($opms->upperback == "Ache") checked @endif @endif  required class="custom-checkbox"></td>
                                            <td style="text-align: center"> <input type="radio" name="upperback" value="Pain"  @if(isset($opms)) @if ($opms->upperback == "Pain") checked @endif @endif  required class="custom-checkbox"></td>
                                            <td style="text-align: center"> <input type="radio" name="upperback" value="Pins and needles"  @if(isset($opms)) @if ($opms->upperback == "Pins and needles") checked @endif @endif  required class="custom-checkbox"></td>
                                            <td style="text-align: center"> <input type="radio" name="upperback" value="Numbness" @if(isset($opms)) @if ($opms->upperback == "Numbness") checked @endif @endif  required class="custom-checkbox"></td>
                                        </tr>
                                        
                                        <tr>
                                            <td style="text-align: left">Neck</td>
                                            <td style="text-align: center"> <input type="radio" name="neck" class="custom-checkbox"  @if(isset($opms)) @if ($opms->neck == "None") checked @endif @endif  value="None" required></td>
                                            <td style="text-align: center"> <input type="radio" name="neck" class="custom-checkbox"  @if(isset($opms)) @if ($opms->neck == "Ache") checked @endif @endif  value="Ache" required></td>
                                            <td style="text-align: center"> <input type="radio" name="neck" class="custom-checkbox"  @if(isset($opms)) @if ($opms->neck == "Pain") checked @endif @endif  value="Pain" required></td>
                                            <td style="text-align: center"> <input type="radio" name="neck" class="custom-checkbox"  @if(isset($opms)) @if ($opms->neck == "Pins and needles") checked @endif @endif  value="Pins and needles" required></td>
                                            <td style="text-align: center"> <input type="radio" name="neck" class="custom-checkbox" @if(isset($opms)) @if ($opms->neck == "Numbness") checked @endif @endif  value="Numbness" required></td>
                                        </tr>
                                        
                                        <tr>
                                            <td style="text-align: left">Shoulders</td>
                                            <td style="text-align: center"> <input type="radio" name="shoulders" value="None"  @if(isset($opms)) @if ($opms->shoulders == "None") checked @endif @endif  required class="custom-checkbox"></td>
                                            <td style="text-align: center"> <input type="radio" name="shoulders" value="Ache"  @if(isset($opms)) @if ($opms->shoulders == "Ache") checked @endif @endif  required class="custom-checkbox"></td>
                                            <td style="text-align: center"> <input type="radio" name="shoulders" value="Pain"  @if(isset($opms)) @if ($opms->shoulders == "Pain") checked @endif @endif  required class="custom-checkbox"></td>
                                            <td style="text-align: center"> <input type="radio" name="shoulders" value="Pins and needles"  @if(isset($opms)) @if ($opms->shoulders == "Pins and needles") checked @endif @endif  required class="custom-checkbox"></td>
                                            <td style="text-align: center"> <input type="radio" name="shoulders" value="Numbness" @if(isset($opms)) @if ($opms->shoulders == "Numbness") checked @endif @endif  required class="custom-checkbox"></td>
                                        </tr>

                                        <tr>
                                            <td style="text-align: left">Arms</td>
                                            <td style="text-align: center"> <input type="radio" name="arms" class="custom-checkbox"  @if(isset($opms)) @if ($opms->arms == "None") checked @endif @endif  value="None" required></td>
                                            <td style="text-align: center"> <input type="radio" name="arms" class="custom-checkbox"  @if(isset($opms)) @if ($opms->arms == "Ache") checked @endif @endif  value="Ache" required></td>
                                            <td style="text-align: center"> <input type="radio" name="arms" class="custom-checkbox"  @if(isset($opms)) @if ($opms->arms == "Pain") checked @endif @endif  value="Pain" required></td>
                                            <td style="text-align: center"> <input type="radio" name="arms" class="custom-checkbox" value="Pins and needles"  @if(isset($opms)) @if ($opms->arms == "Pins and needles") checked @endif @endif  required></td>
                                            <td style="text-align: center"> <input type="radio" name="arms" class="custom-checkbox"  @if(isset($opms)) @if ($opms->arms == "Numbness") checked @endif @endif value="Numbness" required></td>
                                        </tr>

                                        <tr>
                                            <td style="text-align: left">Hand/fingers</td>
                                            <td style="text-align: center"> <input type="radio" name="hand_fingers" class="custom-checkbox"  @if(isset($opms)) @if ($opms->hand_fingers == "None") checked @endif @endif  value="None" required></td>
                                            <td style="text-align: center"> <input type="radio" name="hand_fingers" class="custom-checkbox"  @if(isset($opms)) @if ($opms->hand_fingers == "Ache") checked @endif @endif  value="Ache" required></td>
                                            <td style="text-align: center"> <input type="radio" name="hand_fingers" class="custom-checkbox"  @if(isset($opms)) @if ($opms->hand_fingers == "Pain") checked @endif @endif  value="Pain" required></td>
                                            <td style="text-align: center"> <input type="radio" name="hand_fingers" class="custom-checkbox" value="Pins and needles"  @if(isset($opms)) @if ($opms->hand_fingers == "Pins and needles") checked @endif @endif  required></td>
                                            <td style="text-align: center"> <input type="radio" name="hand_fingers" class="custom-checkbox" @if(isset($opms)) @if ($opms->hand_fingers == "Numbness") checked @endif @endif  value="Numbness" required></td>
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
                                                <label  class="mx-2">
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
                {{-- additional assesment add  --}}
            </div>
        </div>



</section>


@endsection

@section('script')

<script>

     // header for csrf-token is must in laravel
     $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        // 

    
</script>
    
@endsection