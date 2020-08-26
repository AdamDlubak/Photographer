<!DOCTYPE html>
<html lang="pl">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Fotograf Pajęczno - Zdjęcia legitymacyjne i do dokumentów, odbitki i skany - najwyższa jakość | Ryszard Dłubak</title>

    <meta name="description" content="Duet fotografów ślubnych - Adam i Ryszard Dłubak. Profesjonalna i naturalna fotografia na ślub i wesele: Pajęczno, Działoszyn, Częstochowa, Wieluń, Radomsko.">
    <meta name="keywords" content="fotograf, fotografia, łódzkie, śląskie, ślub, wesele, Pajęczno, Działoszyn, Częstochowa, Wieluń, Radomsko">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://www.sklep.fotodlubak.pl" />
    <meta property="og:title" content="Przepiękna pamiątka z Waszego ślubu w zasięgu ręki" />
    <meta property="og:description" content="Pokażemy Waszą historię naszymi zdjęciami. Wspólnie stworzymy cudowną pamiątkę o której marzycie!" />
    <meta property="og:locale" content="pl_PL" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://sklep.fotodlubak.pl" />
    <meta property="og:image" content="https://i.imgur.com/FQPFnEj.jpg" />
    <meta property="fb:app_id" content="832744753803702" />
    <!-- ______________________ Head ______________________ -->
    <?php require_once("elements/header-scripts.php") ?>
    <link type="text/css" rel="stylesheet" href="./_css/validation.css">
    <script src="_js/SpryValidationTextField.js"></script>
    <script src="_js/SpryValidationTextarea.js"></script>
    <script src="_js/SpryValidationConfirm.js"></script>
    <!-- ____________________ End Head ____________________ -->
</head>

<body>
<div class="site-wrap">
    <!-- ______________________ Header _____________________ -->
    <?php require_once("elements/header.php") ?>
    <!-- ____________________ End Header ___________________ -->

    <!-- __________________ Page Content ___________________ -->
    <?php require_once("sites/kontakt.php") ?>
    <!-- ________________ End Page Content _________________ -->
</div>
    <!-- ____________________ Footer ____________________ -->
    <?php require_once("elements/footer.php") ?>
    <!-- __________________ End Footer __________________ -->
    <!-- ____________________ Footer ____________________ -->
    <?php require_once("elements/footer-scripts.php") ?>
    <script src="./_js/lightbox.js"></script>

    <script>

        

        var form = {
            sendForm: function(url, data, type) {
                $(document).ajaxStart(function() {});
                $(document).ajaxComplete(function() {});
                
                $.ajax({
                    url: url,
                    type: type,
                    data: data,
                    success: function(response) {
                        $('.form-response').addClass("form-response-success");
                        $('.form-response-success').removeClass("form-response");
                        $('.form-response-success').append(response.message);
                        $("#contact-form").addClass("message-sended");
                        $("#send-button").attr("disabled", "disabled");
                    },
                    error: function(response) {
                        $('.form-response').addClass("form-response-faild");
                        $('.form-response-faild').removeClass("form-response");

                        $('.form-response-faild').append(response.responseJSON.message);
                        $("#contact-form").addClass("message-sended");
                    }
                });
            },
            setBinder: function(formName) {
                $(formName).bind('submit', function(event) {
                    if (validatedFields.nameValidation.validate() && validatedFields.emailValidation.validate() && validatedFields.descriptionValidation.validate()) {
                        var data = $(this).serialize();
                        form.sendForm('./_assets/send_mail.php', data, 'POST');
                        $('.form-message').empty();
                    } else {
                        $('.form-message').empty();
                        $('.form-message').append("Przed wysłaniem formularza należy go w poprawnie wypełnić. Pola oznaczone gwiazdką są wymagane.");

                    }
                });
            }
        }

        var validatedFields = {};
        $(document).ready(function() {
            validatedFields.nameValidation = new Spry.Widget.ValidationTextField("name-section", "none", {
                validateOn: ["blur"],
                minChars: 4,
                maxChars: 70
            });
            validatedFields.emailValidation = new Spry.Widget.ValidationTextField("email-section", "email", {
                validateOn: ["blur"]
            });
            validatedFields.descriptionValidation = new Spry.Widget.ValidationTextarea("description-section", {
                validateOn: ["blur"],
                minChars: 10
            });

            form.setBinder('#contact-form');
        });
    </script>

    <!-- __________________ End Footer __________________ -->

</body>

</html>