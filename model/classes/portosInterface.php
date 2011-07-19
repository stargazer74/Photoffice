<?php

interface portosInterface
{
	public function _hinzufuegen($porto);
	public function _setPortosAnzahl($neuer_zaehler);
	public function _getPortosAnzahl();
	public function _ausgeben();
}

?>