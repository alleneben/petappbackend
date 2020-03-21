<?php
$pd = $_SESSION['psd'];//payment
$ud = $_SESSION['usd'];//user
$sd = $_SESSION['ssd'];//subscriber
$cd = $_SESSION['csd'];//client
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
<td>Created For: <strong><?=$sd['nam']?></strong></td>
</tr>

<tr>
<td>Start Date: <strong><?=$cd['sdt']?></strong></td>
<td>End Date: <strong><?=$cd['edt']?></strong></td>
</tr>

<tr>
<td>Requested By: <strong><?=$ud['onm'].' '.$ud['snm'].' ('.$ud['enm'].')'?></strong></td>
<td>Role: <strong><?=$ud['rnm']?></strong></td>
</tr>
</table>


<table class="change_order_items">

<tr><td colspan="6"><h2>Payments:</h2></td></tr>

<tbody>
<tr>
<th class="stmt">Date</th>
<th class="stmt">Ref. No</th>
<th class="stmt">Type</th>
<th class="stmt">Status</th>
<th class="stmt">Amount</th>
<th class="stmt">Details</th>
</tr>
<?php
$c=0;$d=0;$b=0;$a='';$i=0;
$sts = array(0=>'Processed',1=>'Pending',2=>'Requested',3=>'Received');
foreach($pd as $k=>$v){
	$i++;
	//$row = $v
	$rowclass = ($i%2==0) ? 'even_row':'odd_row';
	//$si=$v['sts'];
	//$st = ($si==0)?'Processed':($si==1)?'Pending':$si==2?'Requested':$si==3?'Received':$si;
	$st = $sts[$v['sts']];
	$b+=$v['amt'];$a=$v['cuc'];
	$amt = $v['amt'].$v['cuc'];
	$dtl = implode(json_decode($v['dtl'],true),'::');
?>
<tr class="<?=$rowclass?>">
<td class="stmttext"><?=$v['pdt']?></td>
<td class="stmttext"><?=$v['tki']?></td>
<td class="stmttext"><?=$v['pty']?></td>
<td class="stmttext"><?=$st.$si?></td>
<td class="stmtmoney"><?=$amt?></td>
<!--<td class="stmtmoney"><?=$b?></td>-->
<td class="stmttext"><?=$dtl?></td>
</tr>
<?php
//$c+=$v['CRA'];
//$d+=$v['DBA'];
//$b =$v['ABL'];
}
?>
<tr>
<td colspan="4" class="stmttext"><strong>TOTALS:</strong></td>
<!--<td class="change_order_total_col"><strong>-<?=$d?></strong></td>-->
<td class="change_order_total_col"><strong><?=$b.$a?></strong></td>
<td class="change_order_total_col"><strong>&nbsp;</strong></td>
</tr>

</tbody>




</table>

<table style="width: 100%; border-top: 1px solid black; border-bottom: 1px solid black; font-size: 8pt;">

<tr>
<td>Account No: <strong><?=$sd['ban']?></strong></td>
<td>Bank Name: <strong><?=$sd['bno']?></strong></td>
<td>Bank Branch: <strong><?=$sd['bbh']?></strong></td>
<td>Phone: <strong><?=$sd['ct1']?></strong></td>
</tr>
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
Please note that monies acrued to you are only transferred upon request.
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
  $pdf->text(210, 30, "SKYFOX CASHLESS PAYMENT SYSTEM", Font_Metrics::get_font("verdana", "bold"),
             10, array(0.85, 0.85, 0.85), 0, 0);

  $text = "Page {PAGE_NUM} of {PAGE_COUNT}";  

  // Center the text
  $width = Font_Metrics::get_text_width("Page 1 of 2", $font, $size);
  $pdf->page_text($w / 2 - $width / 2, $y, $text, $font, $size, $color);
  
}
</script>

</body>
</html>