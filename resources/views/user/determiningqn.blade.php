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
                                <h2 class="text-danger text-center ">Dislay screen equipment assesment</h2>
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                </p>
                                <div class="d-flex gap-3 flex-wrap justify-content-center mt-4">
                                    <input type="hidden" id="assesment_id" name="assesment_id" value="@if(isset($assesment)){{$assesment->id}}@endif">
                                    <div class="dropdown">
                                        <select name="line_manager" id="line_manager" class="btn btn-secondary dropdown-toggle select2">
                                            <option value="">Line Manager</option>
                                            @foreach ($linemanagers as $linemanager)
                                                <option value="{{$linemanager->id}}" @if (isset($assesment))
                                                    @if ($assesment->line_manager_id == $linemanager->id) selected @endif
                                                @endif>{{$linemanager->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="dropdown">
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
                                        <select name="division_id" id="division_id" class="btn btn-secondary dropdown-toggle select2">
                                            <option value="">Division</option>
                                            @foreach ($divisions as $division)
                                                <option value="{{$division->id}}"  @if (isset($assesment))
                                                    @if ($assesment->division_id == $division->id) selected @endif
                                                @endif>{{$division->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="row ">
                <div class="col-lg-8 shadow-sm border rounded-0 bg-light ">
                    <div class="row pt-5 px-4">
                        <div class="col-lg-12 mb-4">
                            <h6 class="mb-3">1.1 Is threr enough space for your desk for all of your equipment ?
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
                        <div class="collapse" id="collapseExample">
                            <div class="col-lg-12 mb-4">
                                <h6 class="mb-3">1.1 Is threr enough space for your desk for all of your equipment ?
                                </h6>
                                <div class="col-lg-12">
                                    <textarea name="" class="form-control" placeholder="Comments Here"></textarea>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row py-3 ">
                                        <div class="col-lg-5 d-flex align-items-center">
                                            
                                        </div>
                                        <div class="col-lg-7 d-flex gap-3 justify-content-end">
                                             
                                            <button class="btn btn-warning d-flex align-items-center"> <iconify-icon icon="akar-icons:check-box-fill" class="me-1"></iconify-icon> send
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-8 p-2 alert alert-secondary   mb-3 rounded-3 text-dark">user side message</div>
                          </div>
                          <div class="row">
                              <div class="col-lg-8 p-2 alert alert-secondary text-start mb-3 rounded-3 text-dark">line manager side message</div>
                            <div class="col-lg-4"></div>
                          </div>
                          <div class="row">
                            <div class="col-lg-6"></div>
                            <div class="col-lg-6 p-2 alert alert-secondary   mb-3 rounded-3 text-dark">user side message</div>
                          </div>
                          <div class="row">
                              <div class="col-lg-6 p-2 alert alert-secondary text-start mb-3 rounded-3 text-dark">line manager side message</div>
                            <div class="col-lg-6"></div>
                          </div>
                        <!-- <div class="col-lg-12 mb-4">
                            <h6 class="mb-3"><iconify-icon class="text-warning"
                                    icon="ci:arrow-sub-down-right"></iconify-icon> 1.1.1 Is threr enough space for
                                your desk for all of your equipment ?</h6>
                            <label for="yes" class="mx-2">
                                <input id="yes" type="radio" name="equipment" class="form-check-input me-1"
                                    value="yes">Yes
                            </label>
                            <label for="no" class="mx-2">
                                <input id="no" type="radio" name="equipment" class="form-check-input me-1"
                                    value="yes">No
                            </label>
                        </div> -->
                        
                        <div class="col-lg-12">
                            <textarea name="" class="form-control" placeholder="Comments Here"></textarea>
                        </div>
                        <div class="col-lg-12">
                            <div class="row py-3 ">
                                <div class="col-lg-5 d-flex align-items-center">
                                    <small class="text-muted mb-0">76 charachter remaining</small>
                                </div>
                                <div class="col-lg-7 d-flex gap-3 justify-content-end">
                                    <button class="btn btn-success d-flex align-items-center"> <iconify-icon
                                            icon="akar-icons:check-box-fill" class="me-1"></iconify-icon> accept as
                                        resolved</button>
                                    <button class="btn btn-warning d-flex align-items-center"> <iconify-icon
                                            icon="akar-icons:check-box-fill" class="me-1"></iconify-icon> send
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 shadow-sm border rounded-0 bg-light">
                    <div class="py-4">
                        <ol class="custom-list">
                            <li><a href="">1. work equipment </a></li>
                            <li><a href="">2. Chair </a></li>
                            <li><a href="">3. Standing desk </a></li>
                            <li><a href="">4. Visual & screens</a></li>
                            <li><a href="">5. Multiple screens</a></li>
                            <li><a href="">6. Portable Devices </a></li>
                            <li><a href="">7. Additional Concerns </a></li>
                        </ol>
                    </div>
                </div>
            </div>


            
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