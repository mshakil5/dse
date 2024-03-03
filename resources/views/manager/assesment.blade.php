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
                          <th scope="col">Progress</th>
                          <th scope="col">Created</th>
                          <th scope="col">Updated</th>
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
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-info"
                                    role="progressbar" aria-label="Animated striped example" aria-valuenow="75"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                            </div>
                        </td>
                        <td>{{$data->created_at}}</td>
                        <td>{{$data->updated_at}}</td>
                        <td>
                            <div class="d-flex gap-2 align-items-center justify-content-center">
                                <a href="#"><iconify-icon class="text-warning"
                                        icon="solar:pen-bold"></iconify-icon></a>
                                <a href="#"><iconify-icon class="text-danger"
                                        icon="tabler:trash-filled"></iconify-icon></a>
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