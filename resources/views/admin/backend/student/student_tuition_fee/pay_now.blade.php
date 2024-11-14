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
                            @if (session('error'))
                                <div class="alert alert-danger" id="errorMessage">
                                    {{ session('error') }}
                                </div>

                                <script>
                                    // Show the error message and reload the page after 3 seconds
                                    window.onload = function() {
                                        setTimeout(function() {
                                            location.reload(); // This will reload the page
                                        }, 3000); // Adjust the delay in milliseconds (3000ms = 3 seconds)
                                    };
                                </script>
                            @endif

                            <div class="box-body">
                                <form action="{{ route('tuition.fee.pay.slipe', [$class_id, $student_id]) }}" method="POST">
                                    @csrf
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
                                                <input type="date" class="form-control" name="payment_date" value="{{ date('Y-m-d') }}" required readonly>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Fee Amount:</label>
                                                <input type="text" class="form-control" name="fee_amount" value="{{ $feeAmount->fee_category_amount }} Tk" readonly>
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
                                                <label>Number of Months:</label>

                                                <div class="month-checkboxes">
                                                    <div class="month-checkbox">
                                                        <input type="checkbox" id="january" name="months[]" value="January">
                                                        <label for="january">January</label>
                                                    </div>
                                                    <div class="month-checkbox">
                                                        <input type="checkbox" id="february" name="months[]" value="February">
                                                        <label for="february">February</label>
                                                    </div>
                                                    <div class="month-checkbox">
                                                        <input type="checkbox" id="march" name="months[]" value="March">
                                                        <label for="march">March</label>
                                                    </div>
                                                    <div class="month-checkbox">
                                                        <input type="checkbox" id="april" name="months[]" value="April">
                                                        <label for="april">April</label>
                                                    </div>
                                                    <div class="month-checkbox">
                                                        <input type="checkbox" id="may" name="months[]" value="May">
                                                        <label for="may">May</label>
                                                    </div>
                                                    <div class="month-checkbox">
                                                        <input type="checkbox" id="june" name="months[]" value="June">
                                                        <label for="june">June</label>
                                                    </div>
                                                    <div class="month-checkbox">
                                                        <input type="checkbox" id="july" name="months[]" value="July">
                                                        <label for="july">July</label>
                                                    </div>
                                                    <div class="month-checkbox">
                                                        <input type="checkbox" id="august" name="months[]" value="August">
                                                        <label for="august">August</label>
                                                    </div>
                                                    <div class="month-checkbox">
                                                        <input type="checkbox" id="september" name="months[]" value="September">
                                                        <label for="september">September</label>
                                                    </div>
                                                    <div class="month-checkbox">
                                                        <input type="checkbox" id="october" name="months[]" value="October">
                                                        <label for="october">October</label>
                                                    </div>
                                                    <div class="month-checkbox">
                                                        <input type="checkbox" id="november" name="months[]" value="November">
                                                        <label for="november">November</label>
                                                    </div>
                                                    <div class="month-checkbox">
                                                        <input type="checkbox" id="december" name="months[]" value="December">
                                                        <label for="december">December</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if($lateFee > 0)
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Late Fee:</label>
                                                    <input type="text" class="form-control" value="{{ $lateFee }} Tk" readonly>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Total Amount:</label>
                                                <input type="text" class="form-control" name="total_amount" value="{{ $totalAmount }} Tk" readonly>
                                                <input type="hidden" name="amount" id="amount" value="{{ $totalAmount }}">
                                            </div>
                                        </div>

                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary">Submit Payment</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- Display Inserted Payment Data -->
                                <div class="box-header mt-4">
                                    <h4 class="box-title">Payment History</h4>
                                </div>

                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Payment Date</th>
                                            <th>Months Paid</th>
                                            <th>Amount</th>
                                            <th>Late Fee</th>
                                            <th>Discount</th>
                                            <th>Total Amount</th>
                                            <th>Status</th> <!-- New column -->
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($payments as $payment)
                                            <tr>
                                                <td>{{ $payment->payment_date }}</td>
                                                <td>{{ $payment->months }}</td>
                                                <td>{{ $payment->amount }} Tk</td>
                                                <td>{{ $payment->late_fee }} Tk</td>
                                                <td>{{ $payment->discount }}%</td>
                                                <td>{{ $payment->amount + $payment->late_fee }} Tk</td>
                                                <td>
                                                    @if($payment->status === 'Paid')
                                                        <button class="btn-sm btn-secondary" disabled>Paid</button>
                                                    @else
                                                        <form action="{{ route('payment.initiate') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="amount" value="{{ $payment->amount + $payment->late_fee }}">
                                                            <input type="hidden" name="tran_id" value="{{ $payment->tran_id }}"> <!-- Assuming transaction ID is stored in the payment table -->
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
{{--    <script>--}}
{{--        document.getElementById('nextButton').addEventListener('click', function() {--}}
{{--            const form = document.querySelector('form');--}}
{{--            form.action = "{{ route('payment.initiate') }}"; // Set to your payment route--}}
{{--            form.method = 'POST'; // Ensure it's a POST request--}}
{{--            form.submit(); // Submit the form--}}
{{--        });--}}
{{--    </script>--}}

@endsection
