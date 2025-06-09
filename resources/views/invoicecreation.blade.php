<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Invoice</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .invoice-creation-form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        select, input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .invalid-feedback {
            color: red;
            font-size: 12px;
        }
        .submit-btn {
            text-align: center;
            margin-top: 20px;
        }
        .register-btn {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        .register-btn:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="invoice-creation-form">
        <h2>Create Invoice</h2>
        <form action="{{ route('customerandinvoiceregister') }}" method="post">
            @csrf
            <input type="hidden" name="type" value="invoice">
            <label for="name">Customer Name</label>
            <select name="useridinvoice" id="name" class="@error('user_id') is-invalid @enderror" >
                <option value="" disabled >Select a customer</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                @endforeach
            </select>
            @error('user_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <label for="date">Date</label>
            <input id="date" type="date" name="date" class="@error('date') is-invalid @enderror" value="{{ old('date') }}" >
            @error('date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <label for="amount">Amount</label>
            <input type="number" name="amount" class="@error('amount') is-invalid @enderror" value="{{ old('amount') }}" >
            @error('amount')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <label for="status">Status</label>
            <select name="status" id="status" class="@error('status') is-invalid @enderror" required>
                <option value="Paid">Paid</option>
                <option value="Unpaid">Unpaid</option>
                <option value="Cancelled">Cancelled</option>
            </select>      
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <div class="submit-btn">
                <button class="register-btn" type="submit">Submit</button>
            </div>
        </form> 
    </div>
    
</body>
</html>
