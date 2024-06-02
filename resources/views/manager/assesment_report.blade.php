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
                            <div class="col-6 col-sm-6 col-lg-6">
                                <div class="brand p-3">
                                    <img src="{{ asset('nhs.png')}}" width="200px" alt="">
                                </div>
                            </div>
                            <div class="col-6 col-sm-6 col-lg-6 d-flex align-items-center justify-content-end">
                                <a href="{{route('assesment.print', $assesment->program_number)}}" class="btn btn-secondary d-flex align-items-center m-2" >
                                    <iconify-icon class="text-primary" icon="bi:plus"></iconify-icon> Print
                                </a>

                                <a href="{{route('manager.dashboard')}}" class="btn btn-sm btn-danger d-block float-end fs-5 d-flex align-items-center gap-2"> <iconify-icon icon="majesticons:door-exit" class=""></iconify-icon>
                                    Exit
                                </a>
                            </div>
                        </div>


                        
                        <div class="row mt-2">
                            <div class="col-lg-12 p-4">

                                <h4>User Information</h4>
                                <p>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 2048 2048"><path fill="black" d="M1792 993q60 41 107 93t81 114t50 131t18 141q0 119-45 224t-124 183t-183 123t-224 46q-91 0-176-27t-156-78t-126-122t-85-157H128V128h256V0h128v128h896V0h128v128h256zM256 256v256h1408V256h-128v128h-128V256H512v128H384V256zm643 1280q-3-31-3-64q0-86 24-167t73-153h-97v-128h128v86q41-51 91-90t108-67t121-42t128-15q100 0 192 33V640H256v896zm573 384q93 0 174-35t142-96t96-142t36-175q0-93-35-174t-96-142t-142-96t-175-36q-93 0-174 35t-142 96t-96 142t-36 175q0 93 35 174t96 142t142 96t175 36m64-512h192v128h-320v-384h128zM384 1024h128v128H384zm256 0h128v128H640zm0-256h128v128H640zm-256 512h128v128H384zm256 0h128v128H640zm384-384H896V768h128zm256 0h-128V768h128zm256 0h-128V768h128z"/></svg> <b>Date of Assessment: {{ \Carbon\Carbon::parse($assesment->date)->format('d/m/Y')}} </b> 
                                    <br>

                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 2048 2048"><path fill="black" d="M1792 993q60 41 107 93t81 114t50 131t18 141q0 119-45 224t-124 183t-183 123t-224 46q-91 0-176-27t-156-78t-126-122t-85-157H128V128h256V0h128v128h896V0h128v128h256zM256 256v256h1408V256h-128v128h-128V256H512v128H384V256zm643 1280q-3-31-3-64q0-86 24-167t73-153h-97v-128h128v86q41-51 91-90t108-67t121-42t128-15q100 0 192 33V640H256v896zm573 384q93 0 174-35t142-96t96-142t36-175q0-93-35-174t-96-142t-142-96t-175-36q-93 0-174 35t-142 96t-96 142t-36 175q0 93 35 174t96 142t142 96t175 36m64-512h192v128h-320v-384h128zM384 1024h128v128H384zm256 0h128v128H640zm0-256h128v128H640zm-256 512h128v128H384zm256 0h128v128H640zm384-384H896V768h128zm256 0h-128V768h128zm256 0h-128V768h128z"/></svg> <b>Review Date: {{ \Carbon\Carbon::parse($oldschedule->updated_at)->format('d/m/Y')}} </b> 
                                    <br>

                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="black" d="M15.71 12.71a6 6 0 1 0-7.42 0a10 10 0 0 0-6.22 8.18a1 1 0 0 0 2 .22a8 8 0 0 1 15.9 0a1 1 0 0 0 1 .89h.11a1 1 0 0 0 .88-1.1a10 10 0 0 0-6.25-8.19M12 12a4 4 0 1 1 4-4a4 4 0 0 1-4 4"/></svg> <b>User Name: {{ $user->name }}</b> <br>

                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="black" d="M4.616 20q-.691 0-1.153-.462T3 18.384V8.616q0-.691.463-1.153T4.615 7H9V5.615q0-.69.463-1.153T10.616 4h2.769q.69 0 1.153.462T15 5.615V7h4.385q.69 0 1.152.463T21 8.616v9.769q0 .69-.463 1.153T19.385 20zm0-1h14.769q.23 0 .423-.192t.192-.424V8.616q0-.231-.192-.424T19.385 8H4.615q-.23 0-.423.192T4 8.616v9.769q0 .23.192.423t.423.192M10 7h4V5.615q0-.23-.192-.423T13.385 5h-2.77q-.23 0-.423.192T10 5.615zM4 19V8z"/></svg> <b> Working Hours: {{$data->job_type}}</b>
                                    <br>

                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="black" d="M4.616 20q-.691 0-1.153-.462T3 18.384V8.616q0-.691.463-1.153T4.615 7H9V5.615q0-.69.463-1.153T10.616 4h2.769q.69 0 1.153.462T15 5.615V7h4.385q.69 0 1.152.463T21 8.616v9.769q0 .69-.463 1.153T19.385 20zm0-1h14.769q.23 0 .423-.192t.192-.424V8.616q0-.231-.192-.424T19.385 8H4.615q-.23 0-.423.192T4 8.616v9.769q0 .23.192.423t.423.192M10 7h4V5.615q0-.23-.192-.423T13.385 5h-2.77q-.23 0-.423.192T10 5.615zM4 19V8z"/></svg> <b> Work Station Number: {{ $data->work_station_number}}</b>
                                    <br>



                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 48 48"><path fill="#c5cae9" d="M42 42H6V9l18-7l18 7z"/><path fill="#9fa8da" d="M6 42h36v2H6z"/><path fill="black" d="M20 35h8v9h-8z"/><path fill="#1565c0" d="M31 27h6v5h-6zm-10 0h6v5h-6zm-10 0h6v5h-6zm20 8h6v5h-6zm-20 0h6v5h-6zm20-16h6v5h-6zm-10 0h6v5h-6zm-10 0h6v5h-6zm20-8h6v5h-6zm-10 0h6v5h-6zm-10 0h6v5h-6z"/></svg> <b>Department: {{ $department->name }}</b> <br>

                                    
                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="black" d="M15 6a3.001 3.001 0 0 1-2 2.83V11h3a3 3 0 0 1 3 3v1.17a3.001 3.001 0 1 1-2 0V14a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v1.17a3.001 3.001 0 1 1-2 0V14a3 3 0 0 1 3-3h3V8.83A3.001 3.001 0 1 1 15 6m-3-1a1 1 0 1 0 0 2a1 1 0 0 0 0-2M6 17a1 1 0 1 0 0 2a1 1 0 0 0 0-2m12 0a1 1 0 1 0 0 2a1 1 0 0 0 0-2"/></g></svg> <b>Division: {{$division->name}}</b>
                                    <br>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><g fill="none" stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" color="black"><path d="M20 22v-5c0-1.886 0-2.828-.586-3.414S17.886 13 16 13l-4 9l-4-9c-1.886 0-2.828 0-3.414.586S4 15.114 4 17v5"/><path d="m12 15l-.5 4l.5 1.5l.5-1.5zm0 0l-1-2h2zm3.5-8.5v-1a3.5 3.5 0 1 0-7 0v1a3.5 3.5 0 1 0 7 0"/></g></svg> <b>Line manager: {{ \App\Models\User::where('id', $oldschedule->line_manager_id)->first()->name}}</b>
                                </p>


                                <h4>DSE Risk Assessment Action Plan - Manager Action </h4>
                                <h6>To be completed by Manager / Health and Safety Lead</h6>
                                
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
                                            <td>{{$oldschedule->achieve_date}}</td>
                                            <td>{{$oldschedule->risk_rating_point}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- health comment here --}}

                        <div class="row mt-2">
                            <div class="col-lg-12  ">
                                <h4>Occupational Health Review and Action </h4>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Risk factors</th>
                                            <th style="text-align: center">Conversation</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                            {{-- manager and health comment  --}}
                                            @if (isset($chkboxitemNone) && $chkboxitemNone > 0)
                                            <tr>
                                                
                                                <td><h6 class="mb-3"> Health experience </h6></td>
                                                <td style="text-align: left">
                                                    @if (isset($otheranscmmnts))
                                                    <div class="row"> 
                                                        @foreach ($otheranscmmnts as $heathcmt)
                                                        @if ($heathcmt->catname == "checkitem")
                                                        <div class="col-lg-12 p-2 alert alert-secondary text-start rounded-3 text-dark">
                                                            <b> {{$heathcmt->created_by}}: </b>{{$heathcmt->comment}} <br>
                                                            <small>Date:{{$heathcmt->date}}</small>
                                                        </div>  
                                                        @endif
                                                        @endforeach
                                                    </div>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endif
                                            {{-- manager and health comment end --}}


                                            {{-- cmmnt start  --}}
                                            {{-- manager and health comment  --}}
                                            @if (isset($exerciseAns) && $exerciseAns > 0)
                                            <tr>
                                                <td style="text-align: left">
                                                    <h6>Do you do any stretching exercises during the day to prevent muscular tension? </h6>
                                                </td>
                                                <td style="text-align: left">
                                                    @if (isset($otheranscmmnts))
                                                    <div class="row"> 
                                                        @foreach ($otheranscmmnts as $heathcmt)
                                                        @if ($heathcmt->catname == "exercise")
                                                        <div class="col-lg-12 alert alert-secondary text-start rounded-3 text-dark">
                                                            <b> {{$heathcmt->created_by}}: </b>{{$heathcmt->comment}} <br>
                                                            <small>Date:{{$heathcmt->date}}</small>
                                                        </div>  
                                                        @endif
                                                        @endforeach
                                                    </div>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endif
                                            {{-- cmmnt end  --}}

                                            {{-- cmmnt start  --}}
                                            @if (isset($texerciseAns) && $texerciseAns > 0)
                                                
                                            <tr>
                                                <td style="text-align: left">
                                                    <h6> Would you like to be taught some exercises? </h6>
                                                </td>
                                                <td style="text-align: left">
                                                    @if (isset($otheranscmmnts))
                                                    <div class="row"> 
                                                        @foreach ($otheranscmmnts as $heathcmt)
                                                        @if ($heathcmt->catname == "taught_exercise")
                                                        <div class="col-lg-12 alert alert-secondary text-start rounded-3 text-dark">
                                                            <b> {{$heathcmt->created_by}}: </b>{{$heathcmt->comment}} <br>
                                                            <small>Date:{{$heathcmt->date}}</small>
                                                        </div>  
                                                        @endif
                                                        @endforeach
                                                    </div>
                                                    @endif
                                                    
                                                </td>
                                            </tr>
                                            @endif
                                            {{-- cmmnt end  --}}

                                            @if (isset($healthans)) 
                                            
                                            <tr>
                                                <td style="text-align: left">
                                                    <h6>Do you have any other health concern or comments ? </h6>

                                                    <h6 class="mb-3">@foreach ($healthans as $newqn) @if ($newqn->result == "Yes" && $newqn->catname == "newqn") Question: {{$newqn->newquestion}} @endif @endforeach</h6>
                                                </td>
                                                <td style="text-align: left">
                                                    @if (isset($otherqnAns) && $otherqnAns > 0)
                                                            @if (isset($otheranscmmnts))
                                                            <div class="row"> 
                                                                @foreach ($otheranscmmnts as $heathcmt)
                                                                @if ($heathcmt->catname == "newqn")
                                                                <div class="col-lg-12 p-2 alert alert-secondary text-start rounded-3 text-dark">
                                                                    <b> {{$heathcmt->created_by}}: </b>{{$heathcmt->comment}} <br>
                                                                    <small>Date:{{$heathcmt->date}}</small>
                                                                </div>  
                                                                @endif
                                                                @endforeach
                                                            </div>
                                                            @endif
                                                    @endif
                                                    
                                                </td>
                                            </tr>
                                            @endif 

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <h5>
                            NB: it is important that you discuss any actions that need to be taken and ensure a record is kept of the said action agreed and timescales for completion. Closure of actions must be documented and signed off. For further guidance on DSE please see the full policy.
                        </h5>

                        <div class="row">
                            <div class="col-lg-12 border-md-end d-flex align-items-center justify-content-center">
                                <div class="py-3">
                                    
                                    
                                    <h4 class="text-danger text-left ">Display screen equipment (DSE) workstation self-assessment</h4>
                                        <p>
                                            You are asked to complete the enclosed form to assess that you are using your computer and workstation in the ‘optimum’ way, so that you suffer no ill-effects from your work.  Read the ‘things to consider’ column and assess yourself against the photographs.  Try to adjust your position or items of equipment.  Once you have completed your form, contact your manager to discuss your assessment who will complete the right hand column on the form and make additional notes for further action if this is required on the DSE Risk Assessment action plan.
                                        </p>
                                        <p>
                                           <b>DSE </b> = 	visual display unit (VDU) / screen, stand & central processing unit (CPU) / box. <br>
                                           <b>Workstation </b>  = 	Dictaphone, telephone, table, chair, document holder, footstool, mouse.
                                        </p>
                                        
                                        


                                        
                                    <div class="row mt-3">
                                        {{-- <div class="col-lg-12">
                                            <h6 class="mb-3">If part time how many hours a week do you work?  {{$data->part_time_work_hour}}</h6>
                                        </div> --}}
                                
                                        <div class="col-lg-12 mb-1">
                                            <h6 class="mb-3">Do you normally use your DSE for continuous spells of an hour or more at a time?
                                            </h6>
                                            <label class="mx-2">
                                                <input type="radio" name="work_hour" class="form-check-input me-1" value="Yes" @if(isset($determiningAnswer)) @if ($determiningAnswer->work_hour == "Yes") checked @endif @endif>Yes
                                            </label>
                                            <label class="mx-2">
                                                <input type="radio" name="work_hour" class="form-check-input me-1" value="No" @if(isset($determiningAnswer)) @if ($determiningAnswer->work_hour == "No") checked @endif @endif>No
                                            </label>
                                        </div>
                                
                                        <div class="col-lg-12 mb-1">
                                            <h6 class="mb-3">Do you use Medicine Administration Workstation on Wheels (WoW) throughout your shift?     
                                            </h6>
                                            <label class="mx-2">
                                                <input type="radio" name="wow_system" class="form-check-input me-1" value="Yes"@if(isset($determiningAnswer)) @if ($determiningAnswer->wow_system == "Yes") checked @endif @endif>Yes
                                            </label>
                                            <label class="mx-2">
                                                <input type="radio" name="wow_system" class="form-check-input me-1" value="No" @if(isset($determiningAnswer)) @if ($determiningAnswer->wow_system == "No") checked @endif @endif>No
                                            </label>
                                        </div>
                                
                                        <div class="col-lg-12 mb-1">
                                            <h6 class="mb-3">How many hours on average daily do you spend using your DSE? {{$data->average_using_dse}}</h6>
                                        </div>
                                
                                        <div class="col-lg-12 mb-1">
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

                                            <label for="others" class="mx-2">
                                                <input id="others" type="checkbox" name="software[]" class="form-check-input me-1" value="Others" @if (isset($data->software)) @foreach (json_decode($data->software) as $software) @if ($software == "Others") checked @endif @endforeach @endif>Others
                                            </label>
                                            <label class="">
                                                <input id="others_software" type="text" name="others_software" class="form-control" placeholder="Somerset, EPT, Cerner" value="@if(isset($data)){{$data->others_software}}@endif">
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

                                @foreach ($category as $key => $category)

                                <tr>
                                    <td colspan="4">
                                        <span class="px-2 text-success">{{$category->name}}
                                        </span>
                                    </td>
                                </tr>

                                @foreach ($category->question as $question)
                                    
                                <tr>
                                    <td>{{ $question->question }}
                                        <div class="py-4">
                                            <img src="{{ asset('images/question/'.$question->image) }}" class="img-fluid" alt="">
                                        </div>
                                    </td>
                                    <td>
                                        
                                        <input type="radio" class="custom-checkbox"  value="Yes" {{ $question->assesmentAnswers->answer == 'Yes' ? 'checked' : '' }} >
                                    </td>
                                    <td>
                                        <input type="radio" class="custom-checkbox"  value="Yes" {{ $question->assesmentAnswers->answer == 'No' ? 'checked' : '' }} >
                                    </td>
                                    <td>{{ $question->tips }}</td>
                                </tr>
                                @endforeach



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
                
                

                <h4>Tick to confirm location & type of health problem's experienced</h4>

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

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2 d-none">
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




                <h4>Review Audit Record</h4>
                <div class="row mt-2">
                    <div class="col-lg-12 shadow-sm border rounded-0 bg-light ">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Risk factors</th>
                                    <th style="text-align: center">Conversation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comments as $key => $assanswer)
                                <tr>
                                    <td>{{ $assanswer->question->question }} </td>
                                    <td style="width: 70%" class="p-2">  
                                        @foreach ($assanswer->assesmentAnswerComments as $comment)
                                            @if ($comment->created_by == "User")
                                                <div class="row">
                                                    <div class="col-lg-8 alert alert-secondary  rounded-3 text-dark  align-items-right"><b>{{$comment->created_by}}:</b>  {{$comment->comment}}
                                                        <br>
                                                    <small>Date: {{$comment->date}}</small>
                                                    </div>
                                                    <div class="col-lg-4"></div>
                                                </div>
                                            @else
                                                <div class="row">
                                                    <div class="col-lg-4"></div>
                                                    <div class="col-lg-8 alert alert-secondary text-start rounded-3 text-dark"><b>{{$comment->created_by}}: </b> {{$comment->comment}}
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

    
</script>
    
@endsection