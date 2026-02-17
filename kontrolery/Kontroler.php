<?php
// Načtení modelu
require 'modely/PojistenecModel.php';
// Vytvoření instance modelu
$model_pojistence = new PojistenecModel();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['pojistenci'] = [];
}
// Inicializace proměnných
$jmeno = '';
$prijmeni = '';
$telefon = '';
$vek = '';
$chyby = [];

// Zpracování formuláře
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Získání dat z formuláře
    if (isset($_POST['jmeno'])) {
        $jmeno = $_POST['jmeno'];
    } else {
        $jmeno = '';
    }

    if (isset($_POST['prijmeni'])) {
        $prijmeni = $_POST['prijmeni'];
    } else {
        $prijmeni = '';
    }

    if (isset($_POST['telefon'])) {
        $telefon = $_POST['telefon'];
    } else {
        $telefon = '';
    }

    if (isset($_POST['vek'])) {
        $vek = (int)$_POST['vek'];
    } else {
        $vek = 0;
    }

    // Validace vložených dat: jméno, přijmení, telefon a věk
    if ($jmeno === '') {
        $chyby[] = 'Jméno nesmí být prázdné.';
    } else {
        if (preg_match("/^[a-zA-ZěščřžýáíéúůĚŠČŘŽÝÁÍÉÚŮ -]+$/u", $jmeno)) {
        } else {
            $chyby[] = 'Jméno může obsahovat jen písmena a mezery.';
        }
    }
    if ($prijmeni === '') {
        $chyby[] = 'Příjmení nesmí být prázdné.';
    } else {
        if (preg_match("/^[a-zA-ZěščřžýáíéúůĚŠČŘŽÝÁÍÉÚŮ -]+$/u", $prijmeni)) {
        } else {
            $chyby[] = 'Příjmení může obsahovat jen písmena a mezery.';
        }
    }
    if ($telefon === '') {
        $chyby[] = 'Telefon nesmí být prázdný.';
    } else {
        if (preg_match('/^\+?[0-9]{6,15}$/', $telefon)) {
        } else {
            $chyby[] = 'Telefon může obsahovat pouze čísla a případně + na začátku.';
        }
    }
    if ($vek < 1) {
        $chyby[] = 'Věk musí být mezi 1 a 100.';
    } else {
        if ($vek > 100) {
            $chyby[] = 'Věk musí být mezi 1 a 100.';
        }
    }

    // Pokud nejsou nalezeny žádné chyby, uložíme pojištěnce do modelu
    if (count($chyby) == 0) {
    $model_pojistence->pridej($jmeno, $prijmeni, $telefon, $vek);
    // Vymazání vložených dat z formuláře po odeslání
    $jmeno = '';
    $prijmeni = '';
    $telefon = '';
    $vek = '';
    }
}
// Načtení všech pojištěnců z modelu
$pojistenci = $model_pojistence->vypis();
// Načtení pohledu
require 'pohledy/pojisteni.phtml';