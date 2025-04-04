<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice List</title>
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/customer.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 20px;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .invoices {
            margin-top: 20px;
        }
        .invoice-body {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #e9ecef;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .invoice p {
            margin: 0;
        }
        .invoice-btn button {
            background: #007bff;
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
        }
        .invoice-btn button:hover {
            background: #0056b3;
        }
        .create-invoice {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
            color: #d9534f;
        }
        .create-invoice:hover {
            text-decoration: underline;
        }
        #edit-invoices {
            display: none;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 20px auto;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .submit-btn {
            text-align: center;
            margin-top: 15px;
        }
        .update-btn {
            background: #28a745;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        .update-btn:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Invoice List</h2>
        <div class="invoices">
            @forelse($invoices as $invoice)
                <div class="invoice-body">
                    <div class="invoice">
                        <p><strong>{{ $invoice->user->username }}</strong> | {{ $invoice->date }} | ₹{{ $invoice->amount }} | {{ $invoice->status }}</p>
                    </div>
                    <div class="invoice-btn">               
                        <button type="button" class="editinvoice-btn" data-id="{{ $invoice->id }}">Edit</button>
                    </div>
                </div>
            @empty
                <p>No invoices found</p>
            @endforelse
        </div>

        <div class="pagination mt-3">
            {{ $invoices->links() }}
        </div>

        <a href="{{ route('customerscreation', ['type' => 'invoice']) }}" class="create-invoice">Create Invoice</a>

        <div id="edit-invoices">
            <form id="edit-invoices-form">
                @csrf
                <input type="hidden" name="id" id="invoiceId">
                <input type="hidden" name="useridinvoice" id="userIdinvoice">
                
                <label for="username">Name</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" readonly>

                <label for="date">Date</label>
                <input id="date" type="date" name="date" value="{{ old('date') }}">

                <label for="amount">Amount</label>
                <input id="amount" type="number" name="amount" value="{{ old('amount') }}">

                <label for="status">Status</label>
                <select name="status" id="status">
                    <option value="Paid">Paid</option>
                    <option value="Unpaid">Unpaid</option>
                    <option value="Cancelled">Cancelled</option>
                </select>  

                <div class="submit-btn">
                    <button class="update-btn" id="invoiceUpdateBtn" type="button">Update</button>
                </div>
            </form> 
        </div>
    </div>
</body>
</html>
