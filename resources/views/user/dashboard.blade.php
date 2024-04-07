@extends('layouts.user')
@section('content')

@php
    $danswer = \App\Models\DeterminigAnswer::where('user_notification', 1)->first();
@endphp
<section class="header-main py-5">
  <div class="container ">
      <div class="col-lg-10 mx-auto px-4 ">
          <div class="row">
            @if (isset($danswer))
            {{-- <div class="alert alert-warning" role="alert">
                <iconify-icon icon="flat-color-icons:idea"></iconify-icon>  Some text will be there for user notification when manager reject assesment. <em class="text-dark fw-bold"></em>
            </div> --}}
            @endif

            @if (isset($dueRecords))
            <div class="alert alert-warning" role="alert">
                <iconify-icon icon="flat-color-icons:idea"></iconify-icon>  Some text will be there for user notification when due assesment. <em class="text-dark fw-bold"></em>
            </div>
            @endif
                
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
                                        
                                        @if (isset($danswer))
                                            Outstanding Task
                                        @else
                                        DSE Self Assesment 
                                        @endif
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

                    
                  </div>
              </div>
          </div>

      </div>
  </div>
</section>

  
@endsection