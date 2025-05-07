<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use Stripe\Stripe;
use Stripe\PaymentIntent;

use function PHPUnit\Framework\never;

class PaymentController extends Controller
{
    public function showPaymentForm($invoice_id)
    { 
        $invoice = Invoice::with('user')->findOrFail($invoice_id);
        $user = $invoice->user;
        $val=$user->createOrGetStripeCustomer();
        //  dd($val);
        // Check if invoice is already paid
        if ($invoice->status != 'Unpaid') {
            return redirect()->route('customersinvoices', ['type' => 'invoice'])
                ->with('message', 'This invoice has already been processed.');
        }
       
        // Create a payment intent for this invoice
        try {
            $amount = (int)($invoice->amount * 100); // Convert to cents
            Stripe::setApiKey(config('services.stripe.secret'));
        $paymentIntent = PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'usd',
            'customer' => $user->stripe_id,
            'metadata' => [
                'invoice_id' => $invoice->id,
            ],
            'payment_method_types' => ['card'], 
            
        ]);
        // dd($paymentIntent->toArray());
           
            return view('paymentform', [
                'invoice' => $invoice,
                'intent' => $paymentIntent,
                'stripeKey' => config('services.stripe.key')
            ]);
        } catch (Exception $e) {
            dd('Stripe error:', $e->getMessage());
            Log::error('Payment Intent Creation Error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['payment_error' => 'Unable to initialize payment. Please try again later.']);
        }
    }
    
    public function processPayment(Request $request)
    { 
        $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'payment_method' => 'required',
        ]);
        
        $invoice = Invoice::with('user')->findOrFail($request->invoice_id);
        stripe::setApiKey(config('services.stripe.secret'));
        $paymentIntent =PaymentIntent::retrieve($request->payment_intent_id);
        
        if ($paymentIntent->status === 'succeeded') {
            $invoice->status = 'Paid';
            $invoice->stripe_payment_id = $paymentIntent->id;
            $invoice->save();
            return redirect()->route('customersinvoices', ['type' => 'invoice']);
            // return response()->json(['success' => 'Payment successful!'], 200);
        } else {
            return response()->json(['error' => 'Payment did not succeed.'], 400);
        }
    }
    
    // Optional: Add method to handle Stripe webhooks for payment confirmations
    public function handleWebhook(Request $request)
    {
        // Laravel Cashier has built-in webhook handling
        // This can be used to confirm payments asynchronously
        
        return response()->json(['success' => true]);
    }

    public function equipment(){
        return view('equiment');
    }
}