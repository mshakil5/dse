@extends('layouts.user')
@section('content')




<section class="header-main py-5">
  <div class="container ">
      <div class="col-lg-10 mx-auto px-4 ">
        


        
        <div class="row">
            <div class="col-lg-12 shadow  border p-4 rounded-0 bg-white pt-0">
                <div class="row border-bottom border-dashed">
                    <div class="col-6 col-sm-6 col-lg-4">
                        <div class="brand p-3">
                            <img src="{{ asset('nhs.png')}}" width="200px" alt="">
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-8 d-flex align-items-center justify-content-end">
                       
                        <a href="{{route('user.dashboard')}}" class="btn btn-sm btn-warning d-block float-end fs-5 d-flex align-items-center gap-2"> <iconify-icon icon="majesticons:door-exit" class=""></iconify-icon> Exit</a>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 mx-auto align-items-center justify-content-center">


                        
                        <div class="py-3">

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif


                            <h2 class="text-center">Profile Update</h2>


                            <form action="" method="POST" class="mt-3">
                                @csrf

                            
                                <div class="row mt-3">
                                    <div class="col-lg-12  mx-auto">
                                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}"> 
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <label for="employee_name" >Employee Name</label>
                                            </div>
                                            <div class="col-8">
                                                <input id="employee_name" type="text" class="form-control @error('employee_name') is-invalid @enderror" name="employee_name" value="{{ old('employee_name') }}"  autocomplete="employee_name" autofocus>
                                                @error('employee_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <label for="employee_email" >Employee Email Address </label>
                                            </div>
                                            <div class="col-8">
                                                <input id="employee_email" type="text" class="form-control @error('employee_email') is-invalid @enderror" name="employee_email" value="{{ old('employee_email') }}"  autocomplete="employee_email" autofocus>
                                                @error('employee_email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <label for="home_contact_number" >Contact Number </label>
                                            </div>
                                            <div class="col-8">
                                                <input id="home_contact_number" type="text" class="form-control @error('home_contact_number') is-invalid @enderror" name="home_contact_number" value="{{ old('home_contact_number') }}"  autocomplete="home_contact_number" autofocus>
                                                @error('home_contact_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <label for="address_first_line" >Address First Line </label>
                                            </div>
                                            <div class="col-8">
                                                <input id="address_first_line" type="text" class="form-control @error('address_first_line') is-invalid @enderror" name="address_first_line" value="{{ old('address_first_line') }}"  autocomplete="address"   autofocus>
                                                @error('address_first_line')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <label for="address_second_line" >Address Second Line </label>
                                            </div>
                                            <div class="col-8">
                                                <input id="address_second_line" type="text" class="form-control @error('address_second_line') is-invalid @enderror" name="address_second_line" value="{{ old('address_second_line') }}"  autocomplete="address_second_line"  autofocus>
                                                @error('address_second_line')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <label for="city" >City </label>
                                            </div>
                                            <div class="col-8">
                                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}"  autocomplete="city" autofocus>
                                                @error('city')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <label for="country" >Country </label>
                                            </div>
                                            <div class="col-8">
                                                <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}"  autocomplete="country" autofocus>
                                                @error('country')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <label for="postcode" >Postal Code </label>
                                            </div>
                                            <div class="col-8">
                                                <input id="postcode" type="text" class="form-control @error('postcode') is-invalid @enderror" name="postcode" value="{{ old('postcode') }}"  autocomplete="postcode" autofocus>
                                                @error('postcode')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        



                                        
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <label for="division" >Division </label>
                                            </div>
                                            <div class="col-8">
                                                <input id="division" type="text" class="form-control @error('division') is-invalid @enderror" name="division" value="{{ old('division') }}"  autocomplete="division" autofocus>
                                                @error('division')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <label for="department" >Ward/Department </label>
                                            </div>
                                            <div class="col-8">
                                                <input id="department" type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{ old('department') }}"  autocomplete="department" autofocus>
                                                @error('department')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>


                                    </div>
                                </div>
                
                
              
                            
                                <div class="col-lg-12">
                                    <div class="row py-3 ">
                                        <div class="col-lg-5 d-flex align-items-center">
                                            <button type="submit" class="btn btn-warning d-flex align-items-center">
                                                <iconify-icon icon="akar-icons:check-box-fill" class="me-1"></iconify-icon> Update
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
          


      </div>
  </div>
</section>

  
@endsection
@section('script')





@endsection