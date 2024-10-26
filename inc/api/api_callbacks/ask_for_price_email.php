<?php

function send_ask_for_price_email($request)
{
    // Retrieve input parameters
    $fullname = $request->get_param('fullname');
    $email = $request->get_param('email');
    $userMessage = $request->get_param('message');
    $productTitle = $request->get_param('productTitle');
    $productLink = $request->get_param('productLink');
    $productId = $request->get_param('productId');

    // Validate input
    $validationErrors = validate_ask_for_price_form_input($fullname, $email, $userMessage);

    // Check for validation errors
    if (!empty($validationErrors)) {
        return ['status' => 'error', 'message' => pll__('Some fields are missing or invalid'), 'errors' => $validationErrors];
    }

    // Prepare and send the email
    $emailSent = send_price_quote_email($fullname, $email, $userMessage, $productTitle, $productLink, $productId);

    // Return the appropriate response based on email sending status
    if ($emailSent) {
        return ['status' => 'success', 'message' => pll__('Your request has been sent successfully.')];
    } else {
        return ['status' => 'error', 'message' => pll__('Failed to send your message. Please try again later.')];
    }
}

function validate_ask_for_price_form_input($fullname, $email, $message)
{
    $errors = [];
    if (empty($fullname)) {
        $errors['fullName'] = pll__('Full Name is required');
    }
    if (empty($email)) {
        $errors['email'] = pll__('Email is required');
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = pll__('Invalid email format');
    }
    if (empty($message)) {
        $errors['message'] = pll__('Message is required');
    }
    return $errors;
}


function send_price_quote_email($fullname, $email, $message, $productTitle, $productLink, $productId)
{
    $to = get_field('contact_form_email', 'option') ? get_field('contact_form_email', 'option') : get_option('admin_email');
    $subject = "Ask for Price Submission - " . $productTitle . " - (ID:" . $productId . ")";
    $headers = ['Content-Type: text/html; charset=UTF-8'];

    $emailBody = "<html><body>";
    $emailBody .= "<h2>Ask for Price Submission</h2> <br>";
    $emailBody .= "<p><strong>Name:</strong> $fullname</p> <br>";
    $emailBody .= "<p><strong>Email:</strong> $email</p> <br>";
    $emailBody .= "<p><strong>Message:</strong> $message</p> <br>";
    $emailBody .= "<p><strong>Product Title:</strong> $productTitle</p> <br>";
    $emailBody .= "<p><strong>Product Link:</strong> $productLink</p> <br>";
    $emailBody .= "<p><strong>Product ID:</strong> $productId</p> <br>";
    $emailBody .= "</body></html>";

    return wp_mail($to, $subject, $emailBody, $headers);
}
