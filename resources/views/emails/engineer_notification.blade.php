<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background: #007bff;
            color: #fff;
            text-align: center;
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
        }
        .email-body {
            padding: 20px;
            color: #333;
            line-height: 1.6;
        }
        .email-button {
            display: inline-block;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            margin: 20px 0;
            border-radius: 5px;
            font-size: 16px;
        }
        .email-footer {
            text-align: center;
            color: #666;
            font-size: 14px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            TKKF/FR-KYM-247 Form Girişi
        </div>
        <div class="email-body">
            <p>Merhaba,</p>
            <p>**TKKF/FR-KYM-247** formuna yeni bir giriş yapılmıştır.</p>
            <blockquote>{{ $data['message'] }}</blockquote>
            <a href="http://kalite-kontrol.aspilsan.com" class="email-button">Detayları Görüntüle</a>
        </div>
        <div class="email-footer">
            <p>Bu bir sistem tarafından oluşturulan e-postadır, lütfen yanıtlamayın.</p>
        </div>
    </div>
</body>
</html>
