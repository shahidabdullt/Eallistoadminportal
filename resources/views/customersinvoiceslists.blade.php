<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>customrlist</title>
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/customer.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <p>customers</p>
    <div class="customers">
        @forelse($users as $user )
        <div class="customerbody">
            <div class="customer">
                <p>{{ $user->username }} {{ $user->email }} {{ $user->status }} {{ $user->mobile }}</p>
            </div>
            <div class="cusbtn">               
                <button type="button" class="edit-btn" data-id="{{ $user->id }}">Edit</button>
            </div>
        </div>
        @empty
        <p>No customers found</p>
        @endforelse
    </div>
    <div id="editcustmers" style="display: none;">
    <form id="editcustomerform">
        @csrf
        <input type="hidden" name="id" id="userId">
        <label for="name">Name</label>
        <input id="userName" type="text" class="name form-control @error('name') is-invalid @enderror" placeholder="name" name="username" value="{{ old('name') }}" required>
        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <br><br>
        <label for="email">Email</label>
        <input id="userEmail" type="email" class="form-control email @error('email') is-invalid @enderror" placeholder="email" name="email" value="{{ old('email') }}">
        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <br><br>
        <label for="address">Address</label>
        <input id="address" type="text" class="form-control address @error('address') is-invalid @enderror" placeholder="Address" name="address" value="{{ old('address') }}">
        @error('address')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror              
        <br><br>
        <label for="mobile">Mobile no</label>
        <input id="mobile" type="text" class="form-control mobile @error('mobile') is-invalid @enderror" name="mobile">
        @error('mobile')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror        
        <br><br>
        <div class="submitbtn">
            <button class="registrationbtn" id="registerbtn" type="button">Update</button>
        </div> <!-- closing submitbtn -->
    </form> 
    </div>
    <br><br>
    <br><br>
    <br><br>
    <p>invoices</p>
    <div class="invoices">
        @forelse($invoices as $invoice )
        <div class="invoicesbody">
            <div class="invoices">
                <p>{{ $invoice->user->username }} {{ $invoice->date }} {{ $invoice->amount }} {{ $invoice->status }} </p>
            </div>
            <div class="invoicesbtn">               
                <button type="button" class="editinvoice-btn" data-id="{{ $invoice->id }}">Edit</button>
            </div>
        </div>

        @empty
        <p>No invoices found</p>
        @endforelse
    </div>
    <div id="editinvoices" style="display: none;">
    <form id="editinvoicesform">
        @csrf
        <input type="hidden" name="id" id="invoceId">
        <input type="hidden" name="useridinvoice" id="userIdinvoice">
        <label for="username">Name</label>
        <input type="text" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="name" name="username" value="{{ old('username') }}">
        @error('username')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <br><br>
        <label for="Date">Date</label>
        <input id="Date" type="text" class="date form-control @error('date') is-invalid @enderror" placeholder="Date" name="Date" value="{{ old('Date') }}" >
        @error('date')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <br><br>
        <label for="Amount">Amount</label>
        <input id="Amount" type="text" class="form-control Amount @error('Amount') is-invalid @enderror" placeholder="Amount" name="Amount" value="{{ old('Amount') }}">
        @error('Amount')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <br><br>
        <label for="status">status</label>
        <!-- <input id="status" type="text" class="form-control status @error('status') is-invalid @enderror" placeholder="status" name="status" value="{{ old('status') }}"> -->
        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" placeholder="status" value="{{ old('status') }}">
                    <option>Paid</option>
                    <option>Unpaid</option>
                    <option>Cancelled</option>
        </select>  
        @error('status')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror              
        <br><br>    
        <br><br>
        <div class="submitbtn">
            <button class="updationbtn" id="invoiceupdationbtn" type="button">Update</button>
        </div> <!-- closing submitbtn -->
    </form> 
    </div>
    <a href="{{ route('customerscreation',['type'=>'customer']) }}" class="creartecus">Create Customer</a>
    <a href="{{ route("customerscreation",['type'=>'invoice']) }}" class="createinvoice">Create Invoice</a>
</body>
</html>