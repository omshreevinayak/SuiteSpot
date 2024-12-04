<?php

$to_email = "omshreevinayak5@gmail.com";
$subject = "Simple Email Test via PHP";
$body = "Hi, This is a test email sent by a PHP script.";
$headers = "From: 76e070001@smtp-brevo.com";


if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed: " . error_get_last()['message'];
}
