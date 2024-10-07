@extends('admin.admin_master')

@section('admin')

    <div class="content-wrapper" style="min-height: 984.547px;">
        <div class="container-full">
            <!-- Content Header (Page header) -->

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box bb-3 border-warning">
                            <div class="box-header">
                                <h4 class="box-title">Student <strong>Search</strong></h4>
                            </div>

                            <div class="box-body">
                                <form method="GET" action="{{route('student.class.year.wise')}}">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Class<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="class_id" id="religion" required="" class="form-control">
                                                        <option value="">Select User Class</option>
                                                        @foreach($studentClass as $studentClasses)
                                                            <option value="{{$studentClasses->id}}" {{ (@$class_id == $studentClasses->id)? 'selected': ''}}>{{$studentClasses->name}}</option>
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
                                                            <option value="{{$studentYears->id}}" {{ (@$year_id == $studentYears->id)? 'selected': ''}}>{{$studentYears->year}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4" style="padding-top: 25px">
                                            <input type="submit" class="btn btn-rounded btn-dark mb-5" name="search" value="Search">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Assign Student</h3>
                                <a style="float: right" class="btn btn-success" href="{{route("add.student")}}">ADD Assign Student</a>
                            </div>

                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="example1_length"><label>Show <select name="example1_length" aria-controls="example1" class="form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label></div></div></div><div class="row"><div class="col-sm-12">
                                                @if(!empty($search))
                                                <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">

                                                    <thead>
                                                    <tr role="row">
                                                        <th width="10%">SL</th>
                                                        <th >Name</th>
                                                        <th >ID_No</th>
                                                        <th >Roll</th>
                                                        <th >Year</th>
                                                        <th >Class</th>
                                                        <th >Image</th>
                                                        @if(Auth::user()->role == 'admin')
                                                        <th >Code</th>
                                                        @endif
                                                        <th width="20%">Action</th>
                                                    </thead>
                                                        <tbody>
                                                        @foreach($allData as $key => $value)
                                                        <tr role="row" class="even">
                                                            <td >{{$key +1}}</td>
                                                            <td >{{$value['student']['name']}}</td>
                                                            <td >{{$value['student']['id_no']}}</td>
                                                            <td >{{$value->roll}}</td>
                                                            <td >{{$value['student_year']['year']}}</td>
                                                            <td >{{$value['student_class']['name']}}</td>
                                                            <td >
                                                                <img class="rounded-circle" src="{{(!empty($value['student']['image'])? url('upload/user_image/'.$value['student']['image']): url('upload/no_image.jpg'))}}" style="width: 50px; height: 50px" alt="User Avatar">
                                                            </td>

                                                            <td >5</td>

                                                            <td>
                                                                <a title="Edit" href="{{ route('student.reg.edit',$value->student_id) }}" class="btn btn-info"> <i class="fa fa-edit"></i> </a>

                                                                <a title="Promotion" href="{{ route('student.reg.promotion',$value->student_id) }}" class="btn btn-primary" ><i class="fa fa-check"></i></a>

                                                                <a target="_blank" title="Details" href="{{ route('student.registration.details',$value->student_id) }}" class="btn btn-danger"  ><i class="fa fa-eye"></i></a>
                                                            </td>

                                                        </tr>
                                                        @endforeach
                                                        </tbody>

                                                </table>
                                                @else
                                                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">

                                                        <thead>
                                                        <tr role="row">
                                                            <th width="10%">SL</th>
                                                            <th >Name</th>
                                                            <th >ID_No</th>
                                                            <th >Roll</th>
                                                            <th >Year</th>
                                                            <th >Class</th>
                                                            <th >Image</th>
                                                            @if(Auth::user()->role == 'admin')
                                                                <th >Code</th>
                                                            @endif
                                                            <th width="20%">Action</th>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($allData as $key => $value)
                                                            <tr role="row" class="even">
                                                                <td >{{$key +1}}</td>
                                                                <td >{{$value['student']['name']}}</td>
                                                                <td >{{$value['student']['id_no']}}</td>
                                                                <td >{{$value->roll}}</td>
                                                                <td >{{$value['student_year']['year']}}</td>
                                                                <td >{{$value['student_class']['name']}}</td>
                                                                <td >
                                                                    <img class="rounded-circle" src="{{(!empty($value['student']['image'])? url('upload/user_image/'.$value['student']['image']): url('upload/no_image.jpg'))}}" style="width: 50px; height: 50px" alt="User Avatar">
                                                                </td>

                                                                <td >5</td>

                                                                <td>
                                                                    <a title="Edit" href="{{ route('student.reg.edit',$value->student_id) }}" class="btn btn-info"> <i class="fa fa-edit"></i> </a>

                                                                    <a title="Promotion" href="{{ route('student.reg.promotion',$value->student_id) }}" class="btn btn-primary" ><i class="fa fa-check"></i></a>

                                                                    <a target="_blank" title="Details" href="{{ route('student.registration.details',$value->student_id) }}" class="btn btn-danger"  ><i class="fa fa-eye"></i></a>
                                                                </td>

                                                            </tr>
                                                        @endforeach
                                                        </tbody>

                                                    </table>

                                                @endif
                                            </div>
                                        </div>
                                        <div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0" class="page-link">6</a></li><li class="paginate_button page-item next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->

        </div>
    </div>



@endsection
