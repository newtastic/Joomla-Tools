<?php

// Verzeichnis, in dem das Skript nach ZIP-Dateien suchen soll
$verzeichnis = __DIR__; // Aktuelles Verzeichnis

// Alle Dateien im Verzeichnis auflisten
$files = scandir($verzeichnis);

foreach ($files as $file) {
    // Überprüfen, ob die Datei eine ZIP-Datei ist
    if (pathinfo($file, PATHINFO_EXTENSION) === 'zip') {
        $zipPfad = $verzeichnis . DIRECTORY_SEPARATOR . $file;

        // Entpacken der ZIP-Datei
        $zip = new ZipArchive;
        if ($zip->open($zipPfad) === TRUE) {
            $zip->extractTo($verzeichnis); // Entpacken ins aktuelle Verzeichnis
            $zip->close();
            echo "$file wurde erfolgreich entpackt.\n";

            // Löschen der ZIP-Datei nach dem Entpacken
            unlink($zipPfad);
            echo "$file wurde gelöscht.\n";
        } else {
            echo "Fehler beim Öffnen der ZIP-Datei $file.\n";
        }
    }
}
?>
