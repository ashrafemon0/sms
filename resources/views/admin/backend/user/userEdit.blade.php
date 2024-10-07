@extends('admin.admin_master')

@section('admin')

    <div class="content-wrapper" style="min-height: 984.547px;">
        <div class="container-full">
            <!-- Content Header (Page header) -->

            <section class="content">

                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Form Validation</h4>
                        <h6 class="box-subtitle">Bootstrap Form Validation check the <a class="text-warning" href="http://reactiveraven.github.io/jqBootstrapValidation/">official website </a></h6>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" action="{{route("update.user",$userEdit->id)}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <h5>User Name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="name" name="name" class="form-control" required="" data-validation-required-message="This field is required" value="{{$userEdit->name}}"> <div class="help-block"></div></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <h5>Role <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="role" id="role" required="" class="form-control">
                                                        <option value="">Select User Role</option>
                                                        <option value="admin" {{($userEdit->role == 'admin' ? 'selected': '')}}>Admin</option>
                                                        <option value="operator" {{($userEdit->role == 'operator' ? 'selected': '')}}>User</option>
                                                        <option value="Student" {{($userEdit->role == 'Student' ? 'selected': '')}}>Student</option>
                                                    </select>
                                                    <div class="help-block"></div></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <h5>User Email <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="email" name="email" class="form-control" required="" data-validation-required-message="This field is required" value="{{$userEdit->email}}"> <div class="help-block"></div></div>
                                            </div>
                                        </div>
                                        <div class="col-6">

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
