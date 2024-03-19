@extends('layouts.user')
@section('content')

<section class="header-main py-5">
  <div class="container ">
      <div class="col-lg-10 mx-auto px-4 ">
          <div class="row">

              <div class="col-lg-12 shadow  border p-4 rounded-0 bg-light  ">
                  <div class="row ">
                    <a href="{{route('user.determinigQn')}}">
                      <div class="col-lg-4">
                          <label class="card position-relative rounded-3 shadow-sm border border-2 overflow-hidden">
                              <h4 class=" text-center py-3 position-absolute top-50 start-50 translate-middle w-100" style="z-index: 1;">
                                  some text goes here</h4>
                              <img src="https://picsum.photos/300/150" class="img-responsive opacity-75" alt="">
                              <div class="p-1 text-center fs-3 position-absolute bottom-0 w-100 bg-white">
                                  <input type="radio">
                                  somener
                              </div>
                          </label>
                      </div>
                    </a>
                  </div>
              </div>
          </div>

      </div>
  </div>
</section>

  
@endsection