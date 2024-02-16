<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ Config('app.name') }}</title>

    <h5> Sender Name:{{ $mail_data['name'] }}</h5> <br>
    <h5> Sender Mail:{{ $mail_data['fromEmail'] }}</h5>
    <h5>Subject:<b>{{ $mail_data['subject'] }}</b> </h5>
    <h5> Message:{{ $mail_data['body'] }}</h5>
</head>

<body>

</body>

</html>
