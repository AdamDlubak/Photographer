<?php

function json_response($code = 200, $message = null)
{
    // clear the old headers
    header_remove();
    // set the actual code
    http_response_code($code);
    // set the header to make sure cache is forced
    header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
    // treat this as json
    header('Content-Type: application/json');
    $status = array(
        200 => '200 OK',
        400 => '400 Bad Request',
        422 => 'Unprocessable Entity',
        500 => '500 Internal Server Error'
        );
    // ok, validation error, or failure
    header('Status: '.$status[$code]);
    // return the encoded json
    return json_encode(array(
        'status' => $code < 300, // success or not?
        'message' => $message
        ));
}

header('Content-Type: text/html; charset=UTF-8');
$recipientMail = 'fotodlubak@gmail.com'; // twój adres e-mail
if ($_POST['verify']) {
 
            // filtrowanie treści wprowadzonych przez użytkownika
            $name = htmlspecialchars(stripslashes(strip_tags(trim($_POST["c_name"]))), ENT_QUOTES);
            $email = htmlspecialchars(stripslashes(strip_tags(trim($_POST["c_email"]))), ENT_QUOTES);
            $phone = htmlspecialchars(stripslashes(strip_tags(trim($_POST["c_phone"]))), ENT_QUOTES);
            $description = htmlspecialchars(stripslashes(strip_tags(trim($_POST["c_message"]))), ENT_QUOTES);

            // system sprawdza czy wszystkie pola zostały wypełnione
            if (!$name || !$email || !$description) {
                $error = true;
                echo json_response(400, 'Niestety wysłanie wiadomości nie powiodło się...<br />Jedno z pól formularza nie spełniało wymagań. Spróbuj ponownie...');
            }
            else {
                // niezbędne nagłówki do wyświetlania wiadomości HTML
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
 
                // opcjonalne nagłówki
                $headers .= 'From: <'.$email.'>' . "\r\n";
                $headers .= 'Cc: <'.$recipientMail.'>' . "\r\n";
 
                // tytuł wiadomości
                $topic = 'Wiadomość z formularza kontaktowego Sklep.FotoDłubak.pl';
 
                // całkowita treść wiadomości
                $description = nl2br($description);
                $descriptionContent = <<< MAIL
                <html>
                    <p><strong>Imię i nazwisko:</strong> $name</p>
					<p><strong>Adres E-mail:</strong> $email</p>
					<p><strong>Numer telefonu:</strong> $phone</p>
                    <p><strong>Treść wiadomości:</strong> <br />$description</p>
                </html>
MAIL;


 
                // komunikat potwierdzający wysłanie wiadomości bądź nie
                if (mail('<'.$recipientMail.'>', $topic, $descriptionContent, $headers)) {
                    echo json_response(200, 'Wiadomość została wysłana poprawnie!<br />Na każdą wiadomość staramy się odpowiadać w czasie nie dłuższym niż 24h.<br />');
                } 
				 else {
                    echo json_response(400, 'Niestety wysłanie wiadomości nie powiodło się...<br />Przepraszamy za utrudnienia i prosimy skontaktować się z nami w inny sposób (będziemy również wdzięczni za informację o problemach z formularzem).');
                }
            }
        }
		
 ?>