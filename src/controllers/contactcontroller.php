<?php
require_once 'src/model/Contact.php';
require_once 'src\services\mailer.php';

class ContactController
{
    public function submit()
    {
        // Get database connection
        $conn = getDbConnection();

        // Create Contact object
        $contact = new Contact($conn);

        // Populate Contact object with form data
        $contact->name = $_POST['name'];
        $contact->email = $_POST['email'];
        $contact->message = $_POST['message'];

        // Create the contact record in the database
        if ($contact->create()) {
            // Send notification email
            $mailer = new Mailer();
            $subject = 'New Contact Form Submission';
            $body = "Name: {$contact->name}<br>Email: {$contact->email}<br>Message: {$contact->message}";

            if ($mailer->sendMail('yunn.beebee@outlook.com', $subject, $body)) {
                // Set a cookie with success message
                setcookie('contact_success_message', 'Message created successfully', time() + 3600, '/');

                // Redirect to a thank you page after processing
                header('Location: /contact');
                exit;
            } else {
                echo "Unable to send notification email.";
            }
        } else {
            echo "Unable to submit contact form.";
        }
    }
}
?>
