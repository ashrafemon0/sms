@extends('admin.admin_master')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.3/handlebars.min.js" integrity="sha512-n9yUUHek//8TJ7Iu8lYy3tQGYDXIvik5Z7N5Ul84ifkz0zEpWMulCimmkiH3ko7BxOZysC44D1USJNo+SM0wuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->


            <!-- Main content -->
            <section class="content">
                <div class="row">

                    <div class="col-12">
                        <div class="box bb-3 border-warning">
                            <div class="box-header">
                                <h4 class="box-title">Student <strong>Student Data</strong></h4>
                            </div>

                            <div class="box-body">
                                <form method="post" action="{{ route('store.student.data') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Year <span class="text-danger"> *</span></h5>
                                                <div class="controls">
                                                    <select name="year_id" id="year_id" required class="form-control">
                                                        <option value="">Select User Year</option>
                                                        @foreach($studentYear as $studentYears)
                                                            <option value="{{ $studentYears->id }}">{{ $studentYears->year }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Class <span class="text-danger"> *</span></h5>
                                                <div class="controls">
                                                    <select name="class_id" id="class_id" required class="form-control">
                                                        <option value="">Select User Class</option>
                                                        @foreach($studentClass as $studentClasses)
                                                            <option value="{{ $studentClasses->id }}">{{ $studentClasses->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Name <span class="text-danger"> *</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="Sname" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Student ID <span class="text-danger"> *</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="Sid" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>PDF Upload <span class="text-danger"> *</span></h5>
                                                <div class="controls">
                                                    <input name="pdf" class="form-control" type="file" id="pdf" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-info" value="Add">
                                    </div>
                                </form>
                                </div><!--  end row -->

                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
            </section>
            <!-- /.content -->

        </div>
    </div>





@endsection
