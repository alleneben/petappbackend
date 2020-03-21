<?php
$grd=$_SESSION['grd'];
$usr=isset($_SESSION['us'])&&$_SESSION['us']['rid']>0?$_SESSION['us']['onm'].' '.$_SESSION['us']['snm']:'Customer';
$_SESSION['printusr']=$usr; 
$dtl = json_decode($grd['dtl'],true);
$d = "";
foreach($dtl as $n=>$v){
	$d.=$n.'='.$v.'::';
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link rel="STYLESHEET" href="skyfoxreports.css" type="text/css" />
</head>

<body>

<div id="body">

<div id="section_header"></div>

<div id="content">
  
<div class="page" style="font-size: 7pt">
<table style="width: 100%;" class="header">
<tr>
<td class="logo">&nbsp;</td>
<td><h1 style="text-align: center">Payment Receipt</td>
<td><h3 style="text-align: right">REF NO: <?php echo $grd['tki'] ?></h3></td>
</tr>
</table>

<table style="width: 100%; border-bottom: 1px solid black; font-size: 8pt;">
<tr>
<td>Card ID: <strong><?php echo $grd['cid'] ?></strong></td>
<td>Date: <strong><?php echo date('j M Y');?></strong></td>
</tr>
</table>

<table class="change_order_items">
<tr><td colspan="6"><h2>Service Order:</h2></td></tr>
<tbody>
<tr>
<th>Type</th>
<th>Recipient</th>
<th>Amount Paid</th>
<th>Taxes/Comm</th>
<th>Subtotal</th>
<th>Remarks</th>
</tr>
<!--
<tr class="even_row">
<td style="text-align: center">1</td>
<td>Money Transfer from UK to Ghana</td>
<td style="text-align: center">30 GBP</td>
<td style="text-align: center">3.00</td>
<td style="text-align: center">1.613</td>
<td style="text-align: center">48.80</td>
</tr>
-->
<tr class="odd_row">
<td style="text-align: center"><?=$grd['pty']?></td>
<td style="text-align: center"><?=$grd['snm']?></td>
<td style="text-align: center"><?=$grd['amt'].' '.$grd['cur']?></td>
<td style="text-align: center"><?=$grd['com'].' '.$grd['cur']?></td>
<td style="text-align: center"><?=($grd['amt']+$grd['com']).' '.$grd['cur']?></td>
<td style="text-align: center"><?=rtrim($d,'::')?></td>
</tr>
</tbody>

<tr>
<td colspan="3" style="text-align: right;">Terms and Conditions: <font size='small'>Wrong Payments are not refundable but may be reusable</font></td>
<td colspan="2" style="text-align: right;"><strong>GRAND TOTAL:</strong></td>
<td class="change_order_total_col"><strong><?php echo $grd['amt'].' '.$grd['cur']; ?> <?php echo $grd['suc']; ?></strong></td></tr>
</table>
<table class="sa_signature_box" style="border-top: 1px solid black; padding-top: .2em; margin-top: .2em;">
	<tr><td colspan="4" style="white-space: normal"><b>DISCLAIMER: </b>
	Any change or special request not noted on this document is not contractual.
	</td>
	</tr>
<tr>
<td colspan="2"><span>&nbsp;</span></td>
<td colspan="2" style="padding-left: 1em;">SKYFOX LIMITED.</td>
</tr>
</table>

<table style="width: 100%; border-top: 1px solid black; border-bottom: 1px solid black; font-size: 8pt;">

<tr>
<td><strong>Address: </strong>127 Nii Oti St, Asylum Down</td>
<td><strong>Location: </strong>B/n FedEx and CPP HQ</td>
<td><strong>Hotline: </strong>+233-(0)21-SKYFOX</td>
<td><strong>Email: </strong>info@skyfox.com.gh</td>
</tr>

</table>

</div>

<!-- <div class="cutter"><img src="blank.gif" class="scissors"><img src="blank.gif" class="dashes"></div> -->
<div class="cutter">
	<table style="width: 100%;">
	<tr>
	<td class="scissors">&nbsp;</td>
	<td class="dashes">&nbsp;</td>
	</tr>
	</table>
</div>


</div>
</div>

<script type="text/php">
$refno = $_SESSION['grd']['gti'];
//$usr = $_SESSION['usr'];
if ( isset($pdf) ) {

  $font = Font_Metrics::get_font("helvetica");;
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

  $text = "Ref: ".$refno;
  $pdf->text(16, $y, $text, $font, $size, $color);

  $pdf->close_object();
  $pdf->add_object($foot, "all");

  global $initials;
  $initials = $pdf->open_object();
  
  // Add an initals box
  $text = "Auth Code:";
  $width = Font_Metrics::get_text_width($text, $font, $size);
  $pdf->text($w - 16 - $width - 38, $y, $text, $font, $size, $color);
  $pdf->rectangle($w - 16 - 36, $y - 2, 36, $text_height + 4, array(0.5,0.5,0.5), 0.5);
    

  $pdf->close_object();
  $pdf->add_object($initials);
 
  // Mark the document as a duplicate
  //$pdf->text(110, 220, "SKYFOX", Font_Metrics::get_font("helvetica", "bold"),
  //           110, array(0.85, 0.85, 0.85), 0, -30);

  // Mark the document with stamp
  $pdf->text(400, 240, "SKYFOX", Font_Metrics::get_font("helvetica", "bold"),
             30, array(0.85, 0.85, 0.85), 0, -20);

  
  $text = "Page {PAGE_NUM} of {PAGE_COUNT}";  

  // Center the text
  $width = Font_Metrics::get_text_width("Page 01 of 02", $font, $size);
  $pdf->page_text($w / 2 - $width / 2, $y, $text, $font, $size, $color);
  
}
</script>

</body>
</html>