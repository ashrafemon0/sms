@extends('admin.admin_master')

@section('admin')
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <h3>Payment Successful</h3>
                        <p>Transaction ID: {{ $payment->tran_id }}</p>
                        <p>Amount Paid: {{ $payment->amount }}</p>

                        <!-- Download Receipt Button -->
                        <form action="{{ route('payment.download_receipt', $payment->tran_id) }}" method="GET" id="downloadReceiptForm">
                            <button type="submit" class="btn btn-success">Download Receipt</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script>
        // Redirect to dashboard after download
        document.getElementById('downloadReceiptForm').onsubmit = function() {
            setTimeout(function() {
                window.location.href = "{{ route('dashboard') }}"; // Replace with the correct route to the dashboard
            }, 1000); // Delay to allow download before redirect
        };
    </script>
@endsection
