<?php
class pdf_bestellung extends FPDF {

	private $titel;

    public function createTable($header,$data) {
        // Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(90, 20, 20, 50);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0;
        foreach($data as $row) {
            $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row[1], 'LR', 0, 'R', $fill);
            $this->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, $row[3], 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill=!$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }
    
	//Kopfzeile
	public function Header()
	{
	    //Logo
	   	$this->Image('./view/images/logo.jpg', 10, 7, 33);
	    //Arial fett 15
	    $this->SetFont('Arial', 'B', 12);
	    //nach rechts gehen
	    $this->Cell(35);
	    //Titel
	    $this->Cell(30, 10, $this->titel, 0, 0,'L');
	    //Zeilenumbruch
	    $this->Ln(20);
	}
	
	//Fusszeile
	public function Footer()
	{
	    //Position 1,5 cm von unten
	    $this->SetY(-15);
	    //Arial kursiv 8
	    $this->SetFont('Arial','I',8);
	    //Seitenzahl
	    $this->Cell(0,10,'Seite '.$this->PageNo().'/{nb}',0,0,'C');
	}
	
	public function _setTitel($titel)
	{
		$this->titel = $titel;
	}

}
?>