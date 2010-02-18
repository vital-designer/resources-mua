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

function Translate($text)
{
  $translated = "";

  switch ($text) {
    case "Aucune archive" :
      $translated = "No archive";
    break;
    case "Cr�er" :
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
    case "D�truire" :
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
    case "cr�er" :
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
    case "Cr�ez ou Ouvrez une archive PhpZip." :
      $translated = "Create or Open a PhpZip archive.";
    break;
    case "La commande \"Cr�er\" a r�ussie" :
      $translated = "\"Create\" command succeed";
    break;
    case "La commande \"Cr�er\" a �chou�e" :
      $translated = "\"Create\" command failed";
    break;
    case "La commande \"Extraire\" a r�ussie" :
      $translated = "\"Extract\" command succeed";
    break;
    case "La commande \"Extraire\" a �chou�e" :
      $translated = "\"Extract\" command failed";
    break;
    case "La commande \"D�truire\" a r�ussie" :
      $translated = "\"Delete\" command succeed";
    break;
    case "La commande \"D�truire\" a �chou�e" :
      $translated = "\"Delete\" command failed";
    break;
    case "La commande \"Ajouter\" a r�ussie" :
      $translated = "\"Add\" command succeed";
    break;
    case "La commande \"Ajouter\" a �chou�e" :
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
    case "�" :
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
    case "D�tails de l'erreur" :
      $translated = "Error details";
    break;
    case "Ouvrir une archive PhpZip" :
      $translated = "Open a PhpZip archive";
    break;
    case "Archive � ouvrir" :
      $translated = "Archive to open";
    break;
    case "Indiquez le nom de l'archive � ouvrir." :
      $translated = "Give the name of the archive to be opened.";
    break;
    case "Cr�er une archive PhpZip" :
      $translated = "Create a PhpZip archive";
    break;
    case "Archive � cr�er" :
      $translated = "Archive to create";
    break;
    case "Type d'archive" :
      $translated = "Archive type";
    break;
    case "Fichier d'auto-d�marrage" :
      $translated = "Auto-start file";
    break;
    case "Veuillez indiquer un nom d'archive � cr�er ou cliquez sur Ouvrir." :
      $translated = "Give the name of the archive to create or click on Open menu.";
    break;
    case "Cr�ation de l'archive PhpZip" :
      $translated = "Creation of PhpZip archive";
    break;
    case "termin�e" :
      $translated = "finished";
    break;
    case "Erreur lors de la cr�ation de l'archive PhpZip" :
      $translated = "Error while creating the PhpZip archive";
    break;
    case "Une archive PhpZip avec le nom" :
      $translated = "A PhpZip archive with name";
    break;
    case "existe d�j�." :
      $translated = "already exists.";
    break;
    case "Ajouter un fichier ou un dossier � l'archive PhpZip" :
      $translated = "Add a file or a directory to the PhpZip archive";
    break;
    case "Fichier ou dossier � ajouter" :
      $translated = "File or directory to add";
    break;
    case "Type de compression" :
      $translated = "Compression type";
    break;
    case "Automatique" :
      $translated = "Automatic";
    break;
    case "Compress�" :
      $translated = "Compressed";
    break;
    case "Non compress�" :
      $translated = "Not compressed";
    break;
    case "Indiquez un nom de fichier ou de dossier � ajouter." :
      $translated = "Give the name of a file or a directory to add.";
    break;
    case "Le fichier" :
      $translated = "The file";
    break;
    case "Le dossier" :
      $translated = "The directory";
    break;
    case "a bien �t� ajout� dans l'archive." :
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
    case "Aucun fichier archiv�" :
      $translated = "No files in archive";
    break;
    case "Contenu de l'archive " :
      $translated = "Content of archive ";
    break;
    case "Erreur lors de la lecture de l'archive PhpZip" :
      $translated = "Error while reading the PhpZip archive";
    break;
    case "Chemin de d�compression de l'archive PhpZip" :
      $translated = "Extraction path for PhpZip archive";
    break;
    case "D�compresser l'archive dans le dossier" :
      $translated = "Extract the archive in directory";
    break;
    case "Indiquez le dossier o� seront extrait les fichiers." :
      $translated = "Give the directory path where the files will be extracted.";
    break;
    case "D�compression PhpZip" :
      $translated = "Extract PhpZip";
    break;
    case "Op�ration termin�e" :
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
    case "D�compression PhpZip OK." :
      $translated = "PhpZip extraction OK.";
    break;
    case "Erreur lors de la d�compression de l'archive PhpZip" :
      $translated = "Error while extracting the PhpZip archive";
    break;
    case "Confirmer destruction d'une archive PhpZip" :
      $translated = "Confirm deletion of a PhpZip archive";
    break;
    case "Voulez-vous d�truire" :
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
    case "d�truite" :
      $translated = "deleted";
    break;
    case "Archive d�truite." :
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
    case "S�lection des fichiers et/ou dossiers � archiver" :
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
    case "Ajouter � l'archive" :
      $translated = "Add to the archive";
    break;
    case "Impossible de lire la liste des fichiers." :
      $translated = "Unable to read file list.";
    break;
    case "La liste de fichiers a bien �t� ajout� dans l'archive." :
      $translated = "The list of files has been added in the archive.";
    break;
    case "Erreur lors de l'ajout de la liste dans l'archive PhpZip" :
      $translated = "Error while adding the list of files in the PhpZip archive";
    break;
    case "Selectionnez l'archive � ouvrir." :
      $translated = "Choose the archive to open.";
    break;
    case "Extraire" :
      $translated = "Extract";
    break;
    case "Selectionner les fichiers � extraire de l'archive " :
      $translated = "Select files to be extracted from archive ";
    break;
    case "S�lection des fichiers � extraire" :
      $translated = "Selection of files to be extracted";
    break;
    case "Extraire de l'archive" :
      $translated = "Extract from archive";
    break;
    case "D�compresser dans le dossier" :
      $translated = "Extract in directory";
    break;
    case "Extraire toute l'archive" :
      $translated = "Extract all the archive";
    break;
    case "La liste de fichiers a bien �t� extraite de l'archive." :
      $translated = "The list of files was correctly extracted from the archive.";
    break;
    case "Extraction termin�e." :
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
    case "Police de caract�res" :
      $translated = "Font type";
    break;
    case "Appliquer" :
      $translated = "Apply";
    break;
    case "Aucun dossier parent" :
      $translated = "No parent directory";
    break;
    case "Impossible d'ouvrir en �criture le fichier de configuration" :
      $translated = "Unable to open in write mode the configuration file";
    break;
    case "Configurer" :
      $translated = "Configure";
    break;
    case "Impossible de sauvegarder le fichier de configuration en .bak" :
      $translated = "Unable to save in .bak the configuration file";
    break;
    case "Warning : Impossible de d�truire le fichier temporaire" :
      $translated = "Unable to delete the temporary file";
    break;
    case "Fichier d'ent�te" :
      $translated = "Header filename";
    break;
    case "Fichier de pied de page" :
      $translated = "Footer filename";
    break;
    case "Police de Caract�res et Couleurs" :
      $translated = "Font and Colors";
    break;
    case "Configuration avanc�e" :
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
    case "Pas � pas" :
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
    case "+ d�tails" :
      $translated = "+ details";
    break;
    case "+ d�tails fins" :
      $translated = "+ precise details";
    break;
    case " d�tails tr�s fins" :
      $translated = "+ very precise details";
    break;
    case "Couleur du texte normal" :
      $translated = "Normal text color";
    break;
    case "Arri�re plan" :
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
    case "Impossible d'�crire dans le dossier" :
      $translated = "Unable to write in directory";
    break;
    case "de l'archive PhpZip" :
      $translated = "of PhpZip archive";
    break;
    case "L'un des fichiers de la liste existe d�j� et est prot�g� en �criture" :
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
    case "Dossier de d�marrage" :
      $translated = "Home directory";
    break;
    case "Param�tres g�n�raux" :
      $translated = "Global parameters";
    break;
    case "La commande \"Lire\" a r�ussie" :
      $translated = "\"Read\" command succeed";
    break;
    case "La commande \"Lire\" a �chou�e" :
      $translated = "\"Read\" command failed";
    break;
    case "Ajout termin�." :
      $translated = "End of add function.";
    break;
    case "Chemin � ignorer" :
      $translated = "Ignore path";
    break;
    case "Modification des chemins d'extraction" :
      $translated = "Modify extract path";
    break;
    case "Ajout�" :
      $translated = "Added";
    break;
    case "Mis � jour" :
      $translated = "File is updated";
    break;
    case "Non mis � jour" :
      $translated = "File is not updated";
    break;
    case "Un dossier utilise d�j� ce nom" :
      $translated = "A folder already use this name";
    break;
    case "Le fichier est prot�g� en �criture" :
      $translated = "File is write protected";
    break;
    case "Un fichier plus r�cent existe" :
      $translated = "A most recent file exist";
    break;
    case "Impossible de cr�er le dossier du fichier" :
      $translated = "Unable to create the file path";
    break;
    case "Probl�me d'�criture du fichier" :
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
    case "et tous ceux qui ont rapport�s les bugs" :
      $translated = "and all of you who report bugs";
    break;
    case "Chemin d'acc�s m�moris�" :
      $translated = "Memorized path";
    break;
    case "Fonction non support�e pour ce type d'archive" :
      $translated = "Unsupported function for this archive format";
    break;
    case "S�lection des fichiers � supprimer" :
      $translated = "List of files to remove";
    break;
    case "Supprimer fichiers" :
      $translated = "Remove files";
    break;
    case "Supprimer" :
      $translated = "Remove";
    break;
    case "Selectionner les fichiers � supprimer de l'archive" :
      $translated = "Select the files to remove from the archive";
    break;
    case "Suppression termin�e." :
      $translated = "File deletion finished.";
    break;
    case "La commande" :
      $translated = "Command";
    break;
    case "a r�ussie" :
      $translated = "succeed";
    break;
    case "a �chou�e" :
      $translated = "has failed";
    break;
    case "Voulez-vous la remplacer ?" :
      $translated = "Do you want to replace it ?";
    break;
    case "Vous pouvez remplacer l'archive existante." :
      $translated = "You can replace the existing archive.";
    break;
    case "T�l�charger" :
      $translated = "Download";
    break;
    case "Impossible de trouver l'archive" :
      $translated = "Unable to find archive";
    break;
    case "S�lection des fichiers et/ou dossiers � mettre � jour" :
      $translated = "File and/or directory to update in archive";
    break;
    case "Mettre � jour fichiers" :
      $translated = "Update files";
    break;
    case "Confirmer que PhpZip doit maintenant essayer de mettre � jour les fichiers suivants" :
      $translated = "Please confirm that PhpZip will try to update the following files";
    break;
    case "Mettre � jour" :
      $translated = "Update";
    break;
    case "Mettre � jour dans l'archive" :
      $translated = "Update in the archive";
    break;
    case "Etat de l'ajout des fichiers" :
      $translated = "Add file status";
    break;
    case "Etat de la mise � jour des fichiers" :
      $translated = "Update file status";
    break;
    case "fichiers mis � jour" :
      $translated = "updated files";
    break;
    case "fichiers non modifi�s" :
      $translated = "not modified files";
    break;
    case "fichiers ajout�s" :
      $translated = "added files";
    break;
    case "Mise � jour termin�e." :
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
