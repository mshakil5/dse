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

                                <form action="{{route('user.workStationAssesmentStore')}}" method="POST">
                                    @csrf
                                    <div class="d-flex gap-3 flex-wrap justify-content-center mt-4">
                                        <input type="hidden" id="assesment_id" name="assesment_id"
                                            value="@if(isset($assesment)){{$assesment->id}}@endif">
                                        <input type="hidden" id="determinig_answer_id" name="determinig_answer_id"
                                            value="@if(isset($determiningans)){{$determiningans->id}}@endif">
                                        <div class="dropdown">
                                            <label for="">Work Station Number</label>
                                            <input type="number" id="work_station_number" name="work_station_number" class="form-control"
                                                value="{{ old('work_station_number') }}">
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
                                            <p for="">Are you Full time <input type="radio" class="form-check-input" name="job_type" value="Full time"
                                                    {{ old('job_type')=='Full time' ? 'checked' : '' }}> or Part time <input type="radio" id="part_time"
                                                    class="form-check-input" name="job_type" value="Part time" {{ old('job_type')=='Part time'
                                                    ? 'checked' : '' }}> ?
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
                                                <input type="radio" name="continuous_spell" class="form-check-input me-1" value="Yes" {{
                                                    old('continuous_spell')=='Yes' ? 'checked' : '' }}>Yes
                                            </label>
                                            <label class="mx-2">
                                                <input type="radio" name="continuous_spell" class="form-check-input me-1" value="No" {{
                                                    old('continuous_spell')=='No' ? 'checked' : '' }}>No
                                            </label>
                                        </div>
                                
                                        <div class="col-lg-12 mb-4">
                                            <h6 class="mb-3">If ‘Yes’ do you do this more or less daily ?
                                            </h6>
                                            <label class="mx-2">
                                                <input type="radio" name="continuous_spell_time" class="form-check-input me-1" value="Yes" {{
                                                    old('continuous_spell_time')=='Yes' ? 'checked' : '' }}>Yes
                                            </label>
                                            <label class="mx-2">
                                                <input type="radio" name="continuous_spell_time" class="form-check-input me-1" value="No" {{
                                                    old('continuous_spell_time')=='No' ? 'checked' : '' }}>No
                                            </label>
                                        </div>
                                
                                        <div class="col-lg-6 mb-4">
                                            <h6 class="mb-3">How many hours on average daily do you spend using your DSE? </h6>
                                            <input id="average_using_dse" type="number" name="average_using_dse" class="form-control me-1"
                                                value="{{ old('average_using_dse') }}">
                                        </div>
                                
                                        {{-- <div class="col-lg-12 mb-4">
                                            <h6 class="mb-3">What Software do you use? </h6>
                                            <label class="mx-2">
                                                <input id="ms_word" type="checkbox" name="software[]" class="form-check-input me-1" value="Word" @if
                                                    (isset($data->software)) @foreach (json_decode($data->software) as $software) @if ($software == "Word")
                                                checked @endif @endforeach @endif>Word
                                            </label>
                                            <label class="mx-2">
                                                <input id="ms_excel" type="checkbox" name="software[]" class="form-check-input me-1" value="Excel" @if
                                                    (isset($data->software)) @foreach (json_decode($data->software) as $software) @if ($software == "Excel")
                                                checked @endif @endforeach @endif>Excel
                                            </label>
                                            <label for="ms_access" class="mx-2">
                                                <input id="ms_access" type="checkbox" name="software[]" class="form-check-input me-1" value="Access" @if
                                                    (isset($data->software)) @foreach (json_decode($data->software) as $software) @if ($software == "Access")
                                                checked @endif @endforeach @endif>Access
                                            </label>
                                            <label for="ms_powerpoint" class="mx-2">
                                                <input id="ms_powerpoint" type="checkbox" name="software[]" class="form-check-input me-1" value="Powerpoint" @if
                                                    (isset($data->software)) @foreach (json_decode($data->software) as $software) @if ($software ==
                                                "Powerpoint") checked @endif @endforeach @endif>Powerpoint
                                            </label>
                                            <label for="others" class="mx-2">
                                                <input id="others" type="checkbox" name="software[]" class="form-check-input me-1" value="Others" @if
                                                    (isset($data->software)) @foreach (json_decode($data->software) as $software) @if ($software == "Others")
                                                checked @endif @endforeach @endif>Others
                                            </label>
                                            <label class="">
                                                <input id="others_software" type="text" name="others_software" class="form-control"
                                                    placeholder="Somerset, EPT, ERS, Cerner" value="@if(isset($data)){{$data->others_software}}@endif">
                                            </label>
                                        </div> --}}
                                
                                    </div>
                                
                                
                                    <div class="col-lg-12">
                                        <div class="row py-3 ">
                                            <div class="col-lg-5 d-flex align-items-center">
                                                <button type="submit" class="btn btn-warning d-flex align-items-center">
                                                    <iconify-icon icon="akar-icons:check-box-fill" class="me-1"></iconify-icon> @if(isset($data)) Update
                                                    @else Save @endif
                                                </button>
                                            </div>
                                            <div class="col-lg-7 d-flex gap-3 justify-content-end"> </div>
                                        </div>
                                    </div>
                                
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

<<<<<<< Updated upstream


            <form action="{{ route('add.assessment') }}" method="POST">
=======
            

            <form action="" method="POST">
>>>>>>> Stashed changes
                @csrf
                <input type="hidden" name="line_manager_id" value="{{ $selectedLineManager->id }}">
                <input type="hidden" name="department_id" value="{{ $departments->id }}">
                <input type="hidden" name="division_id" value="{{ $selectedDivision->id }}">
<<<<<<< Updated upstream

=======
            
>>>>>>> Stashed changes


                @foreach ($questions as $key => $question)
                <div class="row mt-1">
                    <div class="col-lg-8 shadow-sm border rounded-0 bg-light ">
                        <div class="row pt-5 px-4">
                            <div class="col-lg-12 mb-4">
                                <h6 class="mb-3">{{$key + 1}}. {{$question->question}} </h6>

                                <div class="d-flex">
                                    <label for="yes" class="mx-4 fw-bold text-success">
<<<<<<< Updated upstream
                                        YES <input type="radio" name="assesmentanswer{{$question->id}}" class="form-check-input" id="yes{{$question->id}}" value="Yes">
                                    </label>
                                    <label for="no" class="me-3 fw-bold text-danger">
                                        NO <input type="radio" name="assesmentanswer{{$question->id}}" class="form-check-input"
=======
                                        YES <input type="radio" name="{{$question->id}}" class="form-check-input"
                                            id="yes{{$question->id}}" value="Yes">
                                    </label>
                                    <label for="no" class="me-3 fw-bold text-danger">
                                        NO <input type="radio" name="{{$question->id}}" class="form-check-input"
>>>>>>> Stashed changes
                                            id="no{{$question->id}}" value="No">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 shadow-sm border rounded-0 bg-light">
                        <div class="py-4">
                            <img src="{{asset('images/question/'.$question->image)}}" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
                @endforeach

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
            </form>

<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes


        </div>
    </div>
</section>



@endsection

@section('script')

<script>
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
    });
    
</script>


<script>
    $(document).ready(function() {
    
    

    //header for csrf-token is must in laravel
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    //


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