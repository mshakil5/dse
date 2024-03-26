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
                                <h2 class="text-danger text-left ">Display screen equipment (DSE) workstation
                                    self-assessment</h2>
                                <p>
                                    You are asked to complete the enclosed form to assess that you are using your
                                    computer and workstation in the ‘optimum’ way, so that you suffer no ill-effects
                                    from your work. Read the ‘things to consider’ column and assess yourself against the
                                    photographs. Try to adjust your position or items of equipment. Once you have
                                    completed your form, contact your manager to discuss your assessment who will
                                    complete the right hand column on the form and make additional notes for further
                                    action if this is required on the DSE Risk Assessment action plan.
                                </p>
                                <p>
                                    DSE = visual display unit (VDU) / screen, stand & central processing unit (CPU) /
                                    box. <br>
                                    Workstation = Dictaphone, telephone, table, chair, document holder, footstool,
                                    mouse.
                                </p>


                                {{-- <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                </p> --}}
                                <form action="{{route('user.determinigQnStore')}}" method="POST">
                                    @csrf
                                <div class="d-flex gap-3 flex-wrap justify-content-center mt-4">

                                    <div class="dropdown">
                                        <label for=""> Line Manager</label> <br>
                                        <select name="line_manager" id="line_manager" class="btn btn-secondary dropdown-toggle select2  @error('line_manager') is-invalid @enderror">
                                            <option value="">Line Manager</option>
                                            @foreach ($linemanagers as $linemanager)
                                                <option value="{{$linemanager->id}}" @if (isset($data))
                                                    @if ($data->line_manager_id == $linemanager->id) selected @endif
                                                @endif>{{$linemanager->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="dropdown">
                                        <label for=""> Department</label> <br>
                                        <select name="department_id" id="department_id" class="btn btn-secondary dropdown-toggle select2  @error('department_id') is-invalid @enderror">
                                            <option value="">Department</option>
                                            @foreach ($departments as $department)
                                                <option value="{{$department->id}}"  @if (isset($data))
                                                    @if ($data->department_id == $department->id) selected @endif
                                                @endif>{{$department->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="dropdown">
                                        <label for=""> Division</label> <br>
                                        <select name="division_id" id="division_id" class="btn btn-secondary dropdown-toggle select2 @error('division_id') is-invalid @enderror">
                                            <option value="">Division</option>
                                            @foreach ($divisions as $division)
                                                <option value="{{$division->id}}"  @if (isset($data))
                                                    @if ($data->division_id == $division->id) selected @endif
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
                <div class="col-lg-12 shadow-sm border rounded-0 bg-light ">
                    <div class="row pt-5 px-4">

                        

                            <div class="col-lg-12 mb-4">
                                <h6 class="mb-3">1. Do you work with DSE for 1 hrs or more ? </h6>
                                <label for="yes" class="mx-2">
                                    <input id="work_hour_yes" type="radio" name="work_hour"  class="form-check-input me-1" value="Yes" @if (isset($data)) @if ($data->work_hour == "Yes") checked @endif @endif>Yes
                                </label>
                                <label for="no" class="mx-2">
                                    <input id="work_hour_no" type="radio" name="work_hour" class="form-check-input me-1" value="No" @if (isset($data)) @if ($data->work_hour == "No") checked @endif @endif>No
                                </label>
                            </div>
                            <div class="col-lg-12 mb-4">
                                <h6 class="mb-3">2. Do you use WoW system through your shift ? </h6>
                                <label for="yes" class="mx-2">
                                    <input id="wow_system_yes" type="radio" name="wow_system" class="form-check-input me-1" value="Yes" @if (isset($data)) @if ($data->wow_system == "Yes") checked @endif @endif>Yes
                                </label>
                                <label for="no" class="mx-2">
                                    <input id="wow_system_no" type="radio" name="wow_system" class="form-check-input me-1" value="No" @if (isset($data)) @if ($data->wow_system == "No") checked @endif @endif>No
                                </label>

                                


                            </div>
                            @if (empty($data))
                            <div class="col-lg-12">
                                <div class="row py-3 ">
                                    <div class="col-lg-5 d-flex align-items-center">
                                        <button type="submit" class="btn btn-warning d-flex align-items-center"> <iconify-icon icon="akar-icons:check-box-fill" class="me-1"></iconify-icon> Save
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
</section>



@endsection

@section('script')



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

});

</script>
@endsection