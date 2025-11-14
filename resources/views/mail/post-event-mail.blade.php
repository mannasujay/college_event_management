<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You - {{ $event->title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .content {
            padding: 30px;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .stats {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .stat-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #dee2e6;
        }
        .stat-item:last-child {
            border-bottom: none;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Thank You for Attending!</h1>
            <h2>{{ $event->title }}</h2>
        </div>
        
        <div class="content">
            <p>Dear {{ $user->name }},</p>
            
            <p>Thank you for attending <strong>{{ $event->title }}</strong> held on {{ $event->event_date->format('F d, Y') }}. We hope you had a wonderful experience!</p>
            
            <div class="stats">
                <h3>Event Summary</h3>
                <div class="stat-item">
                    <span><strong>Event Date:</strong></span>
                    <span>{{ $event->event_date->format('F d, Y') }}</span>
                </div>
                <div class="stat-item">
                    <span><strong>Location:</strong></span>
                    <span>{{ $event->location }}</span>
                </div>
                <div class="stat-item">
                    <span><strong>Total Participants:</strong></span>
                    <span>{{ $event->registrations->where('status', 'attended')->count() }}</span>
                </div>
            </div>
            
            <p>We value your feedback! Please take a moment to share your experience:</p>
            
            <center>
                <a href="{{ route('events.show', $event->id) }}" class="button">View Event Details</a>
            </center>
            
            <p><strong>What's Next?</strong></p>
            <ul>
                <li>Check out the event photo gallery (coming soon)</li>
                <li>Download your certificate of participation</li>
                <li>View event results if applicable</li>
                <li>Stay tuned for upcoming events</li>
            </ul>
            
            <p>Thank you once again for your participation. We look forward to seeing you at our future events!</p>
            
            <p>Best regards,<br>
            <strong>{{ $event->organizer->name }}</strong><br>
            Event Organizer</p>
        </div>
        
        <div class="footer">
            <p>This is an automated email. Please do not reply to this message.</p>
            <p>&copy; {{ date('Y') }} College Event Management System. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
