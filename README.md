# Coupon-World
Progetto TW 2017

# Specifiche di Progetto

# Obiettivo

Obiettivo del progetto è la realizzazione di un sito web per la pubblicizzazione di offerte promozionali (sconti,
tre-per-due, ...) di prodotti e servizi e per l’emissione dei relativi coupon.
Il sito è gestito da una società che crea una vetrina per le aziende (produttrici di beni e/o di servizi) le quali
possono pubblicare le loro offerte riservate agli utenti registrati al sito. Questi ultimi possono visualizzare
(anche come risultato di una ricerca) le offerte di interesse ed acquisire un coupon che abilita all’acquisto della
promozione presso i negozi/centri delle aziende. Il sito non implementa alcuna attività di e-commerce.

# Specifiche
L’applicazione Web da realizzare permetterà:
1. la visualizzazione di informazioni generali sul sito e sui servizi offerti: modalità di accesso, funzionalità
implementate, informazioni sulle aziende (nome, localizzazione, logo, ...), FAQ, …;
2. la registrazione al sito degli utenti (cioè coloro che avranno accesso alle offerte promozionali), che
dovranno indicare i dati anagrafici (nome, cognome, genere, età, …), i riferimenti per eventuali contatti
(e-mail, telefono) e l’account scelto (username e password).
3. la visualizzazione delle offerte promozionali, organizzate sia per tipologia del prodotto/servizio oggetto
della promozione che per azienda;
4. la descrizione dettagliata delle offerte (oggetto dell’offerta, modalità, tempi e luoghi di fruizione, ...)
5. l’acquisizione da parte dell’utente registrato, una volta selezionata l’offerta di interesse, di un coupon
da presentare al punto vendita dell’offerente per usufruire della promozione;
6. la gestione (inserimento, modifica, cancellazione) delle promozioni pubblicizzate;
7. la gestione (inserimento, modifica, cancellazione) delle aziende (cioè i soggetti che offrono le
promozioni), con tutte le informazioni ad esse associate (ragione sociale, tipologia, logo aziendale,
descrizione dell’azienda, localizzazione, ...);
8. la gestione (inserimento, modifica, cancellazione) di tutti gli utenti del sito (coloro che possono
acquisire i coupon ed i membri dello staff della società che gestisce il sito), delle tipologie di
prodotto/servizio per cui vengono emessi i coupon e delle FAQ.

Ad un maggior livello di dettaglio, si tenga anche conto delle seguenti specifiche funzionali:
• si dia a tutti gli utenti la possibilità di effettuare la ricerca sulle offerte, indicando la tipologia e/o uno o
più termini che compaiono nella descrizione dell’offerta. Il risultato sia un elenco delle offerte
individuate, tra le quali l’utente registrato possa selezionare quella di cui vuole usufruire per acquisire
il relativo coupon;
• si dia la possibilità, a ciascun utente, di acquisire un solo coupon per ciascuna promozione;
• il coupon sia generato come una pagina Web (stampabile) che contiene la descrizione del prodotto
offerto, l’identità dell’utente per cui è stato emesso, le modalità di fruizione ed un codice univoco
diverso per ciascun coupon;
• le tipologie di prodotto/servizio per cui il sito emette coupon siano definite dagli sviluppatori del sito; a
titolo di esempio e senza pretesa di esaustività si citano: per i prodotti: alimentari, tecnologici, etc.;
per i servizi: alla persona, ricreativi, etc.)
• come username di ciascun utente registrato, si utilizzi una stringa e non un indirizzo di e-mail;
Relativamente all’accesso all’applicazione, si definisca una policy diversificata articolata nei seguenti livelli:
§ Livello 0: area pubblica del sito, cioè disponibile con le informazioni fornite a tutti coloro che accedono
al sito (quindi, anche agli utenti definiti nei livelli successivi). A questo livello si associ:
§ la visualizzazione delle informazioni generali sul sito, sulle aziende che offrono promozioni e la
procedura di registrazione degli utenti;
§ la visualizzazione delle offerte promozionali e la relativa funzionalità di ricerca, senza la
possibilità di emissione dei coupon.
• Livello 1: area riservata agli utenti registrati al sito, i quali possono:
§ modificare i propri dati e la password di accesso;
§ acquisite coupon per le promozioni.
• Livello 2: area riservata ai membri dello staff, che possono:
§ modificare il proprio profilo e la password di accesso;
§ gestire (creare/modificare/cancellare) le promozioni.
• Livello 3: area ad accesso esclusivo dell’amministratore del sito che consenta:
§ la gestione (creazione/modifica/cancellazione) delle aziende (i soggetti che offrono le
promozioni);
§ la gestione (modifica/cancellazione) degli utenti del sito, membri dello staff inclusi (per questi
ultimi va prevista anche la creazione);
§ la gestione (creazione/modifica/cancellazione) delle tipologie di prodotto/servizio per cui
vengono emessi i coupon;
§ la generazione delle statistiche sull’attività del sito:
§ numero totale di coupon emessi;
©2017 Università Politecnica delle Marche – Corso di Tecnologie WEB
§ selezionando una promozione (sia attiva che scaduta), il numero di coupon emessi
per essa;
§ selezionando un cliente, il numero di coupon emessi a suo nome.
§ l’aggiornamento delle FAQ.
#Funzionalità opzionali

L’implementazione delle funzionalità descritte nel seguito non è obbligatoria, ma se realizzata, determina un
incremento fino ad un massimo totale di 3 punti del punteggio associato alla valutazione del progetto (solo
se, al netto del contributo delle funzionalità opzionali, questo è ≥ 18):
• ripartizione gestione aziende tra i membri dello staff. Si implementi una funzionalità, in capo
all’amministratore, di assegnazione a ciascun componente dello staff di una o più aziende delle quali
può gestire in modo esclusivo le promozioni;
• gestione di promozioni abbinate. Si implementi una funzionalità che consenta allo staff di inserire
promozioni abbinate, che accorpano, cioè, più promozioni. In questo caso l’utente registrato che sceglie
questa offerta riceve un coupon che gli consente di acquisire tutti i prodotti/servizi delle singole
promozioni con uno sconto ulteriore (in percentuale) rispetto alla somma del costo delle singole
promozioni. Sia dato all’amministratore il compito di definire il membro (unico) dello staff che deve
gestire le promozioni abbinate, il quale sarà anche in grado di gestire le promozioni singole di tutte le
aziende.
