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
                                <h4 class="box-title">Employee <strong>Monthly Salary</strong></h4>
                            </div>

                            <div class="box-body">


                                <div class="row">



                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <h5>employee Date<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="date" id="date" class="form-control"  data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                                            @error("start_date")
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                    </div> <!-- End Col md 4 -->




                                    <div class="col-md-6" style="padding-top: 25px;">

                                        <a id="search" class="btn btn-primary" name="search"> Search</a>

                                    </div> <!-- End Col md 4 -->
                                </div><!--  end row -->


                                <!--  ////////////////// Registration Fee table /////////////  -->


                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="DocumentResults">

                                            <script id="document-template" type="text/x-handlebars-template">

                                                <table class="table table-bordered table-striped" style="width: 100%">
                                                    <thead>
                                                    <tr>
                                                        @{{{thsource}}}
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @{{#each this}}
                                                    <tr>
                                                        @{{{tdsource}}}
                                                    </tr>
                                                    @{{/each}}
                                                    </tbody>
                                                </table>
                                            </script>



                                        </div>
                                    </div>

                                </div>




                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
            </section>
            <!-- /.content -->

        </div>
    </div>


    <script type="text/javascript">
        $(document).on('click','#search',function(){
            var date = $('#date').val();
            $.ajax({
                url: "{{ route('employee.monthly.salary.get')}}",
                type: "get",
                data: {'date':date,},
                beforeSend: function() {
                },
                success: function (data) {
                    var source = $("#document-template").html();
                    var template = Handlebars.compile(source);
                    var html = template(data);
                    $('#DocumentResults').html(html);
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });
        });

    </script>


@endsection
