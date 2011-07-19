<?php

interface papierformateInterface
{
	public function _hinzufuegen($papierformat);
	public function _setPapierFormateAnzahl($neuer_zaehler);
	public function _getPapierFormateAnzahl();
	public function _ausgeben();
}

?>