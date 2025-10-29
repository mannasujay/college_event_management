@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('content')
<style>
    .privacy-page {
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 4rem 0;
    }

    .privacy-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .privacy-header {
        text-align: center;
        margin-bottom: 3rem;
        animation: fadeInDown 0.8s ease;
    }

    .privacy-header h1 {
        font-size: 3.5rem;
        color: white;
        margin-bottom: 1rem;
        font-weight: 700;
    }

    .privacy-header p {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.9);
    }

    .privacy-content {
        background: white;
        border-radius: 20px;
        padding: 3rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        animation: fadeInUp 0.8s ease;
    }

    .privacy-section {
        margin-bottom: 3rem;
    }

    .privacy-section:last-child {
        margin-bottom: 0;
    }

    .privacy-section h2 {
        font-size: 1.8rem;
        color: #333;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 3px solid #667eea;
    }

    .privacy-section h3 {
        font-size: 1.4rem;
        color: #444;
        margin-top: 1.5rem;
        margin-bottom: 0.8rem;
    }

    .privacy-section p {
        font-size: 1.05rem;
        color: #666;
        line-height: 1.8;
        margin-bottom: 1rem;
    }

    .privacy-section ul {
        margin-left: 2rem;
        margin-bottom: 1rem;
    }

    .privacy-section li {
        font-size: 1.05rem;
        color: #666;
        line-height: 1.8;
        margin-bottom: 0.5rem;
    }

    .highlight-box {
        background: #f0f4ff;
        border-left: 4px solid #667eea;
        padding: 1.5rem;
        border-radius: 10px;
        margin: 1.5rem 0;
    }

    .highlight-box p {
        margin: 0;
        color: #444;
    }

    .last-updated {
        text-align: center;
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.95rem;
        margin-top: 2rem;
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

    @media (max-width: 768px) {
        .privacy-header h1 {
            font-size: 2.5rem;
        }

        .privacy-content {
            padding: 2rem;
        }
    }
</style>

<div class="privacy-page">
    <div class="privacy-container">
        <div class="privacy-header">
            <h1>🔒 Privacy Policy</h1>
            <p>Your privacy is important to us</p>
        </div>

        <div class="privacy-content">
            <div class="privacy-section">
                <h2>📋 Introduction</h2>
                <p>
                    Welcome to College Event Management System. This Privacy Policy explains how we collect, 
                    use, disclose, and safeguard your information when you use our platform. Please read this 
                    privacy policy carefully. If you do not agree with the terms of this privacy policy, 
                    please do not access the site.
                </p>
            </div>

            <div class="privacy-section">
                <h2>📊 Information We Collect</h2>
                
                <h3>Personal Information</h3>
                <p>We may collect personal information that you voluntarily provide to us when you:</p>
                <ul>
                    <li>Register for an account</li>
                    <li>Create or manage events</li>
                    <li>Register for events</li>
                    <li>Contact us for support</li>
                    <li>Subscribe to announcements</li>
                </ul>

                <p>This information may include:</p>
                <ul>
                    <li>Name and email address</li>
                    <li>Student ID or registration number</li>
                    <li>Phone number (optional)</li>
                    <li>Profile information</li>
                    <li>Event registration details</li>
                </ul>

                <h3>Automatically Collected Information</h3>
                <p>When you access our platform, we may automatically collect certain information, including:</p>
                <ul>
                    <li>IP address and browser type</li>
                    <li>Device information</li>
                    <li>Usage data and analytics</li>
                    <li>Cookies and tracking technologies</li>
                </ul>
            </div>

            <div class="privacy-section">
                <h2>🎯 How We Use Your Information</h2>
                <p>We use the information we collect to:</p>
                <ul>
                    <li>Create and manage your account</li>
                    <li>Process event registrations and manage participation</li>
                    <li>Send you important notifications and announcements</li>
                    <li>Improve our platform and user experience</li>
                    <li>Respond to your inquiries and provide support</li>
                    <li>Detect and prevent fraud or unauthorized activity</li>
                    <li>Generate analytics and reports</li>
                    <li>Comply with legal obligations</li>
                </ul>
            </div>

            <div class="privacy-section">
                <h2>🔐 Data Security</h2>
                <p>
                    We implement appropriate technical and organizational security measures to protect your 
                    personal information against unauthorized access, alteration, disclosure, or destruction. 
                    These measures include:
                </p>
                <ul>
                    <li>Encryption of sensitive data</li>
                    <li>Secure server infrastructure</li>
                    <li>Regular security audits</li>
                    <li>Access controls and authentication</li>
                    <li>Employee training on data protection</li>
                </ul>

                <div class="highlight-box">
                    <p>
                        <strong>⚠️ Important:</strong> While we strive to protect your personal information, 
                        no method of transmission over the internet is 100% secure. We cannot guarantee 
                        absolute security of your data.
                    </p>
                </div>
            </div>

            <div class="privacy-section">
                <h2>🤝 Information Sharing</h2>
                <p>We do not sell, trade, or rent your personal information to third parties. We may share your information in the following circumstances:</p>
                <ul>
                    <li><strong>Event Organizers:</strong> When you register for an event, your information is shared with the event organizer</li>
                    <li><strong>Service Providers:</strong> We may share data with trusted service providers who assist in operating our platform</li>
                    <li><strong>Legal Requirements:</strong> When required by law or to protect our rights and safety</li>
                    <li><strong>With Your Consent:</strong> When you explicitly authorize us to share your information</li>
                </ul>
            </div>

            <div class="privacy-section">
                <h2>🍪 Cookies and Tracking</h2>
                <p>
                    We use cookies and similar tracking technologies to enhance your experience on our platform. 
                    Cookies are small data files stored on your device. You can control cookie preferences through 
                    your browser settings, but disabling cookies may affect platform functionality.
                </p>
            </div>

            <div class="privacy-section">
                <h2>👤 Your Rights</h2>
                <p>You have the right to:</p>
                <ul>
                    <li><strong>Access:</strong> Request a copy of the personal information we hold about you</li>
                    <li><strong>Correction:</strong> Update or correct inaccurate information</li>
                    <li><strong>Deletion:</strong> Request deletion of your personal information</li>
                    <li><strong>Objection:</strong> Object to processing of your personal data</li>
                    <li><strong>Data Portability:</strong> Request transfer of your data to another service</li>
                    <li><strong>Withdraw Consent:</strong> Withdraw consent for data processing at any time</li>
                </ul>

                <p>To exercise these rights, please contact us at <a href="mailto:privacy@collegeevent.com" style="color: #667eea;">privacy@collegeevent.com</a></p>
            </div>

            <div class="privacy-section">
                <h2>👶 Children's Privacy</h2>
                <p>
                    Our platform is designed for use by college students and staff. We do not knowingly collect 
                    personal information from children under 13. If you believe we have inadvertently collected 
                    such information, please contact us immediately.
                </p>
            </div>

            <div class="privacy-section">
                <h2>🔄 Data Retention</h2>
                <p>
                    We retain your personal information for as long as necessary to fulfill the purposes outlined 
                    in this Privacy Policy, unless a longer retention period is required by law. When your data 
                    is no longer needed, we will securely delete or anonymize it.
                </p>
            </div>

            <div class="privacy-section">
                <h2>🌍 International Data Transfers</h2>
                <p>
                    Your information may be transferred to and processed in countries other than your own. 
                    We ensure appropriate safeguards are in place to protect your data in accordance with 
                    this Privacy Policy.
                </p>
            </div>

            <div class="privacy-section">
                <h2>📝 Changes to Privacy Policy</h2>
                <p>
                    We may update this Privacy Policy from time to time. We will notify you of any material 
                    changes by posting the new Privacy Policy on this page and updating the "Last Updated" 
                    date. We encourage you to review this Privacy Policy periodically.
                </p>
            </div>

            <div class="privacy-section">
                <h2>📧 Contact Us</h2>
                <p>If you have questions or concerns about this Privacy Policy, please contact us:</p>
                <ul>
                    <li><strong>Email:</strong> <a href="mailto:privacy@collegeevent.com" style="color: #667eea;">privacy@collegeevent.com</a></li>
                    <li><strong>Phone:</strong> +1 (234) 567-890</li>
                    <li><strong>Address:</strong> 123 College Street, University Campus, City, State 12345</li>
                </ul>
            </div>
        </div>

        <div class="last-updated">
            <p>Last Updated: October 28, 2025</p>
        </div>
    </div>
</div>
@endsection
