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
                               
                                <a href="{{route('admin.assesmentCompiledList')}}" class="btn btn-sm btn-danger d-block float-end fs-5 d-flex align-items-center gap-2"> <iconify-icon icon="majesticons:door-exit" class=""></iconify-icon>
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
                                        
                                        <p> <strong>Work Station Number: </strong> {{$data->work_station_number}}</p>
                                        <p> <strong>Department:</strong>  {{ $department->name }}</p>
                                        <p> <strong>User Name:</strong>  {{ $user->name }}</p>
                                        <p> <strong>Date of Assessment::</strong> {{ $assesment->date }}</p>


                                        
                                    <div class="row mt-3">
                                        <div class="col-lg-12">
                                            <h6 class="mb-3" for="">Are you Full time <input type="radio" class="form-check-input" name="job_type" value="Full time" @if(isset($data)) @if ($data->job_type == "Full time") checked @endif @endif> or Part time <input type="radio" id="part_time" class="form-check-input" name="job_type" value="Part time" @if(isset($data)) @if ($data->job_type == "Part time") checked @endif @endif> ? 
                                            </h6>
                                            
                                            <p style="color: red">( information will be at the bottom this question, “Part time is someone working fewer hours than a full-time worker. As a rule, someone working full time would work at least 35 hours a week “)</p>
                                                
                                            <h6 class="mb-3">If part time how many hours a week do you work?  {{$data->part_time_work_hour}}</h6>
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
                                            <h6 class="mb-3">How many hours on average daily do you spend using your DSE? {{$data->average_using_dse}}</h6>
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
                <div class="row">


                    
                    <div class="col-lg-12 shadow-sm border rounded-0 bg-light ">
                        
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Risk factors</th>
                                    <th>Tick Yes</th>
                                    <th>Tick No</th>
                                    <th>Things to consider</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($assesmentanswers as $key => $assanswer)
                                <tr>
                                    <td>{{ $assanswer->question->question }}
                                        <div class="py-4">
                                            <img src="{{ asset('images/question/'.$assanswer->question->image) }}" class="img-fluid" alt="">
                                        </div>
                                    </td>
                                    <td>
                                        <input type="radio" class="custom-checkbox"  value="Yes" {{ $assanswer->answer == 'Yes' ? 'checked' : '' }} >
                                    </td>
                                    <td>
                                        <input type="radio" class="custom-checkbox"  value="Yes" {{ $assanswer->answer == 'No' ? 'checked' : '' }} ></td>
                                    <td>{{ $assanswer->question->tips }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                    
                    <div class="col-lg-12 shadow-sm border rounded-0 bg-light mt-2">
                        <h5 class="mt-2">Measurements and work area space this is for guidance only.</h5>
                        <h5><u>Desk / Workstation / Lighting</u></h5>
                        <p>
                            Floor to underside of desk – 66 to 73 cms <br>
                            Foot room from front to back of desk at floor level – at least 60cms, and foot area clear <br>
                            Depth of desk from front to back – at least 60cms, ideally 80cms <br>
                            Width of desk (side to side) – at least 120cms, ideally 160cms <br>
                            Space available in front of keyboard for wrist support – 5 to 10cms <br>
                            Light reading (LUX) ideally 200 lux – minimum 100 lux <br>
                            Work space – 11.3 cubic meters per person <br>
                            These are general information. <br>
                        </p>
                    </div>
                    
                </div>
                
                
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
                                
                                <table class="table table-bordered table-striped">
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
                                                <h6 class="mb-3">Do you do any stretching exercises during the day to prevent muscular tension? <input type="radio" class="custom-checkbox" checked  >  {{$opms->exercise}}</h6>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="text-align: left" colspan="6">
                                                <h6 class="mb-3"> Would you like to be taught some exercises? <input type="radio" class="custom-checkbox" checked >  {{$opms->taught_exercise}}</h6>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-lg-12 shadow-sm border rounded-0 bg-light p-4">
                        <h4>Any other issues - for Managers to action: <span style="color: red"> This is line manager area</span></h4>
                        <p><b>Reviewed by H&S Team</b> - Abdullah Mamun <br>
                        
                            Date: need to know <br>
                            One to one review.
                        </p>


                        <p><b>Now you have completed the self-assessment, print a copy and save the document.
                            Pass (hard copy) or send the document electronically to your manager or health and safety
                            co-ordinator. <br>
                            NB: it is important that you discuss any actions that need to be taken and ensure a record is
                            kept of the said action agreed and timescales for completion. Closure of actions must be
                            documented and signed off. <br>
                            
                            For further guidance on DSE please see the full policy at</b> <a href="https://sashnet.sash.nhs.uk/application/files/6915/5179/6627/DSE_2018_final_for_ratification.pdf">https://sashnet.sash.nhs.uk/application/files/6915/5179/6627/DSE_2018_final_for_ratification.pdf</a> </p>
                        
                        
                    </div>
                </div>


                <div class="row mt-2">
                    <div class="col-lg-12 shadow-sm border rounded-0 bg-light p-4">
                        <h4>DSE Risk Assessment Action Plan</h4>
                        <h6>To be completed by Manager / Health and Safety Lead and DSE User</h6>
                        
                        <table class="table table-bordered table-striped p-2">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Degree of risk</th>
                                    <th>Action needed to be taken to <br>
                                        reduce risks <br>
                                        whilst working with DSE</th>
                                    <th>Review Date</th>
                                    <th>Date Achieved</th>
                                    <th>Degree Of risk</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> @if (isset($oldschedule->start_date)) {{$oldschedule->start_date}} @else {{$oldschedule->end_date}} @endif</td>
                                    <td>{{$oldschedule->initial_risk}}</td>
                                    <td>{{$oldschedule->comment}}</td>
                                    <td>{{$newschedule->end_date}}</td>
                                    <td>{{$oldschedule->compiled_date}}</td>
                                    <td>{{$oldschedule->risk_rating_point}}</td>
                                </tr>
                            </tbody>
                        </table>


                        <p><b>User's name</b></p>
                        <p><b> Line Manager's name </b></p>
                        <p><b> Department </b></p>
                        
                        
                    </div>
                </div>


                <div class="row mt-2">
                    
                    <div class="col-lg-12 shadow-sm border rounded-0 bg-light ">
                        
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Risk factors</th>
                                    <th>Conversation</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($comments as $key => $assanswer)
                                
                                    
                                <tr>
                                    <td>{{ $assanswer->question->question }}
                                        <div>
                                            <img src="{{ asset('images/question/'.$assanswer->question->image) }}" class="img-fluid" alt="">
                                        </div>
                                    </td>
                                    <td style="width: 70%" class="p-2">  
                                        @foreach ($assanswer->assesmentAnswerComments as $comment)
                                                @if ($comment->created_by == "User")
                                                    <div class="row">
                                                        <div class="col-lg-8 alert alert-secondary  rounded-3 text-dark  align-items-right">{{$comment->comment}}
                                                            <br>
                                                        <small>Date: {{$comment->date}}</small>
                                                        </div>
                                                        <div class="col-lg-4"></div>
                                                    </div>
                                                @else

                                                    <div class="row">
                                                        <div class="col-lg-4"></div>
                                                        <div class="col-lg-8 alert alert-secondary text-start rounded-3 text-dark">{{$comment->comment}}
                                                            <br>
                                                            <small>Date: {{$comment->date}}</small>
                                                        </div>
                                                    </div>
                                                    
                                                @endif
                                            @endforeach
                                    </td>
                                </tr>
                                
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>


                




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