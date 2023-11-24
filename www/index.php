<!DOCTYPE HTML>
<html lang="ro"> 
<HTML>
    <head>
        <title>Biblioteca proiect</title>
        <link rel="icon" type="image/x-icon" href="img/book.ico">
        <link rel="stylesheet" href="main_style.css" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <base href="index.html" target="_self">
    </head>
    <body>
        <header>
            <h2> Proiect PHP: </h2>
            <h3> BIBLIOTECA </h3>
        </header>
        <main>
            <article class="article">
                <h3>Prezentare generală</h3>
                <p>
                    Aplicația web va avea ca obiectiv să permită unui utilizator să poată împrumuta printr-un mediu on-line cărțile care sunt valabile în cadrul unei bilbioteci pentru a putea a fi rezervate și ridicate apoi din bilbiotecă!
                </p>
            </article>
            <article class="article" id=description>
                <h3>Descrierea aplicației</h3>
                <p> Site-ul va permite utilizatorilor să își creeze cont ori să se conecteze în acesta dacă este deja creat în vederea de a îți face cereri către bilbiotecă pentru a împrumuta în prealabil cărțile valabile. Pe baza datelor introduse li se vor genera permise de bibliotecă cu care vor face dovada în biblioteca fizică pentru a își ridica comanda.
                </p>
                <p> Utilizatorii vor putea să aleagă dintr-o secțiune grafică cărțile pe care  le doresc să le citescă ca apoi să le aduage în coș pentru a le împrumuta sau să le adauge într-o listă de tip wishlitst pentru a le comanda mai târziu în caz că nu sunt valabile.
                </p>
                <p> De asemenea, site-ul va permite angajațiilor bibliotecii să acceseze și managerieze baza de date a bibliotecii în a updata starea cărților, a adăuga cărți noi sau a șterge cărți care nu mai sunt valabile. Tot acolo vor putea adăuga genuri, autori sau edituri noi pentru cărțile adăugate. 
                </p>
                <p> Pentru un control total al utilizatorior site-ului va exista și un rol de administrator care va avea de asemenea abilitatea de a manageria userii și angajații bibliotecii, precum și alte date legate de baza de date(crearea de noi tabele, ștergerea unor tabele inutile, etc.).
                </p>
                
            </article>
            <article class="article">
                <h3>Bază de date</h3>
                <p>
                    Pentru baza de date voi folosi MySql unde se vor defini următoarele tabele:
                </p>
                <ul>
                    <li><b>Bibliotecari</b>, care va conține datele despre angajații bibliotecii
                    <li><b>Cărți</b>, care va conține datele despre cărțile valabile
                    <li><b>Clienți</b>, care va conține informațiile clienților
                    <li><b>Domenii</b>, care va conține criteriile de domenii ale cărților
                    <li><b>Edituri</b>, care va conține editurile fiecărei cărți
                    <li><b>Împrumuturi</b>, care va conține detalii despre fiecare împrumut făcut și 
                    <li><b>Permise</b>, care va conține permisele fiecărui utilizator
                </ul>
            </article>
            <article>
                <h4>Diagrama conceptuală</h4>
                <img id="plans" src="img/diagrama_conecptuala_biblioteca.png" />
            </article>
            <div id=site_button>
                <a href="log_in_site.php">Intră acum pe site</a>
            </div>
        </main>
        <footer>
            <p>Site created by <a href="https://github.com/AndryAurelian101/PHP-project.git">Andry101</a>
            </p>
            <p>Student at the Faculty of Mathematics and Informatics Bucharest.
            </p>
        </footer>
    </body>
</HTML>