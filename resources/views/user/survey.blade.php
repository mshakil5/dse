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
                        <div class="col-lg-8 border-md-end d-flex align-items-center justify-content-center">

                            <div class="py-3">
                                <h2 class="text-danger text-center ">Dislay screen equipment assesment</h2>
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                </p>
                                <div class="d-flex gap-3 flex-wrap justify-content-center mt-4">
                                    <div class="dropdown">
                                        <select name="line_manager" id="line_manager" class="btn btn-secondary dropdown-toggle select2">
                                            <option value="">Line Manager</option>
                                            @foreach ($linemanagers as $linemanager)
                                                <option value="{{$linemanager->id}}">{{$linemanager->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="dropdown">
                                        <select name="department_id" id="department_id" class="btn btn-secondary dropdown-toggle select2">
                                            <option value="">Department</option>
                                            @foreach ($departments as $department)
                                                <option value="{{$department->id}}">{{$department->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="dropdown">
                                        <select name="division_id" id="division_id" class="btn btn-secondary dropdown-toggle select2">
                                            <option value="">Division</option>
                                            @foreach ($divisions as $division)
                                                <option value="{{$division->id}}">{{$division->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 d-flex justify-content-end align-items-end flex-column p-4">


                            <div class="text-dark">
                                <div class="border-bottom pb-2 w-100 mb-3">
                                    <iconify-icon icon="clarity:help-line"></iconify-icon> Help <br>
                                </div>
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nesciunt laudantium
                                nostrum laboriosam blanditiis iste nisi, recusandae ab consequatur a commodi culpa
                                suscipit quasi ipsam aliquid!
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 ">
                        <div class="col-lg-12">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated w-75 bg-warning" role="progressbar" aria-label="Basic example"  aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($questions as $key => $question)
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
                            NO <input type="radio" name="query{{$question->id}}" class="form-check-input" id="no{{$question->id}}" data-qid="{{$question->id}}" value="No" onclick="toggleFields(this)">
                        </label>
                    </div>

                    <div id="subqnDiv{{$question->id}}">

                    </div>
                    

                    {{-- test  --}}


                    {{-- <div class="col-lg-12 mb-4">
                        <h6 class="mb-3"><iconify-icon class="text-warning" icon="ci:arrow-sub-down-right"></iconify-icon> 1.1 Is threr enough space for
                            your desk for all of your equipment ?</h6>
                        <label for="yes" class="mx-2">
                            <input id="yes" type="radio" name="subqn" class="form-check-input me-1"
                                value="yes">Yes
                        </label>
                        <label for="no" class="mx-2">
                            <input id="no" type="radio" name="subqn" class="form-check-input me-1"
                                value="yes">No
                        </label>
                    </div>
                    <div class="col-lg-12">
                        <textarea name="message" class="form-control" placeholder="Comments Here"></textarea>
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
                    </div> --}}


                    {{-- test end --}}
                    











                </div>
                <div class="col-lg-6 px-0 shadow-sm border rounded-0 bg-light">
                    <img src="{{asset('images/question/'.$question->image)}}" class="img-fluid" alt="">
                </div>

            </div>
            @endforeach


            
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
            
            var subqnurl = "{{URL::to('/user/get-sub-question')}}";
            var id = element.getAttribute('data-qid');
            var value = element.getAttribute('value');
            console.log(value);
            var form_data = new FormData();			
            form_data.append("id", id);
            form_data.append("value", value);

            $.ajax({
                url:subqnurl,
                method: "POST",
                type: "POST",
                contentType: false,
                processData: false,
                data:form_data,
                success: function(d){
                    
                    $("#subqnDiv"+id).html(d.subquery);
                    console.log(d);
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