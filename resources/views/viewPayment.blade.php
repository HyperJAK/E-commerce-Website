@extends('master2')
@section('title')
<title>Payment</title>
@endsection
@section('content')
<h1 class="fashion_title">Confirm Payment</h1>
    <div class="container" style="margin-top:2%;margin-bottom:5%;width:100%;">
        <div class="row justify-content-center">
        
            <div class="col-md-10">
                <div class="card" style="box-shadow: 0 0 2rem .2rem var(--maincolor);">
                    <div class="card-header">Payment Details</div>

                    <div class="card-body">
                        <form id="payment-form" action="{{route('payment/process')}}" method="POST">
                        @csrf
                        <div class="form-group">
                                <label for="card_number">Card Number</label>
                                <div id="card_number" class="form-control"></div>
                            </div>

                           
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="expiration_month">Expiration Month</label>
                                    <input type="text" class="form-control" id="expiration_month" placeholder="MM" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="expiration_year">Expiration Year</label>
                                    <input type="text" class="form-control" id="expiration_year" placeholder="YYYY" required>
                                </div>
                            </div>

                         
                            <div class="form-group">
                                <label for="cvc">CVC</label>
                                <input type="text" class="form-control" id="cvc" placeholder="CVC" required>
                            </div>

                           
                            <button type="submit" class="btn btn-outline-dark" id="pay-btn">Submit Payment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');
        const elements = stripe.elements();
        const cardElement = elements.create('card', {
            hidePostalCode: true,
        });
        cardElement.mount('#card_number');
        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const { paymentMethod, error } = await stripe.createPaymentMethod({
                type: 'card',
                card: cardElement,
            });

            if (error) {
                console.error(error);
            } else {
                const tokenInput = document.createElement('input');
                tokenInput.setAttribute('type', 'hidden');
                tokenInput.setAttribute('name', 'payment_method_id');
                tokenInput.setAttribute('value', paymentMethod.id);
                form.appendChild(tokenInput);

                form.submit();
            }
        });
    </script>
@endsection
