<?php
//============================================================+
// File name   : example_011.php
// Begin       : 2008-03-04
// Last Update : 2008-05-28
// 
// Description : Example 011 for TCPDF class
//               Colored Table
// 
// Author: Nicola Asuni
// 
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com s.r.l.
//               Via Della Pace, 11
//               09044 Quartucciu (CA)
//               ITALY
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Colored Table
 * @author Nicola Asuni
 * @copyright 2004-2008 Nicola Asuni - Tecnick.com S.r.l (www.tecnick.com) Via Della Pace, 11 - 09044 - Quartucciu (CA) - ITALY - www.tecnick.com - info@tecnick.com
 * @link http://tcpdf.org
 * @license http://www.gnu.org/copyleft/lesser.html LGPL
 * @since 2008-03-04
 */

require_once('../config/lang/eng.php');
require_once('../tcpdf.php');

// extend TCPF with custom functions
class MYPDF extends TCPDF {
	
	//Load table data from file
	public function LoadData($file) {
		//Read file lines
		$lines=file($file);
		$data=array();
		foreach($lines as $line)
		$data[]=explode(';',chop($line));
		return $data;
	}
	
	//Colored table
	public function ColoredTable($header,$data) {
		//Colors, line width and bold font
		$this->SetFillColor(255,0,0);
		$this->SetTextColor(255);
		$this->SetDrawColor(128,0,0);
		$this->SetLineWidth(.3);
		$this->SetFont('','B');
		//Header
		$w=array(40,35,40,45);
		for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],7,$header[$i],1,0,'C',1);
		$this->Ln();
		//Color and font restoration
		$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);
		$this->SetFont('');
		//Data
		$fill=0;
		foreach($data as $row) {
			$this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
			$this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
			$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
			$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
			$this->Ln();
			$fill=!$fill;
		}
		$this->Cell(array_sum($w),0,'','T');
	}
}

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
$header=array('Country','Capital','Area (sq km)','Pop. (thousands)');

//Data loading
$data=$pdf->LoadData('../cache/table_data_demo.txt');

// print colored table
$pdf->ColoredTable($header,$data);

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output("example_011.pdf", "I");

//============================================================+
// END OF FILE                                                 
//============================================================+
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link rel="STYLESHEET" href="reports.css" type="text/css" />
</head>

<body>

<div id="body">

<div id="section_header">
</div>

<div id="content">
  
<div class="page" style="font-size: 7pt">
<table style="width: 100%;" class="header">
<tr>
<td class="logo"></td>
<td style="text-align: right"><strong>Report:</strong> Statement</td>
</tr>
</table>

<table style="width: 100%; font-size: 8pt;">
<tr>
<td>Created On: <strong><?=date('d/m/Y h:i')?></strong></td>
<td>Created For: <strong><?=$ta['ANM']?></strong></td>
</tr>

<tr>
<td>Start Date: <strong><?=$gd['sdt'].' '.$gd['stm']?></strong></td>
<td>End Date: <strong><?=$gd['edt'].' '.$gd['etm']?></strong></td>
</tr>

<tr>
<td>Requested By: <strong><?=$us['ONM']?></strong></td>
<td>Role: <strong><?=$us['GNM']?></strong></td>
</tr>
</table>

<table style="width: 100%; border-top: 1px solid black; border-bottom: 1px solid black; font-size: 8pt;">

<tr>
<td>Account No: <strong><?=$ta['ANO']?></strong></td>
<td>Currency: <strong><?=$ta['CSC']?></strong></td>
<td>Credit Cap: <strong><?=$ta['CCP']?></strong></td>
<td>Debit Cap: <strong><?=$ta['DCP']?></strong></td>

</tr>
<tr>
<td>Account Bal: <strong><?=$ta['CBL']?></strong></td>
<td>Tot. Inclearing: <strong><?=$ta['TIC']?></strong></td>
<td>Total Debit: <strong><?=$ta['TDB']?></strong></td>
<td>Actual Bal: <strong><?=$ta['ABL']?></strong></td>
</tr>

</table>

<table class="change_order_items">

<tr><td colspan="8"><h2>Statement (<?=($rrc.' Operations')?>):</h2></td></tr>

<tbody>
<tr>
<th class="stmt">No</th>
<th class="stmt">Date Time</th>
<th class="stmt">Operation</th>
<th class="stmt">Ref. No</th>
<th class="stmt">Credit</th>
<th class="stmt">Debit</th>
<th class="stmt">Balance</th>
<th class="stmt">Remarks</th>
</tr>
<?php
	$s = $sd[0];
	$bb = $s['CBL']-$s['CRA']+$s['DBA'];
