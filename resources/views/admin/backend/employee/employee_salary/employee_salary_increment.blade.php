@extends('admin.admin_master')

@section('admin')

    <div class="content-wrapper" style="min-height: 984.547px;">
        <div class="container-full">
            <!-- Content Header (Page header) -->

            <section class="content">

                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Salary Increment</h4>
                        <h6 class="box-subtitle">Bootstrap Form Validation check the <a class="text-warning" href="http://reactiveraven.github.io/jqBootstrapValidation/">official website </a></h6>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" action="{{route("store.salary.employee",$allData->id)}}">
                                    @csrf
                                    <div class="row mb-5">
                                        <div class="col-md-6">
                                            <div class="controls">
                                                <input type="text" name="name" class="form-control" readonly data-validation-required-message="This field is required" value="{{$allData->name}}"> <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <h5>Salary Increment<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="increment_salary" class="form-control"  data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                                @error("increment_salary")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <h5>Salary Efected<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="effected_salary" class="form-control"  data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                                @error("effected_salary")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
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
