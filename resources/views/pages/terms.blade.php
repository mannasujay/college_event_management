@extends('layouts.app')

@section('title', 'Terms of Service')

@section('content')
<style>
    .terms-page {
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 4rem 0;
    }

    .terms-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .terms-header {
        text-align: center;
        margin-bottom: 3rem;
        animation: fadeInDown 0.8s ease;
    }

    .terms-header h1 {
        font-size: 3.5rem;
        color: white;
        margin-bottom: 1rem;
        font-weight: 700;
    }

    .terms-header p {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.9);
    }

    .terms-content {
        background: white;
        border-radius: 20px;
        padding: 3rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        animation: fadeInUp 0.8s ease;
    }

    .terms-section {
        margin-bottom: 3rem;
    }

    .terms-section:last-child {
        margin-bottom: 0;
    }

    .terms-section h2 {
        font-size: 1.8rem;
        color: #333;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 3px solid #667eea;
    }

    .terms-section h3 {
        font-size: 1.4rem;
        color: #444;
        margin-top: 1.5rem;
        margin-bottom: 0.8rem;
    }

    .terms-section p {
        font-size: 1.05rem;
        color: #666;
        line-height: 1.8;
        margin-bottom: 1rem;
    }

    .terms-section ul, .terms-section ol {
        margin-left: 2rem;
        margin-bottom: 1rem;
    }

    .terms-section li {
        font-size: 1.05rem;
        color: #666;
        line-height: 1.8;
        margin-bottom: 0.5rem;
    }

    .warning-box {
        background: #fff3cd;
        border-left: 4px solid #ffc107;
        padding: 1.5rem;
        border-radius: 10px;
        margin: 1.5rem 0;
    }

    .warning-box p {
        margin: 0;
        color: #856404;
    }

    .info-box {
        background: #d1ecf1;
        border-left: 4px solid #17a2b8;
        padding: 1.5rem;
        border-radius: 10px;
        margin: 1.5rem 0;
    }

    .info-box p {
        margin: 0;
        color: #0c5460;
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
        .terms-header h1 {
            font-size: 2.5rem;
        }

        .terms-content {
            padding: 2rem;
        }
    }
</style>

