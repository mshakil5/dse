@extends('admin.layouts.admin')

@section('content')

<!-- Main content -->
<section class="content mt-3" id="newBtnSection">
    <div class="container-fluid">
      <div class="row">
        <div class="col-2">
            <button type="button" class="btn btn-secondary my-3" id="newBtn">Add new</button>
        </div>
      </div>
    </div>
</section>
  <!-- /.content -->



    <!-- Main content -->
    <section class="content" id="addThisFormContainer">
      <div class="container-fluid">
        <div class="row justify-content-md-center">
          <!-- right column -->
          <div class="col-md-6">
            <!-- general form elements disabled -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Add new question</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="ermsg"></div>
                <form id="createThisForm">
                  @csrf
                  <input type="hidden" class="form-control" id="codeid" name="codeid">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Category</label>
                        <select name="qn_category_id" id="qn_category_id" class="form-control">
                          <option value="">Please Select</option>
                          @foreach ($cats as $cat)
                          <option value="{{$cat->id}}">{{$cat->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Type</label>
                        <select name="type" id="type" class="form-control">
                          <option value="">Please Select</option>
                          <option value="Office">Office</option>
                          <option value="Home">Home</option>
                          
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Image</label>
                        {{-- <input type="file" name="image" id="image" class="form-control" multiple> --}}
                        <input type="file" name="image[]" class="form-control" id="image" multiple required>
                      </div>
                      
                        <div class="preview2"></div>
                    </div>

                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Question</label>
                        <textarea  class="form-control" id="question" name="question" cols="30" rows="3"></textarea>
                      </div>
                    </div>

                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Tips</label>
                        <textarea  class="form-control" id="tips" name="tips" cols="30" rows="3"></textarea>
                      </div>
                    </div>
                  </div>

                  
                </form>
              </div>

              
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" id="addBtn" class="btn btn-secondary" value="Create">Create</button>
                <button type="submit" id="FormCloseBtn" class="btn btn-default">Cancel</button>
              </div>
              <!-- /.card-footer -->
              <!-- /.card-body -->
            </div>
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


<!-- Main content -->
<section class="content" id="contentContainer">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->

          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">All Data</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl</th>
                  <th>Category</th>
                  <th>Type</th>
                  <th>Question</th>
                  <th>Tips</th>
                  <th style="text-align: center">Image</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($data as $key => $data)
                  <tr>
                    <td style="text-align: center">{{ $key + 1 }}</td>
                    <td style="text-align: center">
                      {{ \App\Models\QnCategory::where('id',$data->qn_category_id)->first()->name }}
                    </td>
                    <td style="text-align: center">{{$data->type}}</td>
                    <td style="text-align: center">{{$data->question}}</td>
                    <td style="text-align: center">{{$data->tips}}</td>
                    
                    <td style="text-align: center">
                        {{-- @if ($data->image)
                        <img src="{{asset('images/question/'.$data->image)}}" height="120px" width="220px" alt="">
                        @endif --}}
                        @if ($data->questionImage)
                          <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                              @foreach ($data->questionImage as $key => $image)
                                <div class="carousel-item {{ $key==0 ? 'active' : '' }}">
                                  <img src="{{asset('images/question/'.$image->image)}}"  height="120px" width="320px" alt="...">
                                </div> 
                              @endforeach
                            </div>
                          </div>
                        @endif
                    </td>

                    <td style="text-align: center">
                      <a id="EditBtn" rid="{{$data->id}}"><i class="fa fa-edit" style="color: #2196f3;font-size:16px;"></i></a>
                      <a id="deleteBtn" rid="{{$data->id}}"><i class="fa fa-trash-o" style="color: red;font-size:16px;"></i></a>
                    </td>
                  </tr>
                  @endforeach
                
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->


@endsection
@section('script')
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

<script>
  
  var storedFiles = [];

  $(document).ready(function () {
      $("#addThisFormContainer").hide();
      $("#newBtn").click(function(){
          clearform();
          $("#newBtn").hide(100);
          $("#addThisFormContainer").show(300);

      });
      $("#FormCloseBtn").click(function(){
          $("#addThisFormContainer").hide(200);
          $("#newBtn").show(100);
          clearform();
      });
      //header for csrf-token is must in laravel
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
      //
      var url = "{{URL::to('/admin/question')}}";
      var upurl = "{{URL::to('/admin/question-update')}}";
      // console.log(url);
      $("#addBtn").click(function(){
      //   alert("#addBtn");
          if($(this).val() == 'Create') {
              // var file_data = $('#image').prop('files')[0];
              //   if(typeof file_data === 'undefined'){
              //       file_data = 'null';
              //   }
              

              var form_data = new FormData();
              for(var i=0, len=storedFiles.length; i<len; i++) {
                      form_data.append('image[]', storedFiles[i]);
                  }
              form_data.append("question", $("#question").val());
              form_data.append("type", $("#type").val());
              form_data.append("tips", $("#tips").val());
              form_data.append("qn_category_id", $("#qn_category_id").val());
              $.ajax({
                url: url,
                method: "POST",
                contentType: false,
                processData: false,
                data:form_data,
                success: function (d) {
                    if (d.status == 303) {
                        $(".ermsg").html(d.message);
                    }else if(d.status == 300){
                      $(".ermsg").html(d.message);
                      window.setTimeout(function(){location.reload()},2000)
                    }
                },
                error: function (d) {
                    console.log(d);
                }
            });
          }
          //create  end
          //Update
          if($(this).val() == 'Update'){
            var file_data = $('#image').prop('files')[0];
                if(typeof file_data === 'undefined'){
                    file_data = 'null';
                }


              var form_data = new FormData();
              form_data.append('image', file_data);
              form_data.append("question", $("#question").val());
              form_data.append("type", $("#type").val());
              form_data.append("tips", $("#tips").val());
              form_data.append("qn_category_id", $("#qn_category_id").val());
              form_data.append("codeid", $("#codeid").val());
              
              $.ajax({
                  url:upurl,
                  type: "POST",
                  dataType: 'json',
                  contentType: false,
                  processData: false,
                  data:form_data,
                  success: function(d){
                      console.log(d);
                      if (d.status == 303) {
                          $(".ermsg").html(d.message);
                          pagetop();
                      }else if(d.status == 300){
                        $(".ermsg").html(d.message);
                          window.setTimeout(function(){location.reload()},2000)
                      }
                  },
                  error:function(d){
                      console.log(d);
                  }
              });
          }
          //Update
      });
      //Edit
      $("#contentContainer").on('click','#EditBtn', function(){
          //alert("btn work");
          codeid = $(this).attr('rid');
          //console.log($codeid);
          info_url = url + '/'+codeid+'/edit';
          //console.log($info_url);
          $.get(info_url,{},function(d){
              populateForm(d);
              pagetop();
          });
      });
      //Edit  end
      //Delete 
      $("#contentContainer").on('click','#deleteBtn', function(){
            if(!confirm('Sure?')) return;
            codeid = $(this).attr('rid');
            info_url = url + '/'+codeid;
            $.ajax({
                url:info_url,
                method: "GET",
                type: "DELETE",
                data:{
                },
                success: function(d){
                    if(d.success) {
                        alert(d.message);
                        location.reload();
                    }
                },
                error:function(d){
                    console.log(d);
                }
            });
        });
      //Delete  
      function populateForm(data){
          $("#question").val(data.question);
          $("#type").val(data.type);
          $("#tips").val(data.tips);
          $("#qn_category_id").val(data.qn_category_id);
          $("#codeid").val(data.id);
          $("#addBtn").val('Update');
          $("#addBtn").html('Update');
          $("#addThisFormContainer").show(300);
          $("#newBtn").hide(100);
      }
      function clearform(){
          $('#createThisForm')[0].reset();
          $("#addBtn").val('Create');
      }
  });

  // images
        /* WHEN YOU UPLOAD ONE OR MULTIPLE FILES */
        $(document).on('change','#image',function(){
            len_files = $("#image").prop("files").length;
            
            for (var i = 0; i < len_files; i++) {
                var file_data2 = $("#image").prop("files")[i];
                storedFiles.push(file_data2);
            }
            
        });

        // images
        /* WHEN YOU UPLOAD ONE OR MULTIPLE FILES */
        // $(document).on('change','#image',function(){
        //     len_files = $("#image").prop("files").length;
        //     var construc = "<div class='row'>";
        //     for (var i = 0; i < len_files; i++) {
        //         var file_data2 = $("#image").prop("files")[i];
        //         storedFiles.push(file_data2);
        //         construc += '<div class="col-3 singleImage my-3"><span data-file="'+file_data2.name+'" class="btn ' + 'btn-sm btn-danger imageremove2">&times;</span><img width="120px" height="auto" src="' +  window.URL.createObjectURL(file_data2) + '" alt="'  +  file_data2.name  + '" /></div>';
        //     }
        //     construc += "</div>";
        //     $('.preview2').append(construc);
        // });

        // $(".preview2").on('click','span.imageremove2',function(){
        //     var trash = $(this).data("file");
        //     for(var i=0;i<storedFiles.length;i++) {
        //         if(storedFiles[i].name === trash) {
        //             storedFiles.splice(i,1);
        //             break;
        //         }
        //     }
        //     $(this).parent().remove();

        // });




</script>
@endsection