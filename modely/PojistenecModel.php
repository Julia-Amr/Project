<?php
class PojistenecModel {
    /**
    * Inicializace session pole
    */
    public function __construct() {
        if (!isset($_SESSION['pojistenci'])) {
            $_SESSION['pojistenci'] = [];
        }
    }
    /**
	 * Přidání nového pojištěnce
	 * @param string $jmeno Jméno pojištěnce
     * @param string $prijmeni Přijmení pojištěnce
     * @param string $telefon Telefon pojištěnce
     * @param int $vek Věk pojištěnce
	 */
    public function pridej(string $jmeno, string $prijmeni, string $telefon, int $vek): void {
        $_SESSION['pojistenci'][] = [
            'cele_jmeno' => htmlspecialchars($jmeno . ' ' . $prijmeni),
            'telefon' => htmlspecialchars($telefon),
            'vek' => $vek
        ];
    }
    /**
     * Vrátí všechny pojištěnce
     */
    public function vypis(): array {
        return $_SESSION['pojistenci'];
    }
}