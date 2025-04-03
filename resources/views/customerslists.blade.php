<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer List</title>
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
        .customers {
            margin-top: 20px;
        }
        .customerbody {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #e9ecef;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .customer p {
            margin: 0;
        }
        .cusbtn button {
            background: #007bff;
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
        }
        .cusbtn button:hover {
            background: #0056b3;
        }
        .createcus {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
            color: #d9534f;
        }
        .createcus:hover {
            text-decoration: underline;
        }
        #editcustomers {
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
        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .submitbtn {
            text-align: center;
            margin-top: 15px;
        }
        .registrationbtn {
            background: #28a745;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        .registrationbtn:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Customer List</h2>
        <div class="customers">
            @forelse($users as $user)
                <div class="customerbody">
                    <div class="customer">
                        <p><strong>{{ $user->username }}</strong> | {{ $user->email }} | {{ $user->status }} | {{ $user->mobile }} | {{ $user->address }}</p>
                    </div>
                    <div class="cusbtn">               
                        <button type="button" class="edit-btn" data-id="{{ $user->id }}">Edit</button>
                    </div>
                </div>
            @empty
                <p>No customers found</p>
            @endforelse
        </div>

        <a href="{{ route('customerscreation', ['type' => 'customer']) }}" class="createcus">Create Customer</a>

        <div id="editcustomers" >
            <form id="editcustomerform">
                @csrf
                <input type="hidden" name="id" id="userId">
                <label for="name">Name</label>
                <input id="userName" type="text" name="username" value="{{ old('name') }}" required>

                <label for="email">Email</label>
                <input id="userEmail" type="email" name="email" value="{{ old('email') }}">

                <label for="address">Address</label>
                <input id="address" type="text" name="address" value="{{ old('address') }}">

                <label for="mobile">Mobile no</label>
                <input id="mobile" type="text" name="mobile">

                <div class="submitbtn">
                    <button class="registrationbtn" id="registerbtn" type="button">Update</button>
                </div>
            </form> 
        </div>
    </div>
</body>
</html>
