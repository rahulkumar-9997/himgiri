<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Customer Care Ticket - {{ $careRequest->ticket_id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        td, th { border: 1px solid #ccc; padding: 8px; }
    </style>
</head>
<body>
    <h2>Customer Care Request Details</h2>
    <table>
        <tr><th>Ticket ID</th><td>{{ $careRequest->ticket_id }}</td></tr>
        <tr><th>Category</th><td>{{ $careRequest->category_name }}</td></tr>
        <tr><th>Model</th><td>{{ $careRequest->model_name }}</td></tr>
        <tr><th>Name</th><td>{{ $careRequest->name }}</td></tr>
        <tr><th>Email</th><td>{{ $careRequest->email ?? '-' }}</td></tr>
        <tr><th>Phone Number</th><td>{{ $careRequest->phone_number }}</td></tr>
        <tr><th>Message</th><td>{{ $careRequest->message ?? '-' }}</td></tr>
        <tr><th>Product Image</th><td>
            <img src="{{ asset('uploads/customer-care/'.$careRequest->product_image) }}" alt="Product Image" width="300">
        </td></tr>
    </table>
</body>
</html>

