<?php

interface bildformateInterface
{
	public function _hinzufuegen($bildformat);
	public function _setBildFormateAnzahl($neuer_zaehler);
	public function _getBildFormateAnzahl();
	public function _ausgeben();
}

?>