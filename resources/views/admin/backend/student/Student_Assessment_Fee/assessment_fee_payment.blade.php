@extends('admin.admin_master')

@section('admin')

    <style>
        .month-checkboxes {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .month-checkbox {
            display: flex;
            align-items: center;
        }
        .month-checkbox input {
            margin-right: 5px;
        }
    </style>

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
                                <form action="{{ route('assessment.fee.pay.slipe', [$class_id, $student_id]) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                                    <input type="hidden" name="class_id" value="{{ $class_id }}">
                                    <div class="row">
                                        <!-- Form Fields -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Student Name:</label>
                                                <input type="text" class="form-control" name="student_name" value="{{ $student->name }}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date:</label>
                                                <input type="date" class="form-control" name="payment_date" value="{{ old('payment_date') }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Fee Amount:</label>
                                                <input type="text" class="form-control" name="fee_amount" value="{{ $feeAmount ? $feeAmount->fee_category_amount . ' Tk' : 'N/A' }}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Promo Code:</label>
                                                <input type="text" class="form-control" name="promo_code" placeholder="Enter Promo Code" value="{{ request()->promo_code }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Discount:</label>
                                                <input type="text" class="form-control" name="discount" value="{{ $discount }}%" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Total Amount:</label>
                                                <input type="text" class="form-control" name="total_amount" value="{{ $totalAmount }} Tk" readonly>
                                                <input type="hidden" name="amount" value="{{ $totalAmount }}">
                                            </div>
                                        </div>

                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary">Submit Payment</button>
                                        </div>
                                    </div>
                                </form>

                                <!-- Display Payment History -->
                                <div class="box-header mt-4">
                                    <h4 class="box-title">Payment History</h4>
                                </div>

                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Payment Date</th>
                                            <th>Amount</th>
                                            <th>Discount</th>
                                            <th>Total Amount</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($payments as $payment)
                                            <tr>
                                                <td>{{ $payment->payment_date }}</td>
                                                <td>{{ $payment->amount }} Tk</td>
                                                <td>{{ $payment->discount }}%</td>
                                                <td>{{ $payment->amount + $payment->late_fee }} Tk</td>
                                                <td>
                                                    @if($payment->status === 'Paid')
                                                        <button class="btn-sm btn-secondary" disabled>Paid</button>
                                                    @else
                                                        <form action="{{ route('payment.initiate') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="amount" value="{{ $payment->amount + $payment->late_fee }}">
                                                            <input type="hidden" name="tran_id" value="{{ $payment->tran_id }}">
                                                            <input type="hidden" name="success_url" value="{{ $payment->success_url }}">
                                                            <input type="hidden" name="student_id" value="{{ $student->id }}">
                                                            <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                                                            <button type="submit" class="btn-sm btn-success">Pay Now</button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection
