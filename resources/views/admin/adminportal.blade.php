<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Portal</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .header {
            background: #2c3e50;
            color: #ecf0f1;
            padding: 10px 20px;
            height: 50px;
            line-height: 30px;
        }
        .sidebar {
            background: #34495e;
            color: #ecf0f1;
            width: 200px;
            height: calc(100vh - 50px);
            padding: 20px;
            float: left;
        }
        .main-content {
            background: #ecf0f1;
            padding: 20px;
            margin-left: 200px;
            height: calc(100vh - 50px);
        }
        .sidebar a {
            color: #ecf0f1;
            text-decoration: none;
            display: block;
            margin-bottom: 15px;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="header">
        Admin Portal
    </div>
    <div class="sidebar">
        <a href="{{ route('customersinvoices', ['type' => 'customer']) }}">Customer</a>
        <a href="{{ route('customersinvoices', ['type' => 'invoice']) }}">Invoice</a>

        <form method="POST" action="{{ route('Logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
    <div class="main-content">
        <h2>Dashboard Content</h2>
        <p>Welcome to the admin portal.</p>
    </div>
</body>
</html>
