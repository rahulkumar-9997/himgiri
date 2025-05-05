<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Customer Care Ticket - {{ $careRequest->ticket_id }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #dd2b1c;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #dd2b1c;
            margin: 0;
            font-size: 24px;
        }
        .header .subtitle {
            color: #7f8c8d;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            box-shadow: 0 2px 3px rgba(0,0,0,0.1);
        }
        th {
            background-color: #dd2b1c;
            color: white;
            text-align: left;
            padding: 12px;
            font-weight: 500;
        }
        td {
            padding: 12px;
            border: 1px solid #ddd;
            vertical-align: top;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .image-container {
            text-align: center;
            margin-top: 10px;
        }
        .image-container img {
            max-width: 300px;
            max-height: 300px;
            border: 1px solid #eee;
            padding: 5px;
            background: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #7f8c8d;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Customer Care Request</h1>
        <div class="subtitle">Ticket ID: {{ $careRequest->ticket_id }}</div>
    </div>

    <table>
        <tr>
            <th width="30%">Field</th>
            <th width="70%">Details</th>
        </tr>
        <tr>
            <td><strong>Category</strong></td>
            <td>{{ $careRequest->category_name }}</td>
        </tr>
        <tr>
            <td><strong>Model</strong></td>
            <td>{{ $careRequest->model_name }}</td>
        </tr>
        <tr>
            <td><strong>Problem Type</strong></td>
            <td>{{ $careRequest->problem_type }}</td>
        </tr>
        <tr>
            <td><strong>Customer Name</strong></td>
            <td>{{ $careRequest->name }}</td>
        </tr>
        <tr>
            <td><strong>Contact Information</strong></td>
            <td>
                Email: {{ $careRequest->email ?? 'Not provided' }}<br>
                Phone: {{ $careRequest->phone_number }}
            </td>
        </tr>
        <tr>
            <td><strong>Message</strong></td>
            <td>{{ $careRequest->message ?? 'No additional message provided' }}</td>
        </tr>
        <tr>
            <td><strong>Product Image</strong></td>
            <td>
                @if(file_exists(public_path('uploads/customer-care/'.$careRequest->product_image)))
                    <div class="image-container">
                        <img src="{{ public_path('uploads/customer-care/'.$careRequest->product_image) }}" 
                             alt="Product Image">
                    </div>
                @else
                    <em>Image not available</em>
                @endif
            </td>
        </tr>
    </table>

    <div class="footer">
        This ticket was generated on {{ now()->format('F j, Y \a\t H:i') }}<br>
        For any questions, please contact our support team
    </div>
</body>
</html>