<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Certificate of Participation</title>
    <style>
        body {
            font-family: 'Georgia', serif;
            margin: 0;
            padding: 40px;
            background: white;
        }
        .certificate {
            border: 20px solid #667eea;
            border-image: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-image-slice: 1;
            padding: 60px;
            text-align: center;
            background: white;
        }
        .certificate-header {
            font-size: 48px;
            color: #667eea;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .certificate-subtitle {
            font-size: 20px;
            color: #666;
            margin-bottom: 40px;
        }
        .certificate-body {
            font-size: 18px;
            line-height: 1.8;
            margin: 40px 0;
        }
        .recipient-name {
            font-size: 36px;
            color: #333;
            font-weight: bold;
            margin: 30px 0;
            text-transform: uppercase;
            border-bottom: 2px solid #667eea;
            display: inline-block;
            padding: 10px 50px;
        }
        .event-name {
            font-size: 24px;
            color: #667eea;
            font-weight: bold;
            margin: 20px 0;
        }
        .certificate-footer {
            margin-top: 60px;
            display: flex;
            justify-content: space-around;
        }
        .signature-block {
            text-align: center;
        }
        .signature-line {
            border-top: 2px solid #333;
            width: 200px;
            margin: 10px auto;
        }
        .certificate-number {
            font-size: 12px;
            color: #999;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="certificate-header">CERTIFICATE</div>
        <div class="certificate-subtitle">OF PARTICIPATION</div>
        
        <div class="certificate-body">
            This is to certify that
        </div>
        
        <div class="recipient-name">{{ $name }}</div>
        
        <div class="certificate-body">
            has successfully participated in
        </div>
        
        <div class="event-name">{{ $event }}</div>
        
        <div class="certificate-body">
            held on {{ $date }}
        </div>
        
        <div class="certificate-footer">
            <div class="signature-block">
                <div class="signature-line"></div>
                <div>Event Organizer</div>
            </div>
            <div class="signature-block">
                <div class="signature-line"></div>
                <div>College Director</div>
            </div>
        </div>
        
        <div class="certificate-number">
            Certificate No: {{ $certificate_number }}
        </div>
    </div>
</body>
</html>
