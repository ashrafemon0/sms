@extends('admin.admin_master')

@section('admin')

    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header">
                                <h4 class="box-title">Student <strong>Payment Details</strong></h4>
                            </div>

                            <div class="box-body">
                                <form action="{{ route('payment.initiate') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <!-- Name (Dynamic) -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Student Name:</label>
                                                <input type="text" class="form-control" name="student_name" value="{{ $student->name }}" readonly>
                                            </div>
                                        </div>

                                        <!-- Date -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date:</label>
                                                <input type="date" class="form-control" name="payment_date" value="{{ old('payment_date') }}" required>
                                            </div>
                                        </div>

                                        <!-- Fee Amount -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Fee Amount:</label>
                                                <input type="text" class="form-control" name="fee_amount" value="{{ $feeAmount->fee_category_amount }} Tk" readonly>
                                            </div>
                                        </div>

                                        <!-- Promo Code -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Promo Code:</label>
                                                <input type="text" class="form-control" name="promo_code" placeholder="Enter Promo Code" value="{{ request()->promo_code }}">
                                            </div>
                                        </div>

                                        <!-- Discount -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Discount:</label>
                                                <input type="text" class="form-control" name="discount" value="{{ $discount }}%" readonly>
                                            </div>
                                        </div>

                                        <!-- Total Amount -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Total Amount:</label>
                                                <input type="text" class="form-control" name="total_amount" value="{{ $totalAmount }} Tk" readonly>
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="col-md-6 text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                        <div class="col-md-6">
                                            <a class="btn btn-info" href="#">Next</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection
