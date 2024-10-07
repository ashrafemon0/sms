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
                        <h4 class="box-title">Grade Input</h4>
                        <h6 class="box-subtitle">Bootstrap Form Validation check the <a class="text-warning" href="http://reactiveraven.github.io/jqBootstrapValidation/">official website </a></h6>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" action="{{route("store.student.grade")}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Grade Name<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="grade_name" class="form-control"  data-validation-required-message="This field is required" required=""> <div class="help-block"></div></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Grade Point<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="grade_point" class="form-control"  data-validation-required-message="This field is required" required=""> <div class="help-block"></div></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Start Mark<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="start_mark" class="form-control"  data-validation-required-message="This field is required" required=""> <div class="help-block"></div></div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>End Mark<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="end_mark" class="form-control"  data-validation-required-message="This field is required" required=""> <div class="help-block"></div></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Start Point<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="start_point" class="form-control"  data-validation-required-message="This field is required" required=""> <div class="help-block"></div></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>End Point<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="end_point" class="form-control"  required=""> <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Remark<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="remark" class="form-control"  data-validation-required-message="This field is required" required=""> <div class="help-block"></div></div>
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

@endsection
