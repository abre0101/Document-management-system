<!DOCTYPE html>
<html>
<head>
    <title>Letter #{{ $letter->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.5; }
        .header { text-align: center; margin-bottom: 20px; }
        .content { margin: 20px; }
        .footer { margin-top: 40px; font-size: 0.9em; color: #555; }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $letter->subject }}</h1>
        <p><strong>Date:</strong> {{ $letter->created_at->format('Y-m-d') }}</p>
        <p><strong>From:</strong> {{ $letter->sender }}</p>
        <p><strong>To:</strong> {{ $letter->recipient }}</p>
    </div>

    <div class="content">
        {!! nl2br(e($letter->body)) !!}
    </div>

    <div class="footer">
        <p>Generated by Document Management System</p>
    </div>
</body>
</html>
