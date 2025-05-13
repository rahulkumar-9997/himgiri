<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Customer Care Ticket - {{ $careRequest->ticket_id }}</title>
</head>

<body style="font-family: 'DejaVu Sans', Arial, sans-serif; color: #333; line-height: 1.6; padding: 20px;">
    <div style="text-align: center; margin-bottom: 30px; padding-bottom: 20px; position: relative;">
        <div style="margin-bottom: 15px;">
            @if(file_exists(public_path('frontend/assets/himgiri-img/logo/1.png')))
            <img src="{{ public_path('frontend/assets/himgiri-img/logo/1.png') }}" alt="Company Logo" style="max-height: 80px; max-width: 200px;">
            @else
            <h2>Himgiri Coolers</h2>
            @endif
        </div>

        <h1 style="color: #dd2b1c; margin: 10px 0 5px; font-size: 24px;">Customer Care Request</h1>
        <div style="color: #7f8c8d; font-size: 14px;">Ticket ID: {{ $careRequest->ticket_id }}</div>
        <div style="border-bottom: 2px solid #dd2b1c; width: 80%; margin: 0 auto; padding-top: 20px;"></div>
    </div>

    <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px; box-shadow: 0 2px 3px rgba(0,0,0,0.1);">
        <tr>
            <th style="background-color: #dd2b1c; color: white; text-align: left; padding: 3px 5px; font-weight: 500;" width="30%">Field</th>
            <th style="background-color: #dd2b1c; color: white; text-align: left; padding: 3px 5px; font-weight: 500;" width="70%">Details</th>
        </tr>
        <tr>
            <td style="padding: 3px 5px; border: 1px solid #ddd; vertical-align: top;"><strong>Category</strong></td>
            <td style="padding: 3px 5px; border: 1px solid #ddd; vertical-align: top;">{{ $careRequest->category_name }}</td>
        </tr>
        <tr style="background-color: #f9f9f9;">
            <td style="padding: 3px 5px; border: 1px solid #ddd; vertical-align: top;"><strong>Model</strong></td>
            <td style="padding: 3px 5px; border: 1px solid #ddd; vertical-align: top;">{{ $careRequest->model_name }}</td>
        </tr>
        <tr>
            <td style="padding: 3px 5px; border: 1px solid #ddd; vertical-align: top;"><strong>Problem Type</strong></td>
            <td style="padding: 3px 5px; border: 1px solid #ddd; vertical-align: top;">{{ $careRequest->problem_type }}</td>
        </tr>
        <tr style="background-color: #f9f9f9;">
            <td style="padding: 3px 5px; border: 1px solid #ddd; vertical-align: top;"><strong>Warranty Status</strong></td>
            <td style="padding: 3px 5px; border: 1px solid #ddd; vertical-align: top;">
                @if($careRequest->in_warranty === 'Yes')
                <span style="color: #27ae60; font-weight: bold;">Yes</span>
                @else
                <span style="color: #e74c3c; font-weight: bold;">No</span>
                @endif
            </td>
        </tr>
        <tr>
            <td style="padding: 3px 5px; border: 1px solid #ddd; vertical-align: top;"><strong>Customer Name</strong></td>
            <td style="padding: 3px 5px; border: 1px solid #ddd; vertical-align: top;">{{ $careRequest->name }}</td>
        </tr>
        <tr style="background-color: #f9f9f9;">
            <td style="padding: 3px 5px; border: 1px solid #ddd; vertical-align: top;"><strong>Contact Information</strong></td>
            <td style="padding: 3px 5px; border: 1px solid #ddd; vertical-align: top;">
                Email: {{ $careRequest->email ?? 'Not provided' }}<br>
                Phone: {{ $careRequest->phone_number }}<br>
                City: {{ $careRequest->city_name }}<br>
                Address: {{ $careRequest->address }}
            </td>
        </tr>
        <tr>
            <td style="padding: 3px 5px; border: 1px solid #ddd; vertical-align: top;"><strong>Message</strong></td>
            <td style="padding: 3px 5px; border: 1px solid #ddd; vertical-align: top;">{{ $careRequest->message ?? 'No additional message provided' }}</td>
        </tr>
        <tr style="background-color: #f9f9f9;">
            <td style="padding: 3px 5px; border: 1px solid #ddd; vertical-align: top;"><strong>Product Image</strong></td>
            <td style="padding: 3px 5px; border: 1px solid #ddd; vertical-align: top;">
                @if(file_exists(public_path('uploads/customer-care/'.$careRequest->product_image)))
                <div style="text-align: center; margin-top: 10px;">
                    <img src="{{ public_path('uploads/customer-care/'.$careRequest->product_image) }}"
                        alt="Product Image" style="max-width: 300px; max-height: 300px; border: 1px solid #eee; padding: 5px; background: white; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                </div>
                @else
                <em>Image not available</em>
                @endif
            </td>
        </tr>
        <tr>
            <td style="padding: 3px 5px; border: 1px solid #ddd; vertical-align: top;"><strong>Invoice Image</strong></td>
            <td style="padding: 3px 5px; border: 1px solid #ddd; vertical-align: top;">
                @if($careRequest->invoice_image && file_exists(public_path('uploads/customer-care/invoice/'.$careRequest->invoice_image)))
                <div style="text-align: center; margin-top: 10px;">
                    <img src="{{ public_path('uploads/customer-care/invoice/'.$careRequest->invoice_image) }}"
                        alt="Invoice Image" style="max-width: 300px; max-height: 300px; border: 1px solid #eee; padding: 5px; background: white; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                </div>
                @else
                <em>No invoice image provided</em>
                @endif
            </td>
        </tr>
    </table>
</body>

</html>