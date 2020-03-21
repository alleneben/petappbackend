<?php
$auth=new Authenticate();
$urs=$auth->BasicUserData();
$urd= json_decode($urs,true);
if(!(isset($urd['success'])&&is_array($urd['sd']))){
	echo $urs; exit;
}
$usd=$urd['sd'];

$gd = $_SESSION['grd'];
$gd['sdt']=isset($gd['sdt'])?$gd['sdt']:date('d-m-Y');
$gd['edt']=isset($gd['edt'])?$gd['edt']:date('d-m-Y');
$gd['stm']=isset($gd['stm'])?$gd['stm']:'00:00';
$gd['etm']=isset($gd['etm'])?$gd['etm']:'23:59';
			
$tac=new TransactionAccount();
$ars=$tac->Find(json_encode(array("tai"=>$gd['tai'],"mod"=>1)));
$ard= json_decode($ars,true);
if(!(isset($ard['success'])&&is_array($ard['sd']))){
	echo $ars; exit;
}
$asd=$ard['sd'][0];

$rep=new Report();
$rrs = $rep->AccountStatement(json_encode(array(
					 "tai"=>$gd['tai']
					,"sdt"=>$gd['sdt']
					,"edt"=>$gd['edt']
					,"stm"=>$gd['stm']
					,"etm"=>$gd['etm'])));
$rrd= json_decode($rrs,true);
if(!(isset($rrd['success'])&&is_array($rrd['sd']))){
	echo $rrs; exit;
}
$rrc = $rrd['rec'];
$rsd = $rrd['sd'];
$met = $rrc*3;
ini_set('max_execution_time',$met);
//$gd['sdt']=isset($gd['sdt'])?$gd['sdt']:'N/A';
//$gd['edt']=isset($gd['edt'])?$gd['edt']:'N/A';
//$gd['stm']=isset($gd['sdt'])?$gd['sdt']:'N/A';
//$gd['edt']=isset($gd['edt'])?$gd['edt']:'N/A';


$gd['sdt']=isset($gd['sdt'])?$gd['sdt']:'N/A';
$gd['edt']=isset($gd['edt'])?$gd['edt']:'N/A';
//$gd['rrc']=$rrc;
$sd = $rsd;
$us = $usd; 
$ta = $asd;


// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true); 

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor("Nicola Asuni");
$pdf->SetTitle("TCPDF Example 011");
$pdf->SetSubject("TCPDF Tutorial");
$pdf->SetKeywords("TCPDF, PDF, example, test, guide");

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 

//set some language-dependent strings
$pdf->setLanguageArray($l); 

//initialize document
$pdf->AliasNbPages();

// add a page
$pdf->AddPage();

// ---------------------------------------------------------

// set font
$pdf->SetFont("dejavusans", "", 12);

//Column titles
//$header=array('Country','Capital','Area (sq km)','Pop. (thousands)');
$header=array('No','Date Time','Operation','Ref. No','Credit','Debit','Balance','Remarks');

//Data loading
//$data=$pdf->LoadData('../cache/table_data_demo.txt');

// print colored table
//$pdf->ColoredTable($header,$sd);
//Colors, line width and bold font
	$this->SetFillColor(255,0,0);
	$this->SetTextColor(255);
	$this->SetDrawColor(128,0,0);
	$this->SetLineWidth(.3);
	$this->SetFont('','B');
	//Header
	$w=array(10,35,40,35,30,30,30,45);
	//for($i=0;$i<count($header);$i++)
	//$this->Cell($w[$i],7,$header[$i],1,0,'C',1);
	$this->Cell($w[0],6,'No','LR',0,'L',$fill);
	$this->Cell($w[1],6,'Date Time','LR',0,'L',$fill);
	$this->Cell($w[2],6,'Operation','LR',0,'L',$fill);
	$this->Cell($w[3],6,'Ref. No','LR',0,'L',$fill);
	$this->Cell($w[4],6,'Credit','LR',0,'R',$fill);
	$this->Cell($w[5],6,'Debit','LR',0,'R',$fill);
	$this->Cell($w[6],6,'Balance','LR',0,'R',$fill);
	$this->Cell($w[7],6,'Remarks','LR',0,'L',$fill);
		
	$this->Ln();
	//Color and font restoration
	$this->SetFillColor(224,235,255);
	$this->SetTextColor(0);
	$this->SetFont('');
	//Data
	$fill=0;
	
	foreach($sd as $row) {
		$this->Cell($w[0],6,'001','LR',0,'L',$fill);
		$this->Cell($w[1],6,$row['TDT'],'LR',0,'L',$fill);
		$this->Cell($w[2],6,$row['DNM'],'LR',0,'L',$fill);
		$this->Cell($w[3],6,$row['RNO'],'LR',0,'L',$fill);
		$this->Cell($w[4],6,number_format($row['CRA']),'LR',0,'R',$fill);
		$this->Cell($w[5],6,number_format($row['DBA']),'LR',0,'R',$fill);
		$this->Cell($w[6],6,number_format($row['CBL']),'LR',0,'R',$fill);
		$this->Cell($w[7],6,$row['DSC'],'LR',0,'L',$fill);
		$this->Ln();
		$fill=!$fill;
	}
	$this->Cell(array_sum($w),0,'','T');
// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output("statement.pdf", "I");

?>