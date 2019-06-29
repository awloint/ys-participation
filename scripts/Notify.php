<?php
/**
 * This script is the Notify Class
 *
 * PHP version 7.2
 *
 * @category Notification_Class
 * @package  Notification_Class
 * @author   Benson Imoh,ST <benson@stbensonimoh.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://stbensonimoh.com
 */
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
/**
 * This is the Notify Class
 *
 * @category Notify_Class
 * @package  Notify_Class
 * @author   Benson Imoh,ST <benson@stbensonimoh.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://stbensonimoh.com
 */
class Notify
{
    /**
     * Constructor Function
     *
     * @param string  $smstoken      The API token for the SMS
     * @param string  $emailHost     The hostname of the email server
     * @param string  $emailUsername The email address
     * @param string  $emailPassword The email Password
     * @param integer $SMTPDebug     If you'd like to see debug information
     * @param boolean $SMTPAuth      If you'd like to authenticate via SMTP
     * @param string  $SMTPSecure    Certificate Type
     * @param integer $Port          Port Number
     */
    public function __construct($smstoken, $emailHost, $emailUsername, $emailPassword, $SMTPDebug, $SMTPAuth, $SMTPSecure, $Port)
    {
        $this->smstoken = $smstoken;
        $this->emailHost = $emailHost;
        $this->emailUsername = $emailUsername;
        $this->emailPassword = $emailPassword;
        $this->SMTPDebug = $SMTPDebug;
        $this->SMTPAuth = $SMTPAuth;
        $this->SMTPSecure = $SMTPSecure;
        $this->Port = $Port;
    }

    /**
     * Send notification via SMS
     *
     * @param string $from  the SMS from identify - not more than 11 characters
     * @param string $body  - The body of the SMS
     * @param string $phone - The Phone number enclosed in Strings
     *
     * @return void
     */
    public function viaSMS($from, $body, $phone)
    {
        // prepare the parameters
        $url = 'https://www.bulksmsnigeria.com/api/v1/sms/create';
        $token = $this->smstoken;
        $myvars = 'api_token=' . $token . '&from=' . $from . '&to='
                    . $phone . '&body=' . $body;
        //start CURL
        // create curl resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $myvars);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_exec($ch);
    }

    /**
     * Sends Email notification via PHPMailer
     *
     * @param string $fromEmail The From Email Address
     * @param string $fromName  The From Name
     * @param string $toEmail   The To Email Address
     * @param string $toName    The To Name
     * @param string $emailBody The Email Body
     * @param string $subject   The Email Subject
     *
     * @return void
     */
    public function viaEmail($fromEmail, $fromName, $toEmail, $toName, $emailBody, $subject)
    {
        $mail = new PHPMailer(true);

        // Server settings
        $mail->SMTPDebug = $this->SMTPDebug;
        $mail->isSMTP();
        $mail->Host = $this->emailHost;
        $mail->SMTPAuth = $this->SMTPAuth;
        $mail->Username = $this->emailUsername;
        $mail->Password = $this->emailPassword;
        $mail->SMTPSecure = $this->SMTPSecure;
        $mail->Port = $this->Port;

        // Send the Email
        $mail->setFrom($fromEmail, $fromName);
        $mail->addAddress($toEmail, $toName);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $emailBody;

        $mail->send();
    }
}
