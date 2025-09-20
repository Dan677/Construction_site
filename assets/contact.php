<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $number = trim($_POST["number"]);
    $message = trim($_POST["message"]);

    if (empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Te rog, completează toate câmpurile.";
        exit;
    }

    $recipient = "matei.gabor030@gmail.com";
    $subject = "Mesaj nou de la " . $name;
    $email_content = "Nume: " . $name . "\n";
    $email_content .= "Email: " . $email . "\n\n";
    $email_content .= "Numar de telefon: " . $number . "\n\n";
    $email_content .= "Mesaj:\n" . $message . "\n";
    $email_headers = "From: " . $name . " <" . $email . ">";

    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Mesajul a fost trimis cu succes!";
    } else {
        http_response_code(500);
        echo "Oops! A apărut o eroare și mesajul tău nu a putut fi trimis.";
    }
} else {
    http_response_code(403);
    echo "A apărut o problemă cu trimiterea, te rog încearcă din nou.";
}
?>