@extends('layouts.user')
@section('content')

<section class="header-main py-5">
  <div class="container ">
      <div class="col-lg-10 mx-auto px-4 ">
          <div class="row">

              <div class="col-lg-12 shadow  border p-4 rounded-0 bg-light  ">
                  <div class="row ">
                    {{-- @if (isset($assesment))

                    @foreach ($assesment as $item)
                    <a href="{{route('user.survey',$item->program_number)}}">
                        <div class="col-lg-4">
                            <label class="card position-relative rounded-3 shadow-sm border border-2 overflow-hidden">
                                <img src="https://picsum.photos/300/150" class="img-responsive opacity-75" alt="">
                                <div class="p-1 text-center fs-3 position-absolute bottom-0 w-100 bg-white">
                                    Ongoing
                                </div>
                            </label>
                        </div>
                      </a>
                    @endforeach
                        
                    @endif --}}

                        <div class="col-lg-4">
                            <a href="{{route('user.determinigQn')}}">
                                <label class="card position-relative rounded-3 shadow-sm border border-2 overflow-hidden">
                                    <img src="https://picsum.photos/300/150" class="img-responsive opacity-75" alt="">
                                    <div class="p-1 text-center fs-3 position-absolute bottom-0 w-100 bg-white">
                                        DSE Self Assesment
                                    </div>
                                </label>
                            </a>
                        </div>
                        <div class="col-lg-4">

                        </div>
                        <div class="col-lg-4">
                            <label class="card position-relative rounded-3 shadow-sm border border-2 overflow-hidden">
                                <img src="https://picsum.photos/300/150" class="img-responsive opacity-75" alt="">
                                <div class="p-1 text-center fs-3 position-absolute bottom-0 w-100 bg-white">
                                    Training Module
                                </div>
                            </label>
                        </div>

                    {{-- <div class="col-lg-4">
                        <label class="card position-relative rounded-3 shadow-sm border border-2 overflow-hidden">
                            <div class="embed-responsive embed-responsive-16by9"><iframe width="1280" height="720" src="https://www.youtube.com/embed/_BtYctonMTQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>

                            <div class="p-1 text-center fs-3 position-absolute bottom-0 w-100 bg-white">
                                DSE Self Assesment
                            </div>
                        </label>
                    </div> --}}
                    
                  </div>
              </div>
          </div>

      </div>
  </div>
</section>

  
@endsection