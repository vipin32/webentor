@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Webentor</div>

                <div class="card-body text-center">
                    <h3>Welcome To <strong>Webentor</strong></h3>
                    <!-- <form><script src="https://checkout.razorpay.com/v1/payment-button.js" data-payment_button_id="pl_IcYO6Q4LHYyDxJ" async> </script> </form> -->
                </div>
            </div>
        </div>
    </div>

    <div class="row my-4 align-items-center justify-content-center">

        @foreach($products as $product)
            <div class="col-sm-3 mx-1 products-container">
                <form action="{{ route('razorpay.payment.store') }}" method="POST" >
                    @csrf
                    <div class="row bg-dark text-white products align-items-center justify-content-center">
                        <p class="text-center">{{$product->name}}</p>
                    </div>
                    <!-- <center><a href="{{route('payment', $product->price)}}" class="btn btn-primary btn-sm my-2">Pay {{$product->price}}</a></center> -->
                    
                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                        data-key="{{ env('RAZORPAY_KEY') }}"
                        data-amount={{$product->price * 100}} 
                        data-buttontext="Pay {{$product->price}} INR"
                        data-name="Webentor"
                        data-description="By Vipin"
                        data-image="https://udraodisha.com/wp-content/uploads/2021/08/1_4XRAX4obUOvMVqWibVCneQ.jpeg"
                        data-prefill.name="name"
                        data-prefill.email="email"
                        data-theme.color="#ff7529">
                    </script>
                </form>            
            </div>
        @endforeach
    </div>
</div>
@endsection
