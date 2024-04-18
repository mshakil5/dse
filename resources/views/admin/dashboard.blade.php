@extends('admin.layouts.admin')

@section('content')

<div class="row">
  <div class="col-lg-12 text-center">
    <img src="{{ asset('frontend/images/dselogo.PNG')}}" width="300" class="mx-auto" alt="">
  </div>
</div>


<div class="row">
  <div class="col-lg-8 mx-auto">
    <div class="row g-1">
      <div class="col-4 col-sm-3 col-md-3 col-lg-3 text-center">
        <div class="box border shadow-sm p-4">
          <a href="{{route('admin.assesmentCompiledList')}}"><img src="{{ asset('assets/admin/img/action.png')}}" class="img-fluid w-50 mb-3"></a>
          <h6>Action</h6>
        </div>

      </div>
      <div class="col-4 col-sm-3 col-md-3 col-lg-3 text-center">
        <div class="box border shadow-sm p-4">
          <a href="#"><img src="{{ asset('assets/admin/img/oversight.png')}}" class="img-fluid w-50 mb-3"></a>
          <h6>oversight</h6>
        </div>

      </div>
      <div class="col-4 col-sm-3 col-md-3 col-lg-3 text-center">
        <div class="box border shadow-sm p-4">
          <a href="#"><img src="{{ asset('assets/admin/img/risk.png')}}" class="img-fluid w-50 mb-3"></a>
          <h6>high risk</h6>
        </div>

      </div>
      <div class="col-4 col-sm-3 col-md-3 col-lg-3 text-center">
        <div class="box border shadow-sm p-4">
          <a href="{{route('admin.linemanager')}}"><img src="{{ asset('assets/admin/img/manger.png')}}" class="img-fluid w-50 mb-3"></a>
          <h6>Line Manger </h6>
        </div>

      </div>
      <div class="col-4 col-sm-3 col-md-3 col-lg-3 text-center">
        <div class="box border shadow-sm p-4">
          <a href="{{route('admin.expert')}}"><img src="{{ asset('assets/admin/img/occupation.png')}}" class="img-fluid w-50 mb-3"></a>
          <h6>Occupational </h6>
        </div>

      </div>
      <div class="col-4 col-sm-3 col-md-3 col-lg-3 text-center">
        <div class="box border shadow-sm p-4">
          <a href="#"><img src="{{ asset('assets/admin/img/training.png')}}" class="img-fluid w-50 mb-3"></a>
          <h6>Training </h6>
        </div>

      </div>
      <div class="col-4 col-sm-3 col-md-3 col-lg-3 text-center">
        <div class="box border shadow-sm p-4">
          <a href="{{route('admin.user')}}"><img src="{{ asset('assets/admin/img/policy.png')}}" class="img-fluid w-50 mb-3"></a>
          <h6>Users </h6>
        </div>

      </div>
      <div class="col-4 col-sm-3 col-md-3 col-lg-3 text-center">
        <div class="box border shadow-sm p-4">
          <a href="#"><img src="{{ asset('assets/admin/img/overdue.png')}}" class="img-fluid w-50 mb-3"></a>
          <h6>Overdue </h6>
        </div>

      </div>
    </div>
  </div>
</div>

@endsection

@section('script')


<script>
    
</script>

@endsection
