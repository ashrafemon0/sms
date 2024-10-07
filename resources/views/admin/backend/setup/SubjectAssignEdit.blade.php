@extends('admin.admin_master')

@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->


            <section class="content">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Edit Subject Assign</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">

                                <form method="post" action="{{ route('update.SubjectAssign',$editData[0]->class_id) }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="add_item">

                                                <div class="form-group">
                                                    <h5>Subject Assign<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="class_id" id="usertype" required="" class="form-control">
                                                            <option value="">Select Student Class</option>
                                                            @foreach($StudentClass as $key => $StudentClasses)
                                                                <option value="{{$StudentClasses->id}}" {{( $editData[0]->class_id == $StudentClasses->id ? 'selected':'' )}}>{{$StudentClasses->name}}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div> <!-- // end form group -->
                                                @foreach($editData as $edit)
                                                    <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                                                <div class="row">

                                                    <div class="col-md-4">

                                                        <div class="form-group">
                                                            <h5>Student Class <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <select name="subject_id[]" id="usertype" required="" class="form-control">
                                                                    <option value="">Select Student Subject</option>
                                                                    @foreach($StudentSubject as $key => $StudentSubjects)
                                                                        <option value="{{$StudentSubjects->id}}" {{( $edit->subject_id == $StudentSubjects->id ? 'selected':'' )}}>{{$StudentSubjects->name}}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div> <!-- // end form group -->


                                                    </div> <!-- End col-md-5 -->

                                                    <div class="col-md-2">

                                                        <div class="form-group">
                                                            <h5>Full Mark <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="text" name="full_mark[]" class="form-control" required="" data-validation-required-message="This field is required" value="{{$edit->full_mark}}"> <div class="help-block"></div></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">

                                                        <div class="form-group">
                                                            <h5>Pass Mark <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="text" name="pass_mark[]" class="form-control" required="" data-validation-required-message="This field is required" value="{{$edit->pass_mark}}"> <div class="help-block"></div></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">

                                                        <div class="form-group">
                                                            <h5>Subjective Mark <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="text" name="subjective_mark[]" class="form-control" required="" data-validation-required-message="This field is required" value="{{$edit->subjective_mark}}"> <div class="help-block"></div></div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2" style="padding-top: 25px;">
                                                        <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> </span>
                                                        <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i> </span>
                                                    </div><!-- End col-md-5 -->
                                                </div><!-- End col-md-5 -->

                                            </div> <!-- end Row -->
                                                @endforeach

                                            </div> <!-- end Row -->
                                        </div>
                                    </div>	<!-- // End add_item -->

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-info mb-5" value="Submit">
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


    <div style="visibility: hidden;">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                <div class="form-row">

                    <div class="col-md-4">

                        <div class="form-group">
                            <h5>Student Class <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="subject_id[]" id="usertype" required="" class="form-control">
                                    <option value="">Select Student Class</option>
                                    @foreach($StudentSubject as $key => $StudentSubjects)
                                        <option value="{{$StudentSubjects->id}}">{{$StudentSubjects->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div> <!-- // end form group -->

                    </div><!-- End col-md-5 -->
                    <div class="col-md-2">

                        <div class="form-group">
                            <h5>Full Mark <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="full_mark[]" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                        </div>
                    </div>
                    <div class="col-md-2">

                        <div class="form-group">
                            <h5>Pass Mark <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="pass_mark[]" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                        </div>
                    </div>
                    <div class="col-md-2">

                        <div class="form-group">
                            <h5>Subjective Mark <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="subjective_mark[]" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                        </div>
                    </div>
                    <div class="col-md-2" style="padding-top: 25px;">
                        <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> </span>
                        <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i> </span>
                    </div><!-- End col-md-2 -->

                </div>
            </div>
        </div>



        <script type="text/javascript">
            $(document).ready(function(){
                var counter = 0;
                $(document).on("click",".addeventmore",function(){
                    var whole_extra_item_add = $('#whole_extra_item_add').html();
                    $(this).closest(".add_item").append(whole_extra_item_add);
                    counter++;
                });
                $(document).on("click",'.removeeventmore',function(event){
                    $(this).closest(".delete_whole_extra_item_add").remove();
                    counter -= 1
                });

            });
        </script>

@endsection
