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

function Translate($text)
{
  $translated = "";

  switch ($text) {
    case "Aucune archive" :
      $translated = "No archive";
    break;
    case "Créer" :
      $translated = "Create";
    break;
    case "Ouvrir" :
      $translated = "Open";
    break;
    case "Ajouter" :
      $translated = "Add";
    break;
    case "Extraire" :
      $translated = "Extract";
    break;
    case "Lister" :
      $translated = "List";
    break;
    case "Lire" :
      $translated = "Read";
    break;
    case "Extraire" :
      $translated = "Extract";
    break;
    case "Détruire" :
      $translated = "Delete";
    break;
    case "Quitter" :
      $translated = "Quit";
    break;
    case "Aide" :
      $translated = "Help";
    break;
    case "Bienvenue" :
      $translated = "Welcome";
    break;
    case "Pour continuer vous devez soit" :
      $translated = "To continue you can";
    break;
    case "créer" :
      $translated = "create";
    break;
    case "une archive" :
      $translated = "an archive";
    break;
    case "soit" :
      $translated = "or";
    break;
    case "ouvrir" :
      $translated = "open";
    break;
    case "demander de l'" :
      $translated = "ask for ";
    break;
    case "aide" :
      $translated = "help";
    break;
    case "Créez ou Ouvrez une archive PhpZip." :
      $translated = "Create or Open a PhpZip archive.";
    break;
    case "La commande \"Créer\" a réussie" :
      $translated = "\"Create\" command succeed";
    break;
    case "La commande \"Créer\" a échouée" :
      $translated = "\"Create\" command failed";
    break;
    case "La commande \"Extraire\" a réussie" :
      $translated = "\"Extract\" command succeed";
    break;
    case "La commande \"Extraire\" a échouée" :
      $translated = "\"Extract\" command failed";
    break;
    case "La commande \"Détruire\" a réussie" :
      $translated = "\"Delete\" command succeed";
    break;
    case "La commande \"Détruire\" a échouée" :
      $translated = "\"Delete\" command failed";
    break;
    case "La commande \"Ajouter\" a réussie" :
      $translated = "\"Add\" command succeed";
    break;
    case "La commande \"Ajouter\" a échouée" :
      $translated = "\"Add\" command failed";
    break;
    case "Pour continuer vous pouvez" :
      $translated = "To continue you can";
    break;
    case "ou" :
      $translated = "or";
    break;
    case "ajouter" :
      $translated = "add";
    break;
    case "un fichier" :
      $translated = "a file";
    break;
    case "un dossier" :
      $translated = "a directory";
    break;
    case "à" :
      $translated = "to";
    break;
    case "l'archive" :
      $translated = "the archive";
    break;
    case "lister" :
      $translated = "list";
    break;
    case "le contenu de l'archive" :
      $translated = "the archive content";
    break;
    case "Détails de l'erreur" :
      $translated = "Error details";
    break;
    case "Ouvrir une archive PhpZip" :
      $translated = "Open a PhpZip archive";
    break;
    case "Archive à ouvrir" :
      $translated = "Archive to open";
    break;
    case "Indiquez le nom de l'archive à ouvrir." :
      $translated = "Give the name of the archive to be opened.";
    break;
    case "Créer une archive PhpZip" :
      $translated = "Create a PhpZip archive";
    break;
    case "Archive à créer" :
      $translated = "Archive to create";
    break;
    case "Type d'archive" :
      $translated = "Archive type";
    break;
    case "Fichier d'auto-démarrage" :
      $translated = "Auto-start file";
    break;
    case "Veuillez indiquer un nom d'archive à créer ou cliquez sur Ouvrir." :
      $translated = "Give the name of the archive to create or click on Open menu.";
    break;
    case "Création de l'archive PhpZip" :
      $translated = "Creation of PhpZip archive";
    break;
    case "terminée" :
      $translated = "finished";
    break;
    case "Erreur lors de la création de l'archive PhpZip" :
      $translated = "Error while creating the PhpZip archive";
    break;
    case "Une archive PhpZip avec le nom" :
      $translated = "A PhpZip archive with name";
    break;
    case "existe déjà." :
      $translated = "already exists.";
    break;
    case "Ajouter un fichier ou un dossier à l'archive PhpZip" :
      $translated = "Add a file or a directory to the PhpZip archive";
    break;
    case "Fichier ou dossier à ajouter" :
      $translated = "File or directory to add";
    break;
    case "Type de compression" :
      $translated = "Compression type";
    break;
    case "Automatique" :
      $translated = "Automatic";
    break;
    case "Compressé" :
      $translated = "Compressed";
    break;
    case "Non compressé" :
      $translated = "Not compressed";
    break;
    case "Indiquez un nom de fichier ou de dossier à ajouter." :
      $translated = "Give the name of a file or a directory to add.";
    break;
    case "Le fichier" :
      $translated = "The file";
    break;
    case "Le dossier" :
      $translated = "The directory";
    break;
    case "a bien été ajouté dans l'archive." :
      $translated = "was correctly added in the archive.";
    break;
    case "Erreur lors de l'ajout du fichier" :
      $translated = "Error while adding file";
    break;
    case "Erreur lors de l'ajout du dossier" :
      $translated = "Error while adding directory";
    break;
    case "dans l'archive PhpZip" :
      $translated = "in the PhpZip archive";
    break;
    case "Erreur" :
      $translated = "Error";
    break;
    case "n'est pas un nom de fichier ou dossier valide." :
      $translated = "is not a valid file or directory name.";
    break;
    case "Archive PhpZip inconnue" :
      $translated = "Unknown PhpZip archive";
    break;
    case "Fichier" :
      $translated = "File";
    break;
    case "Taille" :
      $translated = "Size";
    break;
    case "Compression" :
      $translated = "Compression";
    break;
    case "Dossier" :
      $translated = "Directory";
    break;
    case "Oui" :
      $translated = "Yes";
    break;
    case "Non" :
      $translated = "No";
    break;
    case "Aucun fichier archivé" :
      $translated = "No files in archive";
    break;
    case "Contenu de l'archive " :
      $translated = "Content of archive ";
    break;
    case "Erreur lors de la lecture de l'archive PhpZip" :
      $translated = "Error while reading the PhpZip archive";
    break;
    case "Chemin de décompression de l'archive PhpZip" :
      $translated = "Extraction path for PhpZip archive";
    break;
    case "Décompresser l'archive dans le dossier" :
      $translated = "Extract the archive in directory";
    break;
    case "Indiquez le dossier où seront extrait les fichiers." :
      $translated = "Give the directory path where the files will be extracted.";
    break;
    case "Décompression PhpZip" :
      $translated = "Extract PhpZip";
    break;
    case "Opération terminée" :
      $translated = "Action finished";
    break;
    case "L'archive" :
      $translated = "The archive";
    break;
    case "contient un fichier d'auto-start." :
      $translated = "has an auto-start file defined.";
    break;
    case "Cliquez dessus pour le lancer" :
      $translated = "Click on the name to launch it";
    break;
    case "Décompression PhpZip OK." :
      $translated = "PhpZip extraction OK.";
    break;
    case "Erreur lors de la décompression de l'archive PhpZip" :
      $translated = "Error while extracting the PhpZip archive";
    break;
    case "Confirmer destruction d'une archive PhpZip" :
      $translated = "Confirm deletion of a PhpZip archive";
    break;
    case "Voulez-vous détruire" :
      $translated = "Do you want to delete";
    break;
    case "Supprimer" :
      $translated = "Delete";
    break;
    case "Conserver" :
      $translated = "Cancel";
    break;
    case "Confirmez la suppression." :
      $translated = "Confirm the deletion";
    break;
    case "Archive PhpZip" :
      $translated = "PhpZip archive";
    break;
    case "détruite" :
      $translated = "deleted";
    break;
    case "Archive détruite." :
      $translated = "Archive deleted.";
    break;
    case "Le manuel d'utilisation est disponible en ligne" :
      $translated = "User manual is available online";
    break;
    case "Aide PhpZip." :
      $translated = "PhpZip help.";
    break;
    case "Options" :
      $translated = "Options";
    break;
    case "Sélection des fichiers et/ou dossiers à archiver" :
      $translated = "File and/or directory to add in archive";
    break;
    case "Fichier/Dossier" :
      $translated = "File/Directory";
    break;
    case "Dossier courant" :
      $translated = "Current Directory";
    break;
    case "Dossier parent" :
      $translated = "Parent directory";
    break;
    case "Ajouter à l'archive" :
      $translated = "Add to the archive";
    break;
    case "Impossible de lire la liste des fichiers." :
      $translated = "Unable to read file list.";
    break;
    case "La liste de fichiers a bien été ajouté dans l'archive." :
      $translated = "The list of files has been added in the archive.";
    break;
    case "Erreur lors de l'ajout de la liste dans l'archive PhpZip" :
      $translated = "Error while adding the list of files in the PhpZip archive";
    break;
    case "Selectionnez l'archive à ouvrir." :
      $translated = "Choose the archive to open.";
    break;
    case "Extraire" :
      $translated = "Extract";
    break;
    case "Selectionner les fichiers à extraire de l'archive " :
      $translated = "Select files to be extracted from archive ";
    break;
    case "Sélection des fichiers à extraire" :
      $translated = "Selection of files to be extracted";
    break;
    case "Extraire de l'archive" :
      $translated = "Extract from archive";
    break;
    case "Décompresser dans le dossier" :
      $translated = "Extract in directory";
    break;
    case "Extraire toute l'archive" :
      $translated = "Extract all the archive";
    break;
    case "La liste de fichiers a bien été extraite de l'archive." :
      $translated = "The list of files was correctly extracted from the archive.";
    break;
    case "Extraction terminée." :
      $translated = "End of extraction.";
    break;
    case "Erreur lors de l'extraction d'une liste de fichiers de l'archive PhpZip" :
      $translated = "Error while extracting a list of files from the Phpzip archive";
    break;
    case "Configuration" :
      $translated = "Configuration";
    break;
    case "Langue" :
      $translated = "Language";
    break;
    case "Police de caractères" :
      $translated = "Font type";
    break;
    case "Appliquer" :
      $translated = "Apply";
    break;
    case "Aucun dossier parent" :
      $translated = "No parent directory";
    break;
    case "Impossible d'ouvrir en écriture le fichier de configuration" :
      $translated = "Unable to open in write mode the configuration file";
    break;
    case "Configurer" :
      $translated = "Configure";
    break;
    case "Impossible de sauvegarder le fichier de configuration en .bak" :
      $translated = "Unable to save in .bak the configuration file";
    break;
    case "Warning : Impossible de détruire le fichier temporaire" :
      $translated = "Unable to delete the temporary file";
    break;
    case "Fichier d'entête" :
      $translated = "Header filename";
    break;
    case "Fichier de pied de page" :
      $translated = "Footer filename";
    break;
    case "Police de Caractères et Couleurs" :
      $translated = "Font and Colors";
    break;
    case "Configuration avancée" :
      $translated = "Advanced configuration";
    break;
    case "Configuration de la trace" :
      $translated = "Trace configuration";
    break;
    case "Trace" :
      $translated = "Trace";
    break;
    case "Allumer" :
      $translated = "On";
    break;
    case "Eteindre" :
      $translated = "Off";
    break;
    case "Affichage de la trace" :
      $translated = "Trace displaying";
    break;
    case "Pas à pas" :
      $translated = "Step by step";
    break;
    case "A la fin" :
      $translated = "At the end";
    break;
    case "Dans un fichier" :
      $translated = "In a file";
    break;
    case "Niveau de trace" :
      $translated = "Trace level";
    break;
    case "Appels fonctions" :
      $translated = "Function calls";
    break;
    case "+ actions" :
      $translated = "+ actions";
    break;
    case "+ détails" :
      $translated = "+ details";
    break;
    case "+ détails fins" :
      $translated = "+ precise details";
    break;
    case " détails trés fins" :
      $translated = "+ very precise details";
    break;
    case "Couleur du texte normal" :
      $translated = "Normal text color";
    break;
    case "Arrière plan" :
      $translated = "Background";
    break;
    case "Couleur des liens" :
      $translated = "Links color";
    break;
    case "Couleur des titres" :
      $translated = "Titles color";
    break;
    case "Couleur des erreurs" :
      $translated = "Errors color";
    break;
    case "Texte normal" :
      $translated = "Standard text";
    break;
    case "Titres" :
      $translated = "Titles";
    break;
    case "Sous-titres" :
      $translated = "Sub-titles";
    break;
    case "Bas de page" :
      $translated = "Footer";
    break;
    case "Erreurs" :
      $translated = "Errors";
    break;
    case "Syntaxe incorrecte pour le nom de l'archive PhpZip" :
      $translated = "Invalid syntax name for PhpZip archive";
    break;
    case "Impossible de trouver le dossier" :
      $translated = "Unable to find directory";
    break;
    case "Impossible d'écrire dans le dossier" :
      $translated = "Unable to write in directory";
    break;
    case "de l'archive PhpZip" :
      $translated = "of PhpZip archive";
    break;
    case "L'un des fichiers de la liste existe déjà et est protégé en écriture" :
      $translated = "One of the listed file already exists and is write protected";
    break;
    case "Tailles des Textes" :
      $translated = "Font sizes";
    break;

    // ----- Added for Version 1.5
    case "Le type d'archive" :
      $translated = "The archive type";
    break;

    case "est inconnu." :
      $translated = "is unknown.";
    break;

    // ----- Added for Version 1.6
    case "Dossier de démarrage" :
      $translated = "Home directory";
    break;
    case "Paramètres généraux" :
      $translated = "Global parameters";
    break;
    case "La commande \"Lire\" a réussie" :
      $translated = "\"Read\" command succeed";
    break;
    case "La commande \"Lire\" a échouée" :
      $translated = "\"Read\" command failed";
    break;
    case "Ajout terminé." :
      $translated = "End of add function.";
    break;
    case "Chemin à ignorer" :
      $translated = "Ignore path";
    break;
    case "Modification des chemins d'extraction" :
      $translated = "Modify extract path";
    break;
    case "Ajouté" :
      $translated = "Added";
    break;
    case "Mis à jour" :
      $translated = "File is updated";
    break;
    case "Non mis à jour" :
      $translated = "File is not updated";
    break;
    case "Un dossier utilise déjà ce nom" :
      $translated = "A folder already use this name";
    break;
    case "Le fichier est protégé en écriture" :
      $translated = "File is write protected";
    break;
    case "Un fichier plus récent existe" :
      $translated = "A most recent file exist";
    break;
    case "Impossible de créer le dossier du fichier" :
      $translated = "Unable to create the file path";
    break;
    case "Problème d'écriture du fichier" :
      $translated = "Write error";
    break;
    case "Nouveau" :
      $translated = "New";
    break;
    case "Archive" :
      $translated = "Archive";
    break;
    case "Fichiers" :
      $translated = "Files";
    break;
    case "Visualiser" :
      $translated = "View";
    break;
    case "Quitter" :
      $translated = "Quit";
    break;
    case "Au sujet de" :
      $translated = "About";
    break;
    case "Auteur" :
      $translated = "Author";
    break;
    case "PhpZip utilise les ressources suivantes" :
      $translated = "Phpzip use the following resources";
    break;
    case "Librairies de compression" :
      $translated = "Compression libraries";
    break;
    case "Librairie de gestion des erreurs" :
      $translated = "Error handling library";
    break;
    case "Librairie de gestion des traces" :
      $translated = "Trace handling library";
    break;
    case "Gestion des menus dynamiques" :
      $translated = "Dynamic menus handlers";
    break;
    case "Avec l'aide de" :
      $translated = "With help from";
    break;
    case "pour la traduction Italienne" :
      $translated = "for the Italian translation";
    break;
    case "et tous ceux qui ont rapportés les bugs" :
      $translated = "and all of you who report bugs";
    break;
    case "Chemin d'accès mémorisé" :
      $translated = "Memorized path";
    break;
    case "Fonction non supportée pour ce type d'archive" :
      $translated = "Unsupported function for this archive format";
    break;
    case "Sélection des fichiers à supprimer" :
      $translated = "List of files to remove";
    break;
    case "Supprimer fichiers" :
      $translated = "Remove files";
    break;
    case "Supprimer" :
      $translated = "Remove";
    break;
    case "Selectionner les fichiers à supprimer de l'archive" :
      $translated = "Select the files to remove from the archive";
    break;
    case "Suppression terminée." :
      $translated = "File deletion finished.";
    break;
    case "La commande" :
      $translated = "Command";
    break;
    case "a réussie" :
      $translated = "succeed";
    break;
    case "a échouée" :
      $translated = "has failed";
    break;
    case "Voulez-vous la remplacer ?" :
      $translated = "Do you want to replace it ?";
    break;
    case "Vous pouvez remplacer l'archive existante." :
      $translated = "You can replace the existing archive.";
    break;
    case "Télécharger" :
      $translated = "Download";
    break;
    case "Impossible de trouver l'archive" :
      $translated = "Unable to find archive";
    break;
    case "Sélection des fichiers et/ou dossiers à mettre à jour" :
      $translated = "File and/or directory to update in archive";
    break;
    case "Mettre à jour fichiers" :
      $translated = "Update files";
    break;
    case "Confirmer que PhpZip doit maintenant essayer de mettre à jour les fichiers suivants" :
      $translated = "Please confirm that PhpZip will try to update the following files";
    break;
    case "Mettre à jour" :
      $translated = "Update";
    break;
    case "Mettre à jour dans l'archive" :
      $translated = "Update in the archive";
    break;
    case "Etat de l'ajout des fichiers" :
      $translated = "Add file status";
    break;
    case "Etat de la mise à jour des fichiers" :
      $translated = "Update file status";
    break;
    case "fichiers mis à jour" :
      $translated = "updated files";
    break;
    case "fichiers non modifiés" :
      $translated = "not modified files";
    break;
    case "fichiers ajoutés" :
      $translated = "added files";
    break;
    case "Mise à jour terminée." :
      $translated = "Update finish.";
    break;
    case "Menu" :
      $translated = "Menu";
    break;

    default :
      $translated = $text."[Not translated]";
  }

  return $translated;
}

?>
