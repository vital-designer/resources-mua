<?
// --------------------------------------------------------------------------------
// PhpZip Application 1.5 - Language file :
// --------------------------------------------------------------------------------
// License GNU/GPL - Vincent Blavet - Mars 2001
// http://www.phpconcept.net & http://phpconcept.free.fr
// --------------------------------------------------------------------------------
// Credits :
//   Le format de cette fonction a �t� inspir� de ce qui est fait dans PhpNuke.
//   Pour plus de d�tails voir http://www.phpnuke.org
// --------------------------------------------------------------------------------

// --------------------------------------------------------------------------------
// Versione Italiana - Ultima modifica: 19/05/01
// --------------------------------------------------------------------------------

function Translate($text)
{
  $translated = "";

  switch ($text) {
    case "Aucune archive" :
      $translated = " Nessun archivio ";
    break;
    case "Cr�er" :
      $translated = "Crea";
    break;
    case "Ouvrir" :
      $translated = "Apri";
    break;
    case "Ajouter" :
      $translated = "Aggiungi";
    break;
    case "Extraire" :
      $translated = "Estrai";
    break;
    case "Lister" :
      $translated = "Elenca";
    break;
    case "Lire" :
      $translated = "Leggi";
    break;
    case "Extraire" :
      $translated = "Estrai";
    break;
    case "D�truire" :
      $translated = "Elimina";
    break;
    case "Quitter" :
      $translated = "Quit";
    break;
    case "Aide" :
      $translated = "Aiuto";
    break;
    case "Bienvenue" :
      $translated = "Benvenuto";
    break;
    case "Pour continuer vous devez soit" :
      $translated = "Con <b>PhpZip</b> puoi<br>";
    break;
    case "cr�er" :
      $translated = "creare";
    break;
    case "une archive" :
      $translated = "un archivio";
    break;
    case "soit" :
      $translated = "oppure";
    break;
    case "ouvrir" :
      $translated = "aprire";
    break;
    case "demander de l'" :
      $translated = "chiedere ";
    break;
    case "aide" :
      $translated = "aiuto";
    break;
    case "Cr�ez ou Ouvrez une archive PhpZip." :
      $translated = "Crea o apri un archivio PhpZip.";
    break;
    case "La commande \"Cr�er\" a r�ussie" :
      $translated = "Comando \"Crea\" eseguito correttamente";
    break;
    case "La commande \"Cr�er\" a �chou�e" :
      $translated = "Comando \"Crea\" fallito";
    break;
    case "La commande \"Extraire\" a r�ussie" :
      $translated = "Comando \"Estrai\" eseguito correttamente";
    break;
    case "La commande \"Extraire\" a �chou�e" :
      $translated = "Comando \"Estrai\" fallito";
    break;
    case "La commande \"D�truire\" a r�ussie" :
      $translated = "Comando \"Elimina\" eseguito correttamente";
    break;
    case "La commande \"D�truire\" a �chou�e" :
      $translated = "Comando \"Elimina\" fallito";
    break;
    case "La commande \"Ajouter\" a r�ussie" :
      $translated = "Comando \"Aggiungi\" eseguito correttamente";
    break;
    case "La commande \"Ajouter\" a �chou�e" :
      $translated = "Comando \"Aggiungi\" fallito";
    break;
    case "Pour continuer vous pouvez" :
      $translated = "Per continuare puoi";
    break;
    case "ou" :
      $translated = "oppure";
    break;
    case "ajouter" :
      $translated = "aggiungere";
    break;
    case "un fichier" :
      $translated = "un file";
    break;
    case "un dossier" :
      $translated = "una directory";
    break;
    case "�" :
      $translated = "all'";
    break;
    case "l'archive" :
      $translated = "archivio";
    break;
    case "lister" :
      $translated = "elenca";
    break;
    case "le contenu de l'archive" :
      $translated = "il contenuto dell'archivio";
    break;
    case "D�tails de l'erreur" :
      $translated = "Dettaglio errori";
    break;
    case "Ouvrir une archive PhpZip" :
      $translated = "Apri un archivio PhpZip";
    break;
    case "Archive � ouvrir" :
      $translated = "Archivio da aprire";
    break;
    case "Indiquez le nom de l'archive � ouvrir." :
      $translated = "Indica il nome dell'archivio da aprire.";
    break;
    case "Cr�er une archive PhpZip" :
      $translated = "Crea l'archivo PhpZip";
    break;
    case "Archive � cr�er" :
      $translated = "Archivio da creare";
    break;
    case "Type d'archive" :
      $translated = "Tipo di archivo";
    break;
    case "Fichier d'auto-d�marrage" :
      $translated = "File auto partente";
    break;
    case "Veuillez indiquer un nom d'archive � cr�er ou cliquez sur Ouvrir." :
          $translated = "Give the name of the archive to create or click on Open menu.";
    break;
    case "Cr�ation de l'archive PhpZip" :
      $translated = "Creazione dell'archivio PhpZip";
    break;
    case "termin�e" :
      $translated = "terminata";
    break;
    case "Erreur lors de la cr�ation de l'archive PhpZip" :
      $translated = "Errore durante la creazioe dell'archivio PhpZip";
    break;
    case "Une archive PhpZip avec le nom" :
      $translated = "Un archivo PHpZip con il nome";
    break;
    case "existe d�j�." :
      $translated = "esiste gi�.";
    break;
    case "Ajouter un fichier ou un dossier � l'archive PhpZip" :
      $translated = "Aggiungi un file o una cartella all'archivio PhpZip";
    break;
    case "Fichier ou dossier � ajouter" :
      $translated = "File o directory da aggiungere";
    break;
    case "Type de compression" :
      $translated = "Tipo di compressione";
    break;
    case "Automatique" :
      $translated = "Automatica";
    break;
    case "Compress�" :
      $translated = "Compresso";
    break;
    case "Non compress�" :
      $translated = "Non compresso";
    break;
    case "Indiquez un nom de fichier ou de dossier � ajouter." :
      $translated = "Indica il nome del file o della cartella da aggiungere.";
    break;
    case "Le fichier" :
      $translated = "Il file";
    break;
    case "Le dossier" :
      $translated = "La directory";
    break;
    case "a bien �t� ajout� dans l'archive." :
      $translated = "� stato correttamente aggiungto/a all'archivio.";
    break;
    case "Erreur lors de l'ajout du fichier" :
      $translated = "Errore durante l'aggiunta del file";
    break;
    case "Erreur lors de l'ajout du dossier" :
      $translated = "Errore durante l'aggiunta della directory";
    break;
    case "dans l'archive PhpZip" :
      $translated = "nell'archvio phpZip";
    break;
    case "Erreur" :
      $translated = "Errore";
    break;
    case "n'est pas un nom de fichier ou dossier valide." :
      $translated = "non � un nome valido di archivio o directory.";
    break;
    case "Archive PhpZip inconnue" :
      $translated = "Archivio PhpZip sconosciuto";
    break;
    case "Fichier" :
      $translated = "File";
    break;
    case "Taille" :
      $translated = "Taglia";
    break;
    case "Compression" :
      $translated = "Compressione";
    break;
    case "Dossier" :
      $translated = "Directory";
    break;
    case "Oui" :
      $translated = "S�";
    break;
    case "Non" :
      $translated = "No";
    break;
    case "Aucun fichier archiv�" :
      $translated = "Nessun file in archivio";
    break;
    case "Contenu de l'archive " :
      $translated = "Contenuto dell'archivio ";
    break;
    case "Erreur lors de la lecture de l'archive PhpZip" :
      $translated = "Errore durante la lettura dell'archivio";
    break;
    case "Chemin de d�compression de l'archive PhpZip" :
      $translated = "Percorso per l'estrazione dell'archivio";
    break;
    case "D�compresser l'archive dans le dossier" :
      $translated = "Estrai l'archivio nell directory";
    break;
    case "Indiquez le dossier o� seront extrait les fichiers." :
      $translated = "Indica il percorso della cartella dove i file saranno estratti.";
    break;
    case "D�compression PhpZip" :
      $translated = "Estrai PhpZip";
    break;
    case "Op�ration termin�e" :
      $translated = "Operazione terminata";
    break;
    case "L'archive" :
      $translated = "L'archivio";
    break;
    case "contient un fichier d'auto-start." :
      $translated = "contiene un file auto estraente.";
    break;
    case "Cliquez dessus pour le lancer" :
      $translated = "Clicca sul nome per lanciarlo";
    break;
    case "D�compression PhpZip OK." :
      $translated = "Estrazione PhpZip OK.";
    break;
    case "Erreur lors de la d�compression de l'archive PhpZip" :
      $translated = "Errore durante l'estrazionde dell'archivio PhpZip";
    break;
    case "Confirmer destruction d'une archive PhpZip" :
      $translated = "Conferma l'eliminazione di un'archivio PhpZip";
    break;
    case "Voulez-vous d�truire" :
      $translated = "Vuoi eliminare";
    break;
    case "Supprimer" :
      $translated = "Eliminare";
    break;
    case "Conserver" :
      $translated = "Cancel";
    break;
    case "Confirmez la suppression." :
      $translated = "Comferma l'eliminazione";
    break;
    case "Archive PhpZip" :
      $translated = "Archivio PhpZip";
    break;
    case "d�truite" :
      $translated = "eliminato";
    break;
    case "Archive d�truite." :
      $translated = "Archivio eliminato.";
    break;
    case "Le manuel d'utilisation est disponible en ligne" :
      $translated = "Il manuale utente � disponibile online";
    break;
    case "Aide PhpZip." :
      $translated = "PhpZip help.";
    break;
    case "Options" :
      $translated = "Opzioni";
    break;
    case "S�lection des fichiers et/ou dossiers � archiver" :
      $translated = "File e/o directory da aggiungere all'archivio";
    break;
    case "Fichier/Dossier" :
      $translated = "File/Directory";
    break;
    case "Dossier courant" :
      $translated = "Directory corrente";
    break;
    case "Dossier parent" :
      $translated = "Directory superiore";
    break;
    case "Ajouter � l'archive" :
      $translated = "Aggiungi all'archivio";
    break;
    case "Impossible de lire la liste des fichiers." :
      $translated = "Impossibile leggere la lista dei file.";
    break;
    case "La liste de fichiers a bien �t� ajout� dans l'archive." :
      $translated = "La lista dei file � stata aggiunta all'archivio.";
    break;
    case "Erreur lors de l'ajout de la liste dans l'archive PhpZip" :
      $translated = "Errore durante l'operazione di aggiunta della lista file all'archivio";
    break;
    case "Selectionnez l'archive � ouvrir." :
      $translated = "Scegli l'archivio da aprire.";
    break;
    case "Extraire" :
      $translated = "Estrai";
    break;
    case "Selectionner les fichiers � extraire de l'archive " :
      $translated = "Seleziona i file da estrarre dalll'archivio ";
    break;
    case "S�lection des fichiers � extraire" :
      $translated = "Seleziona i file da estrarre";
    break;
    case "Extraire de l'archive" :
      $translated = "Estrai dall'arichivio";
    break;
    case "D�compresser dans le dossier" :
      $translated = "Estrai nella directory";
    break;
    case "Extraire toute l'archive" :
      $translated = "Estrai tutto l'archivio";
    break;
    case "La liste de fichiers a bien �t� extraite de l'archive." :
      $translated = "La lista di file � stata estratta correttamente dall'archivio.";
    break;
    case "Extraction termin�e." :
      $translated = "Fine estrazione.";
    break;
    case "Erreur lors de l'extraction d'une liste de fichiers de l'archive PhpZip" :
      $translated = "Errore durante l'estrazione dei file dall'archivio PhpZip";
    break;
    case "Configuration" :
      $translated = "Configurazione";
    break;
    case "Langue" :
      $translated = "Lingua";
    break;
    case "Police de caract�res" :
      $translated = "Font Type";
    break;
    case "Appliquer" :
      $translated = "Applica";
    break;
    case "Aucun dossier parent" :
      $translated = "Nessuna directory superiore";
    break;
    case "Impossible d'ouvrir en �criture le fichier de configuration" :
      $translated = "Impossibile aprire in write mode il file di configurazione";
    break;
    case "Configurer" :
      $translated = "Configura";
    break;
    case "Impossible de sauvegarder le fichier de configuration en .bak" :
      $translated = "Impossibile creare il backup .bak del file di configurazione";
    break;
    case "Warning : Impossible de d�truire le fichier temporaire" :
      $translated = "Impossibile eliminare il file temporaneo";
    break;
    case "Fichier d'ent�te" :
      $translated = "File di testa";
    break;
    case "Fichier de pied de page" :
      $translated = "File di pi� di pagina";
    break;
    case "Police de Caract�res et Couleurs" :
      $translated = "Font e colori";
    break;
    case "Configuration avanc�e" :
      $translated = "Configurazione avanzata";
    break;
    case "Configuration de la trace" :
      $translated = "Configuratione History";
    break;
    case "Trace" :
      $translated = "Mostra struttura archivio";
    break;
    case "Allumer" :
      $translated = "On";
    break;
    case "Eteindre" :
      $translated = "Off";
    break;
    case "Affichage de la trace" :
      $translated = "Modalit�";
    break;
    case "Pas � pas" :
      $translated = "Step by step";
    break;
    case "A la fin" :
      $translated = "Alla fine";
    break;
    case "Dans un fichier" :
      $translated = "In un file";
    break;
    case "Niveau de trace" :
      $translated = "Trace level";
    break;
    case "Appels fonctions" :
      $translated = "Chiamate funzioni";
    break;
    case "+ actions" :
      $translated = "+ azioni";
    break;
    case "+ d�tails" :
      $translated = "+ dettagli";
    break;
    case "+ d�tails fins" :
      $translated = "+ dettagli precisi";
    break;
    case " d�tails tr�s fins" :
      $translated = "+ dettagli molto precisi";
    break;
    case "Couleur du texte normal" :
      $translated = "Colore testo normale";
    break;
    case "Arri�re plan" :
      $translated = "Sfondo";
    break;
    case "Couleur des liens" :
      $translated = "colore links";
    break;
    case "Couleur des titres" :
      $translated = "Colore titolo";
    break;
    case "Couleur des erreurs" :
      $translated = "Colore errori";
    break;
    case "Texte normal" :
      $translated = "Testo standard";
    break;
    case "Titres" :
      $translated = "Titoli";
    break;
    case "Sous-titres" :
      $translated = "Sotto-titoli";
    break;
    case "Bas de page" :
      $translated = "Footer";
    break;
    case "Erreurs" :
      $translated = "Errori";
    break;
    case "Syntaxe incorrecte pour le nom de l'archive PhpZip" :
      $translated = "Nome non valido per l'archivo PhpZip";
    break;
    case "Impossible de trouver le dossier" :
      $translated = "Impossibile trovare la directory";
    break;
    case "Impossible d'�crire dans le dossier" :
      $translated = "Impossibile scrivere nella directory";
    break;
    case "de l'archive PhpZip" :
      $translated = "dall'archivio PhpZip";
    break;
    case "L'un des fichiers de la liste existe d�j� et est prot�g� en �criture" :
      $translated = "Uno dei file della lista esiste � non ha i permessi di scrittura";
    break;
    case "Tailles des Textes" :
      $translated = "Font size";
    break;

    // ----- Added for Version 1.5
    case "Le type d'archive" :
      $translated = "Tipi d'archivio";
    break;

    case "est inconnu." :
      $translated = "� sconosciuto.";
    break;

    // ----- Added for Version 1.6
    case "Dossier de d�marrage" :
      $translated = "Directory Home ";
    break;
    case "Param�tres g�n�raux" :
      $translated = "Parametri globali";
    break;
    case "La commande \"Lire\" a r�ussie" :
      $translated = "Comando \"Read\" eseguito";
    break;
    case "La commande \"Lire\" a �chou�e" :
      $translated = "Comando \"Read\" fallito";
    break;
    case "Ajout termin�." :
      $translated = "Fine funzioni aggiunta.";
    break;
    case "Chemin � ignorer" :
      $translated = "Ignora percorso";
    break;
    case "Modification des chemins d'extraction" :
      $translated = "Modifica percorso d'estrazione";
    break;
    case "Ajout�" :
      $translated = "Aggiunto";
    break;
    case "Mis � jour" :
      $translated = "File aggiornato";
    break;
    case "Non mis � jour" :
      $translated = "File non aggiornato";
    break;
    case "Un dossier utilise d�j� ce nom" :
      $translated = "Una directory utilizza gi� questo nome";
    break;
    case "Le fichier est prot�g� en �criture" :
      $translated = "Il File � write/protected";
    break;
    case "Un fichier plus r�cent existe" :
      $translated = "Esiste un file pi� recente";
    break;
    case "Impossible de cr�er le dossier du fichier" :
      $translated = "Impossibile creare il percorso del file";
    break;
    case "Probl�me d'�criture du fichier" :
      $translated = "Problemi di scittura";
    break;
    case "Nouveau" :
      $translated = "Nuovo";
    break;
    case "Archive" :
      $translated = "Archivio";
    break;
    case "Fichiers" :
      $translated = "File";
    break;
    case "Visualiser" :
      $translated = "Visualizza";
    break;
    case "Quitter" :
      $translated = "Quit";
    break;
    case "Au sujet de" :
      $translated = "Info";
    break;
    case "Auteur" :
      $translated = "Autore";
    break;
    case "PhpZip utilise les ressources suivantes" :
      $translated = "Phpzip utilizza le seguenti risorse:";
    break;
    case "Librairies de compression" :
      $translated = "Librerie di compressione";
    break;
    case "Librairie de gestion des erreurs" :
      $translated = "Librerie di gestione degli errori";
    break;
    case "Librairie de gestion des traces" :
      $translated = "Librerie gestione tracce";
    break;
    case "Gestion des menus dynamiques" :
      $translated = "Gestione dei menu dinamici";
    break;
    case "Avec l'aide de" :
      $translated = "Con l'aiuto di";
    break;
    case "pour la traduction Italienne" :
      $translated = "per la traduzione italiana";
    break;
    case "et tous ceux qui ont rapport�s les bugs" :
      $translated = "e di tutti coloro che hanno riportato i bug";
    break;
    case "Chemin d'acc�s m�moris�" :
      $translated = "Percorso memorizzato";
    break;
    case "Fonction non support�e pour ce type d'archive" :
      $translated = "Funzione non supportata per il tipo di archivio";
    break;
    case "S�lection des fichiers � supprimer" :
      $translated = "Lista dei file da rimuovere";
    break;
    case "Supprimer fichiers" :
      $translated = "Rimuovi files";
    break;
    case "Supprimer" :
      $translated = "Rimuovi";
    break;
    case "Selectionner les fichiers � supprimer de l'archive" :
      $translated = "Seleziona i file da rimuovere dall'archivio";
    break;
    case "Suppression termin�e." :
      $translated = "Eliminazione avvenuta.";
    break;
    case "La commande" :
      $translated = "Comando";
    break;
    case "a r�ussie" :
      $translated = "eseguito";
    break;
    case "a �chou�e" :
      $translated = "falito";
    break;
    case "Voulez-vous la remplacer ?" :
      $translated = "Vuoi rimpiazzarlo ?";
    break;
    case "Vous pouvez remplacer l'archive existante." :
      $translated = "Puoi rimpiazzare l'archivio esistente.";
    break;
    case "T�l�charger" :
      $translated = "Download";
    break;
    case "Impossible de trouver l'archive" :
      $translated = "Impossibile trovare l'archivio";
    break;
    case "S�lection des fichiers et/ou dossiers � mettre � jour" :
      $translated = "File o cartelle da aggiornare";
    break;
    case "Mettre � jour fichiers" :
      $translated = "Aggiorna files";
    break;
    case "Confirmer que PhpZip doit maintenant essayer de mettre � jour les fichiers suivants" :
      $translated = "Conferma aggiornamento dei seguenti files";
    break;
    case "Mettre � jour" :
      $translated = "Aggiorna";
    break;
    case "Mettre � jour dans l'archive" :
      $translated = "Aggiorna nell'archivio";
    break;
    case "Etat de l'ajout des fichiers" :
      $translated = "Stato aggiornamento file";
    break;
    case "Etat de la mise � jour des fichiers" :
      $translated = "Stato aggiornamento file";
    break;
    case "fichiers mis � jour" :
      $translated = "file aggiornati";
    break;
    case "fichiers non modifi�s" :
      $translated = "file non modificati";
    break;
    case "fichiers ajout�s" :
      $translated = "file aggiunti";
    break;
    case "Mise � jour termin�e." :
      $translated = "Aggiornamento terminato.";
    break;
    case "Menu" :
      $translated = "Menu";
    break;

    // ----- Added for Version 1.7
    case "pour la traduction Allemande" :
      $translated = "for the German translation";
    break;

    default :
      $translated = $text."[Non tradotto]";
  }

  return $translated;
}

?>
