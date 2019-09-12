<section id="section-contact">
    <h1>Contact</h1>
    <div id="wrapper">
        <div id="form-wrapper">
                <form id="form" method="post" action="<?php echo $GLOBALS['url']; ?>mail.php">
                    <div id="form-header">
                        <input type="text" placeholder="Votre nom" name="name" oninput="check_form()"/>
                        <input type="email" placeholder="Votre adresse mail" name="mail" oninput="check_form()"/>
                    </div>
                    <textarea placeholder="Votre message" name="message" oninput="check_form()"></textarea>
                    <div class="g-recaptcha" data-sitekey="6LdIF7gUAAAAAEcWImHJdRP-JhTJ0X7hQy_yocbJ" data-callback="on_recaptcha_success"></div>
                    <div id="button_wrapper">
                        <button type="submit" class="button" disabled>Envoyer<i class="fas fa-paper-plane"></i></button>
                    </div>
                </form>
        </div>
        <div id="animation">
            <canvas id="contact-animation"></canvas>
        </div>
    </div>
</section>
