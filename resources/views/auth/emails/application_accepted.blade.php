<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Welcome To MedCrip!</title>
        <link href='http://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
        <style type="text/css">
            /* EMBEDDED CSS*/

            /* Forces Hotmail to display normal line spacing. */
            .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {
                line-height: 100%;
            }
            body {
                -webkit-text-size-adjust: none;
                -ms-text-size-adjust: none;
                background-color: #ffffff;
                font-family: 'Lato', sans-serif;
                
            }
            body, img, div, p, ul, li, span, strong, a {
                margin: 0;
                padding: 0;
            }
            /* Resolves webkit padding issue. */
            table {
                border-spacing: 0;
                border-collapse: collapse;
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
            }
            table td {
                border-collapse: collapse;
            }
            /****** END BUG FIXES ********/
            /****** END RESETTING DEFAULTS ********/
            body, #body_style {
                width: 100% !important;
                color: #000;
            }
            a {
                color: #ffffff;
                text-decoration: none !important;
                outline: none;
                border: none !important;
                outline: none !important;
            }
            a:link {
                color: #ffffff;
                text-decoration: none;
            }
            a:visited {
                color: #ffffff;
                text-decoration: none;
            }
            a:hover {
                text-decoration: none !important;
            }

            img {
                border: medium none;
                margin: 0;
                max-width: 100%;
                outline: medium none;
                padding: 0;
                text-decoration: none;
                display: block;
            }

            tr, td {
                margin: 0;
                padding: 0;
            }

            @media only screen and (max-width: 639px) {

                body[yahoo] .wrapper {
                    width: 100% !important;
                }
                .resize-img {
                    width: 100%;
                    height: auto;
                }
                .resize1-img {
                    width: 100%;
                    height: 100%;
                }
                .lr-spacer{
                    width:20px;
                }
                .fnt-sz{font-size:18px !important;}


            }
@media only screen and (max-width: 479px) {
    .break-tab {
                    display: block;
                    width: 100%;
                }
                .lr-spacer1{
                    width:10px;
                }
                .lr-spacer2{
                    width:20px;
                }
                .fnt-sz1{font-size:20px !important;}
                .fnt-sz2{font-size:15px !important;}
                .spance-height {
                    height: 20px !important;
                }
                .spance-in-height {
                    height: 10px !important;
                }
                .hide{display: none;}
                .center-v{width: 100%}
    
}
        </style>

    </head>
    <body style="width:100% !important; " alink="#9d470a" link="#9d470a" text="#333333" yahoo="fix">

        <table class="wrapper" width="640" border="0" cellspacing="0" cellpadding="0" align="center">
            <!-- Start of Section-1 -->
            <tr>
                <td>
                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                        <tr>
                            <td height="40"><img src="{{asset('assets/mailers/images/spacer.gif')}}" height="1" width="1" alt=" "/></td>
                        </tr>
                        <tr>
                            <td align="left"><a href="{{url('/')}}"><img  src="{{asset('assets/mailers/images/logo.png')}}" border="0" width="107" height="43" alt=" " style="display: block;" /></a></td>
                        </tr>
                        <tr>
                            <td height="20"><img src="{{asset('assets/mailers/images/spacer.gif')}}" height="1" width="1" alt=" "/></td>
                        </tr>
                        <tr>
                            <td style="font-family: 'Lato', sans-serif; font-size:18px;font-weight:normal; color:#2a241c; line-height: 18px">Hi
                                {{$full_name}},
                            </td>
                        </tr>
                       
                        <tr>
                            <td height="20"><img src="{{asset('assets/mailers/images/spacer.gif')}}" height="1" width="1" alt=" "/></td>
                        </tr>

                        <td style="font-family: 'Lato', sans-serif; font-size:18px;font-weight:normal; color:#2a241c; line-height:23px">
                            <p>
                               <h2> Congratulations! </h2>
                            </p>
                                <br>
                            <p>
                                We’re glad to have you as a part of the MedCrip family. 
                               
                            </p>
                                <br>
                            <p>
                               Login ID: <b> {{$username}} </b>
                               <br />
                               Password: <b> {{$password}} </b>
                            </p>
                                <br>
                            <p>
                                <b> P.S.: </b> You can change your password as per your convenience.
                            </p>
                         </td>
                        
                        <tr>
                            <td height="20"><img src="{{asset('assets/mailers/images/spacer.gif')}}" height="1" width="1" alt=" "/></td>
                        </tr>
                       

                        <tr>
                            <td height="40"><img src="{{asset('assets/mailers/images/spacer.gif')}}" height="1" width="1" alt=" "/></td>
                        </tr>
                        <tr>
                            <td style="font-family: 'Lato', sans-serif; font-size:18px;font-weight:normal; color:#2a241c; line-height:23px">Cheers,</td>
                        </tr>
                        <tr>
                            <td style="font-family: 'Lato', sans-serif; font-size:18px;font-weight:normal; color:#2a241c; line-height:23px">The Team MedCrip</td>
                        </tr>
                        <tr>
                            <td height="42"><img src="{{asset('assets/mailers/images/spacer.gif')}}" height="1" width="1" alt=" "/></td>
                        </tr>
                        <tr>
                            <td height="1" style="background: #bfbfbf;"><img src="{{asset('assets/mailers/images/spacer.gif')}}" height="1" width="1" alt=" "/></td>
                        </tr>
                        <tr>
                            <td height="30"><img src="{{asset('assets/mailers/images/spacer.gif')}}" height="1" width="1" alt=" "/></td>
                        </tr>

                        <tr>
                            <td>
                                <table cellpadding="0" cellspacing="0" border="0"align="left" >
                                    <tr>
                                        <td width="40"><a href="#!" style="display: inline-block;"><img  src="{{asset('assets/mailers/images/facebook.png')}}" border="0" width="40" height="40" alt=" " style="display: block;" /></a></td>
                                        <td width="10"><img src="{{asset('assets/mailers/images/spacer.gif')}}" height="1" width="1" alt=" "/></td>
                                        <td width="40"><a href="#!" style="display: inline-block;"><img  src="{{asset('assets/mailers/images/instagram.png')}}" border="0" width="40" height="40" alt=" " style="display: block;" /></a></td>
                                        <td width="10"><img src="{{asset('assets/mailers/images/spacer.gif')}}" height="1" width="1" alt=" "/></td>
                                        <td width="40"><a href="#!" style="display: inline-block;"><img  src="{{asset('assets/mailers/images/g-plus.png')}}" border="0" width="40" height="40" alt=" " style="display: block;" /></a></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td style="font-family: 'Lato', sans-serif; font-size:16px;font-weight:normal; color:#7d7872; line-height:23px">Sent with <span style="display: inline-block;"><img src="{{asset('assets/mailers/images/shap1.png')}}" alt="" /></span> from Medcrip</td>
                        </tr>
                        <tr>
                            <td style="font-family: 'Lato', sans-serif; font-size:16px;font-weight:normal; color:#7d7872; line-height:23px">A3, Sector-63, <br> Noida 201301, Uttar Pradesh.
                            <br>
                            Call us : (+91) 999-999-9999  </td>
                        </tr>

                    </table>
                </td>
            </tr>
            
            <!-- End of Section-1 -->
            

        </table>

    </body>
</html>
    