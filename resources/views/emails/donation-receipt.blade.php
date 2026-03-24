<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إيصال التبرع</title>
</head>

<body style="margin:0;padding:0;background:#ffffff;">

<table width="100%" cellpadding="0" cellspacing="0" role="presentation"
       dir="rtl"
       style="font-family:Cairo,Arial,sans-serif;text-align:right;">

    <!-- Logo -->
    <tr>
        <td align="center"
            style="padding:40px 16px 16px;border-bottom:1px solid #F1F1F4;">
            <img src="{{ asset('home-assets/images/logo.svg') }}"
                 width="200"
                 style="display:block;"
                 alt="جمعية مناصرة فلسطين">
        </td>
    </tr>

    <!-- Intro -->
    <tr>
        <td style="padding:32px 16px 16px;font-size:14px;line-height:1.8;">
            مرحباً <strong>{{ $transaction->user?->name ?? 'المحسن الكريم' }}،</strong><br><br>
            شكراً لك على تبرعك، لقد تمت العملية بنجاح وتم توزيع مبلغ تبرعك على المشاريع التالية:
        </td>
    </tr>

    <!-- Projects -->
    @foreach($transaction->invoice?->items as $item)
        <tr>
            <td style="padding:0 16px 12px;">
                <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
                       style="width:100%;background:#FFF7F7;border:1px solid #FAD7D9;border-radius:12px;">
                    <tr>
                        <td style="padding:16px 20px;">
                            <div style="font-size:15px;font-weight:bold;color:#AD010B;margin-bottom:6px;">
                                {{ $item->project->name }}
                            </div>
                            <div style="font-size:14px;">
                                المبلغ:
                                <strong>{{ number_format($item->amount, 3) }} دينار بحريني</strong>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    @endforeach

    <!-- Summary -->
    <tr>
        <td style="padding:24px 16px 0;">
            <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
                   style="width:100%;background:#FFF7F7;border:1px solid #E20512;border-radius:12px;">
                <tr>
                    <td style="padding:20px;text-align:center;font-weight:bold;color:#AD010B;">
                        ملخص التبرع
                    </td>
                </tr>
                <tr>
                    <td style="padding:0 20px 6px;">
                        اسم المتبرع: <strong>{{ $transaction->user?->name ?? 'المحسن الكريم' }}</strong>
                    </td>
                </tr>
                <tr>
                    <td style="padding:0 20px 6px;">
                        رقم العملية: <strong>{{ $transaction->no }}</strong>
                    </td>
                </tr>
                <tr>
                    <td style="padding:0 20px 6px;">
                        تاريخ التبرع: <strong>{{ $transaction->created_at->format('Y-m-d') }}</strong>
                    </td>
                </tr>
                <tr>
                    <td style="padding:0 20px 6px;">
                        طريقة الدفع:
                        <strong>{{ $transaction->receipt?->payment_method->label() }}</strong>
                    </td>
                </tr>
                <tr>
                    <td style="padding:12px 20px;border-top:1px dashed #E20512;font-weight:bold;color:#AD010B;">
                        الإجمالي: {{ $transaction->invoice?->amount }} دينار بحريني
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <!-- Footer -->
    <tr>
        <td style="padding:60px 16px 24px;text-align:center;font-size:12px;color:#9DA4AE;">
            © {{ now()->year }} جمعية مناصرة فلسطين – هذا البريد للإشعار فقط.<br>
            للمزيد من المعلومات يرجى زيارة موقعنا أو التواصل معنا عبر البريد الإلكتروني:<br>
            <a href="mailto:info@munasara.bh" style="color:#9DA4AE;text-decoration:underline;">
                info@munasara.bh
            </a>
        </td>
    </tr>

</table>

</body>
</html>
