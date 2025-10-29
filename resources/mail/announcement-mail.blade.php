<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Announcement</title>
</head>
<body>
    <h2>{{ $announcement->title }}</h2>
    
    <p>{{ $announcement->content }}</p>
    
    <p>Published on: {{ $announcement->published_at->format('F j, Y g:i A') }}</p>
    
    <p>Best regards,<br>College Event Management Team</p>
</body>
</html>
