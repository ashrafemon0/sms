@extends('admin.admin_master')

@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="content-wrapper" style="min-height: 984.547px;">
        <div class="container-full">
            <!-- Content Header (Page header) -->

            <section class="content">

                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Employee Leave</h4>
                        <h6 class="box-subtitle">Bootstrap Form Validation check the <a class="text-warning" href="http://reactiveraven.github.io/jqBootstrapValidation/">official website </a></h6>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" action="{{route("store.employee.leave")}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="controls">
                                                <h5>Employee name<span class="text-danger">*</span></h5>
                                                <select name="employee_id" id="designation" required="" class="form-control">
                                                    <option value="" selected="" disabled="">Select Employee</option>
                                                    @foreach($employee as $employees)
                                                        <option value="{{$employees->id}}">{{$employees->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Start Date<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="start_date" class="form-control"  data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                                @error("start_date")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Leave Purpose<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="leave_purpose_id" id="leave_purpose_id" required="" class="form-control">
                                                        <option value="" selected="" disabled="">Select Leave Purpose</option>
                                                        @foreach($leave_purpose as $leave_purposes)
                                                            <option value="{{$leave_purposes->id}}">{{$leave_purposes->name}}</option>
                                                        @endforeach
                                                        <option value="0">New Purpose</option>
                                                    </select>
                                                    <input type="text" name="name" id="another_purpose" class="form-control" placeholder="Write Purpose" style="display: none">
                                                </div>
                                                @error("leave_purpose_id")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>End Date<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="end_date" class="form-control"  data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                                @error("end_date")
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

<script type="text/javascript">
    $(document).ready(function (){
        $(document).on('change','#leave_purpose_id',function (){
            var leave_purpose_id = $(this).val();
            if(leave_purpose_id == 0){
                $('#another_purpose').show();
            }else{
                $('#another_purpose').hide();
            }
        })
    })

</script>

@endsection
