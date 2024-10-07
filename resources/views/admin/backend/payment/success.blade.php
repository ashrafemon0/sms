@extends('admin.admin_master')

@section('admin')
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">
                <h2>Payment Successful!</h2>
                <p>Thank you for your payment. Your transaction ID is: {{ $payment->tran_id }}</p>
            </section>
        </div>
    </div>
@endsection
