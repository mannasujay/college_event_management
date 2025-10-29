<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP - College Event Management</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .auth-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .auth-card {
            background: white;
            padding: 50px 40px;
            border-radius: 20px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
            max-width: 480px;
            width: 100%;
            animation: slideUp 0.5s ease;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .auth-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .auth-icon {
            font-size: 64px;
            margin-bottom: 20px;
        }
        
        .auth-header h1 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 28px;
            font-weight: 700;
        }
        
        .auth-header p {
            color: #666;
            font-size: 15px;
            line-height: 1.6;
        }
        
        .otp-input-container {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin: 30px 0;
        }
        
        .otp-input {
            width: 60px;
            height: 60px;
            text-align: center;
            font-size: 24px;
            font-weight: 700;
            border: 2px solid #e1e8ed;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        
        .otp-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }
        
        .btn-submit {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }
        
        .resend-otp {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e1e8ed;
        }
        
        .resend-otp a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .resend-otp a:hover {
            color: #764ba2;
        }
        
        .alert {
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 14px;
            border-left: 4px solid;
        }
        
        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            border-color: #22c55e;
            color: #166534;
        }
        
        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border-color: #ef4444;
            color: #991b1b;
        }
        
        .timer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
        
        .timer span {
            font-weight: 700;
            color: #667eea;
        }
        
        .hidden-input {
            display: none;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-icon">✉️</div>
                <h1>Verify OTP</h1>
                <p>We've sent a 6-digit OTP to <strong>{{ session('email') }}</strong></p>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success">
                    ✓ {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-error">
                    ✗ {{ session('error') }}
                </div>
            @endif
            
            @if($errors->any())
                <div class="alert alert-error">
                    @foreach($errors->all() as $error)
                        ✗ {{ $error }}<br>
                    @endforeach
                </div>
            @endif
            
            <form action="{{ route('password.verifyOtp') }}" method="POST" id="otpForm">
                @csrf
                <input type="hidden" name="email" value="{{ session('email') }}">
                <input type="hidden" name="otp" id="otpHidden">
                
                <div class="otp-input-container">
                    <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" data-index="0">
                    <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" data-index="1">
                    <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" data-index="2">
                    <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" data-index="3">
                    <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" data-index="4">
                    <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" data-index="5">
                </div>
                
                <div class="timer">
                    ⏰ OTP expires in: <span id="countdown">10:00</span>
                </div>
                
                <button type="submit" class="btn-submit">
                    ✓ Verify OTP
                </button>
            </form>
            
            <div class="resend-otp">
                <p>Didn't receive the OTP? <a href="{{ route('password.forgot') }}">Resend OTP</a></p>
            </div>
        </div>
    </div>
    
    <script>
        // OTP Input Logic
        const otpInputs = document.querySelectorAll('.otp-input');
        const otpHidden = document.getElementById('otpHidden');
        
        otpInputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                if (e.target.value.length === 1 && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
                updateHiddenOTP();
            });
            
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });
            
            input.addEventListener('paste', (e) => {
                e.preventDefault();
                const pastedData = e.clipboardData.getData('text').slice(0, 6);
                pastedData.split('').forEach((char, i) => {
                    if (otpInputs[i]) {
                        otpInputs[i].value = char;
                    }
                });
                updateHiddenOTP();
            });
        });
        
        function updateHiddenOTP() {
            let otp = '';
            otpInputs.forEach(input => {
                otp += input.value;
            });
            otpHidden.value = otp;
        }
        
        // Countdown Timer
        let timeLeft = 600; // 10 minutes in seconds
        const countdownElement = document.getElementById('countdown');
        
        const timer = setInterval(() => {
            timeLeft--;
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            countdownElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
            
            if (timeLeft <= 0) {
                clearInterval(timer);
                countdownElement.textContent = 'Expired';
                document.querySelector('.btn-submit').disabled = true;
            }
        }, 1000);
        
        // Focus first input on load
        otpInputs[0].focus();
    </script>
</body>
</html>
