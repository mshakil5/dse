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

                            <hr>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif


                            <h2 class="text-center">Profile Update</h2>


                            <form action="{{route('user.profileUpdate')}}" method="POST" class="mt-3">
                                @csrf

                            
                                <div class="row mt-3">
                                    <div class="col-lg-12  mx-auto">
                                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}"> 
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <label for="name" >First Name</label>
                                            </div>
                                            <div class="col-8">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}"  autocomplete="name" autofocus>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <label for="surname" >Sur Name</label>
                                            </div>
                                            <div class="col-8">
                                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ Auth::user()->surname }}"  autocomplete="surname" autofocus>
                                                @error('surname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <label for="email" > Email </label>
                                            </div>
                                            <div class="col-8">
                                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}"  autocomplete="email" autofocus>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <label for="phone" >Phone</label>
                                            </div>
                                            <div class="col-8">
                                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ Auth::user()->phone }}"  autocomplete="phone" autofocus>
                                                @error('phone')
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
                                                <input id="address_first_line" type="text" class="form-control @error('address_first_line') is-invalid @enderror" name="address_first_line" value="{{Auth::user()->address_first_line}}"  autocomplete="address"   autofocus>
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
                                                <input id="address_second_line" type="text" class="form-control @error('address_second_line') is-invalid @enderror" name="address_second_line" value="{{Auth::user()->address_second_line}}"  autocomplete="address_second_line"  autofocus>
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
                                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{Auth::user()->city}}"  autocomplete="city" autofocus>
                                                @error('city')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <label for="postcode" >Post Code </label>
                                            </div>
                                            <div class="col-8">
                                                <input id="postcode" type="text" class="form-control @error('postcode') is-invalid @enderror" name="postcode" value="{{Auth::user()->postcode}}"  autocomplete="postcode" autofocus>
                                                @error('postcode')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <label for="line_manager" >Line Manager </label>
                                            </div>
                                            <div class="col-8">
                                                <select name="line_manager" id="line_manager" class="form-control select2  @error('line_manager') is-invalid @enderror">
                                                    <option value="">Line Manager</option>
                                                    @foreach ($linemanagers as $linemanager)
                                                        <option value="{{$linemanager->id}}"
                                                            @if (Auth::user()->line_manager == $linemanager->id) selected @endif
                                                        >{{$linemanager->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('line_manager')
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

                                                <select name="division_id" id="division_id" class="form-control select2 @error('division_id') is-invalid @enderror">
                                                    <option value="">Division</option>
                                                    @foreach ($divisions as $division)
                                                        <option value="{{$division->id}}"
                                                            @if (Auth::user()->division_id == $division->id) selected @endif
                                                        >{{$division->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('division')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <label for="department_id" >Department </label>
                                            </div>
                                            <div class="col-8">
                                                <select name="department_id" id="department_id" class="form-control select2  @error('department_id') is-invalid @enderror">
                                                    <option value="">Department</option>
                                                    @foreach ($departments as $department)
                                                        <option value="{{$department->id}}"
                                                            @if (Auth::user()->department_id == $department->id) selected @endif
                                                        >{{$department->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('department_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <label for="password" >Password </label>
                                            </div>
                                            <div class="col-8">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" >

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <label for="confirm_password" >Confirm Password </label>
                                            </div>
                                            <div class="col-8">
                                                <input id="confirm_password" type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" >
                                                
                                                @error('confirm_password')
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