?>
<tr class="odd_row">
<td class="stmttext">&nbsp;</td>
<td class="stmttext"><u><b><?=$s['TDT']?></b></u></td>
<td class="stmttext" colspan="4"><u><b>Balance Before</b></u></td>
<td class="stmtmoney"><u><b><?=number_format($bb,2,'.',',')?></b></u></td>
<td class="stmttext">&nbsp;</td>
</tr>
<?php
$i=0;$c=0;$d=0;$b=0;
foreach($sd as $k=>$v){
	$i++;
	//$row = $v
	$rowclass = ($i%2==0) ? 'even_row':'odd_row';
?>
<tr class="<?=$rowclass?>">
<td class="stmtmoney"><?=$i?></td>
<td class="stmttext"><?=$v['TDT']?></td>
<td class="stmttext"><?=$v['DNM']?></td>
<td class="stmttext"><?=$v['RNO']?></td>
<td class="stmtmoney"><?=number_format($v['CRA'],2,'.',',')?></td>
<td class="stmtmoney"><?=number_format($v['DBA'],2,'.',',')?></td>
<td class="stmtmoney"><?=number_format($v['CBL'],2,'.',',')?></td>
<td class="stmttext"><?=$v['DSC']?></td>
</tr>
<?php
$c+=$v['CRA'];
$d+=$v['DBA'];
$b =$v['CBL'];
}
?>
<tr>
<td colspan="4" class="stmttext"><strong>TOTALS:</strong></td>
<td class="change_order_total_col"><strong><?=$c?></strong></td>
<td class="change_order_total_col"><strong>-<?=$d?></strong></td>
<td class="change_order_total_col"><strong><?=$b?></strong></td>
<td class="change_order_total_col"><strong>&nbsp;</strong></td>
</tr>

</tbody>




</table>

<table class="sa_signature_box" style="border-top: 1px solid black; padding-top: 2em; margin-top: 2em;">
<!--
  <tr>    
    <td>WITNESS:</td><td class="written_field" style="padding-left: 2.5in">&nbsp;</td>
    <td style="padding-left: 1em">PURCHASER:</td><td class="written_field" style="padding-left: 2.5in; text-align: right;">X</td>
  </tr>
  <tr>
    <td colspan="3" style="padding-top: 0em">&nbsp;</td>
    <td style="text-align: center; padding-top: 0em;">Mr. Leland Palmer</td>
  </tr>
-->
<tr><td colspan="4" style="white-space: normal">
Please note that your actual balance is the totals of this statement and that of In-Clearing transactions. 
Also not that In-clearing transactions shall only be processed upon payment
</td>
</tr>

<tr>
<td colspan="2">ACCEPTED THIS
<span class="written_field" style="padding-left: 4em">&nbsp;</span>
DAY OF <span class="written_field" style="padding-left: 8em;">&nbsp;</span>, 
20<span class="written_field" style="padding-left: 4em">&nbsp;</span>.
</td>

<td colspan="2" style="padding-left: 1em;">MONEY SYSTEMS INTERNATIONAL.<br/><br/>
PER: 
<span class="written_field" style="padding-left: 2.5in">&nbsp;</span>
</td>
</tr>
</table>

</div>

</div>
</div>

<script type="text/php">

if ( isset($pdf) ) {

  $font = Font_Metrics::get_font("verdana");;
  $size = 6;
  $color = array(0,0,0);
  $text_height = Font_Metrics::get_font_height($font, $size);

  $foot = $pdf->open_object();
  
  $w = $pdf->get_width();
  $h = $pdf->get_height();

  // Draw a line along the bottom
  $y = $h - 2 * $text_height - 24;
  $pdf->line(16, $y, $w - 16, $y, $color, 1);

  $y += $text_height;

  $text = "Ref: 132-003";
  $pdf->text(16, $y, $text, $font, $size, $color);

  $pdf->close_object();
  $pdf->add_object($foot, "all");

  global $initials;
  $initials = $pdf->open_object();
  
  // Add an initals box
  $text = "Code:";
  $width = Font_Metrics::get_text_width($text, $font, $size);
  $pdf->text($w - 16 - $width - 38, $y, $text, $font, $size, $color);
  $pdf->rectangle($w - 16 - 36, $y - 2, 36, $text_height + 4, array(0.5,0.5,0.5), 0.5);
    

  $pdf->close_object();
  $pdf->add_object($initials);
 
  // Mark the document as a duplicate
  //$pdf->text(110, $h - 240, "DUPLICATE", Font_Metrics::get_font("verdana", "bold"),
  //           110, array(0.85, 0.85, 0.85), 0, -52);

  // Watermark the document header
  $pdf->text(210, 30, "MONEY SYSTEMS CASH TRANSFER", Font_Metrics::get_font("verdana", "bold"),
             10, array(0.85, 0.85, 0.85), 0, 0);

  $text = "Page {PAGE_NUM} of {PAGE_COUNT}";  

  // Center the text
  $width = Font_Metrics::get_text_width("Page 1 of 2", $font, $size);
  $pdf->page_text($w / 2 - $width / 2, $y, $text, $font, $size, $color);
  
}
</script>

</body>
</html>