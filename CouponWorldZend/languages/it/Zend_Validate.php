<?php
return array(
 // Zend_Validate_Alnum
 "Invalid type given, value should be float, string, or integer" => "Tipo di dato non valido, il valore deve essere float, string o integer.",
 "'%value%' contains characters which are non alphabetic and no digits" => "'%value%' contiene caratteri non alfabetici o cifre",
 "'%value%' is an empty string" => "'%value%' è una stringa vuota",

 // Zend_Validate_Alpha
 "Invalid type given, value should be a string" => "Tipo di dato non valido, il valore deve essere una stringa",
 "'%value%' contains non alphabetic characters" => "'%value%' contiene caratteri non alfabetici",
 "'%value%' is an empty string" => "'%value%' è una stringa vuota",

 // Zend_Validate_Barcode
 "'%value%' failed checksum validation" => "'%value%' Controllo checksum fallito",
 "'%value%' contains invalid characters" => "'%value%' contiene caratteri non validi",
 "'%value%' should have a length of %length% characters" => "'%value%' deve avere una lunghezza di %length% caratteri",
 "Invalid type given, value should be string" => "Tipo di dato non valido, il valore deve essere una stringa",

 // Zend_Validate_Between
 "'%value%' is not between '%min%' and '%max%', inclusively" => "'%value%' non rientra nei limiti '%min' e '%max%'",
 "'%value%' is not strictly between '%min%' and '%max%'" => "'%value%' non è strettamente nei limiti tra '%min%' e '%max'",

 // Zend_Validate_Callback
 "'%value%' is not valid" => "'%value%' non valido",
 "Failure within the callback, exception returned" => "Callback fallito, eccezione generata",

 // Zend_Validate_Ccnum
 "'%value%' must contain between 13 and 19 digits" => "'%value%' deve contenere dalle 13 alle 19 cifre",
 "Luhn algorithm (mod-10 checksum) failed on '%value%'" => "L'algorimo Luhn (mod-10 checksum) è fallito in '%value%'",

 // Zend_Validate_CreditCard
 "Luhn algorithm (mod-10 checksum) failed on '%value%'" => "L'algoritmo Luhn (mod-10 checksum) è fallito in '%value%'",
 "'%value%' must contain only digits" => "'%value%' deve contere solo cifre",
 "Invalid type given, value should be a string" => "Tipo di dato non valido, il avlore deve essere una stringa",
 "'%value%' contains an invalid amount of digits" => "'%value%' contiene un numero invalido di cifre",
 "'%value%' is not from an allowed institute" => "'%value%' non è consentito da un istituto",
 "Validation of '%value%' has been failed by the service" => "La convalida di '%value%' è fallita",
 "The service returned a failure while validating '%value%'" => "Il servizio ha fallito nella convalida '%value%'",

 // Zend_Validate_Date
 "Invalid type given, value should be string, integer, array or Zend_Date" => "Tipo di dato non valido, il valore deve essere una stringa, un intero, un array o un istanza di Zend_Date",
 "'%value%' does not appear to be a valid date" => "'%value%' sembra non essere una data valida",
 "'%value%' does not fit the date format '%format%'" => "'%value%' non corrisponde nel formato consentito '%format%'",

 //Zend_Validate_Password
 "The two given tokens do not match" => "Le due password non corrispondono",
 
 // Zend_Validate_Db_Abstract
 "No record matching %value% was found" => "Non è stato trovato nessun record corrispondente a '%value%'",
 "A record matching %value% was found" => "Un record è stato trovato '%value%'",

 // Zend_Validate_Digits
 "Invalid type given, value should be string, integer or float" => "Tipo di dato non valido, il valore deve essere una stringa, un intero o un float",
 "'%value%' contains not only digit characters" => "'%value%' contiene caratteri non numerici",
 "'%value%' is an empty string" => "'%value%' è una stringa vuota",

 // Zend_Validate_EmailAddress
 "Invalid type given, value should be a string" => "Tipo di dato non valido, il valore deve essere una stringa",
 "'%value%' is no valid email address in the basic format local-part@hostname" => "'%value%' non è un indirizzo email valido nel formato local-part@hostname",
 "'%hostname%' is not a valid hostname for email address '%value%'" => "'%hostname%' è un hostname non valido per l'indirizzo email '%value%'",
 "'%hostname%' does not appear to have a valid MX record for the email address '%value%'" => "'%hostname%' non ha un MX record per l'indirizzo email '%value%'",
 "'%hostname%' is not in a routable network segment. The email address '%value%' should not be resolved from public network." => "'%hostname%' non è un network raggiungibile.",
 "'%localPart%' can not be matched against dot-atom format" => "'%localPart% non corrisponde con il formato dot-atom",
 "'%localPart%' can not be matched against quoted-string format" => "'%localPart%' non corrisponde con il formato quoted-string",
 "'%localPart%' is no valid local part for email address '%value%'" => "'%localPart%' non è una parte locale valida per l'indirizzo email '%value%'",
 "'%value%' exceeds the allowed length" => "'%value%' eccede nella lunghezza consentita",

 // Zend_Validate_File_Count
 "Too many files, maximum '%max%' are allowed but '%count%' are given" => "Limite massimo file raggiunto, il limite massimo è di '%max%'. Sono stati passati '%count%' files",
 "Too few files, minimum '%min%' are expected but '%count%' are given" => "Limite minimo file raggiunto, il limite minimo è di '%min%'. Sono stati passati '%count%' files",

 // Zend_Validate_File_Crc32
 "File '%value%' does not match the given crc32 hashes" => "Il file '%value%' non corrisponde con gli hash crc32 forniti",
 "A crc32 hash could not be evaluated for the given file" => "L'hash crc32 non può essere valutata per il tipo di file fornito",
 "File '%value%' could not be found" => "Il file '%value%' non è stato trovato",

 // Zend_Validate_File_ExcludeExtension
 "File '%value%' has a false extension" => "Il file '%value%' ha un estensione sbagliata",
 "File '%value%' could not be found" => "Il file '%value%' non è stato trovato",

 // Zend_Validate_File_ExcludeMimeType
 "File '%value%' has a false mimetype of '%type%'" => "Il file '%value%' ha un mimetype errato: '%type%'",
 "The mimetype of file '%value%' could not be detected" => "Non è stato possibile determinare il mimetype del file '%value%'",
 "File '%value%' can not be read" => "Non è stato possibile leggere il file '%value%'",

 // Zend_Validate_File_Exists
 "File '%value%' does not exist" => "Il file '%value%' non esiste",

 // Zend_Validate_File_Extension
 "File '%value%' has a false extension" => "Il file '%value%' ha un estensione errata",
 "File '%value%' could not be found" => "Il file '%value%' non è stato trovato",

 // Zend_Validate_File_FilesSize
 "All files in sum should have a maximum size of '%max%' but '%size%' were detected" => "Tutti i file devono avere una grandezza massima di '%max%'. La grandezza fornita è di '%size%'",
 "All files in sum should have a minimum size of '%min%' but '%size%' were detected" => "Tutti i file devono avere una grandezza minima di '%min%'. La grandezza fornita è di '%size%",
 "One or more files can not be read" => "Uno o piè file non possono essere letti",

 // Zend_Validate_File_Hash
 "File '%value%' does not match the given hashes" => "Il file '%value%' non corrisponde con l'hash fornito",
 "A hash could not be evaluated for the given file" => "L'hash non può essere valutato per il tipo di file fornito",
 "File '%value%' could not be found" => "Il file '%value%' non è stato trovato",

 // Zend_Validate_File_ImageSize
 "Maximum allowed width for image '%value%' should be '%maxwidth%' but '%width%' detected" => "Limite larghezza massima raggiunta per l'immagine '%value%' di larghezza '%width%', il limite massimo è di '%maxwidth%'",
 "Minimum expected width for image '%value%' should be '%minwidth%' but '%width%' detected" => "Larghezza minima non raggiunta per l'immagine '%value%' di larghezza '%width%', il limite minimo è di '%minwidth%'",
 "Maximum allowed height for image '%value%' should be '%maxheight%' but '%height%' detected" => "Limite altezza massima raggiunta per l'immagine '%value%' di larghezza '%height%', il limite massimo è di '%maxheight%'",
 "Minimum expected height for image '%value%' should be '%minheight%' but '%height%' detected" => "Limite altezza minima non raggiunta per l'immagine '%value%' di larghezza '%height%', il limite minimo è di '%minheight%'",
 "The size of image '%value%' could not be detected" => "La grandezza dell'immagine '%value%' non può essere determinata",
 "File '%value%' can not be read" => "Il file '%value%' non può essere letto",

 // Zend_Validate_File_IsCompressed
 "File '%value%' is not compressed, '%type%' detected" => "Il file '%value%' non è compresso, tipo di file '%type%' rilevato ",
 "The mimetype of file '%value%' could not be detected" => "Il mimetype del file '%value%' non può essere rilevato",
 "File '%value%' can not be read" => "Il file '%value%' non può essere letto",

 // Zend_Validate_File_IsImage
 "File '%value%' is no image, '%type%' detected" => "Il file '%value%' non è un'immagine, estensione '%type%' rilevata.",
 "The mimetype of file '%value%' could not been detected" => "Il mimetype del file '%value%' non è stato trovato",
 "File '%value%' can not be read" => "Il file '%value%' non può essere letto",

 // Zend_Validate_File_Md5
 "File '%value%' does not match the given md5 hashes" => "Il file '%value%' non corrisponde con gli hash md5 forniti",
 "A md5 hash could not be evaluated for the given file" => "L'hash md5 non può essere valutato per il tipo di file fornito",
 "File '%value%' could not be found" => "Il file '%value%' non è stato trovato",

 // Zend_Validate_File_MimeType
 "File '%value%' has a false mimetype of '%type%'" => "Il file '%value%' ha un mimetype errato. '%type%'",
 "The mimetype of file '%value%' could not be detected" => "Non è stato possibile determinare il mimetype del file '%value%'",
 "File '%value%' can not be read" => "Il file '%value%' non può essere letto",

 // Zend_Validate_File_NotExists
 "File '%value%' exists" => "Il file '%value%' esiste",

 // Zend_Validate_File_Sha1
 "File '%value%' does not match the given sha1 hashes" => "Il file '%value%' non corrisponde con gli hashes sha1 forniti",
 "A sha1 hash could not be evaluated for the given file" => "L'hash sha1 non può essere valutato per il file fornito",
 "File '%value%' could not be found" => "Il file '%value%' non è stato trovato",

 // Zend_Validate_File_Size
 "Maximum allowed size for file '%value%' is '%max%' but '%size%' detected" => "Limite di grandezza massima raggiunto per il file '%value%'. Il limite massimo è di '%max%', il file è '%size%'",
 "Minimum expected size for file '%value%' is '%min%' but '%size%' detected" => "Limite di grandezza minima raggiunto per il file '%value%'. Il limite minimo è di '%max%', il file è '%size%'",
 "File '%value%' could not be found" => "Il file '%value%' non è stato trovato",

 // Zend_Validate_File_Upload
 "File '%value%' exceeds the defined ini size" => "Il file '%value%' supera la dimensione massima",
 "File '%value%' exceeds the defined form size" => "Il file '%value%' supera la dimensione massima",
 "File '%value%' was only partially uploaded" => "Il file '%value%' è stato caricato solo in parte",
 "File '%value%' was not uploaded" => "Il file '%value%' non è stato caricato",
 "No temporary directory was found for file '%value%'" => "Nessuna directory temporanea trovata per il file '%value%'",
 "File '%value%' can't be written" => "Il file '%value%' non può essere scritto",
 "A PHP extension returned an error while uploading the file '%value%'" => "Un estensione PHP ha restituito un errore durante l'upload del file '%value%'",
 "File '%value%' was illegally uploaded. This could be a possible attack" => "Il file '%value%' è stato caricato illegalmente. Questo potrebbe essere un attacco",
 "File '%value%' was not found" => "Il file '%value%' non è stato trovato",
 "Unknown error while uploading file '%value%'" => "Errore sconosciuto durante l'upload del file '%value%'",

 // Zend_Validate_File_WordCount
 "Too much words, maximum '%max%' are allowed but '%count%' were counted" => "Troppe parole, il limite massimo è di '%max%', fornite '%count%' parole",
 "Too less words, minimum '%min%' are expected but '%count%' were counted" => "Troppe poche parole, il limite minimo è di '%min%', fornite '%count%' parole",
 "File '%value%' could not be found" => "Il file '%value%' non è stato trovato",

 // Zend_Validate_Float
 "Invalid type given, value should be float, string, or integer" => "Tipo di dato non valido, il valore deve essere un float, una stringa o un intero",
 "'%value%' does not appear to be a float" => "'%value%' non sembra essere un tipo di dato float",

 // Zend_Validate_GreaterThan
 "'%value%' is not greater than '%min%'" => "'%value%' non è piè grande di '%min%'",

 // Zend_Validate_Hex
 "Invalid type given, value should be a string" => "Tipo di dato non valido, il valore deve essere una stringa",
 "'%value%' has not only hexadecimal digit characters" => "'%value%' contiene caratteri non esadecimali",

 // Zend_Validate_Hostname
 "Invalid type given, value should be a string" => "Tipo di dato non valido, il valore deve essere una stringa",
 "'%value%' appears to be an IP address, but IP addresses are not allowed" => "'%value%' è un indirizzo IP non consentito",
 "'%value%' appears to be a DNS hostname but cannot match TLD against known list" => "'%value%' sembra un DNS Hostname ma il dominio sembra essere non corretto",
 "'%value%' appears to be a DNS hostname but contains a dash in an invalid position" => "'%value%' sembra un DNS Hostname ma contiene un dash (trattino) in una posizione non valida",
 "'%value%' appears to be a DNS hostname but cannot match against hostname schema for TLD '%tld%'" => "'%value%' sembra un DNS Hostname ma il dominio sembra essere non corretto",
 "'%value%' appears to be a DNS hostname but cannot extract TLD part" => "'%value%' sembra un DNS Hostname ma non è stato possibile estrarre la parte TLD",
 "'%value%' does not match the expected structure for a DNS hostname" => "'%value%' non corrisponde con la struttura di un DNS Hostname",
 "'%value%' does not appear to be a valid local network name" => "'%value%' non è un indirizzo LAN valido",
 "'%value%' appears to be a local network name but local network names are not allowed" => "'%value%' è un indirizzo LAN non consentito",
 "'%value%' appears to be a DNS hostname but the given punycode notation cannot be decoded" => "'%value%' sembra essere un DNS Hostname ma non è stato possibile decodificare il punycode",

 // Zend_Validate_Iban
 "Unknown country within the IBAN '%value%'" => "Nazione sconosciuta fornita nel codice IBAN",
 "'%value%' has a false IBAN format" => "'%value%' ha un formato IBAN non valido",
 "'%value%' has failed the IBAN check" => "'%value%' ha fallito il check dell'IBAN",

 // Zend_Validate_Identical
 "The token '%token%' does not match the given token '%value%'" => "Il token '%token%' non corrisponde con il token inserito '%value%'",
 "No token was provided to match against" => "Nessun token fornito per il controllo",

 // Zend_Validate_InArray
 "'%value%' was not found in the haystack" => "'%value%' non è stato trovato nell'haystack",

 // Zend_Validate_Int
 "Invalid type given, value should be string or integer" => "Tipo di dato non valido, il valore deve essere una stringa o un intero",
 "'%value%' does not appear to be an integer" => "'%value%' non sembra essere un intero",

 // Zend_Validate_Ip
 "Invalid type given, value should be a string" => "Tipo di dato non valido, il valore deve essere una stringa",
 "'%value%' does not appear to be a valid IP address" => "'%value%' non è un indirizzo IP valido",

 // Zend_Validate_Isbn
 "'%value%' is no valid ISBN number" => "'%value%' non è un numero ISBN valido",

 // Zend_Validate_LessThan
 "'%value%' is not less than '%max%'" => "'%value%' non è minore di '%max%'",

 // Zend_Validate_NotEmpty
 "Invalid type given, value should be float, string, array, boolean or integer" => "Tipo di dato non valido, il valore deve essere float, stringa, array, bool o intero",
 "Value is required and can't be empty" => "Questo campo non può essere vuoto",

 // Zend_Validate_PostCode
 "Invalid type given, value should be string or integer" => "Tipo di dato non valido, il valore deve essere una stringa o un intero",
 "'%value%' does not appear to be an postal code" => "'%value%' non sembra essere un indirizzo postale",

 // Zend_Validate_Regex
 "Invalid type given, value should be string, integer or float" => "Tipo di dato non valido, il valore deve essere una stringa, un intero o un float",
 "'%value%' does not match against pattern '%pattern%'" => "'%value%' non corrisponde con il modello '%pattern%'",

 // Zend_Validate_Sitemap_Changefreq
 "'%value%' is no valid sitemap changefreq" => "'%value%' non è un sitemap changefreq valido",

 // Zend_Validate_Sitemap_Lastmod
 "'%value%' is no valid sitemap lastmod" => "'%value%' non è un sitemap lastmod valido",

 // Zend_Validate_Sitemap_Loc
 "'%value%' is no valid sitemap location" => "'%value%' non è una sitemap location valida",

 // Zend_Validate_Sitemap_Priority
 "'%value%' is no valid sitemap priority" => "'%value%' non è una sitemap priority valida",

 // Zend_Validate_StringLength
 "Invalid type given, value should be a string" => "Tipo di dato non valido, il valore deve essere una stringa",
 "'%value%' is less than %min% characters long" => "'%value%' è minore di '%min%' caratteri",
 "'%value%' is more than %max% characters long" => "'%value%' è maggiore di '%max%' caratteri",
);