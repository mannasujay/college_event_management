<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Event Registration Confirmation</title>
</head>
<body>
    <h2>Event Registration Confirmation</h2>
    
    <p>Dear {{ $user->name }},</p>
    
    <p>You have successfully registered for the event: <strong>{{ $event->title }}</strong></p>
    
    <p><strong>Event Details:</strong></p>
    <ul>
        <li>Date: {{ $event->event_date->format('F j, Y g:i A') }}</li>
        <li>Venue: {{ $event->venue }}</li>
    </ul>
    
    <p>We look forward to seeing you at the event!</p>
    
    <p>Best regards,<br>College Event Management Team</p>
</body>
</html>
