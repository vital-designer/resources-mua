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
// Translation: Markus Pfeifenberger, http://www.pmcweb.at/products/
//   contact: pmcweb@cybersound.com
// --------------------------------------------------------------------------------

function Translate($text)
{
  $translated = "";

  switch ($text) {
    case "Aucune archive" :
      $translated = "Kein Archive";
    break;
    case "Créer" :
      $translated = "Erstellen";
    break;
    case "Ouvrir" :
      $translated = "Öffnen";
    break;
    case "Ajouter" :
      $translated = "Hinzufügen";
    break;
    case "Extraire" :
      $translated = "Extrahieren";
    break;
    case "Lister" :
      $translated = "Auflisten";
    break;
    case "Lire" :
      $translated = "Lesen";
    break;
    case "Détruire" :
      $translated = "Löschen";
    break;
    case "Quitter" :
      $translated = "Beenden";
    break;
    case "Aide" :
      $translated = "Hilfe";
    break;
    case "Bienvenue" :
      $translated = "Willkommen";
    break;
    case "Pour continuer vous devez soit" :
      $translated = "Um weiter zu machen, habe Sie folgende Möglichkeiten: ";
    break;
    case "créer" :
      $translated = "erstellen";
    break;
    case "une archive" :
      $translated = "eines Archivs";
    break;
    case "soit" :
      $translated = "oder";
    break;
    case "ouvrir" :
      $translated = "öffnen";
    break;
    case "demander de l'" :
      $translated = "fragen Sie um ";
    break;
    case "aide" :
      $translated = "Hilfe";
    break;
    case "Créez ou Ouvrez une archive PhpZip." :
      $translated = "Erstellen oder öffnen eines Phpzip.";
    break;
    case "La commande \"Créer\" a réussie" :
      $translated = "\"Erstellen\" war erfolgreich";
    break;
    case "La commande \"Créer\" a échouée" :
      $translated = "\"Erstellen\" war nicht erfolgreich";
    break;
    case "La commande \"Extraire\" a réussie" :
      $translated = "\"Extrahieren\" war erfolgreich";
    break;
    case "La commande \"Extraire\" a échouée" :
      $translated = "\"Extrahieren\" war nicht erfolgreich";
    break;
    case "La commande \"Détruire\" a réussie" :
      $translated = "\"Löschen\" war erfolgreich";
    break;
    case "La commande \"Détruire\" a échouée" :
      $translated = "\"Löschen\" war nicht erfolgreich";
    break;
    case "La commande \"Ajouter\" a réussie" :
      $translated = "\"Hinzufügen\" war erfolgreich";
    break;
    case "La commande \"Ajouter\" a échouée" :
      $translated = "\"Hinzufügen\" war nicht erfolgreich";
    break;
    case "Pour continuer vous pouvez" :
      $translated = "Um weiter zu machen, habe Sie folgende Möglichkeiten: ";
    break;
    case "ou" :
      $translated = "oder";
    break;
    case "ajouter" :
      $translated = "hinzufügen";
    break;
    case "un fichier" :
      $translated = "einer Datei";
    break;
    case "un dossier" :
      $translated = "eines Verzeichnis";
    break;
    case "à" :
      $translated = "zu";
    break;
    case "l'archive" :
      $translated = "einem Verzeichnis";
    break;
    case "lister" :
      $translated = "auflisten";
    break;
    case "le contenu de l'archive" :
      $translated = "Verzeichnis Inhalt";
    break;
    case "Détails de l'erreur" :
      $translated = "Fehler Details";
    break;
    case "Ouvrir une archive PhpZip" :
      $translated = "Öffnen eines PhpZip Archive";
    break;
    case "Archive à ouvrir" :
      $translated = "Zu öffnendes Verzeichnis";
    break;
    case "Indiquez le nom de l'archive à ouvrir." :
      $translated = "Geben Sie den Namen des zu öffnenden Verzeichnisses an.";
    break;
    case "Créer une archive PhpZip" :
      $translated = "Erstellen eines PhpZip Archivs";
    break;
    case "Archive à créer" :
      $translated = "Zu erstellende Archiv";
    break;
    case "Type d'archive" :
      $translated = "Archiv Typ";
    break;
    case "Fichier d'auto-démarrage" :
      $translated = "Auto-start Datei";
    break;
    case "Veuillez indiquer un nom d'archive à créer ou cliquez sur Ouvrir." :
      $translated = "Geben Sie den Namen des Archivs an oder klicken Sie auf Menu Öffnen.";
    break;
    case "Création de l'archive PhpZip" :
      $translated = "Erstellen eines PhpZip Archivs";
    break;
    case "terminée" :
      $translated = "fertig";
    break;
    case "Erreur lors de la création de l'archive PhpZip" :
      $translated = "Fehler beim Erstellen des PhpZip Archivs";
    break;
    case "Une archive PhpZip avec le nom" :
      $translated = "A PhpZip Archiv mit dem Namen";
    break;
    case "existe déjà." :
      $translated = "existiert bereits.";
    break;
    case "Ajouter un fichier ou un dossier à l'archive PhpZip" :
      $translated = "Eine Datei oder ein Verzeichnis dem PhpZip Archiv hinzufügen";
    break;
    case "Fichier ou dossier à ajouter" :
      $translated = "Datei oder Verzeichnis hinzugefügt";
    break;
    case "Type de compression" :
      $translated = "Komprimierung Typ";
    break;
    case "Automatique" :
      $translated = "Automatisch";
    break;
    case "Compressé" :
      $translated = "Komprimiert";
    break;
    case "Non compressé" :
      $translated = "Nicht komprimiert";
    break;
    case "Indiquez un nom de fichier ou de dossier à ajouter." :
      $translated = "Geben Sie den Namen eines Files oder eines Verzeichnisses an, welches Hinzugefügt werden soll.";
    break;
    case "Le fichier" :
      $translated = "Die Datei";
    break;
    case "Le dossier" :
      $translated = "Das Verzeichnis";
    break;
    case "a bien été ajouté dans l'archive." :
      $translated = "wurde korrekt zum Archive hinzugefügt.";
    break;
    case "Erreur lors de l'ajout du fichier" :
      $translated = "Fehler beim Hinzufügen";
    break;
    case "dans l'archive PhpZip" :
      $translated = "im PhpZip Archiv";
    break;
    case "Erreur" :
      $translated = "Fehler";
    break;
    case "n'est pas un nom de fichier ou dossier valide." :
      $translated = "ist keine gültige Datei oder Verzeichnis.";
    break;
    case "Archive PhpZip inconnue" :
      $translated = "Unbekanntes PhpZip Archiv";
    break;
    case "Fichier" :
      $translated = "Datei";
    break;
    case "Taille" :
      $translated = "Grösse";
    break;
    case "Compression" :
      $translated = "Komprimierung";
    break;
    case "Dossier" :
      $translated = "Verzeichnis";
    break;
    case "Oui" :
      $translated = "Ja";
    break;
    case "Non" :
      $translated = "Nein";
    break;
    case "Aucun fichier archivé" :
      $translated = "Kein Dateien im Verzeichnis";
    break;
    case "Contenu de l'archive " :
      $translated = "Inhalt des Archivs ";
    break;
    case "Erreur lors de la lecture de l'archive PhpZip" :
      $translated = "Fehler beim Lesen des PhpZip Archivs";
    break;
    case "Chemin de décompression de l'archive PhpZip" :
      $translated = "Exstrahierungspfad des PhpZip Archiv";
    break;
    case "Décompresser l'archive dans le dossier" :
      $translated = "Extrahieren des Archivs in ein Verzeichnis";
    break;
    case "Indiquez le dossier où seront extrait les fichiers." :
      $translated = "Geben Sie das Verzeichnis an, in welches die Dateien extrahiert werden sollen.";
    break;
    case "Décompression PhpZip" :
      $translated = "Extrahiere PhpZip";
    break;
    case "Opération terminée" :
      $translated = "Aktion abgeschlossen";
    break;
    case "L'archive" :
      $translated = "Das Archiv";
    break;
    case "contient un fichier d'auto-start." :
      $translated = "hat eine Auto-start Datei abgelehnt.";
    break;
    case "Cliquez dessus pour le lancer" :
      $translated = "Klicken Sie auf den Namen, um es zu öffnen";
    break;
    case "Décompression PhpZip OK." :
      $translated = "PhpZip Extraktion OK.";
    break;
    case "Erreur lors de la décompression de l'archive PhpZip" :
      $translated = "Fehler beim Extraxtrahieren des PhpZip Archiv";
    break;
    case "Confirmer destruction d'une archive PhpZip" :
      $translated = "Bestätigen Sie das Löschen des PhpZip Archive";
    break;
    case "Voulez-vous détruire" :
      $translated = "Wollen Sie wirklich löschen";
    break;
    case "Supprimer" :
      $translated = "Löschen";
    break;
    case "Conserver" :
      $translated = "Abbrechen";
    break;
    case "Confirmez la suppression." :
      $translated = "Bestötigen sie das Löschen";
    break;
    case "Archive PhpZip" :
      $translated = "PhpZip Archiv";
    break;
    case "détruite" :
      $translated = "gelöscht";
    break;
    case "Archive détruite." :
      $translated = "Archive gelöscht.";
    break;
    case "Le manuel d'utilisation est disponible en ligne" :
      $translated = "Eine Anleitung ist online verfügbar";
    break;
    case "Aide PhpZip." :
      $translated = "PhpZip Hilfe.";
    break;
    case "Options" :
      $translated = "Optionen";
    break;
    case "Sélection des fichiers et/ou dossiers à archiver" :
      $translated = "Datei und/oder Verzeichnis zum Hinzufügen";
    break;
    case "Fichier/Dossier" :
      $translated = "Datei/Verzeichnis";
    break;
    case "Dossier courant" :
      $translated = "Aktuelles Verzeichnis";
    break;
    case "Dossier parent" :
      $translated = "Übergeordnetes Verzeichnis";
    break;
    case "Ajouter à l'archive" :
      $translated = "Zu Archiv hinzufügen";
    break;
    case "Impossible de lire la liste des fichiers." :
      $translated = "Kann Datei nicht anzeigen.";
    break;
    case "La liste de fichiers a bien été ajouté dans l'archive." :
      $translated = "Die Detail wurden zum Archiv hinzugefügt.";
    break;
    case "Erreur lors de l'ajout de la liste dans l'archive PhpZip" :
      $translated = "Fehler beim Hinufügen der Dateiliste zum PhpZip Archiv";
    break;
    case "Selectionnez l'archive à ouvrir." :
      $translated = "Wählen Sie ein Archiv zum öffnen.";
    break;
    case "Extraire" :
      $translated = "Extrahieren";
    break;
    case "Selectionner les fichiers à extraire de l'archive " :
      $translated = "Wählen Sie eine Datei die extrahiert werden soll ";
    break;
    case "Sélection des fichiers à extraire" :
      $translated = "Auswahl der zu extrahierenden Dateien";
    break;
    case "Extraire de l'archive" :
      $translated = "Extrahieren aus dem Archiv";
    break;
    case "Décompresser dans le dossier" :
      $translated = "Extrahieren in ein Verzeichnis";
    break;
    case "Extraire toute l'archive" :
      $translated = "Extrahieren des gesamten Archivs";
    break;
    case "La liste de fichiers a bien été extraite de l'archive." :
      $translated = "Die Liste der Dateien wurde korrekt aus dem Archiv extrahiert.";
    break;
    case "Extraction terminée." :
      $translated = "Ende der Extraktion.";
    break;
    case "Erreur lors de l'extraction d'une liste de fichiers de l'archive PhpZip" :
      $translated = "Fehler beim Extrahieren der Datei Liste aus dem Phpzip Archiv";
    break;
    case "Configuration" :
      $translated = "Konfiguration";
    break;
    case "Langue" :
      $translated = "Sprache";
    break;
    case "Police de caractères" :
      $translated = "Schrift Typ";
    break;
    case "Appliquer" :
      $translated = "Anwenden";
    break;
    case "Aucun dossier parent" :
      $translated = "Kein übergeordnetes Verzeichnis";
    break;
    case "Impossible d'ouvrir en écriture le fichier de configuration" :
      $translated = "Konfigurationsdatei kann im Schreibmodus nicht geöffnet werden";
    break;
    case "Configurer" :
      $translated = "Konfigurieren";
    break;
    case "Impossible de sauvegarder le fichier de configuration en .bak" :
      $translated = "Konnte die Sicherungsdatei .bak nicht erstellen";
    break;
    case "Warning : Impossible de détruire le fichier temporaire" :
      $translated = "Temporäre Datei konnte nicht gelöscht werden";
    break;
    case "Fichier d'entête" :
      $translated = "Kopf Dateiname";
    break;
    case "Fichier de pied de page" :
      $translated = "Fuss Dateiname";
    break;
    case "Police de Caractères et Couleurs" :
      $translated = "Schrift und Farben";
    break;
    case "Configuration avancée" :
      $translated = "Erweiterte Konfiguration";
    break;
    case "Configuration de la trace" :
      $translated = "Trace Konfiguration";
    break;
    case "Trace" :
      $translated = "Trace";
    break;
    case "Allumer" :
      $translated = "Ein";
    break;
    case "Eteindre" :
      $translated = "Aus";
    break;
    case "Affichage de la trace" :
      $translated = "Trace anzeigen";
    break;
    case "Pas à pas" :
      $translated = "Schritt für Schritt";
    break;
    case "A la fin" :
      $translated = "Am Ende";
    break;
    case "Dans un fichier" :
      $translated = "In die Datei";
    break;
    case "Niveau de trace" :
      $translated = "Trace Level";
    break;
    case "Appels fonctions" :
      $translated = "Funktionsaufrufe";
    break;
    case "+ actions" :
      $translated = "+ Aktionen";
    break;
    case "+ détails" :
      $translated = "+ Details";
    break;
    case "+ détails fins" :
      $translated = "+ genaue Details";
    break;
    case " détails trés fins" :
      $translated = "+ ganz genaue Details";
    break;
    case "Couleur du texte normal" :
      $translated = "Normal Text Farbe";
    break;
    case "Arrière plan" :
      $translated = "Hintergrund";
    break;
    case "Couleur des liens" :
      $translated = "Link Farbe";
    break;
    case "Couleur des titres" :
      $translated = "Titel Farbe";
    break;
    case "Couleur des erreurs" :
      $translated = "Fehler Farbe";
    break;
    case "Texte normal" :
      $translated = "Standard Text";
    break;
    case "Titres" :
      $translated = "Titel";
    break;
    case "Sous-titres" :
      $translated = "Untertitel";
    break;
    case "Bas de page" :
      $translated = "Fuss";
    break;
    case "Erreurs" :
      $translated = "Fehler";
    break;
    case "Syntaxe incorrecte pour le nom de l'archive PhpZip" :
      $translated = "Ungültige Name für das PhpZip Archiv";
    break;
    case "Impossible de trouver le dossier" :
      $translated = "Kann Verzeichnis nicht finden";
    break;
    case "Impossible d'écrire dans le dossier" :
      $translated = "Kann im Verzeichnis nicht schreiben";
    break;
    case "de l'archive PhpZip" :
      $translated = "( des PhpZip Archivs)";
    break;
    case "L'un des fichiers de la liste existe déjà et est protégé en écriture" :
      $translated = "Eine der der Dateien in der Liste existiert bereits oder ist schreibgeschützt";
    break;
    case "Tailles des Textes" :
      $translated = "Schriftgrösse";
    break;

    // ----- Added for Version 1.5
    case "Le type d'archive" :
      $translated = "Der Archive Typ";
    break;

    case "est inconnu." :
      $translated = "ist unbekannt.";
    break;

    // ----- Added for Version 1.6
    case "Dossier de démarrage" :
      $translated = "Start Verzeichnis";
    break;
    case "Paramètres généraux" :
      $translated = "Globale Parameter";
    break;
    case "La commande \"Lire\" a réussie" :
      $translated = "\"Lesen\" erfolgreich";
    break;
    case "La commande \"Lire\" a échouée" :
      $translated = "\"Lesen\" fehlgeschlagen";
    break;
    case "Ajout terminé." :
      $translated = "Ende der Hinzufügen Funktion.";
    break;
    case "Chemin à ignorer" :
      $translated = "Pfad ignorieren";
    break;
    case "Modification des chemins d'extraction" :
      $translated = "Ändern Extraktionspfad";
    break;
    case "Ajouté" :
      $translated = "Hinzugefügt";
    break;
    case "Mis à jour" :
      $translated = "Datei wurde aktualisiert";
    break;
    case "Non mis à jour" :
      $translated = "Datei wurde nicht aktualiesiert";
    break;
    case "Un dossier utilise déjà ce nom" :
      $translated = "Ein Verzeichnis benutz bereits diesen Namen";
    break;
    case "Le fichier est protégé en écriture" :
      $translated = "Datei ist schreibgeschützt";
    break;
    case "Un fichier plus récent existe" :
      $translated = "Es existiert eine neuere Datei";
    break;
    case "Impossible de créer le dossier du fichier" :
      $translated = "Dateipfad konnte nicht angelegt werden";
    break;
    case "Problème d'écriture du fichier" :
      $translated = "Schreibfehler";
    break;
    case "Nouveau" :
      $translated = "Neu";
    break;
    case "Archive" :
      $translated = "Archiv";
    break;
    case "Fichiers" :
      $translated = "Dateien";
    break;
    case "Visualiser" :
      $translated = "Ansehen";
    break;
    case "Quitter" :
      $translated = "Beenden";
    break;
    case "Au sujet de" :
      $translated = "Über";
    break;
    case "Auteur" :
      $translated = "Author";
    break;
    case "PhpZip utilise les ressources suivantes" :
      $translated = "Phpzip verwendet folgende Resourcen";
    break;
    case "Librairies de compression" :
      $translated = "Kompressions Libraries";
    break;
    case "Librairie de gestion des erreurs" :
      $translated = "Fehler Handhabungs Library";
    break;
    case "Librairie de gestion des traces" :
      $translated = "Trace Bandhabungs Library";
    break;
    case "Gestion des menus dynamiques" :
      $translated = "Dynamische Menu Handhabung";
    break;
    case "Avec l'aide de" :
      $translated = "mit Hilfe von";
    break;
    case "pour la traduction Italienne" :
      $translated = "für die italienische Übersetzung";
    break;
    case "et tous ceux qui ont rapportés les bugs" :
      $translated = "und allen für den Fehler-Report";
    break;
    case "Chemin d'accès mémorisé" :
      $translated = "Gespeicherter Pfad";
    break;
    case "Fonction non supportée pour ce type d'archive" :
      $translated = "Unterstützte Funktionen für dieses Archiv-Format";
    break;
    case "Sélection des fichiers à supprimer" :
      $translated = "Liste der zu entfernenden Dateien";
    break;
    case "Supprimer fichiers" :
      $translated = "Dateien entfernen";
    break;
    case "Supprimer" :
      $translated = "Entfernen";
    break;
    case "Selectionner les fichiers à supprimer de l'archive" :
      $translated = "Wählen Sie die zu entfernenden Dateien";
    break;
    case "Suppression terminée." :
      $translated = "Löschen der Datei abgeschlossen.";
    break;
    case "La commande" :
      $translated = "Befehl";
    break;
    case "a réussie" :
      $translated = "erfolgreich";
    break;
    case "a échouée" :
      $translated = "fehlgeschlagen";
    break;
    case "Voulez-vous la remplacer ?" :
      $translated = "Wollen die das Archiv ersetzen?";
    break;
    case "Vous pouvez remplacer l'archive existante." :
      $translated = "Sie können das existierende Archiv ersetzen.";
    break;
    case "Télécharger" :
      $translated = "Herunterladen";
    break;
    case "Impossible de trouver l'archive" :
      $translated = "Kann Archiv nicht finden";
    break;
    case "Sélection des fichiers et/ou dossiers à mettre à jour" :
      $translated = "Datei und/oder Verzeichnis zum aktualisiern";
    break;
    case "Mettre à jour fichiers" :
      $translated = "Dateien aktualisiert";
    break;
    case "Confirmer que PhpZip doit maintenant essayer de mettre à jour les fichiers suivants" :
      $translated = "Bitte bestätigen Sie die Aktualisierung der folgenden Dateien im PhpZip ";
    break;
    case "Mettre à jour" :
      $translated = "Aktualisieren";
    break;
    case "Mettre à jour dans l'archive" :
      $translated = "Archiv aktualiesert";
    break;
    case "Etat de l'ajout des fichiers" :
      $translated = "Datei Status hinzugefügt";
    break;
    case "Etat de la mise à jour des fichiers" :
      $translated = "Datei Status aktualisiert";
    break;
    case "fichiers mis à jour" :
      $translated = "Dateien aktualisiert";
    break;
    case "fichiers non modifiés" :
      $translated = "Dateien nicht hinzugefügt";
    break;
    case "fichiers ajoutés" :
      $translated = "Dateien hinzugefügt";
    break;
    case "Mise à jour terminée." :
      $translated = "Aktualisierung abgeschlossen.";
    break;
    case "Menu" :
      $translated = "Menu";
    break;

    // ----- Added for Version 1.7
    case "pour la traduction Allemande" :
      $translated = "für die deutsche Übersetzung";
    break;

    default :
      $translated = $text."[Not translated]";
  }

  return $translated;
}

?>
