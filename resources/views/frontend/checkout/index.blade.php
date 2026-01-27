@extends('frontend.layout.master')

@section('title', 'Checkout')

@section('content')
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <h4>Billing Details</h4>

            <!-- POST form to checkout.store -->
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf

                <div class="row">
                    <!-- Billing Details -->
                    <div class="col-lg-8 col-md-6">
                        <div class="checkout__input mb-3">
                            <p>Name <span>*</span></p>
                            <input type="text" name="customer_name" class="form-control" placeholder="Customer Name" required>
                        </div>

                        <div class="checkout__input mb-3">
                            <p>Email <span>*</span></p>
                            <input type="email" name="customer_email" class="form-control" placeholder="Email Address" required>
                        </div>

                        <div class="checkout__input mb-3">
                            <p>Phone <span>*</span></p>
                            <input type="text" name="customer_phone" class="form-control" placeholder="Phone Number" required>
                        </div>

                        <div class="checkout__input mb-3">
                            <p>Address <span>*</span></p>
                            <input type="text" name="shipping_address" class="form-control" placeholder="Street Address" required>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Your Order</h4>
                            <div class="checkout__order__products">Products <span>Total</span></div>

                            <ul>
                                @foreach ($cart as $id => $item)
                                    <li>
                                        {{ $item['name'] }}
                                        <span>${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                    </li>
                                    <!-- Hidden input for quantity & id (optional) -->
                                    <input type="hidden" name="cart[{{ $id }}][quantity]" value="{{ $item['quantity'] }}">
                                @endforeach
                            </ul>

                            @php
                                $subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
                                $vat = $subtotal * 0.1;
                                $total = $subtotal + $vat;
                            @endphp

                            <div class="checkout__order__subtotal">Subtotal <span>${{ number_format($subtotal, 2) }}</span></div>
                            <div class="checkout__order__total">VAT (10%) <span class="text-dark">${{ number_format($vat, 2) }}</span></div>
                            <div class="checkout__order__total">Total <span>${{ number_format($total, 2) }}</span></div>

                            <button type="submit" class="site-btn mt-3 w-100">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
