<?
// --------------------------------------------------------------------------------
// PhpZip Application 1.5 - Language file :
// --------------------------------------------------------------------------------
// License GNU/GPL - Vincent Blavet - Mars 2001
// http://www.phpconcept.net & http://phpconcept.free.fr
// --------------------------------------------------------------------------------
// Credits :
//   Le format de cette fonction a été inspiré de ce qui est fait dans PhpNuke.
//   Pour plus de détails voir http://www.phpnuke.org
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
    case "Créer" :
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
    case "Détruire" :
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
    case "créer" :
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
    case "Créez ou Ouvrez une archive PhpZip." :
      $translated = "Crea o apri un archivio PhpZip.";
    break;
    case "La commande \"Créer\" a réussie" :
      $translated = "Comando \"Crea\" eseguito correttamente";
    break;
    case "La commande \"Créer\" a échouée" :
      $translated = "Comando \"Crea\" fallito";
    break;
    case "La commande \"Extraire\" a réussie" :
      $translated = "Comando \"Estrai\" eseguito correttamente";
    break;
    case "La commande \"Extraire\" a échouée" :
      $translated = "Comando \"Estrai\" fallito";
    break;
    case "La commande \"Détruire\" a réussie" :
      $translated = "Comando \"Elimina\" eseguito correttamente";
    break;
    case "La commande \"Détruire\" a échouée" :
      $translated = "Comando \"Elimina\" fallito";
    break;
    case "La commande \"Ajouter\" a réussie" :
      $translated = "Comando \"Aggiungi\" eseguito correttamente";
    break;
    case "La commande \"Ajouter\" a échouée" :
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
    case "à" :
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
    case "Détails de l'erreur" :
      $translated = "Dettaglio errori";
    break;
    case "Ouvrir une archive PhpZip" :
      $translated = "Apri un archivio PhpZip";
    break;
    case "Archive à ouvrir" :
      $translated = "Archivio da aprire";
    break;
    case "Indiquez le nom de l'archive à ouvrir." :
      $translated = "Indica il nome dell'archivio da aprire.";
    break;
    case "Créer une archive PhpZip" :
      $translated = "Crea l'archivo PhpZip";
    break;
    case "Archive à créer" :
      $translated = "Archivio da creare";
    break;
    case "Type d'archive" :
      $translated = "Tipo di archivo";
    break;
    case "Fichier d'auto-démarrage" :
      $translated = "File auto partente";
    break;
    case "Veuillez indiquer un nom d'archive à créer ou cliquez sur Ouvrir." :
          $translated = "Give the name of the archive to create or click on Open menu.";
    break;
    case "Création de l'archive PhpZip" :
      $translated = "Creazione dell'archivio PhpZip";
    break;
    case "terminée" :
      $translated = "terminata";
    break;
    case "Erreur lors de la création de l'archive PhpZip" :
      $translated = "Errore durante la creazioe dell'archivio PhpZip";
    break;
    case "Une archive PhpZip avec le nom" :
      $translated = "Un archivo PHpZip con il nome";
    break;
    case "existe déjà." :
      $translated = "esiste già.";
    break;
    case "Ajouter un fichier ou un dossier à l'archive PhpZip" :
      $translated = "Aggiungi un file o una cartella all'archivio PhpZip";
    break;
    case "Fichier ou dossier à ajouter" :
      $translated = "File o directory da aggiungere";
    break;
    case "Type de compression" :
      $translated = "Tipo di compressione";
    break;
    case "Automatique" :
      $translated = "Automatica";
    break;
    case "Compressé" :
      $translated = "Compresso";
    break;
    case "Non compressé" :
      $translated = "Non compresso";
    break;
    case "Indiquez un nom de fichier ou de dossier à ajouter." :
      $translated = "Indica il nome del file o della cartella da aggiungere.";
    break;
    case "Le fichier" :
      $translated = "Il file";
    break;
    case "Le dossier" :
      $translated = "La directory";
    break;
    case "a bien été ajouté dans l'archive." :
      $translated = "è stato correttamente aggiungto/a all'archivio.";
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
      $translated = "non è un nome valido di archivio o directory.";
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
      $translated = "Sì";
    break;
    case "Non" :
      $translated = "No";
    break;
    case "Aucun fichier archivé" :
      $translated = "Nessun file in archivio";
    break;
    case "Contenu de l'archive " :
      $translated = "Contenuto dell'archivio ";
    break;
    case "Erreur lors de la lecture de l'archive PhpZip" :
      $translated = "Errore durante la lettura dell'archivio";
    break;
    case "Chemin de décompression de l'archive PhpZip" :
      $translated = "Percorso per l'estrazione dell'archivio";
    break;
    case "Décompresser l'archive dans le dossier" :
      $translated = "Estrai l'archivio nell directory";
    break;
    case "Indiquez le dossier où seront extrait les fichiers." :
      $translated = "Indica il percorso della cartella dove i file saranno estratti.";
    break;
    case "Décompression PhpZip" :
      $translated = "Estrai PhpZip";
    break;
    case "Opération terminée" :
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
    case "Décompression PhpZip OK." :
      $translated = "Estrazione PhpZip OK.";
    break;
    case "Erreur lors de la décompression de l'archive PhpZip" :
      $translated = "Errore durante l'estrazionde dell'archivio PhpZip";
    break;
    case "Confirmer destruction d'une archive PhpZip" :
      $translated = "Conferma l'eliminazione di un'archivio PhpZip";
    break;
    case "Voulez-vous détruire" :
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
    case "détruite" :
      $translated = "eliminato";
    break;
    case "Archive détruite." :
      $translated = "Archivio eliminato.";
    break;
    case "Le manuel d'utilisation est disponible en ligne" :
      $translated = "Il manuale utente è disponibile online";
    break;
    case "Aide PhpZip." :
      $translated = "PhpZip help.";
    break;
    case "Options" :
      $translated = "Opzioni";
    break;
    case "Sélection des fichiers et/ou dossiers à archiver" :
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
    case "Ajouter à l'archive" :
      $translated = "Aggiungi all'archivio";
    break;
    case "Impossible de lire la liste des fichiers." :
      $translated = "Impossibile leggere la lista dei file.";
    break;
    case "La liste de fichiers a bien été ajouté dans l'archive." :
      $translated = "La lista dei file è stata aggiunta all'archivio.";
    break;
    case "Erreur lors de l'ajout de la liste dans l'archive PhpZip" :
      $translated = "Errore durante l'operazione di aggiunta della lista file all'archivio";
    break;
    case "Selectionnez l'archive à ouvrir." :
      $translated = "Scegli l'archivio da aprire.";
    break;
    case "Extraire" :
      $translated = "Estrai";
    break;
    case "Selectionner les fichiers à extraire de l'archive " :
      $translated = "Seleziona i file da estrarre dalll'archivio ";
    break;
    case "Sélection des fichiers à extraire" :
      $translated = "Seleziona i file da estrarre";
    break;
    case "Extraire de l'archive" :
      $translated = "Estrai dall'arichivio";
    break;
    case "Décompresser dans le dossier" :
      $translated = "Estrai nella directory";
    break;
    case "Extraire toute l'archive" :
      $translated = "Estrai tutto l'archivio";
    break;
    case "La liste de fichiers a bien été extraite de l'archive." :
      $translated = "La lista di file è stata estratta correttamente dall'archivio.";
    break;
    case "Extraction terminée." :
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
    case "Police de caractères" :
      $translated = "Font Type";
    break;
    case "Appliquer" :
      $translated = "Applica";
    break;
    case "Aucun dossier parent" :
      $translated = "Nessuna directory superiore";
    break;
    case "Impossible d'ouvrir en écriture le fichier de configuration" :
      $translated = "Impossibile aprire in write mode il file di configurazione";
    break;
    case "Configurer" :
      $translated = "Configura";
    break;
    case "Impossible de sauvegarder le fichier de configuration en .bak" :
      $translated = "Impossibile creare il backup .bak del file di configurazione";
    break;
    case "Warning : Impossible de détruire le fichier temporaire" :
      $translated = "Impossibile eliminare il file temporaneo";
    break;
    case "Fichier d'entête" :
      $translated = "File di testa";
    break;
    case "Fichier de pied de page" :
      $translated = "File di piè di pagina";
    break;
    case "Police de Caractères et Couleurs" :
      $translated = "Font e colori";
    break;
    case "Configuration avancée" :
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
      $translated = "Modalità";
    break;
    case "Pas à pas" :
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
    case "+ détails" :
      $translated = "+ dettagli";
    break;
    case "+ détails fins" :
      $translated = "+ dettagli precisi";
    break;
    case " détails trés fins" :
      $translated = "+ dettagli molto precisi";
    break;
    case "Couleur du texte normal" :
      $translated = "Colore testo normale";
    break;
    case "Arrière plan" :
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
    case "Impossible d'écrire dans le dossier" :
      $translated = "Impossibile scrivere nella directory";
    break;
    case "de l'archive PhpZip" :
      $translated = "dall'archivio PhpZip";
    break;
    case "L'un des fichiers de la liste existe déjà et est protégé en écriture" :
      $translated = "Uno dei file della lista esiste è non ha i permessi di scrittura";
    break;
    case "Tailles des Textes" :
      $translated = "Font size";
    break;

    // ----- Added for Version 1.5
    case "Le type d'archive" :
      $translated = "Tipi d'archivio";
    break;

    case "est inconnu." :
      $translated = "è sconosciuto.";
    break;

    // ----- Added for Version 1.6
    case "Dossier de démarrage" :
      $translated = "Directory Home ";
    break;
    case "Paramètres généraux" :
      $translated = "Parametri globali";
    break;
    case "La commande \"Lire\" a réussie" :
      $translated = "Comando \"Read\" eseguito";
    break;
    case "La commande \"Lire\" a échouée" :
      $translated = "Comando \"Read\" fallito";
    break;
    case "Ajout terminé." :
      $translated = "Fine funzioni aggiunta.";
    break;
    case "Chemin à ignorer" :
      $translated = "Ignora percorso";
    break;
    case "Modification des chemins d'extraction" :
      $translated = "Modifica percorso d'estrazione";
    break;
    case "Ajouté" :
      $translated = "Aggiunto";
    break;
    case "Mis à jour" :
      $translated = "File aggiornato";
    break;
    case "Non mis à jour" :
      $translated = "File non aggiornato";
    break;
    case "Un dossier utilise déjà ce nom" :
      $translated = "Una directory utilizza già questo nome";
    break;
    case "Le fichier est protégé en écriture" :
      $translated = "Il File è write/protected";
    break;
    case "Un fichier plus récent existe" :
      $translated = "Esiste un file più recente";
    break;
    case "Impossible de créer le dossier du fichier" :
      $translated = "Impossibile creare il percorso del file";
    break;
    case "Problème d'écriture du fichier" :
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
    case "et tous ceux qui ont rapportés les bugs" :
      $translated = "e di tutti coloro che hanno riportato i bug";
    break;
    case "Chemin d'accès mémorisé" :
      $translated = "Percorso memorizzato";
    break;
    case "Fonction non supportée pour ce type d'archive" :
      $translated = "Funzione non supportata per il tipo di archivio";
    break;
    case "Sélection des fichiers à supprimer" :
      $translated = "Lista dei file da rimuovere";
    break;
    case "Supprimer fichiers" :
      $translated = "Rimuovi files";
    break;
    case "Supprimer" :
      $translated = "Rimuovi";
    break;
    case "Selectionner les fichiers à supprimer de l'archive" :
      $translated = "Seleziona i file da rimuovere dall'archivio";
    break;
    case "Suppression terminée." :
      $translated = "Eliminazione avvenuta.";
    break;
    case "La commande" :
      $translated = "Comando";
    break;
    case "a réussie" :
      $translated = "eseguito";
    break;
    case "a échouée" :
      $translated = "falito";
    break;
    case "Voulez-vous la remplacer ?" :
      $translated = "Vuoi rimpiazzarlo ?";
    break;
    case "Vous pouvez remplacer l'archive existante." :
      $translated = "Puoi rimpiazzare l'archivio esistente.";
    break;
    case "Télécharger" :
      $translated = "Download";
    break;
    case "Impossible de trouver l'archive" :
      $translated = "Impossibile trovare l'archivio";
    break;
    case "Sélection des fichiers et/ou dossiers à mettre à jour" :
      $translated = "File o cartelle da aggiornare";
    break;
    case "Mettre à jour fichiers" :
      $translated = "Aggiorna files";
    break;
    case "Confirmer que PhpZip doit maintenant essayer de mettre à jour les fichiers suivants" :
      $translated = "Conferma aggiornamento dei seguenti files";
    break;
    case "Mettre à jour" :
      $translated = "Aggiorna";
    break;
    case "Mettre à jour dans l'archive" :
      $translated = "Aggiorna nell'archivio";
    break;
    case "Etat de l'ajout des fichiers" :
      $translated = "Stato aggiornamento file";
    break;
    case "Etat de la mise à jour des fichiers" :
      $translated = "Stato aggiornamento file";
    break;
    case "fichiers mis à jour" :
      $translated = "file aggiornati";
    break;
    case "fichiers non modifiés" :
      $translated = "file non modificati";
    break;
    case "fichiers ajoutés" :
      $translated = "file aggiunti";
    break;
    case "Mise à jour terminée." :
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
