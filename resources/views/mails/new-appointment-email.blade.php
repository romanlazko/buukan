<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
</head>
<body>

<p>Dear {{ $appointment->client->first_name }},</p>

<p>You have successfully booked a service at {{ $appointment->employee->company->name }}</p>

<ul>
    <li><strong>Master:</strong> {{ $appointment->employee->first_name }} {{ $appointment->employee->last_name }}</li>
    <li><strong>Booking Date:</strong> {{ $appointment->date->format('d.m.Y') }} {{ $appointment->term->format('H:i') }}</li>
    <li><strong>Service Type:</strong> {{ $appointment->service->name }}</li>
    <li><strong>Service Cost:</strong> {{ $appointment->total_price }}</li>
    <li><strong>Address:</strong> {{ $appointment->employee->company->address }}</li>
</ul>

<p>We thank you for choosing our services</p>

<p>If you have any questions or need to modify or cancel your booking, you can do so through the <a href="{{ route('webapp.index', $appointment->employee->company->web_apps()->first()) }}">manage booking link</a>.</p>

<p>Best regards, Your Buukan team.</p>

</body>
</html>