@extends('layouts.master')
@section('content')

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
                            <a href="{{route('user.dashboard')}}" class="btn btn-sm btn-danger d-block float-end fs-5 d-flex align-items-center gap-2"> <iconify-icon icon="majesticons:door-exit" class=""></iconify-icon>
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
                                    <input type="hidden" id="assesment_id" name="assesment_id" value="@if(isset($assesment)){{$assesment->id}}@endif">
                                    <div class="dropdown">
                                        <label for="">Work Station Number</label>
                                        <input type="number" id="work_station_number" name="work_station_number" class="form-control">
                                    </div>
                                    <div class="dropdown">
                                        <label for="">Department</label><br>
                                        <select name="department_id" id="department_id" class="btn btn-secondary dropdown-toggle select2">
                                            <option value="">Department</option>
                                            @foreach ($departments as $department)
                                                <option value="{{$department->id}}"  @if (isset($assesment))
                                                    @if ($assesment->department_id == $department->id) selected @endif
                                                @endif>{{$department->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="dropdown">
                                        <label for="user_name">User Name</label>
                                        <input type="text" id="user_name" name="user_name" class="form-control" value="{{Auth::user()->name}}" readonly>
                                    </div>

                                    <div class="dropdown">
                                        <label for="date">Date</label>
                                        <input type="date" id="date" name="date" class="form-control" value="{{ date('Y-m-d')}}" readonly>
                                    </div>

                                </div>



                                <div class="d-flex gap-3  mt-4">

                                    <div class="row">
                                        <p for="">Are you Full time <input type="radio" class="form-check-input" name="job_type" id="" value="full_time"> or Part time <input type="radio" class="form-check-input" name="job_type" id="" value="part_time"> ?  <br> 
                                            <span style="color: red"> *** If part time how many hours a week do you work: 27.5  hours.</span>
                                        </p>
                                    </div>

                                </div>

                                
                                <div class="row">

                                    <div class="col-lg-12 mb-4">
                                        <h6 class="mb-3">Do you normally use your DSE for continuous spells of an hour or more at a time?
                                        </h6>
                                        <label for="yes" class="mx-2">
                                            <input id="yes" type="radio" name="equipment" class="form-check-input me-1"
                                                value="yes">Yes
                                        </label>
                                        <label for="no" class="mx-2">
                                            <input id="no" type="radio" data-bs-toggle="collapse" data-bs-target="#collapseExample" name="equipment" class="form-check-input me-1"
                                                value="yes">No
                                        </label>
                                    </div>

                                    <div class="col-lg-12 mb-4">
                                        <h6 class="mb-3">If ‘Yes’ do you do this more or less daily ?     
                                        </h6>
                                        <label for="yes" class="mx-2">
                                            <input id="yes" type="radio" name="equipment" class="form-check-input me-1"
                                                value="yes">Yes
                                        </label>
                                        <label for="no" class="mx-2">
                                            <input id="no" type="radio" data-bs-toggle="collapse" data-bs-target="#collapseExample" name="equipment" class="form-check-input me-1"
                                                value="yes">No
                                        </label>
                                    </div>

                                    <div class="col-lg-6 mb-4">
                                        <h6 class="mb-3">How many hours on average daily do you spend using your DSE?   </h6>
                                        
                                        <input id="yes" type="number" name="equipment" class="form-control me-1" >
                                    </div>

                                    <div class="col-lg-12 mb-4">
                                        <h6 class="mb-3">What Software do you use? </h6>
                                        <label for="yes" class="mx-2">
                                            <input id="yes" type="checkbox" name="equipment" class="form-check-input me-1" value="yes">Word 
                                        </label>
                                        <label for="no" class="mx-2">
                                            <input id="no" type="checkbox" name="equipment" class="form-check-input me-1" value="yes">Excel 
                                        </label>
                                        <label for="no" class="mx-2">
                                            <input id="no" type="checkbox" name="equipment" class="form-check-input me-1" value="yes">Access 
                                        </label>
                                        <label for="no" class="mx-2">
                                            <input id="no" type="checkbox" name="equipment" class="form-check-input me-1" value="yes">PowerPoint 
                                        </label>
                                        <label for="no" class="mx-2">
                                            <input id="no" type="checkbox" name="equipment" class="form-check-input me-1" value="yes">Others 
                                        </label>
                                        <label for="no" class="">
                                            <input id="yes" type="text" name="equipment" class="form-control" placeholder="Somerset, EPT, ERS, Cerner" >
                                        </label>
                                    </div>

                                </div>


                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- @foreach ($questions as $key => $question)
            <div class="row mt-1">
                <div class="col-lg-6 shadow-sm border rounded-0 bg-light d-flex flex-column  justify-content-center align-items-center position-relative">

                    <div class="counter bg-danger">
                        {{$key + 1}}
                    </div>
                    <h3 class="d-block text-left">
                        {{$question->question}}
                    </h3>
                    <div class="d-flex">
                        <label for="yes" class="me-3 fw-bold text-success">
                            YES <input type="radio" name="query{{$question->id}}" class="form-check-input" id="yes{{$question->id}}" data-qid="{{$question->id}}" value="Yes" onclick="toggleFields(this)">
                        </label>
                        <label for="no" class="me-3 fw-bold text-danger">
                            NO <input type="radio" name="query{{$question->id}}" class="form-check-input" id="no{{$question->id}}" data-qid="{{$question->id}}" data-key="{{$key + 1}}" value="No" onclick="toggleFields(this)">
                        </label>
                    </div>

                    <div id="subqnDiv{{$question->id}}">

                    </div>
                    

                </div>
                <div class="col-lg-6 px-0 shadow-sm border rounded-0 bg-light">
                    <img src="{{asset('images/question/'.$question->image)}}" class="img-fluid" alt="">
                </div>

            </div>
            @endforeach --}}


            
        </div>
    </div>
