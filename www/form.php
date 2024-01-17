<html>
  <head>
    <title>Formular contact</title>
    <link rel="icon" type="image/x-icon" href="img/book.ico">
    <link rel="stylesheet" href="form_style.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="index.html" target="_self">
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
  <body>
    <main>
        <div class="content">
            <h1 id=log_in_header>Formular contact</h1>
            <p>Te rugam să ne transmiți informațiile de mai jos:</p>
            <div id="message">
                <form action="verify_recaptcha_form.php" method="post">
                    <label for="name">Nume:</label>
                        <div class="field">
                            <input type="text" name="name" class="required" aria-required="true" required>
                        </div>
                    <label for="email">Email:</label>
                        <div class="field">			
                            <input type="text" name="email" class="required email" aria-required="true" required>
                        </div>
                    <label for="phone">Telefon:</label>
                        <div class="field">			
                            <input type="text" name="phone" class="required phone" aria-required="true" required>
                        </div>
                    <label for="message">Mesaj:</label>
                        <div class="field">			
                            <textarea name="message"></textarea>			
                        </div>
                    <br>
                    <div class="g-recaptcha" data-sitekey="6LcY3DUpAAAAAGE4s2_iEtQuwYyZ4YdF0e-5Rfid"></div>
                    <input class="btn btn-info" type="submit" name="submit" value="SUBMIT" >
                </form>
            </div>		
        </div>
        <div id="site_button">
            <p><a href="log_in_site.php">Log In</a></p>
        </div>
    </main>
    <footer>
            <p>Site created by <a href="https://github.com/AndryAurelian101/PHP-project.git">Andry101</a>
            </p>
            <p>Student at the Faculty of Mathematics and Informatics Bucharest.
            </p>
        </footer>
</body>
</html>