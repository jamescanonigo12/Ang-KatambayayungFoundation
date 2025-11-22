<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = $_POST['amount'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $donorMessage = $_POST['message'] ?? '';

    // Email details
    $to = 'jamescanonigo120@gmail.com';
    $subject = 'New Donation Received';
    $emailMessage = "Donation Details:\n\n" .
                    "Name: $name\n" .
                    "Email: $email\n" .
                    "Amount: $$amount\n";
    if (!empty($donorMessage)) {
        $emailMessage .= "Message: $donorMessage\n\n";
    }
    $emailMessage .= "Thank you for your generous donation!";
    $headers = "From: $email\r\n" .
               "Reply-To: $email\r\n" .
               "X-Mailer: PHP/" . phpversion();

    // Send email
    if (mail($to, $subject, $emailMessage, $headers)) {
        echo "<h2>Thank you for your donation!</h2>";
        echo "<p>We have received your donation of $$amount. A confirmation email has been sent.</p>";
        echo "<p><a href='index.php'>Return to Home</a></p>";
    } else {
        echo "<h2>Sorry, there was an error processing your donation.</h2>";
        echo "<p>Please try again or contact us directly.</p>";
    }
} else {
    header('Location: donate.php');
    exit;
}
?>