</section>



@endsection

@section('script')
<script>
    function showFields() {
        var id = $(this).attr('qid');
        console.log(id);
        document.getElementById("additionalFields").classList.remove("hidden");
    }

    function hideFields() {
        document.getElementById("additionalFields").classList.add("hidden");
    }

    
</script>

<script>

        //header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        //


        function toggleFields(element) {

            // var del = document.getElementById("delivery");
            // var col = document.getElementById("collection");

            
            var line_manager = $("#line_manager").val();
            var department_id = $("#department_id").val();
            var division_id = $("#division_id").val();
            var assesment_id = $("#assesment_id").val();

            if (line_manager == '') {
                alert('Please, select a line manager!!');
                return;
            }

            if (department_id == '') {
                alert('Please, select a Department!!');
                return;
            }

            if (division_id == '') {
                alert('Please, select a Division!!');
                return;
            }
            
            var ansurl = "{{URL::to('/user/assesment-answer-store')}}";
            var id = element.getAttribute('data-qid');
            var key = element.getAttribute('data-key');
            var value = element.getAttribute('value');

            
            var form_data = new FormData();			
            form_data.append("qid", id);
            form_data.append("answer", value);
            form_data.append("key", key);
            form_data.append("line_manager", line_manager);
            form_data.append("department_id", department_id);
            form_data.append("division_id", division_id);
            form_data.append("assesment_id", assesment_id);

            $.ajax({
                    url:ansurl,
                    method: "POST",
                    type: "POST",
                    contentType: false,
                    processData: false,
                    data:form_data,
                    success: function(d){
                        console.log(d);
                        if (value == "No") {
                            $("#subqnDiv"+id).html(d.subquery);
                        } else {
                            $("#subqnDiv"+id).html("");
                        }
                    },
                    error:function(d){
                        console.log(d);
                    }
                });

            
            
            
            
        }

</script>


<script>
$(document).ready(function() {
    // Select2 Multiple
    $('#division_id').select2({
        placeholder: "Division",
        allowClear: true
    });

    $('#department_id').select2({
        placeholder: "Department",
        allowClear: true
    });

    $('#line_manager').select2({
        placeholder: "Line Manager",
        allowClear: true
    });



    var url = "{{URL::to('/user/add-assesment')}}";
    $("#division_id, #department_id, #line_manager").change(function(){
        var id =  $(this).val();
        var fieldname =  $(this).attr('name');
        var line_manager = $("#line_manager").val();
        var department_id = $("#department_id").val();
        var division_id = $("#division_id").val();
        // console.log(line_manager, department_id, division_id);
        
        $.ajax({
            url: url,
            method: "POST",
            data: {line_manager, department_id, division_id},

            success: function (d) {
                
                $("#assesment_id").val(d.assesmentid);
            },
            error: function (d) {
                console.log(d);
            }
        }); 
            

        
    });
        










});

</script>
@endsection