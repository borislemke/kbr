<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Verify Your Email Address</h2>

        <div>
            Thanks for creating an account. Please follow the link below to verify your email address
            <a href="{{ url('register/verify/' . $confirmation_code) }}">{{ url('register/verify/' . $confirmation_code) }}</a><br/>

        </div>

    </body>
</html>