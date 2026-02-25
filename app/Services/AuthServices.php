<?php

namespace App\Services;


use App\Models\AppUser as User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthServices
{
    public function login(array $credentials, string $redirectTo = null)
    {
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $currentSessionId = Session::getId();

        if (Auth::guard('app')->attempt($validator->validated())) {
            (new CartService())->mergeSessionCartToUser(\auth('app')->user()->id, $currentSessionId);

            return [
                'status' => true,
                'redirect' => $redirectTo ?? route('profile'),
            ];
        }

        return [
            'status' => false,
            'error' => 'البريد الإلكتروني او كلمة المرور غير صحيحة.',
        ];
    }

    public function register(array $data, string $redirectTo = null)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'password' => 'required|min:8|confirmed',
            'otp' => 'required',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $validated = $validator->validated();

        if (!$this->verifyEmailOtp($validated['email'], $validated['otp'])) {
            throw ValidationException::withMessages([
                'otp' => 'كود التحقق غير صحيح أو منتهي الصلاحية',
            ]);
        }

        // حذف OTP بعد الاستخدام
        Cache::forget('email_otp_' . $validated['email']);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return [
            'status' => true,
            'redirect' => $redirectTo ?? route('user.dashboard'),
            'message' => 'تم إنشاء الحساب بنجاح.',
        ];
    }


    public function sendEmailOtp(string $email): void
    {
        $ip = request()->ip();

        // هل الـ IP محظور؟
        if (Cache::has('blocked_ip_' . $ip)) {
            $seconds = Cache::get('blocked_ip_' . $ip);

            throw ValidationException::withMessages([
                'email' => "تم حظر عنوان IP مؤقتاً. حاول بعد {$seconds} ثانية.",
            ]);
        }

        //  Rate limit حسب IP (10 محاولات / 10 دقائق)
        $ipKey = 'otp_ip_' . $ip;

        if (RateLimiter::tooManyAttempts($ipKey, 5)) {
            // 🔥 فعّل الحظر 30 دقيقة
            Cache::put(
                'blocked_ip_' . $ip,
                1800, // 30 دقيقة
                now()->addMinutes(30)
            );

            throw ValidationException::withMessages([
                'email' => 'تم حظرك مؤقتاً بسبب عدد محاولات كبير.',
            ]);
        }

        RateLimiter::hit($ipKey, 600); // 10 دقائق

        // 🚫 Rate limit حسب الإيميل (3 / 10 دقائق)
        $emailKey = 'otp_email_' . $email;

        if (RateLimiter::tooManyAttempts($emailKey, 3)) {
            $seconds = RateLimiter::availableIn($emailKey);

            throw ValidationException::withMessages([
                'email' => "يرجى الانتظار {$seconds} ثانية قبل طلب رمز جديد.",
            ]);
        }

        RateLimiter::hit($emailKey, 600);

        // 🔐 توليد OTP
        $otp = random_int(100000, 999999);

        Cache::put(
            'email_otp_' . $email,
            $otp,
            now()->addMinutes(5)
        );

        Mail::raw(
            "Your OTP code is: {$otp}\nThis code expires in 5 minutes.",
            function ($message) use ($email) {
                $message->to($email)
                    ->subject('Your OTP Code');
            }
        );
    }



    public function verifyEmailOtp(string $email, string $otp): bool
    {
        $cachedOtp = Cache::get('email_otp_' . $email);

        if (!$cachedOtp) {
            return false;
        }

        return $cachedOtp == $otp;
    }


}
