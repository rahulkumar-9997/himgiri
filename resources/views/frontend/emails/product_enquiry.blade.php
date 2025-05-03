<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Product Enquiry</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; padding: 20px;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #ffffff; border: 1px solid #dddddd; border-radius: 8px;">
        <tr>
            <td style="padding: 20px; background-color: #ff0000; color: white; text-align: center; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                <h2 style="margin: 0;">Product Enquiry</h2>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <table width="100%" cellpadding="8" cellspacing="0" style="font-size: 14px; color: #333;">
                    <tr>
                        <td style="font-weight: bold;">Product Name:</td>
                        <td>{{ $product_name ?? 'N/A' }}</td>
                    </tr>

                    @if(!empty($image_path))
                    <tr>
                        <td style="font-weight: bold; vertical-align: top;">Product Image:</td>
                        <td>
                            <img src="{{ asset($image_path) }}" alt="Product Image" style="max-width: 200px; border: 1px solid #ccc; padding: 4px;">
                        </td>
                    </tr>
                    @endif

                    <tr>
                        <td style="font-weight: bold;">Name:</td>
                        <td>{{ $enquiry_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Email:</td>
                        <td>{{ $email ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Phone No:</td>
                        <td>{{ $phone_no ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; vertical-align: top;">Message:</td>
                        <td>{{ $enquiry_message ?? 'N/A' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding: 15px; background-color: #f0f0f0; text-align: center; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; font-size: 12px; color: #555;">
                This is an automated message. Please do not reply.
            </td>
        </tr>
    </table>
</body>

</html>