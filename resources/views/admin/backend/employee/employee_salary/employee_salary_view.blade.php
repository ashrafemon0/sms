@extends('admin.admin_master')

@section('admin')

    <div class="content-wrapper" style="min-height: 984.547px;">
        <div class="container-full">
            <!-- Content Header (Page header) -->

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Employee Salary List</h3>
                                <a style="float: right" class="btn btn-success" href="{{route("add.employee")}}">ADD Salary</a>
                            </div>

                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="example1_length"><label>Show <select name="example1_length" aria-controls="example1" class="form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                                    <thead>
                                                    <tr role="row">
                                                        <th width="5%">SL</th>
                                                        <th width="10%">ID No</th>
                                                        <th width="15%">Mobile</th>
                                                        <th width="10%">Gender</th>
                                                        <th width="15%">Joining Date</th>
                                                        <th width="10%">Salary</th>
                                                        <th width="20%">Action</th>
                                                    </thead>
                                                    @foreach($allData as $key => $value)
                                                        <tbody>

                                                        <tr role="row" class="even">
                                                            <td>{{$key +1}}</td>
                                                            <td >{{$value->id_no}}</td>
                                                            <td >{{$value->mobile}}</td>
                                                            <td >{{$value->gender}}</td>
                                                            <td >{{$value->join_date}}</td>
                                                            <td >{{$value->salary}}</td>
                                                            <td>
                                                                <a title="Increment" class="btn btn-info" href="{{route("employee.salary.increment",$value->id)}}"><i class="fa fa-plus-circle"></i></a>
                                                                <a title="Details" class="btn btn-danger" href="{{route("employee.salary.details",$value->id)}}"><i class="fa fa-eye"></i></a>
                                                            </td>

                                                        </tr>
                                                        </tbody>
                                                    @endforeach
                                                </table>
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
