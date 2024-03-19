@extends('manager.layouts.manager')
@section('content')

<section>
  <div class="container-fluid">

      <div class="row">
          <div class="col-lg-12 table-responsive">
              <table class="table table-striped table-dark ">
                  <thead>
                      <tr>
                          <th scope="col">#</th>
                          <th scope="col">Email</th>
                          <th scope="col">Name</th>
                          <th scope="col">Surname</th>
                          <th scope="col">Count</th>
                          <th scope="col">Test</th>
                          <th scope="col" class="text-center">Action</th>
                      </tr>
                  </thead>
                  <tbody>

                    @foreach ($users as $key => $data)
                      <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$data->email}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->surname}}</td>
                        <td>
                            <span class="badge text-bg-warning">100</span>
                        </td>
                        <td></td>
                        {{-- <td>{{$data->created_at}}</td>
                        <td>{{$data->updated_at}}</td> --}}
                        <td>
                            <div class="d-flex gap-2 align-items-center justify-content-center">
                            <a href="{{ route('assessment.user.details', $data->id) }}">
                                <iconify-icon class="text-primary" icon="bi:eye"></iconify-icon>
                            </a>
                        </div>
                        
                        </td>
                    </tr>
                    @endforeach
                      
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</section>
  
@endsection