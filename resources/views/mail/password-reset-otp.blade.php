<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset OTP</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 40px 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }
        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }
        .email-body {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }
        .message {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .otp-container {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            margin: 30px 0;
            border: 2px dashed #667eea;
        }
        .otp-label {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .otp-code {
            font-size: 42px;
            font-weight: 700;
            color: #667eea;
            letter-spacing: 8px;
            margin: 10px 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }
        .otp-validity {
            font-size: 13px;
            color: #999;
            margin-top: 10px;
        }
        .warning {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px 20px;
            margin: 20px 0;
            border-radius: 8px;
        }
        .warning-text {
            font-size: 14px;
            color: #856404;
            margin: 0;
        }
        .footer {
            background: #f8f9fa;
            padding: 30px;
            text-align: center;
            font-size: 14px;
            color: #666;
            border-top: 1px solid #e1e8ed;
        }
        .footer-links {
            margin-top: 15px;
        }
        .footer-links a {
            color: #667eea;
            text-decoration: none;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>🔐 Password Reset Request</h1>
        </div>
        
        <div class="email-body">
            <p class="greeting">Hello {{ $userName }},</p>
            
            <p class="message">
                We received a request to reset your password for your College Event Management account. 
                Use the One-Time Password (OTP) below to proceed with resetting your password.
            </p>
            
            <div class="otp-container">
                <div class="otp-label">Your OTP Code</div>
                <div class="otp-code">{{ $otp }}</div>
                <div class="otp-validity">⏰ Valid for 10 minutes</div>
            </div>
            
            <div class="warning">
                <p class="warning-text">
                    ⚠️ <strong>Security Notice:</strong> If you didn't request a password reset, please ignore this email 
                    or contact support if you have concerns about your account security.
                </p>
            </div>
            
            <p class="message">
                For your security, this OTP will expire in 10 minutes. After that, you'll need to request a new one.
            </p>
            
            <p class="message">
                <strong>Tips for account security:</strong><br>
                • Never share your OTP with anyone<br>
                • Our team will never ask for your OTP<br>
                • Make sure to use a strong, unique password
            </p>
        </div>
        
        <div class="footer">
            <p>© {{ date('Y') }} College Event Management System</p>
            <p>This is an automated message, please do not reply to this email.</p>
            <div class="footer-links">
                <a href="{{ url('/') }}">Visit Website</a> |
                <a href="{{ url('/contact') }}">Contact Support</a>
            </div>
        </div>
    </div>
</body>
</html>
