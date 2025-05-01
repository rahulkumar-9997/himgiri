<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Customer Care Ticket</title>
</head>
<body>
    <h2>New Customer Care Request Submitted</h2>

    <p><strong>Ticket ID:</strong> {{ $careRequest->ticket_id }}</p>
    <p><strong>Category:</strong> {{ $careRequest->category_name }}</p>
    <p><strong>Model:</strong> {{ $careRequest->model_name }}</p>
    <p><strong>Name:</strong> {{ $careRequest->name }}</p>
    <p><strong>Email:</strong> {{ $careRequest->email ?? '-' }}</p>
    <p><strong>Phone Number:</strong> {{ $careRequest->phone_number }}</p>
    <p><strong>Message:</strong> {{ $careRequest->message ?? '-' }}</p>

    @if ($careRequest->product_image)
        <p><strong>Product Image:</strong></p>
        <p><img src="{{ asset('uploads/customer-care/'.$careRequest->product_image) }}" alt="Product Image" width="300"></p>
    @endif

    <p>The ticket details are also attached as a PDF.</p>
</body>
</html>

