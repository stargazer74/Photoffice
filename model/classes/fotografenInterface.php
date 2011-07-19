<?php

interface fotografenInterface
{
	public function _hinzufuegen($fotograf);
	public function _setFotografenAnzahl($neuer_zaehler);
	public function _getFotografenAnzahl();
	public function _ausgeben();
}

?>