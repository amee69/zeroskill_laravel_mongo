<!DOCTYPE html>
<html>
<head>
    <title>Membership Confirmation</title>
</head>
<body>
    <h1>Hello, {{ $user->name }}</h1>

    <p>Thank you for purchasing a membership with us!</p>

    <h3>Membership Details:</h3>
    <p><strong>Tier:</strong> {{ $membershipTier->tier_name }}</p> 
    <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($membershipStartDate)->format('d M Y') }}</p>
    <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($membershipEndDate)->format('d M Y') }}</p>

    <p>We are glad to have you as a member! If you need any assistance, feel free to reach out to us.</p>

    <p>If you have any questions, feel free to contact us at any time.</p>

    <hr>
    <p><strong>Email:</strong> info@zeroskill.com</p>
    <p><strong>Telephone:</strong> +94 123 456 789</p>
</body>
</html>
