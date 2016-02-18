<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Kibarer Property</title>
    </head>
    <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix">
        <center>
            <table cellpadding="0" cellspacing="0" align="center" style="margin: auto; padding:50px; " width="600">
                <tr>
                    <td>
                        <table cellpadding="0" cellspacing="0" width="600" align="center" style="background:#fff; padding:30px; border:1px solid #e8e8e8; font-family: 'Helvetica Neue', sans-serif;"> 
                            <tr>
                                <td align="left">
                                    <table cellpadding="20" cellspacing="0" width="100%">
                                        <tr>
                                            <td align="center" width="50%">
                                                <img src="http://dev.kesato.com/newsletter/kbr/email/assets/logo.png" style="display: block; padding-bottom:20px;">
    
                                            </td>
                                            
                                            <td align="center" width="50%">
                                                <a href="https://www.facebook.com/kesato"><img src="http://dev.kesato.com/newsletter/kbr/email/assets/facebook.png" style="display: inline-block; width:28px;"></a>
                                                <a href="https://www.facebook.com/kesato"><img src="http://dev.kesato.com/newsletter/kbr/email/assets/g-plus.png" style="display: inline-block; width:28px;"></a>
                                                <a href="https://www.facebook.com/kesato"><img src="http://dev.kesato.com/newsletter/kbr/email/assets/twitter.png" style="display: inline-block; width:28px;"></a>
                                                <a href="https://www.facebook.com/kesato"><img src="http://dev.kesato.com/newsletter/kbr/email/assets/linkedin.png" style="display: inline-block; width:28px;"></a>
                                                <a href="https://www.facebook.com/kesato"><img src="http://dev.kesato.com/newsletter/kbr/email/assets/youtube.png" style="display: inline-block; width:28px;"></a>
                                                <a href="https://www.facebook.com/kesato"><img src="http://dev.kesato.com/newsletter/kbr/email/assets/skype.png" style="display: inline-block; width:28px;"></a>
                                            </td>
                                        </tr>

                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <img src="http://dev.kesato.com/newsletter/kbr/email/assets/banner-sm.jpg" style="max-width:600px; display: block; ">
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <p style="line-height: 1.5; font-size: 14px; color:#666666;">       
                                        Hi <strong>{{ ucfirst($firstname) }}</strong>, <br><br>

                                        Thanks for creating an account. Please follow the link below to verify your email address. 
                                        <br><br>
                                    </p>
                                </td>
                            </tr>
                            
                            <tr>
                                <td align="center">
                                    
                                    <a href="{{ route('confirm', ['confirm' => trans('url.confirm'), 'confirmation_code' => $confirmation_code]) }}" style=" background: #ee5b2c; padding: 10px 15px; color: #fff; text-decoration: none;border-radius: 4px; font-size:12px; font-weight: 600;">{{ trans('word.confirmation') }}</a>

                                        <br><br>
                                    </p>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <p style="line-height: 1.5; font-size: 14px; color:#666666;">       
                                        Best, <br>
                                        The Kibarer Accounts team.<br><br>
                                    </p>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <table cellpadding="20" cellspacing="0" width="100%" bgcolor="#ee5b2c">
                                        <tr>
                                            <td align="center">
                                                
                                               <p style="color:#ffffff; line-height:24px; letter-spacing:1px; font-size: 12px;">
                                                    <a href="mailto:contact@kibarerproperty.com"style="color:#ffffff; text-decoration:none; ">contact@kibarerproperty.com</a> <br>
                                                    <a href="tel:(+62361)4741212"style="color:#ffffff; text-decoration:none; ">(+62361) 4741212</a> <br>
                                                    Jalan Petitenget No.9, Badung, Bali 80361 <br><br>
                                                </p>
                                               
                                                <img src="http://dev.kesato.com/newsletter/kbr/email/assets/logo-sm.png" alt="">
                                                
                                            </td>

                                        </tr>
                                        
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p align="center" style="color:#868686; font-size:12px; padding-top:30px;">This email can't receive replies. For more information, visit the</p> 
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>          
            </table>
        </center>
    </body>
</html>
