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
                                <form method="post" action="{{route("store.lesson.plan")}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Day<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="day" class="form-control"  data-validation-required-message="This field is required" required=""> <div class="help-block"></div></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Assembly<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="assembly" class="form-control"  data-validation-required-message="This field is required" required=""> <div class="help-block"></div></div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Table Work<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea class="form-control" name="table_work" rows="8" cols="30"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Group Work<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea class="form-control" name="group_work" rows="8" cols="30"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>ADL Activity<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea class="form-control" name="adl_activity" rows="8" cols="30"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Group Work<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea class="form-control" name="group_work" rows="8" cols="30"></textarea>
                                                    </div>
                                                </div>

                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Massy Play<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea class="form-control" name="massy_play" rows="4" cols="30"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Snack Time<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea class="form-control" name="snack_time" rows="4" cols="30"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Table Work 2<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea class="form-control" name="table_work_2" rows="8" cols="30"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Physical Exercise<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea class="form-control" name="physical_exercise" rows="8" cols="30"></textarea>
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


@endsection
