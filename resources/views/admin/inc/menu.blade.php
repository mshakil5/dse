@extends('admin.layouts.admin')

@section('content')



<div class="row mb-5 mt-5">
    <div class="col-lg-12 text-center text-uppercase fw-bold text-primary ">
      <h1>welcome to incident oversight</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-8 mx-auto">
      <div class="row g-2 mb-5">
        <div class="col-lg-3">
          <div class="card p-3 text-center border mb-1 text-capitalize card-custom ">
            <a href="{{route('admin.dashboard')}}" class="text-dark">
              Dashboard
            </a>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card p-3 text-center border mb-1 text-capitalize card-custom ">
            <a href="{{route('alladmin')}}" class="text-dark">
              Health & Safety
            </a>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card p-3 text-center border mb-1 text-capitalize card-custom ">
            <a href="{{route('admin.linemanager')}}" class="text-dark">
              Line Manager
            </a>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card p-3 text-center border mb-1 text-capitalize card-custom ">
            <a href="{{route('admin.user')}}" class="text-dark">
              Users
            </a>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card p-3 text-center border mb-1 text-capitalize card-custom ">
            <a href="{{route('admin.expert')}}" class="text-dark">
              Occupational Health
            </a>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card p-3 text-center border mb-1 text-capitalize card-custom ">
            <a href="{{route('admin.country')}}" class="text-dark">
              Country
            </a>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card p-3 text-center border mb-1 text-capitalize card-custom ">
            <a href="{{route('admin.department')}}" class="text-dark">
              Department
            </a>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card p-3 text-center border mb-1 text-capitalize card-custom ">
            <a href="{{route('admin.division')}}" class="text-dark">
              Division
            </a>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card p-3 text-center border mb-1 text-capitalize card-custom ">
            <a href="{{route('admin.qncategory')}}" class="text-dark">
              Question Category
            </a>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card p-3 text-center border mb-1 text-capitalize card-custom ">
            <a href="{{route('admin.question')}}" class="text-dark">
            Question
            </a>
          </div>
        </div>
        {{-- <div class="col-lg-3">
          <div class="card p-3 text-center border mb-1 text-capitalize card-custom ">
            <a href="{{route('admin.dashboard')}}" class="text-dark">
              My DSE lagacy Report
            </a>
          </div>
        </div> --}}
      </div>
    </div>
  </div>


@endsection

@section('script')
<script>
    
</script>
@endsection
