<?php

function send_contact_form_email($request)
{
    // Retrieve input parameters
    $fullname = $request->get_param('fullname');
    $email = $request->get_param('email');
    $userMessage = $request->get_param('message');

    // Validate input
    $validationErrors = validate_contact_form_input($fullname, $email, $userMessage);

    // Check for validation errors
    if (!empty($validationErrors)) {
        return ['status' => 'error', 'message' => pll__('Some fields are missing or invalid'), 'errors' => $validationErrors];
    }

    // Prepare and send the email
    $emailSent = send_email($fullname, $email, $userMessage);

    // Return the appropriate response based on email sending status
    if ($emailSent) {
        return ['status' => 'success', 'message' => pll__('Your message has been sent successfully.')];
    } else {
        return ['status' => 'error', 'message' => pll__('Failed to send your message. Please try again later.')];
    }
}

function validate_contact_form_input($fullname, $email, $message)
{
    $errors = [];
    if (empty($fullname)) {
        $errors['fullname'] = pll__('Full Name is required');
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


function send_email($fullname, $email, $message)
{
    $to = get_field('contact_form_email', 'option') ? get_field('contact_form_email', 'option') : get_option('admin_email');
    $subject = "Contact Form Submission - " . get_bloginfo('name');
    $headers = ['Content-Type: text/html; charset=UTF-8'];

    $emailBody = "<html><body>";
    $emailBody .= "<h2>Contact Form Submission</h2>";
    $emailBody .= "<p><strong>Name:</strong> $fullname</p>";
    $emailBody .= "<p><strong>Email:</strong> $email</p>";
    $emailBody .= "<p><strong>Message:</strong> $message</p>";
    $emailBody .= "</body></html>";

    return wp_mail($to, $subject, $emailBody, $headers);
}
