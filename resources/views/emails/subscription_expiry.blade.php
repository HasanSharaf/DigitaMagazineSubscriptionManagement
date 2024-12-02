<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Expiry Notification</title>
</head>
<body>
    <p>Dear {{ $userName }},</p>
    <p>Your subscription for the magazine <strong>{{ $magazineName }}</strong> is about to expire on <strong>{{ $endDate }}</strong>.</p>
    <p>Please renew your subscription to continue enjoying our services.</p>
    <p>Thank you!</p>
</body>
</html>