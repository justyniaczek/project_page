<?php

	session_start();
	
	$db= new PDO('mysql:host=localhost; dbname=schema_suculent_shop','root','');
	$id= $_SESSION['id'];
	$email = $_SESSION['email'];

	require "fpdf.php";
	
	class myPDF extends FPDF{
		function header(){
		$this->SetFont('Times', 'B', 14);
		$this-> Cell(276,5,'Bilet na zlot milosnikow sukulentow',0,0,'C');
		$this-> Ln();
		$this->SetFont('Times','',15);
		$this->Cell(276,10,'Dziekujemy za zainteresowanie',0,0,'C');
		$this->Ln(20);
		}
		function footer(){
			$this->SetY(-15);
			$this->SetFont('Times','',8);
		$this->Cell(0,10,'page'.$this->PageNo().'/{nb}',0,0,'C');
		
			
		}
		function headerTable(){
		
			$this->Cell(55,10,'imie', 1,0,'C');
			$this->Cell(55,10,'nazwisko', 1,0,'C');
			
			$this->Cell(55,10,'email', 1,0,'C');
			$this->Cell(55,10,'adres', 1,0,'C');
			$this->Cell(55,10,'adres2', 1,0,'C');
			$this->Ln();
		}
		function viewTable($db){
			$this->SetFont('Times','',10);
			$stmt = $db->query("select * from customers WHERE id=$_SESSION[id]");
			while($data = $stmt->fetch(PDO::FETCH_OBJ)){
			$this->Cell(55,10,$data->first_name,1,0,'C');
			$this->Cell(55,10,$data->second_name,1,0,'C');

			$this->Cell(55,10,$data->email,1,0,'C');
			$this->Cell(55,10,$data->adress,1,0,'C');
			$this->Cell(55,10,$data->adress2,1,0,'C');
			$this->Ln();}
			
			
			
		}
		
	}
	$pdf = new myPDF();
	$pdf -> AliasNbPages();
	$pdf->AddPage('L','A4', 0);
	$pdf->headerTable();
	$pdf->viewTable($db);
	$pdf->Output();



?>