<div class="terms-page">
    <div class="terms-container">
        <div class="terms-header">
            <h1>📜 Terms of Service</h1>
            <p>Please read these terms carefully before using our platform</p>
        </div>

        <div class="terms-content">
            <div class="terms-section">
                <h2>✅ Agreement to Terms</h2>
                <p>
                    By accessing and using the College Event Management System ("Platform"), you accept and 
                    agree to be bound by these Terms of Service ("Terms"). If you do not agree to these Terms, 
                    you may not access or use the Platform.
                </p>
                <div class="info-box">
                    <p>
                        <strong>📌 Note:</strong> These Terms constitute a legally binding agreement between 
                        you and College Event Management System.
                    </p>
                </div>
            </div>

            <div class="terms-section">
                <h2>👥 User Accounts</h2>
                
                <h3>Account Registration</h3>
                <p>To use certain features of the Platform, you must register for an account. When registering, you agree to:</p>
                <ul>
                    <li>Provide accurate, current, and complete information</li>
                    <li>Maintain and update your information to keep it accurate</li>
                    <li>Maintain the security of your password and account</li>
                    <li>Accept responsibility for all activities under your account</li>
                    <li>Notify us immediately of any unauthorized access</li>
                </ul>

                <h3>Account Types</h3>
                <p>The Platform offers three types of user accounts:</p>
                <ul>
                    <li><strong>Student:</strong> Can view and register for events</li>
                    <li><strong>Organizer:</strong> Can create and manage events</li>
                    <li><strong>Administrator:</strong> Has full platform management capabilities</li>
                </ul>

                <div class="warning-box">
                    <p>
                        <strong>⚠️ Warning:</strong> You are responsible for safeguarding your account 
                        credentials. We are not liable for any losses arising from unauthorized use of your account.
                    </p>
                </div>
            </div>

            <div class="terms-section">
                <h2>✋ Acceptable Use Policy</h2>
                <p>You agree NOT to use the Platform to:</p>
                <ul>
                    <li>Violate any laws, regulations, or third-party rights</li>
                    <li>Post false, misleading, or fraudulent content</li>
                    <li>Impersonate any person or entity</li>
                    <li>Harass, abuse, or harm other users</li>
                    <li>Upload viruses, malware, or harmful code</li>
                    <li>Attempt to gain unauthorized access to the Platform</li>
                    <li>Interfere with the proper functioning of the Platform</li>
                    <li>Scrape, crawl, or use automated tools without permission</li>
                    <li>Create fake events or registrations</li>
                    <li>Spam users with unsolicited communications</li>
                </ul>
            </div>

            <div class="terms-section">
                <h2>📅 Event Management</h2>
                
                <h3>Creating Events</h3>
                <p>Event organizers agree to:</p>
                <ul>
                    <li>Provide accurate and complete event information</li>
                    <li>Ensure events comply with institutional policies</li>
                    <li>Obtain necessary approvals before creating events</li>
                    <li>Update event details promptly if changes occur</li>
                    <li>Cancel events responsibly with adequate notice</li>
                </ul>

                <h3>Event Registration</h3>
                <p>When registering for events, you agree to:</p>
                <ul>
                    <li>Provide accurate personal information</li>
                    <li>Attend events you register for, when possible</li>
                    <li>Cancel registrations if you cannot attend</li>
                    <li>Follow event rules and guidelines</li>
                    <li>Respect capacity limits and other participants</li>
                </ul>
            </div>

            <div class="terms-section">
                <h2>📝 Content Guidelines</h2>
                <p>All content posted on the Platform must:</p>
                <ul>
                    <li>Be appropriate for an educational environment</li>
                    <li>Not contain offensive, discriminatory, or hateful material</li>
                    <li>Not infringe on intellectual property rights</li>
                    <li>Not contain personal or sensitive information of others</li>
                    <li>Comply with applicable laws and regulations</li>
                </ul>

                <p>
                    We reserve the right to remove any content that violates these guidelines without notice. 
                    Repeated violations may result in account suspension or termination.
                </p>
            </div>

            <div class="terms-section">
                <h2>🔒 Intellectual Property</h2>
                <p>
                    The Platform and its original content, features, and functionality are owned by College 
                    Event Management System and are protected by international copyright, trademark, and 
                    other intellectual property laws.
                </p>

                <h3>User Content</h3>
                <p>
                    You retain ownership of content you post on the Platform. However, by posting content, 
                    you grant us a non-exclusive, worldwide, royalty-free license to use, reproduce, modify, 
                    and display your content for the purpose of operating and improving the Platform.
                </p>
            </div>

            <div class="terms-section">
                <h2>⚖️ Disclaimer of Warranties</h2>
                <p>
                    THE PLATFORM IS PROVIDED "AS IS" AND "AS AVAILABLE" WITHOUT WARRANTIES OF ANY KIND, 
                    EITHER EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO:
                </p>
                <ul>
                    <li>Warranties of merchantability or fitness for a particular purpose</li>
                    <li>Warranties that the Platform will be uninterrupted or error-free</li>
                    <li>Warranties regarding the accuracy or reliability of content</li>
                    <li>Warranties that defects will be corrected</li>
                </ul>
            </div>

            <div class="terms-section">
                <h2>🛡️ Limitation of Liability</h2>
                <p>
                    TO THE FULLEST EXTENT PERMITTED BY LAW, COLLEGE EVENT MANAGEMENT SYSTEM SHALL NOT BE 
                    LIABLE FOR ANY INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL, OR PUNITIVE DAMAGES, 
                    INCLUDING BUT NOT LIMITED TO:
                </p>
                <ul>
                    <li>Loss of profits, data, or use</li>
                    <li>Business interruption</li>
                    <li>Personal injury or property damage</li>
                    <li>Unauthorized access to your account</li>
                </ul>
            </div>

            <div class="terms-section">
                <h2>🔄 Modifications to Terms</h2>
                <p>
                    We reserve the right to modify these Terms at any time. We will notify users of material 
                    changes by posting the updated Terms on the Platform and updating the "Last Updated" date. 
                    Your continued use of the Platform after changes constitutes acceptance of the modified Terms.
                </p>
            </div>

            <div class="terms-section">
                <h2>🚫 Termination</h2>
                <p>We may suspend or terminate your account and access to the Platform:</p>
                <ul>
                    <li>For violation of these Terms</li>
                    <li>For fraudulent or illegal activity</li>
                    <li>Upon your request</li>
                    <li>For extended periods of inactivity</li>
                    <li>At our discretion, with or without cause</li>
                </ul>

                <p>
                    Upon termination, your right to use the Platform will immediately cease. We may delete 
                    your account and content without liability.
                </p>
            </div>

            <div class="terms-section">
                <h2>📜 Governing Law</h2>
                <p>
                    These Terms shall be governed by and construed in accordance with the laws of the 
                    jurisdiction in which the Platform operates, without regard to its conflict of law provisions.
                </p>
            </div>

            <div class="terms-section">
                <h2>⚖️ Dispute Resolution</h2>
                <p>
                    Any disputes arising from these Terms or use of the Platform shall be resolved through:
                </p>
                <ol>
                    <li>Good faith negotiation between the parties</li>
                    <li>Mediation, if negotiation fails</li>
                    <li>Binding arbitration in accordance with applicable rules</li>
                </ol>
            </div>

            <div class="terms-section">
                <h2>📞 Contact Information</h2>
                <p>If you have questions about these Terms of Service, please contact us:</p>
                <ul>
                    <li><strong>Email:</strong> <a href="mailto:legal@collegeevent.com" style="color: #667eea;">legal@collegeevent.com</a></li>
                    <li><strong>Phone:</strong> +1 (234) 567-890</li>
                    <li><strong>Address:</strong> 123 College Street, University Campus, City, State 12345</li>
                </ul>
            </div>

            <div class="terms-section">
                <h2>📌 Miscellaneous</h2>
                <ul>
                    <li><strong>Severability:</strong> If any provision of these Terms is found invalid, the remaining provisions will continue in effect</li>
                    <li><strong>No Waiver:</strong> Failure to enforce any provision does not waive our right to enforce it later</li>
                    <li><strong>Assignment:</strong> You may not assign these Terms without our consent</li>
                    <li><strong>Entire Agreement:</strong> These Terms constitute the entire agreement between you and us</li>
                </ul>
            </div>
        </div>

        <div class="last-updated">
            <p>Last Updated: October 28, 2025</p>
        </div>
    </div>
</div>
@endsection
