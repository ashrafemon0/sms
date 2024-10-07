@extends('admin.admin_master')

@section('admin')

    <div class="content-wrapper" style="min-height: 984.547px;">
        <div class="container-full">
            <!-- Content Header (Page header) -->

            <section class="content">

                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Student Group Edit</h4>
                        <h6 class="box-subtitle">Bootstrap Form Validation check the <a class="text-warning" href="http://reactiveraven.github.io/jqBootstrapValidation/">official website </a></h6>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" action="{{route("update.group",$GroupEdit->id)}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <h5>Group Edit <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="name" name="group" class="form-control"  data-validation-required-message="This field is required" value="{{$GroupEdit->group}}"> <div class="help-block"></div></div>
                                                @error("group")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-info" value="Update">
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