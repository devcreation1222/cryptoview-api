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

$email = $request->email;
$password = $request->resetPassword;

$select_sql = "SELECT user_id FROM user WHERE email='" . $email . "' AND status=1";
$sql_result = mysqli_query($link, $select_sql);
$row = mysqli_fetch_array($sql_result,MYSQLI_ASSOC);

if (count($row) > 0) {
    $pwrurl = $api_url . 'user/reset_password.php?id=' . $row["user_id"] . '&password=' . md5($password);

    $to = $email;
    $subject = "Reset Password Request";
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
    $message .= '<h1 style="text-align:center; letter-spacing:normal; line-height:125%; font-weight:bold; font-style:normal; font-size:34px; color:#202020 !important; font-family:Source Sans Pro, Helvetica Neue, Helvetica, Arial, sans-serif; display:block; margin:0; padding:0;"><span style="color:#2f187c"><span style="font-family:source sans pro,helvetica neue,helvetica,arial,sans-serif">FORGOT YOUR PASSWORD?</span></span></h1>';
    $message .= '</td></tr></tbody></table></td></tr></tbody></table>';
    $message .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; min-width:100%; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">';
    $message .= '<tbody class="mcnTextBlockOuter">';
    $message .= '<tr><td valign="top" class="mcnTextBlockInner" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; padding-top:9px; mso-line-height-rule:exactly;">';
    $message .= '<table align="left" border="0" cellpadding="0" cellspacing="0" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; max-width:100%; min-width:100%; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" width="100%" class="mcnTextContentContainer">';
    $message .= '<tbody><tr><td valign="top" class="mcnTextContent" style="color:#202020; font-family:Helvetica; font-size:18px; line-height:150%; text-align:center; word-break:break-word; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; padding: 0px 18px 9px;color: #2F187C;font-family: &quot;Source Sans Pro&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;font-size: 16px;line-height: 150%; mso-line-height-rule:exactly;">';
    $message .= 'No worries! Just click the button below to reset your password.<br>If you have not requested your password to be reset, please ignore this email and your password will remain unchanged.';
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
    $message .= '<a class="mcnButton" title="RESET PASSWORD" href="' . $pwrurl . '" target="_self" style="display:block; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; font-weight: bold;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF; mso-line-height-rule:exactly;">RESET PASSWORD</a>';
    $message .= '</td></tr></tbody></table></td></tr></tbody></table>';
    $message .= '</td></tr></table></td></tr></table></td></tr></table>';
    // END BODY
    $message .= '</td></tr><tr><td align="center" valign="top" style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; mso-line-height-rule:exactly;">';
    // END TEMPLATE
    $message .= '</td></tr></table></center>';
    $message .= '</body></html>';

    mail($to, $subject, $message, $headers);

    echo json_encode(array('status' => 'success', 'message' => 'Sent an email to reset your password successfully.'));
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Please check your email again.'));
}

mysqli_close($link);
?>