<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Customer Care Ticket</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 20px;">
    <h2 style="color: #dd2b1c; margin-bottom: 20px;">New Customer Care Request Submitted</h2>

    <table style="width: 100%; max-width: 600px; border-collapse: collapse; margin-bottom: 20px;">
        <tr>
            <td style="padding: 3px 5px; border: 1px solid #ddd; font-weight: bold; width: 30%;">Ticket ID</td>
            <td style="padding: 3px 5px; border: 1px solid #ddd;">{{ $careRequest->ticket_id }}</td>
        </tr>
        <tr style="background-color: #f9f9f9;">
            <td style="padding: 3px 5px; border: 1px solid #ddd; font-weight: bold;">Category</td>
            <td style="padding: 3px 5px; border: 1px solid #ddd;">{{ $careRequest->category_name }}</td>
        </tr>
        <tr>
            <td style="padding: 3px 5px; border: 1px solid #ddd; font-weight: bold;">Model</td>
            <td style="padding: 3px 5px; border: 1px solid #ddd;">{{ $careRequest->model_name }}</td>
        </tr>
        <tr style="background-color: #f9f9f9;">
            <td style="padding: 3px 5px; border: 1px solid #ddd; font-weight: bold;">Problem Type</td>
            <td style="padding: 3px 5px; border: 1px solid #ddd;">{{ $careRequest->problem_type }}</td>
        </tr>
        <tr>
            <td style="padding: 3px 5px; border: 1px solid #ddd; font-weight: bold;">Warranty Status</td>
            <td style="padding: 3px 5px; border: 1px solid #ddd;">
                @if($careRequest->in_warranty === 'Yes')
                    <span style="color: #27ae60; font-weight: bold;">Yes</span>
                @else
                    <span style="color: #e74c3c; font-weight: bold;">No</span>
                @endif
            </td>
        </tr>
        <tr style="background-color: #f9f9f9;">
            <td style="padding: 3px 5px; border: 1px solid #ddd; font-weight: bold;">Name</td>
            <td style="padding: 3px 5px; border: 1px solid #ddd;">{{ $careRequest->name }}</td>
        </tr>
        <tr>
            <td style="padding: 3px 5px; border: 1px solid #ddd; font-weight: bold;">Email</td>
            <td style="padding: 3px 5px; border: 1px solid #ddd;">{{ $careRequest->email ?? '-' }}</td>
        </tr>
        <tr style="background-color: #f9f9f9;">
            <td style="padding: 3px 5px; border: 1px solid #ddd; font-weight: bold;">Phone Number</td>
            <td style="padding: 3px 5px; border: 1px solid #ddd;">{{ $careRequest->phone_number }}</td>
        </tr>
        <tr style="background-color: #f9f9f9;">
            <td style="padding: 3px 5px; border: 1px solid #ddd; font-weight: bold;">City</td>
            <td style="padding: 3px 5px; border: 1px solid #ddd;">{{ $careRequest->city_name }}</td>
        </tr>
        <tr style="background-color: #f9f9f9;">
            <td style="padding: 3px 5px; border: 1px solid #ddd; font-weight: bold;">Address</td>
            <td style="padding: 3px 5px; border: 1px solid #ddd;">{{ $careRequest->address }}</td>
        </tr>
        <tr>
            <td style="padding: 3px 5px; border: 1px solid #ddd; font-weight: bold;">Message</td>
            <td style="padding: 3px 5px; border: 1px solid #ddd;">{{ $careRequest->message ?? '-' }}</td>
        </tr>
    </table>

    @if ($careRequest->product_image)
        <p style="font-weight: bold; margin-bottom: 5px;">Product Image:</p>
        <img src="{{ asset('uploads/customer-care/'.$careRequest->product_image) }}" alt="Product Image" style="max-width: 300px; border: 1px solid #ddd; padding: 5px; background: #fff; margin-bottom: 20px;">
    @endif

    @if ($careRequest->invoice_image)
        <p style="font-weight: bold; margin-bottom: 5px;">Invoice Image:</p>
        <img src="{{ asset('uploads/customer-care/invoice/'.$careRequest->invoice_image) }}" alt="Invoice Image" style="max-width: 300px; border: 1px solid #ddd; padding: 5px; background: #fff; margin-bottom: 20px;">
    @endif

    <p style="margin-top: 20px;">The ticket details are also attached as a PDF.</p>
</body>
</html>