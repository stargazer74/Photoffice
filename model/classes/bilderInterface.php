<?php

interface bilderInterface
{
	public function _hinzufuegen($bild);
	public function _setBilderAnzahl($neuer_zaehler);
	public function _getBilderAnzahl();
	public function _ausgeben();
}

?>