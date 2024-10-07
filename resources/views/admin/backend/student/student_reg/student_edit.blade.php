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
                        <h4 class="box-title">Student Assign Add</h4>
                        <h6 class="box-subtitle">Bootstrap Form Validation check the <a class="text-warning" href="http://reactiveraven.github.io/jqBootstrapValidation/">official website </a></h6>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" action="{{route("update.student.reg",$EditData->student_id)}}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $EditData->id }}">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Student Name<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="name" class="form-control"  data-validation-required-message="This field is required" required="" value="{{$EditData['student']['name']}}"> <div class="help-block"></div></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Father Name<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="fname" class="form-control"  data-validation-required-message="This field is required" required="" value="{{$EditData['student']['fname']}}"> <div class="help-block"></div></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Mother Name<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="mname" class="form-control"  data-validation-required-message="This field is required" required="" value="{{$EditData['student']['mname']}}"> <div class="help-block"></div></div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Mobile<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="mobile" class="form-control"  data-validation-required-message="This field is required" required="" value="{{$EditData['student']['mobile']}}"> <div class="help-block"></div></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Address<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="address" class="form-control"  data-validation-required-message="This field is required" required="" value="{{$EditData['student']['address']}}"> <div class="help-block"></div></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Gender<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="gender" id="gender" required="" class="form-control">
                                                        <option value="">Select User Role</option>
                                                        <option value="male" {{($EditData['student']['gender'] == 'male' )? 'selected': ""}}>Male</option>
                                                        <option value="female" {{($EditData['student']['gender'] == 'female' )? 'selected': ""}}>Female</option>

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
                                                        <option value="islam" {{($EditData['student']['religion'] == 'islam' )? 'selected': ""}}>Islam</option>
                                                        <option value="hindu" {{($EditData['student']['religion'] == 'hindu' )? 'selected': ""}}>Hindu</option>
                                                        <option value="urdhu" {{($EditData['student']['religion'] == 'urdhu' )? 'selected': ""}}>Urdhu</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Birth Date<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="dob" class="form-control"  required="" value="{{$EditData['student']['dob']}}"> <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Discount<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="discount" class="form-control"  data-validation-required-message="This field is required" required="" value="{{$EditData['discount']['discount']}}"> <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Class<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="class_id" id="religion" required="" class="form-control">
                                                        <option value="">Select User Class</option>
                                                        @foreach($studentClass as $studentClasses)
                                                            <option value="{{$studentClasses->id}}" {{($EditData->class_id == $studentClasses->id)? 'selected':''}}>{{$studentClasses->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Year<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="year_id" id="religion" required="" class="form-control">
                                                        <option value="">Select User Year</option>
                                                        @foreach($studentYear as $studentYears)
                                                            <option value="{{$studentYears->id}}" {{($EditData->year_id == $studentYears->id)? 'selected':''}}>{{$studentYears->year}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Group<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="group_id" id="religion" required="" class="form-control">
                                                        <option value="">Select User Group</option>
                                                        @foreach($studentGroup as $studentGroups)
                                                            <option value="{{$studentGroups->id}}" {{($EditData->group_id == $studentGroups->id)? 'selected':''}}>{{$studentGroups->group}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Shift<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="shift_id" required="" class="form-control">
                                                        <option value="">Select User Class</option>
                                                        @foreach($studentShift as $studentShifts)
                                                            <option value="{{$studentShifts->id}}" {{($EditData->shift_id == $studentShifts->id)? 'selected':''}}>{{$studentShifts->shift}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Profile Image<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <div class="mb-3">
                                                        <input name="image" class="form-control" type="file" id="image" value="{{$EditData['student']['image']}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Image<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <div class="mb-3">
                                                        <img id="showImg" src="{{ (!empty($EditData['student']['image']) ? url('upload/user_image/'.$EditData['student']['image']): url('upload/no_image.jpg')) }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="100" height="100">
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
