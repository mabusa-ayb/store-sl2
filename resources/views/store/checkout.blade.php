@extends('store.layouts.app')

@section('content')
<div class="container">
<br><br>
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your Cart</span>
                <span class="badge badge-secondary badge-pill">{{ \Cart::getTotalQuantity()}}</span>
            </h4>
            <ul class="list-group mb-3">
                @foreach($cartCollection as $item)
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">{{$item->name}}</h6>
                        <small class="text-muted">Qty: {{$item->quantity}}</small>
                    </div>
                    <span class="text-muted">${{ \Cart::get($item->id)->getPriceSum() }}</span>
                </li>
                @endforeach
                <hr>
                <li class="list-group-item d-flex justify-content-between bg-light">
                    <span>Total (USD)</span>
                    <strong>${{ \Cart::getTotal() }}</strong>
                </li>
            </ul>

        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing details</h4>
            <form class="needs-validation" novalidate="">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">First name</label>
                        <input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Last name</label>
                        <input type="text" class="form-control" id="lastName" placeholder="" value="" required="">
                        <div class="invalid-feedback">
                            Valid last name is required.
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="you@example.com">
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="1234 Main St" required="">
                    <div class="invalid-feedback">
                        Please enter your shipping address.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                    <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="state">City/Town</label>
                        <input type="text" class="form-control" id="city" placeholder="" value="" required="">
                        <div class="invalid-feedback">
                            Please provide a valid state.
                        </div>
                    </div>
                    <div class="col-md-5 mb-3">
                        <label for="country">Country</label>
                        <select class="custom-select d-block w-100" id="country" required="">
                            <option value="">Choose...</option>
                            <option>United States</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid country.
                        </div>
                    </div>
                </div>
                <hr class="mb-4">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="shipping" value="1">
                    <label class="custom-control-label" for="same-address">Add Shipping</label>
                </div>
                <hr class="mb-4">

                <h4 class="mb-3">Payment</h4>

                <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                        <input id="credit" name="paynow" type="radio" class="custom-control-input" required="">
                        <label class="custom-control-label" for="credit">Paynow</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="debit" name="cod" type="radio" class="custom-control-input" required="">
                        <label class="custom-control-label" for="debit">Cash On Delivery</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="paypal" name="bt" type="radio" class="custom-control-input" required="">
                        <label class="custom-control-label" for="paypal">Bank Transfer</label>
                    </div>
                </div>
                <!-- Purchase Detail -->
                @foreach($cartCollection as $item)
                    <input type="hidden" readonly="true" name="productid[]" value="{{$item->id}}">
                    <input type="hidden" readonly="true" name="product_name[]" value="{{$item->name}}">
                    <input type="hidden" readonly="true" name="product_quantity[]" value="{{$item->quantity}}">
                @endforeach
                <!-- /. End Purchase Details -->
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
            </form>
        </div>
    </div>

</div>
@endsection
