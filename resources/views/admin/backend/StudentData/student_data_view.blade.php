@extends('admin.admin_master')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.3/handlebars.min.js" integrity="sha512-n9yUUHek//8TJ7Iu8lYy3tQGYDXIvik5Z7N5Ul84ifkz0zEpWMulCimmkiH3ko7BxOZysC44D1USJNo+SM0wuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

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

                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>Year <span class="text-danger"> </span></h5>
                                            <div class="controls">
                                                <select name="year_id" id="year_id" required="" class="form-control">
                                                    <option value="">Select User Year</option>
                                                    @foreach($studentYear as $studentYears)
                                                        <option value="{{$studentYears->id}}">{{$studentYears->year}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div> <!-- End Col md 3 -->

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>Class <span class="text-danger"> </span></h5>
                                            <div class="controls">
                                                <select name="class_id" id="class_id" required="" class="form-control">
                                                    <option value="">Select User Class</option>
                                                    @foreach($studentClass as $studentClasses)
                                                        <option value="{{$studentClasses->id}}">{{$studentClasses->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div> <!-- End Col md 3 -->

                                    <div class="col-md-3" style="padding-top: 25px;">
                                        <a id="search" class="btn btn-primary" name="search"> Search</a>
                                    </div> <!-- End Col md 3 -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>Enter Student ID <span class="text-danger"> </span></h5>
                                            <div class="controls">
                                                <input type="text" id="student_id" class="form-control" placeholder="Student ID and Press Enter Button">
                                            </div>
                                        </div>
                                    </div> <!-- End Col md 3 -->

                                </div><!--  end row -->

                                <!--  Student Data Table -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="DocumentResults">
                                            <script id="document-template" type="text/x-handlebars-template">
                                                <table class="table table-bordered table-striped" style="width: 100%">
                                                    <thead>
                                                    <tr>
                                                        <th>Serial</th>
                                                        <th>Name</th>
                                                        <th>Student ID</th>
                                                        <th>PDF</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @{{#each data}}
                                                    <tr>
                                                        @{{{tdsource}}}
                                                    </tr>
                                                    @{{/each}}
                                                    </tbody>
                                                </table>
                                                <div class="pagination-container">
                                                    @{{{pagination}}} <!-- Dynamic pagination links -->
                                                </div>
                                            </script>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '#search', function() {
                loadStudentData(1);
            });

            $('#student_id').keypress(function(e) {
                if (e.which == 13) {
                    loadStudentData(1);
                }
            });

            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                loadStudentData(page);
            });

            function loadStudentData(page) {
                var year_id = $('#year_id').val();
                var class_id = $('#class_id').val();
                var student_id = $('#student_id').val();

                $.ajax({
                    url: "{{ route('get.student.data') }}?page=" + page,
                    type: "get",
                    data: { 'year_id': year_id, 'class_id': class_id, 'student_id': student_id },
                    beforeSend: function() {},
                    success: function(response) {
                        if (response && response.data) {
                            var source = $("#document-template").html();
                            var template = Handlebars.compile(source);
                            var html = template(response);
                            $('#DocumentResults').html(html);
                        } else {
                            $('#DocumentResults').html('<p>No data found.</p>');
                        }
                    },
                    error: function() {
                        $('#DocumentResults').html('<p>An error occurred while fetching data.</p>');
                    }
                });
            }
        });
    </script>

@endsection
