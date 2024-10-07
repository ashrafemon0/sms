@extends('admin.admin_master')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="content-wrapper" style="min-height: 984.547px;">
        <div class="container-full">
            <!-- Content Header (Page header) -->

            <section class="content">

                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Employee Assign</h4>
                        <h6 class="box-subtitle">Bootstrap Form Validation check the <a class="text-warning" href="http://reactiveraven.github.io/jqBootstrapValidation/">official website </a></h6>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" action="{{route("store.employee.reg")}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Teacher Name<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="name" class="form-control"  data-validation-required-message="This field is required" required=""> <div class="help-block"></div></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Father Name<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="fname" class="form-control"  data-validation-required-message="This field is required" required=""> <div class="help-block"></div></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Mother Name<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="mname" class="form-control"  data-validation-required-message="This field is required" required=""> <div class="help-block"></div></div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Mobile<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="mobile" class="form-control"  data-validation-required-message="This field is required" required=""> <div class="help-block"></div></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Address<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="address" class="form-control"  data-validation-required-message="This field is required" required=""> <div class="help-block"></div></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Gender<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="gender" id="gender" required="" class="form-control">
                                                        <option value="">Select User Role</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Religion<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="religion" id="religion" required="" class="form-control">
                                                        <option value="">Select User Religion</option>
                                                        <option value="male">Islam</option>
                                                        <option value="female">Hindu</option>
                                                        <option value="female">Urdhu</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Birth Date<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="dob" class="form-control"  required=""> <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Designation<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="designation_id" id="designation" required="" class="form-control">
                                                        <option value="" selected="" disabled="">Select Teacher designation</option>
                                                        @foreach($designation as $designations)
                                                            <option value="{{$designations->id}}">{{$designations->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Salary<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="salary" class="form-control"  data-validation-required-message="This field is required" required=""> <div class="help-block"></div></div>
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Joining Date<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="join_date" class="form-control"  required=""> <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Profile Image<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <div class="mb-3">
                                                        <input name="image" class="form-control" type="file" id="image">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Image<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <div class="mb-3">
                                                        <img id="showImg" src="{{ url('upload/no_image.jpg') }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="100" height="100">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-info" value="Add">
                                    </div>
                                </form>

                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </section>

        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#image').change(function (e) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#showImg').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0'])
            })
        })


    </script>

@endsection