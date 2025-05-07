<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>payment</title>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pay Invoice #{{ $invoice->id }}</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="invoice-details mb-4">
                        <h4>Invoice Details</h4>
                        <p><strong>Customer:</strong> {{ $invoice->user->username }}</p>
                        <p><strong>Date:</strong> {{ $invoice->date }}</p>
                        <p><strong>Amount:</strong> ${{ number_format($invoice->amount, 2) }}</p>
                    </div>

                    <form id="payment-form" action="{{ route('invoice.process-payment') }}" method="POST">
                        @csrf
                        <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                        
                        <div class="form-group mb-3">
                            <label for="card-holder-name">Card Holder Name</label>
                            <input id="card-holder-name" type="text" class="form-control" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="card-element">Credit or Debit Card</label>
                            <div id="card-element" style="height: 40px; padding: 10px; border: 1px solid #ccc;"></div>
                            <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                        </div>
                        
                        <button id="card-button" class="btn btn-primary btn-block mt-4" data-secret="{{ $intent->client_secret }}">
                            Pay ${{ number_format($invoice->amount, 2) }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="https://js.stripe.com/v3/"></script>
<script>
      const stripe = Stripe('{{ $stripeKey }}');
    const elements = stripe.elements();
    const cardElement = elements.create('card');

    cardElement.mount('#card-element');

    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;
    const form = document.getElementById('payment-form');

    cardElement.addEventListener('change', function(event) {
        const displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    form.addEventListener('submit', async function(event) {
        event.preventDefault();
        
        cardButton.disabled = true;
        cardButton.textContent = 'Processing...';

        try {
        // Confirm the card payment
        const { paymentIntent, error } = await stripe.confirmCardPayment(
            clientSecret,
            {
                payment_method: {
                    card: cardElement,
                    billing_details: { name: cardHolderName.value }
                }
            }
        );

        if (error) {
            // Display error to your customer
            const errorElement = document.getElementById('card-errors');
            errorElement.textContent = error.message;
            
            // Re-enable the submit button
            cardButton.disabled = false;
            cardButton.textContent = 'Pay ${{ number_format($invoice->amount, 2) }}';
        } else {
            if (paymentIntent.status === 'succeeded') {
                // Payment succeeded, create hidden field for payment method
                const paymentMethodInput = document.createElement('input');
                paymentMethodInput.setAttribute('type', 'hidden');
                paymentMethodInput.setAttribute('name', 'payment_method');
                paymentMethodInput.setAttribute('value', paymentIntent.payment_method);
                form.appendChild(paymentMethodInput);
                
                // Add payment intent ID to form
                const paymentIntentInput = document.createElement('input');
                paymentIntentInput.setAttribute('type', 'hidden');
                paymentIntentInput.setAttribute('name', 'payment_intent_id');
                paymentIntentInput.setAttribute('value', paymentIntent.id);
                form.appendChild(paymentIntentInput);
                
                // Submit the form
                form.submit();

                fetch('/process-payment', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    invoice_id: '{{ $invoice->id }}',
                    payment_intent_id: paymentIntent.id,
                }),
            }).then(response => {
                if (response.ok) {
                    window.location = '/customersinvoices?type=invoice';
                } else {
                    document.getElementById('error-message').textContent = 'Payment verification failed.';
                }
            });
            } 
        }
    } catch (e) {
        console.error('Error:', e);
        document.getElementById('card-errors').textContent = 
            'An unexpected error occurred. Please try again.';
        
        // Re-enable the submit button
        cardButton.disabled = false;
        cardButton.textContent = 'Pay ${{ number_format($invoice->amount, 2) }}';
    }
    });
</script>

</body>
</html>