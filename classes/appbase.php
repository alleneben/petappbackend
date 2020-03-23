<?php
	class AppBase{

		//private variables definition
		private $props;
		public $userid;
		//public $uid;
		//constructor: prepare initializations here
		public function __construct()
		{
			// $this->userid=4;
			if(empty($_SESSION['us']['rid'])){
				$_SESSION['us']['rid']=true;
				// $this->userid=$_SESSION['us']['rid'];
				error_log("all ".print_r($_SESSION['us'],true));
			}

			$this->userid=4;//$_SESSION['us']['rid'];
			error_log("allen: ".print_r($this->userid,true));
		}

		public function formatIn($val,$ftype){
			if($ftype=='n' && is_numeric($val)) return $val;
			elseif(is_null($val) || empty($val)) return addslashes('NULL');
			elseif($ftype=='t') return "'$val'";
			else return $val;
		}
		public function createprops($pd) {
			$p = array();
			foreach ($pd['data'] as $v=>$s) {
				$p[$v] = substr($v,-1);  
			}
			return $p;
		}

		public function formatPost($fp,$pv,$rv,$va=true){
			//TODO: process $rv for required fields validation
			if ($va)
				ErrorHandler::ValidateMandatoryFields($pv,$this->userid,$rv);
			else
				ErrorHandler::ValidateMandatoryFieldsSP($pv,$rv);
			$dv = array();
			foreach($fp as $k=>$f){
				if(!isset($pv[$k]) || is_null($pv[$k])) $dv[$k] = addslashes('NULL');
				elseif($f=='n' && !is_numeric($pv[$k])) $dv[$k] = addslashes('NULL');
				elseif($f=='n' && is_numeric($pv[$k])) $dv[$k]=$pv[$k];
				elseif($f=='t' && empty($pv[$k])) $dv[$k] = addslashes('NULL');
				elseif($f=='t') $dv[$k]= "'$pv[$k]'"; //addslashes("'$pv[$k]'");
				else $dv[$k]=$pv[$k];
			}
			return $dv;
		}
		public function formatPostSU($fp,$pv,$rv,$va=true){
			//TODO: process $rv for required fields validation
			if ($va)
			// 	ErrorHandler::ValidateMandatoryFields($pv,$this->userid,$rv);
			// else
			// 	ErrorHandler::ValidateMandatoryFieldsSP($pv,$rv);
			$dv = array();
			foreach($fp as $k=>$f){
				if(!isset($pv[$k]) || is_null($pv[$k])) $dv[$k] = addslashes('NULL');
				elseif($f=='n' && !is_numeric($pv[$k])) $dv[$k] = addslashes('NULL');
				elseif($f=='n' && is_numeric($pv[$k])) $dv[$k]=$pv[$k];
				elseif($f=='t' && empty($pv[$k])) $dv[$k] = addslashes('NULL');
				elseif($f=='t') $dv[$k]= "'$pv[$k]'"; //addslashes("'$pv[$k]'");
				else $dv[$k]=$pv[$k];
			}
			return $dv;
		}

		public function formatDump($fp,$pv,$rv,$va=true){
			//TODO: process $rv for required fields validation
			if ($va)
				ErrorHandler::ValidateMandatoryFields($pv,$this->userid,$rv);
			else
				ErrorHandler::ValidateMandatoryFieldsSP($pv,$rv);
			$dv = array();
			foreach($fp as $k=>$f){
				if(!isset($pv[$k]) || is_null($pv[$k])) $dv[$k] = addslashes('NULL');
				elseif($f=='n' && !is_numeric($pv[$k])) $dv[$k] = addslashes('NULL');
				elseif($f=='n' && is_numeric($pv[$k])) $dv[$k]=$pv[$k];
				elseif($f=='t' && empty($pv[$k])) $dv[$k] = addslashes('NULL');
				elseif($f=='t') $dv[$k]= pg_escape_literal($pv[$k]);
// 				elseif($f=='t') $dv[$k]= "'$pv[$k]'"; //addslashes("'$pv[$k]'");
				else $dv[$k]=$pv[$k];
			}
			return $dv;
		}

		public function validate(){
			if(!(isset($this->userid) && $this->userid>0))
				throw new ErrorException("Invalid user, Please login",10,1);
		}

		public function editstate($sts){
			return $sts > 0 ? 'updated':'suspended';
		}

		public function RandomPassword()
		{
			return substr(str_shuffle("BmzCDwFc2rGHgk3JKb4LMfjdh5NP6ypQxR7SnT8VWvt9XsqYZ"),0,rand(7,13));
		}

		public function HashPassword($value)
		{
			return sha1("eRnIeOfOrI".$value."2011");
		}

		public function GetHashed($sd,$nfd,$vfd){
			try {
	            //associate the keys
				$new = array();
				foreach($sd as $rec){
					$new[$rec[$nfd]] = $rec[$vfd];
				}
				return $new;
			}
			catch(Exception $e){
				return ErrorHandler::Interpret($e);
			}
		}

		public function TestData($ard,$title=""){
			try {
				if(isset($ard['success']) && is_array($ard['sd']))
					return array("sts"=>0);
				elseif(isset($ard['failure']))
					return array("sts"=>1,"et"=>$ard['et'],"em"=>$ard['em'],"sd"=>$ard);
				elseif(isset($ard['success'])&&!is_array($ard['sd']))
					return array("sts"=>2,"et"=>'Error',"em"=>"No $title record found","sd"=>$ard);
				elseif(!(isset($ard['success'])&&is_array($ard['sd'])))
					return array("sts"=>3,"et"=>'Error',"em"=>'Unknown Error',"sd"=>$ard);
			}
            catch(Exception $e){
                if($cnn)  $cnn->Close();
                return ErrorHandler::Interpret($e);
            }
        }

	}
?>
