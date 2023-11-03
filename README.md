# PHP-project
Proiect PHP:
BIBLIOTECA

Prezentare generală
Aplicația web va avea ca obiectiv să permită unui utilizator să poată împrumuta printr-un mediu on-line cărțile care sunt valabile în cadrul unei bilbioteci pentru a putea a fi rezervate și ridicate apoi din bilbiotecă!

Descrierea aplicației
Site-ul va permite utilizatorilor să își creeze cont ori să se conecteze în acesta dacă este deja creat în vederea de a îți face cereri către bilbiotecă pentru a împrumuta în prealabil cărțile valabile. Pe baza datelor introduse li se vor genera permise de bibliotecă cu care vor face dovada în biblioteca fizică pentru a își ridica comanda.

Utilizatorii vor putea să aleagă dintr-o secțiune grafică cărțile pe care le doresc să le citescă ca apoi să le aduage în coș pentru a le împrumuta sau să le adauge într-o listă de tip wishlitst pentru a le comanda mai târziu în caz că nu sunt valabile.

De asemenea, site-ul va permite angajațiilor bibliotecii să acceseze și managerieze baza de date a bibliotecii în a updata starea cărților, a adăuga cărți noi sau a șterge cărți care nu mai sunt valabile. Tot acolo vor putea adăuga genuri, autori sau edituri noi pentru cărțile adăugate.

Pentru un control total al utilizatorior site-ului va exista și un rol de administrator care va avea de asemenea abilitatea de a manageria userii și angajații bibliotecii, precum și alte date legate de baza de date(crearea de noi tabele, ștergerea unor tabele inutile, etc.).

Bază de date
Pentru baza de date voi folosi MySql unde se vor defini următoarele tabele:

Bibliotecari, care va conține datele despre angajații bibliotecii
Cărți, care va conține datele despre cărțile valabile
Clienți, care va conține informațiile clienților
Domenii, care va conține criteriile de domenii ale cărților
Edituri, care va conține editurile fiecărei cărți
Împrumuturi, care va conține detalii despre fiecare împrumut făcut și
Permise, care va conține permisele fiecărui utilizator
