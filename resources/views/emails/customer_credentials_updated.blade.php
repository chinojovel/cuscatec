<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Credentials Updated</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #ffffff; margin: 0; padding: 20px;">

    <div style="text-align: center; margin-bottom: 30px;">
        <img src="https://importguadalajara.com/assets/images/logo.jpg" alt="Company Logo" style="width: 100px; height: auto;">
    </div>

    <div style="max-width: 600px; margin: auto; background: #f9f9f9; padding: 30px; border-radius: 8px; border: 1px solid #dddddd;">
        <h1 style="color: #333333;">Your Account Credentials Have Been Updated</h1>

        <p style="color: #555555;">Your account details have been updated. Here are your new credentials:</p>

        <p style="font-size: 16px;"><strong>Email:</strong> {{ $email }}</p>

        @if ($password)
        <p style="font-size: 16px;"><strong>New Password:</strong> {{ $password }}</p>
        <p style="color: #d9534f; font-size: 14px;">Please keep this password secure.</p>
        @endif

        <div style="text-align: center; margin: 30px 0;">
            <a href="https://importguadalajara.com/customer-ecommerce/seller/login" 
               style="background-color: #3490dc; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-size: 16px;">
                Visit Our Website
            </a>
        </div>

        <p style="color: #555555;">Thanks,<br><strong>{{ config('app.name') }}</strong></p>
    </div>

</body>
</html>
