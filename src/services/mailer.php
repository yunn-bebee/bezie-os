<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor\autoload.php'; // Adjust the path as needed

class Mailer {
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->setup();
    }

    private function setup() {
        //Server settings
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.example.com'; // Specify main and backup SMTP servers
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'your_email@example.com'; // SMTP username
        $this->mail->Password = 'your_password'; // SMTP password
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `ssl` also accepted
        $this->mail->Port = 587; // TCP port to connect to
    }

    public function sendMail($to, $subject, $body) {
        try {
            //Recipients
            $this->mail->setFrom('your_email@example.com', 'Mailer');
            $this->mail->addAddress($to); // Add a recipient

            // Content
            $this->mail->isHTML(true); // Set email format to HTML
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;

            $this->mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }
}
