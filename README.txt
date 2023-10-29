Informazioni fornite dal professore per il progetto ECOMMERCE CON PHP:
        Devono essere prodotte le seguenti pagine:

        • Pagina Home
        • Pagina per effettuare il login
        • Pagina per iscriversi
        • Pagina della ricerca
        • Pagina del prodotto
        • Pagina del carrello
        • Pagina di riepilogo order
        • Pagina di avvenuto acquisto
        • Pagina per visualizzare la cronologia degli ordini

        Consegna

        Dovrà essere consegnato un archivio compresso contente 3 cartelle principali:

        • STEP 1 - HTML + CSS. Dovranno essere generate staticamente le 8 pagine
        di cui sopra (Home, ricerca, prodotto, carrello, riepilogo order, avvenuto
        acquisto, iscrizione, cronologia ordini). Queste pagine hanno lo scopo di
        trainare la creazione delle pagine dinamiche dello step 3
        • STEP 2 – DEFINIZIONE DELLE TABELLE. Dovranno essere definite
        almeno le seguenti tabelle: Utenti, supplier, Tipo Prodotto, category,
        Prodotto, Ordine, Ordine-item. Dovrà essere definito il codice SQL per la loro
        creazione. Per semplificare la correzione del progetto, è richiesto che il name
        del database sia PABSBDEC.
        • STEP 3 – DEFINIZIONE DELLE PAGINE DINAMICHE. Dovranno essere
        riviste le pagine HTML dello step 1 per renderle dinamiche, integrandole al
        database definito allo step 2. Ogni pagina sarà quindi convertita in un file
        .php che si connetterà al database e produrrà il codice HTML dinamicamente.
        Per l'accesso al database è richiesto l'uso delle classi PDO. Il codice PHP deve
        essere separato il più possibile dal codice HTML, secondo il modello MVC visto
        a lezione. Per motivi di sicurezza il codice JavaScript verrà eliminato e non
        verrà valutato.

Struttura Progetto

   front-end/
        assets/
            ...
        public/
            ...
        user/
            ...
        index.php

    back-end/
        classes/
            ...
        bd_images/
            ...
        index.php
        db.sql

    configurations/
        config.php
        functions.php
        globals.php
        index.php
        init.php

LOGO LAMPEO:
    https://icons8.it/icons/set/lamp


Connessione db con PHP --> https://www.w3schools.com/php/php_mysql_connect.asp

Immagini --> Api journey --> https://apijourney.com/it

Repository GITHUB --> https://github.com/Dambrous/lampeo (progetto pubblico in sviluppo)


Setup necessario per la corretta visualizzazione dell'ecommerce:
- scaricare XAMPP e avviare server Apache e MySql
- clonare il repository dentro la cartella "..\xampp\htdocs" di XAMPP
- copiare le query .sql presente nel file "lampeo\back-end\db.sql" dentro lo spazio .sql presente in "localhost/phpmyadmin"
- modificare i parametri globali presenti nel file "inc\config.php" per il corretto funzionamento


Nel database ci saranno utenti(tabella --> res_user) di 2 tipi:
- utente normali --> senza possibilità di aggiunta prodotti
- utente amministratore --> con possibilità di aggiunta prodotti

Per visualizzare tutte le funzionalità accedere tramite utente amministratore 