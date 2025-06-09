<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Customer</title>
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
        .customer-creation-form {
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
        input {
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
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        .register-btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="customer-creation-form">
        <h2>Create Customer</h2>
        <form action="{{ route('customerandinvoiceregister') }}" method="post">
            @csrf
            <input type="hidden" name="type" value="customer">
            <label for="name">Full Name</label>
            <input id="name" type="text" name="username" class="@error('username') is-invalid @enderror" placeholder="Enter full name" value="{{ old('username') }}" >
            @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <label for="email">Email</label>
            <input id="email" type="email" name="email" class="@error('email') is-invalid @enderror" placeholder="Enter email" value="{{ old('email') }}" >
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <label for="address">Address</label>
            <input id="address" type="text" name="address" class="@error('address') is-invalid @enderror" placeholder="Enter address" value="{{ old('address') }}" >
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <label for="mobile">Mobile Number</label>
            <input id="mobile" type="tel" name="mobile" class="@error('mobile') is-invalid @enderror" placeholder="Enter mobile number" value="{{ old('mobile') }}" >
            @error('mobile')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <div class="submit-btn">
                <button class="register-btn" type="submit">Submit</button>
            </div>
        </form> 
    </div>
</body>
</html>
