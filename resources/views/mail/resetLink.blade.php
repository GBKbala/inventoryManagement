<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rest Password</title>
</head>
<body>
    <div>
        <p>Hello,</p>
        <p>To reset your password, please click the link below:</p>
        <p><a href="{{ route('resetPassword', $mailData['token']) }}">Reset Password</a></p>
        <p>Thank you!</p>
    </div>
    <div>
        <p>Best Regards</p>
        <p>Inventory Admin</p>
    </div>
</body>
</html>