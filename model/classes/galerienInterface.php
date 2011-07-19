<?php

interface galerienInterface
{
	public function _hinzufuegen($galerie);
	public function _setGalerienAnzahl($neuer_zaehler);
	public function _getGalerienAnzahl();
	public function _ausgeben();
}

?>