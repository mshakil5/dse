@extends('layouts.master')
@section('content')

<section class="header-main py-5">
        <div class="container ">
            <div class="col-lg-10 mx-auto px-4">
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
                                <h2 class="text-danger text-left ">Display screen equipment (DSE) workstation self-assessment</h2>
                                    <p>
                                        You are asked to complete the enclosed form to assess that you are using your computer and workstation in the ‘optimum’ way, so that you suffer no ill-effects from your work.  Read the ‘things to consider’ column and assess yourself against the photographs.  Try to adjust your position or items of equipment.  Once you have completed your form, contact your manager to discuss your assessment who will complete the right hand column on the form and make additional notes for further action if this is required on the DSE Risk Assessment action plan.
                                    </p>
                                    <p>
                                        DSE = 	visual display unit (VDU) / screen, stand & central processing unit (CPU) / box. <br>
                                        Workstation  = 	Dictaphone, telephone, table, chair, document holder, footstool, mouse.
                                    </p>
                                    
                                <div class="d-flex gap-3 flex-wrap justify-content-center mt-4">

                                    <input type="hidden" id="assessment_id" name="assessment_id" value="{{ $assesment->id }}">

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
                            <div class="row pt-5 px-4">
                                <!-- Questions  -->
                            </div>
                    
                            <!-- Buttons -->
                            <div class="row py-3">    
                                <div class="col-lg-12 d-flex gap-3 justify-content-end">
                                    <button class="btn btn-success d-flex align-items-center"> <iconify-icon
                                        icon="akar-icons:check-box-fill" class="me-1"></iconify-icon> accept as resolved
                                    </button>
                                    <button class="btn btn-warning d-flex align-items-center"> <iconify-icon
                                        icon="akar-icons:check-box-fill" class="me-1"></iconify-icon> send
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Categories -->
                            <div class="col-lg-4 shadow-sm border rounded-0 bg-light">
                                <div class="py-4">
                                    <ol class="custom-list">
                                        @foreach($questionCategories as $key => $category)
                                            <li ><a  class="category-link getsrchval" data-category-id="{{ $category->id }}" style="cursor: pointer;">{{ $key + 1 }}. {{ $category->name }}</a>
                                            </li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                </div>
            </div>
        </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function() {
    $(document).on('click', '.category-link', function(e) {
        e.preventDefault();
        var categoryId = $(this).data('category-id'); 
        var url = "{{ route('getQuestionsByCategory', ':id') }}".replace(':id', categoryId);

        $.ajax({
            url: url,
            method: "POST",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                var questionsContainer = $('#questions-container .row:first');
                questionsContainer.empty();
                var counter = 1;
                $.each(response.questions, function(index, question) {
                    var questionHtml = '<div class="col-lg-12 mb-4 question">';
                    questionHtml += '<h6 class="mb-3">' + counter++ + '. ' + question.question + '</h6>';
                    questionHtml += '<label for="yes" class="mx-2">';
                    questionHtml += '<input id="yes" type="radio" class="form-check-input me-1" value="yes">Yes';
                    questionHtml += '</label>';
                    questionHtml += '<label for="no" class="mx-2">';
                    questionHtml += '<input id="no" type="radio" name="" class="form-check-input me-1" value="no">No';
                    questionHtml += '</label>';
                    questionHtml += '</div>';
                    questionsContainer.append(questionHtml);
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error(textStatus, errorThrown);
            }
        });
    });
});

</script>


</section>



@endsection