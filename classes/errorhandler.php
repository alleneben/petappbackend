<?php
	class ErrorHandler 
	{
		/*en Error Number*/
		/*et Error Title*/
		/*em Error Message*/
		/*es Error Severity*/
		/*ed Error Data*/

		static function Interpret(ErrorException $ee, $es=2)
		{
			$en=abs($ee->getCode());
			//$es=2;
			$ets = array(1=>'Invalid Property',2=>'Invalid Property Value',3=>'Invalid Image Verification',
						 4=>'Invalid Session',5=>'Invalid Page Request',6=>'Invalid Service Request',
						 7=>'Invalid Password',8=>'Mandatory Field',9=>'Record not found',
						 10=>'Session Expired',11=>'Image Upload Notice',12=>'File Upload Error',
						 13=>'System Configuration Notice',14=>'Logo Upload Error',15=>'Data Input Notice',
						 16=>'Staff Registration Notice',25=>'Data Input Notice');
			
			$grp = $en==1||$en==2?1:$ets[$en]==''?2:3;
			switch($grp)
			{
				case 1://Assignment to non-existent class property
					$et="Invalid Property";
				    $em="Property ".$ee->getMessage()." does not exist";
				    break;
				case 2://Assignment to non-existent class property
					$et="Invalid Property Value";
				    $em="Property ".$ee->getMessage()." is empty";
				    break;
				case 3://Image Verification failure
					$et=$ets[$en];
				    $em=$ee->getMessage();
				    break;
				    
				case 9://Record not found
					$et=$ets[$en];
				    $em=$ee->getMessage(). "<br>Make sure you enter the correct information and try again";
				    break;
				case 10://Session Expired
					$et=$ets[$en];
				    $em=$ee->getMessage(). "<br>Please clear your cache and login again";
				    break;			 
				case 11://Image Upload Notice
					$et=$ets[$en];
				    $em=$ee->getMessage(). "<br>Please check the size and format and try again";
				    break;				       
				case 13://System Configuration Notice
					$et=$ets[$en];
				    $em=$ee->getMessage(). "<br>Please contact system administrator";
				    break;
				
				case 16://Staff Registration
					$et='Data input Error';//$ets[$en];
				    $em=$ee->getMessage();
				    break;  
				 case 17://Staff Registration
				  	$et='Data input Error';//$ets[$en];
				   	$em=$ee->getMessage();
				   	break;
				case 25://System Configuration Notice
					$et=$ets[$en];
				    $em=$ee->getMessage(). "<br\>Please check the information entered and try again";
				    break;
				    
				default:
					$et="Application Error";
					$en=$ee->getCode();
				    $em=$ee->getMessage();
				    break;
			}
			
			$em=$em."<br>"; //Leave a line before error no.http://www.slb.com/services/software/reseng.aspx
			$en='200'.$en;
			return ErrorHandler::OutputError($en,$et,$em,$es);
		}
		
		Public static function OutputError($en,$et,$em,$es) {
			
			$jmsg = json_encode(array(array("failure"=>"true","en"=>$en,"et"=>$et,"em"=>$em,"es"=>$es,"cod"=>0,"msg"=>strip_tags($em))));
			
			if($es==0) {
				//error_log("in_outPutError::".$jmsg);
				return json_encode(array(array("failure"=>"true","en"=>$en,"et"=>$et,"em"=>$em,"es"=>$es,"cod"=>0,"msg"=>strip_tags($em))));
			}
			else {
				echo json_encode(array(array("failure"=>"true","en"=>$en,"et"=>$et,"em"=>$em,"es"=>$es)));
				//error_log("Non WS Error: ".$em);
				exit;
			}
						
		}
		
		static function InterpretADODB(ADODB_Exception $ee, $es=1)
		{
			$en=abs($ee->getCode());
			$em = $ee->getMessage();
			$et = 'System Administration: Database Messages';
			//$es = 1;
			$match = array();
			
			$uexp='/::DBERR\-(\d+)::(.*)::/s';
			//$cexp='/ERROR:(.*)\"([a-z]+)_uk1\"/';
			//$pexp='/ERROR:(.*)\"([a-z]+)_([pkey])\"/';
			//$fexp='/ERROR:(.*)\"([a-z]+)_([a-z_]*)([fkey1])\"/';
			$gexp='/ERROR:(.*)CONTEXT:/s';
			//primary key constraints check(pkey_tab_col)
			$pexp='/ERROR:(.*)\"pkey_([a-z]+)_([a-z]+)\"/';
			//foreign key constraints check(fkey_tab_col)
			$fexp='/ERROR:(.*)\"fkey_([a-z]+)_([a-z]+)\"/';
			//validity check(chek_tab_col)
			$vexp='/ERROR:(.*)\"chek_([a-z]+)_([a-z]+)\"/';
			//unique constraints check(uidx_tab_col_col2_col3)
			$cex1='/ERROR:(.*)\"uniq_([a-z]+)_([a-z]+)\"/';
			$cex2='/ERROR:(.*)\"uniq_([a-z]+)_([a-z]+)_([a-z]+)\"/';
			$cex3='/ERROR:(.*)\"uniq_([a-z]+)_([a-z]+)_([a-z]+)_([a-z]+)\"/';
			$cex4='/ERROR:(.*)\"uniq_([a-z]+)_([a-z]+)_([a-z]+)_([a-z]+)_([a-z]+)\"/';
			if(preg_match($uexp,$em,$match)){
	    		 $en=abs($match[1]);
	    		 $et="Data Request Messages";	    		 
	    		 switch($en)
	    		 {
	    		 	case 21://No student record found for this Exam No
	    		 		$et="Student Registration Message";
	    		 		$match[2]="We cannot find any student with the number provided";
	    		 		$em=$match[2]."<br> Please make sure you enter the correct student number and try again<br>
	    		 						Your Number should be in <b>CAPITAL LETTERS</b> and without <b>spaces</b>";
	    		 		break;
	    		 	case 22://You have already registered
	    		 		$et="Student Registration Request";
	    		 		$em=$match[2]."<br> Please contact your examination officer if this is not the academic year you are registering for";
	    		 		break;
	    		 	
    		 		case 24://You have already registered
    		 			$et="Student Registration Request";
    		 			$em=$match[2]."<br> Please note that Refusal to pay the fine will amount to OUTRIGHT DISMISAL";
    		 			break;
    		 		case 23://You have register before taken part in course appraisal
	    		 			$em=$match[2]."<br> Please contact your examination officer immediately in order to avoid further problems";
	    		 			break;
	    		 
	    		 	case 233://Sorry you have incomplete payments
	    		 		$em=$match[2]."<br>Please rectify your payment information with accounts and try again<br>
	    		 				You will not be able to write the examination if you do not rectify your payments";
	    		 		break;
	    		 		 
    		 		case 261://PROMOTION NOT ALLOWED. You cannot promote student beyond its duration
    		 			$em=$match[2]."<br>Please rectify the problem and try again<br>";
    		 			$et='Student Promotion';
    		 			break;
    		 			
    		 		case 271://A NOT ALLOWED. You cannot promote student beyond its duration
    		 				$em=$match[2]."<br>Please change the quantity and try again<br>";
    		 				$et='Candidate Pincode Generation';
    		 				break;
    		 			
    		 		case 300://ACCESS NOT AUTHORIZED. Access denied for officer
    		 				$em=$match[2]." You cannot manage results for the selected program!<br>Your action has been logged. Please choose the programs of which you have been assigned as an officer<br>";
     		 				$et='Examination results';
     		 				//$es=0;
    		 				
    		 			break;
    		 		case 301://INVALID REQUEST. 
    		 					$em=$match[2]."<br>Please validate your options and try again<br>";
    		 					$et='Access: Examination results';
    		 			break;
    		 		case 302://ACCESS NOT AUTHORIZED. Access denied for officer
    		 				$em=$match[2]."<br>Your action has been logged. Please make sure you access information on program you have been assigned to!<br>";
    		 				$et='Access: Examination results';
    		 			break;
    		 			
    		 			case 303://ACCESS NOT AUTHORIZED. Access denied for officer ACCESSING CSV
    		 				$em=$match[2]."<br>Your action has been logged. Please select pdf format and try again if you have read access to these records<br>";
    		 				$et='CSV Access: NABPTEX Report';
    		 				break;
    		 			
    		 		case 400://PROCCESSING DENIED::Only % percent of the records are Available
    		 				$em=$match[2]."<br>Please make sure you have submitted enough results before you proceed<br>";
    		 				$et='Access: Examination results';
    		 			break;
    		 		case 450://No student record found
    		 				$em=$match[2]."<br>Please make sure you have enough information about the student before you proceed<br>";
    		 				$et="Student Trails and Resits";
    		 			break;
    		 				
    		 						
    		 		case 452://Resit has already been registered
    		 			    $em=$match[2]."<br>You can register a resit only once in a semester<br>Please update the results if the respective marks for the course is available<br>";
    		 				$et="Student Trails and Resits";
    		 			break;
    		 			
    		 			case 453://Student resit Resit has already been registered
    		 				$em=$match[2]."<br>For further information please contact your examination officer";
    		 				$et="Self Resit registration";
    		 				break;
    		 							
    				case 454://No grading system set for the program the student is offering
    		 				$em=$match[2]."<br>Please make sure the program is well configured before you proceed<br>";
    		 				$et="Student Trails and Resits";
    		 			break;
    		 			
    		 		case 551://No No student record
    		 				$em=$match[2]." Please make sure you have entered the correct student number and try again<br>";
    		 				$et="Student Online Results Services";
    		 			break;
    		 			
    		 		case 552://No Registration
    		 			$em=$match[2]." Please complete your registration process. come back and try again<br>";
    		 			$et="Student Online Results Services";
    		 			break;
    		 				
    		 		case 601://No Registration
    		 			$em=$match[2]." Email <font color='blue' >admissions@kpoly.edu.gh</font> for any clarification.";
    		 			$et="Student Online Admission and Matriculation Processes";
    		 			break;
    		 			
	    		  	default:
	       		 		$em=$match[2]."  Please Make the neccesary correction and try again";
	    		 		break;
	    		 }
				 return ErrorHandler::OutputError($en,$et,$em,$es);
				 
				 
			}
			
			elseif(preg_match($cex4,$em,$match)){
				$c2=strtoupper($match[2]);$c3=strtoupper($match[3]);$c4=strtoupper($match[4]);$c5=strtoupper($match[5]);$c6=strtoupper($match[6]);
				$err = $c3.' or '.$c4.' or '.$c5.' or '.$c6.' already exists in '.$match[2].' table. Duplicates are not allowed';
				error_log($err);
				$msg='The record you are trying to add already exist. <br>';
				$msg.= 'Duplicates are not allowed. Please correct before sending';
				return ErrorHandler::OutputError($en,$et,$msg,$es);
			}
			elseif(preg_match($cex3,$em,$match)){
				$c2=strtoupper($match[2]);$c3=strtoupper($match[3]);$c4=strtoupper($match[4]);$c5=strtoupper($match[5]);
				$err = $c3.' or '.$c4.' or '.$c5.' already exists in '.$match[2].' table. Duplicates are not allowed';
				error_log($err);
				$msg='The record you are trying to add already exist. <br>';
				$msg.= 'Duplicates are not allowed. Please correct before sending';
				return ErrorHandler::OutputError($en,$et,$msg,$es);
			}
			elseif(preg_match($cex2,$em,$match)){
				$c2=strtoupper($match[2]);$c3=strtoupper($match[3]);$c4=strtoupper($match[4]);
				$err = $c3.'or'.$c4.' already exists in '.$match[2].' table. <br>';
				error_log($err);
				$msg='The record you are trying to add already exist. <br>';
				$msg.= 'Duplicates are not allowed. Please correct before sending';
				return ErrorHandler::OutputError($en,$et,$msg,$es);
			}
			elseif(preg_match($cex1,$em,$match)){
				$c2=strtoupper($match[2]);$c3=strtoupper($match[3]);
				$err = $c3.' provided, already exists in an existing '.$c2.' record. <br>';
				error_log($err);
				$msg='The record you are trying to add already exist. <br>';
				$msg.= 'Duplicates are not allowed. Please correct before sending';
				return ErrorHandler::OutputError($en,$et,$msg,$es);
			}
			
			elseif(preg_match($vexp,$em,$match)){
				 $c2=strtoupper($match[2]);$c3=strtoupper($match[3]);
				 $msg = $c3.' is not valid for a '.$match[2].' record. <br>';
				 $msg.= 'Please correct before sending';
				 return ErrorHandler::OutputError($en,$et,$msg,$es);
			}
			elseif(preg_match($fexp,$em,$match)){
				 $c2=strtoupper($match[2]);$c3=strtoupper($match[3]);
				 $msg = 'A value associated with '. $c3.' cannot be found in '.$match[2].' table. <br>';
				 $msg.= 'Please correct before sending';
				 return ErrorHandler::OutputError($en,$et,$msg,$es);
			}
			elseif(preg_match($pexp,$em,$match)){
				 $c2=strtoupper($match[2]);$c3=strtoupper($match[3]);
				 $msg = 'A record with the same index already exists. <br>';
				 $msg.= 'Duplicates are not allowed';
				 return ErrorHandler::OutputError($en,$et,$msg,$es);
			}
			//
			elseif(preg_match($gexp,$em,$match)){
				 //errorlog($em) TODO
				 $app = 'An unusual error occured.<br>';
				 $app.= 'Please notify the Administrator with the Error Message below. <br>';
				 $msg = $app.'<br>'.$match[1];
				 return ErrorHandler::OutputError($en,$et,$msg,$es);
			}
			else{
				error_log($em);
				return ErrorHandler::OutputError($en,$et,$em,$es);	
			}
		}
		
		static function InterpretDOMPDF(DOMPDF_Exception $ee)
		{
			$en = $ee->getCode();
			$em = $ee->getMessage();
			$et = 'PDF Printing Message';
			$es = 3;
			return ErrorHandler::OutputError($en,$et,$em,$es);
		}
		
		static function InterpretSMSGW(Smsgh_ApiException $ee)
		{
			$en = $ee->getCode();
			$em = $ee->getMessage();
			$et = 'SMS SENDING ERROR';
			$es = 3;
			return ErrorHandler::OutputError($en,$et,$em,$es);
		}
		
		static public function ValidateUserSession(&$userid)
		{
					
			if(!(isset($userid) && is_numeric($userid))) 
			{
				throw new ErrorException("Your Session has expired",10,3);
			}
		}
		
		static public function ValidateMandatoryFieldsSP(&$props,$fields)
		{
			$rslt="";
						
			foreach($fields as $field)
			{
				
				if(is_numeric($props[$field])) continue; 
				elseif(!isset($props[$field]) ||  is_null($props[$field]) || $props[$field]=='NULL' || strlen($props[$field])==0)
				{
					$rslt.= strlen($rslt)==0?"$field":", $field";
				}	
			}
					
			if (strlen($rslt) > 0)
			{
				$rslt=strtoupper($rslt);
				$semsg ="The mandatory field $rslt is required";
				$memsg ="The mandatory fields $rslt are required";
				$emsg = count(explode($rslt,','))>1 ? $memsg : $semsg; 
				throw new ErrorException("$emsg",8,1);
			}	
		}

		static public function ValidateMandatoryFields(&$props,&$userid,$fields)
		{
					
			ErrorHandler::ValidateUserSession($userid);
			ErrorHandler::ValidateMandatoryFieldsSP($props,$fields);
		}
		
	}

?>
