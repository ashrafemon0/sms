@extends('admin.admin_master')

@section('admin')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Add your styles here */
    </style>

    <div class="content-wrapper" style="min-height: 984.547px;">
        <div class="container-full">
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-12">
                                        <div class="dropdown">
                                            <button id="dLabel" type="button" class="btn btn-primary" data-bs-toggle="dropdown">
                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge bg-danger">{{ count((array) session('cart')) }}</span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dLabel">
                                                <div class="row">
                                                    <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                                        <a href="{{ route('cart') }}" class="btn btn-primary btn-block">View all</a>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Display logged-in user info -->
                            <div class="box-header with-border">
                                <h4>Student Name: {{ $user->name }} <br>(Student ID: {{ $user->id_no }})</h4>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Class<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="class_id" id="religion" required="" class="form-control">
                                            <option value="">Select User Class</option>
                                            @foreach($studentClass as $studentClasses)
                                                <option value="{{$studentClasses->id}}">{{$studentClasses->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="dataTables_length" id="example1_length">
                                                    <label>Show
                                                        <select name="example1_length" aria-controls="example1" class="form-control form-control-sm">
                                                            <option value="10">10</option>
                                                            <option value="25">25</option>
                                                            <option value="50">50</option>
                                                            <option value="100">100</option>
                                                        </select> entries
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div id="example1_filter" class="dataTables_filter">
                                                    <label>Search:
                                                        <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table id="example1" class="table table-bordered dataTable" role="grid" aria-describedby="example1_info">
                                                    <thead>
                                                    <tr role="row">
                                                        <th style="width: 20.562px;">SL</th>
                                                        <th style="width: 100.312px;">Fee Category</th>
                                                        <th style="width: 100.312px;">Amount</th>
                                                        <th style="width: 100.469px;">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($FeeCategory as $key => $FeeCategoryes)
                                                        <tr role="row" class="even">
                                                            <td>{{ $key + 1 }}</td>

                                                            <td>{{ $FeeCategoryes->name }}</td>
                                                            <td>{{ $FeeCategoryes->amount->fee_category_amount ?? 'N/A' }}</td>
                                                            <td>
                                                                <p class="btn-holder">
                                                                    <a href="{{ route('add_to_cart', $FeeCategoryes->id) }}" class="btn btn-primary btn-block text-center" role="button">Add to cart</a>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-5">
                                                <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
                                            </div>
                                            <div class="col-sm-12 col-md-7">
                                                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                                    <ul class="pagination">
                                                        <li class="paginate_button page-item previous disabled" id="example1_previous">
                                                            <a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                                        </li>
                                                        <li class="paginate_button page-item active">
                                                            <a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                                                        </li>
                                                        <li class="paginate_button page-item">
                                                            <a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">2</a>
                                                        </li>
                                                        <li class="paginate_button page-item">
                                                            <a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0" class="page-link">3</a>
                                                        </li>
                                                        <li class="paginate_button page-item">
                                                            <a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0" class="page-link">4</a>
                                                        </li>
                                                        <li class="paginate_button page-item">
                                                            <a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0" class="page-link">5</a>
                                                        </li>
                                                        <li class="paginate_button page-item">
                                                            <a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0" class="page-link">6</a>
                                                        </li>
                                                        <li class="paginate_button page-item next" id="example1_next">
                                                            <a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
