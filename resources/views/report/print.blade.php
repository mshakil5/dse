
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html">
    <title>Assesment Report</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css')}}">
    <script>
        setTimeout(function () {
            window.print();
        }, 800);
    </script>
    <style>
        @media print {
            
            @page {
                margin: 80px auto; /* imprtant to logo margin */
            }

            html, body {
                margin: 50 0 50 0;
                padding: 0;
                font-size: 12px;
                font-family: Arial, Helvetica;
            }

            #printContainer {
                width: 250px;
                margin: auto;
                /*text-align: justify;*/
            }

            .text-center {
                text-align: center;
            }
            .text-right {
                text-align: right;
            }

            /* body{
                font-family: Arial, Helvetica;
            } */
        }
    </style>
    
</head>

<body>


    <section class="invoice">
        <div class="container-fluid p-0">
            <div class="invoice-body py-5 position-relative">

                <div  class="row overflow" style="position:fixed; top:0; width:100%; ">
                    <table style="width: 100%;">
                        <tbody>
                            <tr>
                                <td colspan="2" class="" style="border :0px solid #dee2e6;width:50%;">
                                    <div class="col-lg-2" style="flex: 2; text-align: left;">
                                        
                                    </div>
                                </td>
                                <td colspan="2" class="" style="border :0px solid #dee2e6 ;width:50%;"></td>
                                <td colspan="2" class="" style="border :0px solid #dee2e6 ;">
                                    <div class="col-lg-2" style="flex: 2; text-align: right;">
                                        <img src="{{ asset('nhs.jpg')}}" width="220px" alt="">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="" style="border :0px solid #dee2e6;width:25%;">
                                </td>
                                <td colspan="2" class="" style="border :0px solid #dee2e6 ;width:50%;"></td>
                                <td colspan="2" class="" style="border :0px solid #dee2e6 ;">
                                </td>
                            </tr>
                        </tbody>
                        
                    </table>
                </div>

                <div style="max-width: 1170px; margin: 40px auto;">
                    
                    <div class="row">
                        <div class="col-lg-12  p-4 rounded-0 bg-light pt-0">
                            <div class="row">
                                <div class="col-lg-12  d-flex align-items-center justify-content-center">
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


                        
                        <div class="col-lg-12 rounded-0 bg-light ">
                            
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

                        
                        <div class="col-lg-12  mt-2">
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
                        <div class="col-lg-12">
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
                                                            
                                                            <small>Date:{{$heathcmt->date}}</small>
                                                        </div>  
                                                        @endif
                                                        @endforeach
                                                        
                                                    </div>
                                                    @endif
                                                    
                                                    <div id="replycheckitem"></div>
                                                    
                                                    <div class="cmntermsgcheckitem"></div>
                                                    <div class="col-lg-12" id="replycmnt">
                                                        <textarea id="commentcheckitem" class="form-control" placeholder="Comments Here"></textarea>
                                                    </div>
                                                    <div class="col-lg-12" id="replybtn">
                                                        <div class="row py-3 ">
                                                            <div class="col-lg-5 d-flex align-items-center">
                                                                <button type="button" class="btn btn-warning d-flex align-items-center addOpmsComment" catname="checkitem" opmsname="question" solved="0" prgmnumber="{{$data->program_number}}"> <iconify-icon icon="akar-icons:check-box-fill" class="me-1"></iconify-icon> send
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
                                                            <small>Date:{{$heathcmt->date}}</small>
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
                                                            <small>Date:{{$heathcmt->date}}</small>
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

                    <div class="row my-4">
                        <div class="col-lg-12 p-4">
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


                    <div class="row mt-5">
                        <div class="col-lg-12">
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
                                        <td>{{$oldschedule->achieve_date}}</td>
                                        <td>{{$oldschedule->risk_rating_point}}</td>
                                    </tr>
                                </tbody>
                            </table>


                            {{-- <p><b>User's name: </b>{{$user->name}}</p>
                            <p><b> Line Manager's name: </b>{{\App\Models\User::where('id', $assesment->line_manager_id)->first()->name}}</p>
                            <p><b> Department: </b>{{$department->name}}</p> --}}
                            
                            
                        </div>
                    </div>


                    <div class="row mt-2">
                        
                        <div class="col-lg-12 ">
                            
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
                                        <td>{{ $assanswer->question->question }} </td>
                                        <td style="width: 70%" class="p-2">  
                                            @foreach ($assanswer->assesmentAnswerComments as $comment)
                                                    @if ($comment->created_by == "User")
                                                        <p><b>{{$comment->created_by}}: </b>  {{$comment->comment}}
                                                            <br>
                                                        <small>Date: {{$comment->date}}</small></p>
                                                    @else

                                                        <div class="row">
                                                            <div class="col-lg-4"></div>
                                                            <div class="col-lg-8 text-dark"><b>{{$comment->created_by}}: </b> {{$comment->comment}}
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
                <div class="">
                    <div class="row overflow" style="position:fixed; bottom:0; width:100%; ">
                        
                    
                        <table style="width:100%;border-collapse: collapse;">
                            <thead>
                                <tr>
                                    <th style="width: 25%"></th>
                                    <th style="width: 8%"></th>
                                    <th style="width: 22%"></th>
                                    <th style="width: 9%"></th>
                                    <th style="width: 16%"></th>
                                    <th style="width: 20%"></th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td style="width: 20%; text-align:right;" colspan="2">
                                        <img src="{{ asset('footer.jpg')}}" width="220px" alt="">
                                    </td>
                                    <td style="width: 15%; text-align:left;" colspan="2"></td>
                                    <td style="width: 15%; text-align:left;" colspan="2">
                                    <h5 class="text-success">An Associated University Hospital of <br>
                                        Brighton and Sussex Medical School</h5>
                                    </td>
                                </tr>
                                
                            </tbody>
                            
                        </table>
                    </div>

                </div>
            </div>
            
        </div>
    </section>


</body>
</html>

