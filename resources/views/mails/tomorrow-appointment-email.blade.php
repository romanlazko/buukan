<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Booking Reminder</title>
    </head>
<body>

    <p>Dear {{ $appointment->client->first_name }},</p>

    <p>We would like to remind you that you have an appointment booked at {{ $appointment->company->name }}</p>

    <ul>
        <li><strong>Master:</strong> {{ $appointment->employee->first_name }} {{ $appointment->employee->last_name }}</li>
        <li><strong>Booking Date:</strong> {{ $appointment->date->format('d.m.Y') }} {{ $appointment->term->format('H:i') }}</li>
        <li><strong>Service:</strong> {{ $appointment->service->name }}</li>
        @if ($appointment->sub_services->isNotEmpty())
            <li><strong>Sub services:</strong> {{ $appointment->sub_services->pluck('name')->implode(', ') }}</li>
        @endif
        <li><strong>Total Price:</strong> {{ $appointment->total_price }}</li>
        <li><strong>Address:</strong> {{ $appointment->company->address }}</li>
    </ul>

    <p>We thank you for choosing our services</p>

    @if ($appointment->via_telegram) 
        <p>If you have any questions or need to modify or cancel your booking, you can do so through the <a href="https://t.me/{{ $appointment->company->telegram_bots()->first()->username }}">manage booking link</a>.</p>
    @elseif($appointment->via_webapp)
        <p>If you have any questions or need to modify or cancel your booking, you can do so through the <a href="{{ route('webapp.index', $appointment->company->web_apps()->first()) }}">manage booking link</a>.</p>
    @endif

    <p>Best regards, Your Buukan team.</p>

</body>
</html>