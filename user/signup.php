<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../config/config.php";

$postdata = file_get_contents("php://input");

$request = json_decode($postdata);

$username = $request->username;
$email = $request->email;
$password = $request->password;
$status = 0;
$user_role = 0;
$verify_key = md5(date("Y-m-d h:i:sa"));

$select_username_sql = "SELECT `user_id` FROM `user` WHERE `username`='" . $username . "'";
$select_username = mysqli_query($link, $select_username_sql);

$select_email_sql = "SELECT `user_id` FROM `user` WHERE `email`='" . $email . "'";
$select_email = mysqli_query($link, $select_email_sql);

if (mysqli_num_rows($select_username) > 0 || mysqli_num_rows($select_email) > 0) {

    echo json_encode(array('status' => 'error', 'message' => 'Username or Email already exists.'));

} else {
    $insert_sql = "INSERT INTO `user` (`username`, `email`, `password`, `status`, `user_role`, `verify_key`) VALUES ('".$username."', '".$email."', '" . md5($password) . "', '".$status."', '".$user_role."', '".$verify_key."')";    
    
    mysqli_query($link, $insert_sql);

    $verify_link = $api_url . "user/verify.php?verify_key=" . $verify_key;

    $to = $email;
    $subject = "Registration Verify Request";
    // email template header
    $headers = "From: " . $admin_email;
    $headers .= "no-reply\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    // EMAIL TEMPLATE
    $message = '<html><body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="background-color:#eeeeee; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; height:100%; margin:0; padding:0; width:100%;">';
    $message .= '<span class="mcnPreviewText" style="display:none !important; font-size:0px; line-height:0px; max-height:0px; max-width:0px; opacity:0; overflow:hidden; visibility:hidden; mso-hide:all;">*|MC_PREVIEW_TEXT|*</span>';
    $message .= '<center>';
    $message .= '<table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tr>';
    $message .= '<td align="center" valign="top" id="bodyCell" style="padding-bottom:40px; mso-line-height-rule:exactly; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;">';
    // BEGIN TEMPLATE
    $message .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tr>';
    $message .= '<td align="center" valign="top" style="mso-line-height-rule:exactly; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;">';
    // BEGIN PREHEADER
    $message .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" id="templatePreheader" style="border-bottom:0; border-top:1px none ; background-color:#13ed9a; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tr>';
    $message .= '<td align="center" valign="top" style="padding-right:10px; padding-left:10px; mso-line-height-rule:exactly; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;">';
    $message .= '<table border="0" cellpadding="0" cellspacing="0" width="600" class="templateContainer" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tr>';
    $message .= '<td align="center" valign="top" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; mso-line-height-rule:exactly;">';
    $message .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" id="preheaderBackground" style="border-bottom:20px solid #ffffff; border-top:1px none ; background-color:#13ed9a; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tr>';
    $message .= '<td valign="top" class="preheaderContainer" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; mso-line-height-rule:exactly;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="table-layout:fixed !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; min-width:100%; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tbody class="mcnDividerBlockOuter">';
    $message .= '<tr>';
    $message .= '<td class="mcnDividerBlockInner" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; min-width:100%; padding:18px; mso-line-height-rule:exactly;">';
    $message .= '<table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; min-width: 100%; border-top: 0px; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tbody><tr>';
    $message .= '<td style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; mso-line-height-rule:exactly;"><span></span></td>';
    $message .= '</tr></tbody>';
    $message .= '</table>';
    $message .= '</td>';
    $message .= '</tr>';
    $message .= '</tbody>';
    $message .= '</table>';
    $message .= '</td>';
    $message .= '</tr>';
    $message .= '</table>';
    $message .= '</td>';
    $message .= '</tr>';
    $message .= '</table>';
    $message .= '</td>';
    $message .= '</tr>';
    $message .= '</table>';
    // END PREHEADER
    $message .= '</td>';
    $message .= '</tr>';
    $message .= '<tr>';
    $message .= '<td align="center" valign="top" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; mso-line-height-rule:exactly;">';
    // BEGIN HEADER
    $message .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateHeader" style="border-bottom:0; border-top:1px none ; background-color:#eeeeee; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tr>';
    $message .= '<td align="center" valign="top" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; padding-right:10px; padding-left:10px; mso-line-height-rule:exactly;">';
    $message .= '<table border="0" cellpadding="0" cellspacing="0" width="600" class="templateContainer" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tr>';
    $message .= '<td align="center" valign="top" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; mso-line-height-rule:exactly;">';
    $message .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" id="headerBackground" style="border-bottom:0; border-top:0; background-color:#FFFFFF; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tr>';
    $message .= '<td valign="top" class="headerContainer" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; mso-line-height-rule:exactly;"></td>';
    $message .= '</tr>';
    $message .= '</table>';
    $message .= '</td>';
    $message .= '</tr>';
    $message .= '</table>';
    $message .= '</td></tr></table>';
    // END HEADER
    $message .= '</td></tr>';
    $message .= '<tr><td align="center" valign="top" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; mso-line-height-rule:exactly;">';
    // BEGIN BODY
    $message .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody" style="border-bottom:0; border-top:0; background-color:#eeeeee; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tr><td align="center" valign="top" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; padding-right:10px; padding-left:10px; mso-line-height-rule:exactly;">';
    $message .= '<table border="0" cellpadding="0" cellspacing="0" width="600" class="templateContainer" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tr><td align="center" valign="top" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; mso-line-height-rule:exactly;">';
    $message .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" id="bodyBackground" style="border-bottom:0; border-top:0; background-color:#FFFFFF; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tr><td valign="top" class="bodyContainer" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; mso-line-height-rule:exactly;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="table-layout:fixed !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; min-width:100%;border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tbody class="mcnDividerBlockOuter">';
    $message .= '<tr><td class="mcnDividerBlockInner" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; min-width:100%; padding:18px; mso-line-height-rule:exactly;">';
    $message .= '<table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; min-width: 100%; border-top: 0px; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tbody><tr><td style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; mso-line-height-rule:exactly;"><span></span></td></tr></tbody></table>';
    $message .= '</td></tr></tbody></table>';
    $message .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; min-width:100%; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tbody class="mcnTextBlockOuter">';
    $message .= '<tr><td valign="top" class="mcnTextBlockInner" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; padding-top:9px; mso-line-height-rule:exactly;">';
    $message .= '<table align="left" border="0" cellpadding="0" cellspacing="0" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; max-width:100%; min-width:100%; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" width="100%" class="mcnTextContentContainer">';
    $message .= '<tbody><tr><td valign="top" class="mcnTextContent" style="word-break:break-word; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; padding: 0px 18px 9px;color: #2F187C;font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;font-size: 16px;line-height: 150%; color:#202020; font-family:Helvetica; font-size:18px; line-height:150%; text-align:center; mso-line-height-rule:exactly;">';
    $message .= '<h1 style="text-align:center; letter-spacing:normal; line-height:125%; font-weight:bold; font-style:normal; font-size:34px; color:#202020 !important; font-family:Source Sans Pro, Helvetica Neue, Helvetica, Arial, sans-serif; display:block; margin:0; padding:0;"><span style="color:#2f187c"><span style="font-family:source sans pro,helvetica neue,helvetica,arial,sans-serif">CRYPTOVIEW</span></span></h1>';
    $message .= '</td></tr></tbody></table></td></tr></tbody></table>';
    $message .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; min-width:100%; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tbody class="mcnTextBlockOuter">';
    $message .= '<tr><td valign="top" class="mcnTextBlockInner" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; padding-top:9px; mso-line-height-rule:exactly;">';
    $message .= '<table align="left" border="0" cellpadding="0" cellspacing="0" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; max-width:100%; min-width:100%; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" width="100%" class="mcnTextContentContainer">';
    $message .= '<tbody><tr><td valign="top" class="mcnTextContent" style="color:#202020; font-family:Helvetica; font-size:18px; line-height:150%; text-align:center; word-break:break-word; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; padding: 0px 18px 9px;color: #2F187C;font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;font-size: 16px;line-height: 150%; mso-line-height-rule:exactly;">';
    $message .= 'Hey, cool dass du dabei bist.<br>Bitte klicke auf den nachfolgenden Link und bestätige, dass du dich zum Cryptoview anmelden möchtest.';
    $message .= '</td></tr></tbody></table></td></tr></tbody></table>';
    $message .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="table-layout:fixed !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; min-width:100%; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tbody class="mcnDividerBlockOuter">';
    $message .= '<tr><td class="mcnDividerBlockInner" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; min-width:100%; padding:18px; mso-line-height-rule:exactly;">';
    $message .= '<table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; min-width: 100%; border-top: 0px; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tbody><tr><td style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; mso-line-height-rule:exactly;"><span></span></td></tr></tbody></table></td></tr></tbody></table>';
    $message .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonBlock" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; min-width:100%; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tbody class="mcnButtonBlockOuter">';
    $message .= '<tr><td style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; padding-top:0; padding-right:18px; padding-bottom:18px; padding-left:18px; mso-line-height-rule:exactly;" valign="top" align="center" class="mcnButtonBlockInner">';
    $message .= '<table border="0" cellpadding="0" cellspacing="0" class="mcnButtonContentContainer" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; border-collapse: separate !important;border-radius: 0px;background-color: #2DEC9C; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tbody><tr><td align="center" valign="middle" class="mcnButtonContent" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 20px; mso-line-height-rule:exactly;">';
    $message .= '<a class="mcnButton" title="E-MAIL ADRESSE BESTÄTIGEN" href="' . $verify_link . '" target="_self" style="display:block; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; font-weight: bold;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF; mso-line-height-rule:exactly;">E-MAIL ADRESSE BESTÄTIGEN</a>';
    $message .= '</td></tr></tbody></table></td></tr></tbody></table>';
    $message .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="table-layout:fixed !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; min-width:100%; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tbody class="mcnDividerBlockOuter">';
    $message .= '<tr><td class="mcnDividerBlockInner" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; min-width:100%; padding:18px; mso-line-height-rule:exactly;">';
    $message .= '<table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; min-width: 100%; border-top: 0px; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tbody><tr><td style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; mso-line-height-rule:exactly;"><span></span></td></tr></tbody></table></td></tr></tbody></table>';
    $message .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; min-width:100%; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tbody class="mcnImageBlockOuter">';
    $message .= '<tr><td valign="top" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; padding:0px; mso-line-height-rule:exactly;" class="mcnImageBlockInner">';
    $message .= '<table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; min-width:100%; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tbody><tr><td class="mcnImageContent" valign="top" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; padding-right: 0px; padding-left: 0px; padding-top: 0; padding-bottom: 0; text-align:center; mso-line-height-rule:exactly;">';
    $message .= '<img align="center" alt="" src="https://gallery.mailchimp.com/154234de8797ca7fa2dafb585/images/b6bb5199-8b4c-401e-bd4d-db68d8e83d50.gif" width="426" style="vertical-align:bottom; max-width:426px; padding-bottom: 0; display: inline !important; vertical-align: bottom; border:0; height:auto; outline:none; text-decoration:none; -ms-interpolation-mode:bicubic;" class="mcnImage">';
    $message .= '</td></tr></tbody></table></td></tr></tbody></table></td></tr></table></td></tr></table></td></tr></table>';
    // END BODY
    $message .= '</td></tr><tr><td align="center" valign="top" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; mso-line-height-rule:exactly;">';
    // BEGIN FOOTER
    $message .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateFooter" style="border-bottom:0; border-top:0; background-color:#eeeeee; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tr><td align="center" valign="top" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; padding-right:10px; padding-left:10px; mso-line-height-rule:exactly;">';
    $message .= '<table border="0" cellpadding="0" cellspacing="0" width="600" class="templateContainer" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tr><td align="center" valign="top" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; mso-line-height-rule:exactly;">';
    $message .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" id="footerBackground" style="background-color:#FFFFFF; border-top:0; border-bottom:0; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tr><td valign="top" class="footerContainer" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; mso-line-height-rule:exactly;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; min-width:100%; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tbody class="mcnTextBlockOuter">';
    $message .= '<tr><td valign="top" class="mcnTextBlockInner" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; padding-top:9px; mso-line-height-rule:exactly;">';
    $message .= '<table align="left" border="0" cellpadding="0" cellspacing="0" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; max-width:100%; min-width:100%; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" width="100%" class="mcnTextContentContainer">';
    $message .= '<tbody><tr><td valign="top" class="mcnTextContent" style="color:#606060; font-family:Helvetica; font-size:10px; line-height:125%; text-align:center; word-break:break-word; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; padding-top:0; padding-right:18px; padding-bottom:9px; padding-left:18px; mso-line-height-rule:exactly;">';
    $message .= '<em>Copyright © 2018 Crypto Rebels UG, Alle Rechte vorbehalten.</em><br><br><strong>Unsere Adresse:</strong><br>Crypto Rebels UG<br>Falbenhennenstraße 2a<br>70180 Stuttgart</td></tr></tbody></table>';
    $message .= '</td></tr></tbody></table></td></tr></table></td></tr></table></td></tr></table>';
    // END FOOTER
    $message .= '</td></tr></table>';
    // END TEMPLATE
    $message .= '</td></tr></table></center>';
    $message .= '</body></html>';

    mail($to, $subject, $message, $headers);
    
    echo json_encode(array('status' => 'success', 'message' => 'Registered successfully and verify your account on your email.'));
    
    mysqli_close($link);
}
?>