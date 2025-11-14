@extends('layouts.app')

@section('title', 'Certificate Preview')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@300;400;500;600;700;800&display=swap');
    
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    .certificate-page {
        min-height: 100vh;
        background: #0f172a;
        padding: 2rem 1rem;
        position: relative;
        overflow: hidden;
    }
    
    .certificate-page::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 50%, rgba(120, 119, 198, 0.15), transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(139, 92, 246, 0.15), transparent 50%),
            radial-gradient(circle at 40% 20%, rgba(59, 130, 246, 0.1), transparent 50%);
        animation: gradientShift 15s ease infinite;
    }
    
    @keyframes gradientShift {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.8; }
    }
    
    .certificate-header {
        text-align: center;
        margin-bottom: 3rem;
        position: relative;
        z-index: 1;
        animation: fadeInDown 0.6s ease-out;
    }
    
    .certificate-header h2 {
        font-family: 'Inter', sans-serif;
        font-weight: 700;
        font-size: 2.25rem;
        color: #f8fafc;
        margin-bottom: 1.5rem;
        letter-spacing: -0.5px;
    }
    
    .download-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 2.5rem;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-family: 'Inter', sans-serif;
        font-weight: 600;
        font-size: 1rem;
        text-decoration: none;
        box-shadow: 0 10px 40px rgba(99, 102, 241, 0.4);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    
    .download-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }
    
    .download-btn:hover::before {
        left: 100%;
    }
    
    .download-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 50px rgba(99, 102, 241, 0.5);
        color: white;
    }
    
    .certificate-wrapper {
        max-width: 1100px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
        animation: fadeInUp 0.8s ease-out;
    }
    
    .certificate-container {
        background: white;
        padding: 3.5rem;
        border-radius: 24px;
        box-shadow: 
            0 0 0 1px rgba(255,255,255,0.1),
            0 25px 80px rgba(0, 0, 0, 0.5);
        position: relative;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .certificate-container:hover {
        transform: translateY(-5px);
        box-shadow: 
            0 0 0 1px rgba(255,255,255,0.15),
            0 35px 100px rgba(0, 0, 0, 0.6);
    }
    
    .certificate-border {
        border: 12px solid;
        border-image: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #ec4899 100%) 1;
        padding: 4rem 3.5rem;
        position: relative;
        background: white;
    }
    
    .certificate-border::before {
        content: '';
        position: absolute;
        top: 24px;
        left: 24px;
        right: 24px;
        bottom: 24px;
        border: 1px solid #e2e8f0;
        pointer-events: none;
    }
    
    .certificate-content {
        text-align: center;
        position: relative;
        z-index: 1;
    }
    
    .certificate-logo {
        width: 90px;
        height: 90px;
        margin: 0 auto 2rem;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.25rem;
        color: white;
        font-weight: 800;
        font-family: 'Inter', sans-serif;
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
    }
    
    .certificate-title {
        font-family: 'Playfair Display', serif;
        font-size: 4rem;
        font-weight: 900;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.75rem;
        letter-spacing: 2px;
        text-transform: uppercase;
    }
    
    .certificate-subtitle {
        font-family: 'Inter', sans-serif;
        font-size: 1.125rem;
        color: #64748b;
        font-weight: 600;
        letter-spacing: 6px;
        margin-bottom: 3.5rem;
        text-transform: uppercase;
    }
    
    .certificate-text {
        font-family: 'Inter', sans-serif;
        font-size: 1.125rem;
        color: #475569;
        line-height: 1.8;
        margin: 2.5rem 0;
        font-weight: 500;
    }
    
    .recipient-name {
        font-family: 'Playfair Display', serif;
        font-size: 3rem;
        font-weight: 700;
        color: #1e293b;
        margin: 2.5rem 0;
        padding: 1.25rem 4rem;
        border-bottom: 4px solid #6366f1;
        display: inline-block;
        text-transform: capitalize;
        position: relative;
    }
    
    .recipient-name::before,
    .recipient-name::after {
        content: '✦';
        position: absolute;
        color: #6366f1;
        font-size: 1.75rem;
        top: 50%;
        transform: translateY(-50%);
    }
    
    .recipient-name::before {
        left: 0.5rem;
    }
    
    .recipient-name::after {
        right: 0.5rem;
    }
    
    .event-name {
        font-family: 'Inter', sans-serif;
        font-size: 1.875rem;
        font-weight: 700;
        color: #6366f1;
        margin: 2.5rem 0;
        line-height: 1.6;
    }
    
    .event-date {
        font-family: 'Inter', sans-serif;
        font-size: 1.125rem;
        color: #475569;
        margin: 2.5rem 0;
        font-weight: 600;
    }
    
    .signatures {
        display: flex;
        justify-content: space-around;
        margin-top: 5rem;
        gap: 3rem;
        flex-wrap: wrap;
    }
    
    .signature-block {
        flex: 1;
        min-width: 220px;
        text-align: center;
    }
    
    .signature-line {
        width: 240px;
        height: 70px;
        margin: 0 auto 1rem;
        border-bottom: 2px solid #1e293b;
        position: relative;
    }
    
    .signature-title {
        font-family: 'Inter', sans-serif;
        font-size: 0.875rem;
        color: #64748b;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }
    
    .certificate-number {
        font-family: 'Inter', sans-serif;
        font-size: 0.875rem;
        color: #94a3b8;
        margin-top: 3.5rem;
        font-weight: 600;
        letter-spacing: 1.5px;
    }
    
    .decorative-element {
        position: absolute;
        opacity: 0.04;
        pointer-events: none;
    }
    
    .decorative-element.top-left {
        top: 40px;
        left: 40px;
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border-radius: 50%;
    }
    
    .decorative-element.bottom-right {
        bottom: 40px;
        right: 40px;
        width: 140px;
        height: 140px;
        background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
        border-radius: 50%;
    }
    
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @media print {
        .certificate-page {
            background: white;
            padding: 0;
        }
        
        .certificate-page::before {
            display: none;
        }
        
        .certificate-header,
        .download-btn {
            display: none;
        }
        
        .certificate-container {
            box-shadow: none;
        }
    }
    
    @media (max-width: 768px) {
        .certificate-container {
            padding: 2rem;
        }
        
        .certificate-border {
            padding: 2.5rem 2rem;
        }
        
        .certificate-title {
            font-size: 2.75rem;
        }
        
        .recipient-name {
            font-size: 2.25rem;
            padding: 1rem 2.5rem;
        }
        
        .event-name {
            font-size: 1.5rem;
        }
        
        .signatures {
            flex-direction: column;
            align-items: center;
            gap: 2rem;
        }
    }
</style>

<div class="certificate-page">
    <div class="certificate-header">
        <h2>Certificate Preview</h2>
        <a href="{{ route('certificates.download', $certificate_number) }}" class="download-btn">
            <i class="fas fa-download"></i>
            <span>Download Certificate</span>
        </a>
    </div>

    <div class="certificate-wrapper">
        <div class="certificate-container">
            <div class="certificate-border">
                <div class="decorative-element top-left"></div>
                <div class="decorative-element bottom-right"></div>
                
                <div class="certificate-content">
                    <div class="certificate-logo">CE</div>
                    
                    <h1 class="certificate-title">Certificate</h1>
                    <p class="certificate-subtitle">of Participation</p>
                    
                    <p class="certificate-text">This is proudly presented to</p>
                    
                    <div class="recipient-name">{{ $name }}</div>
                    
                    <p class="certificate-text">
                        for successfully participating in
                    </p>
                    
                    <div class="event-name">{{ $event }}</div>
                    
                    <p class="event-date">Held on {{ $date }}</p>
                    
                    <div class="signatures">
                        <div class="signature-block">
                            <div class="signature-line"></div>
                            <p class="signature-title">Event Organizer</p>
                        </div>
                        <div class="signature-block">
                            <div class="signature-line"></div>
                            <p class="signature-title">College Director</p>
                        </div>
                    </div>
                    
                    <p class="certificate-number">Certificate No: {{ $certificate_number }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
