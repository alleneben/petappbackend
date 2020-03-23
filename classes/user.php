<?php
class User extends AppBase{
    private $props;
    public function __construct(){
        parent::__construct();

    }

    public function SignUp($pd){
        try {
            
            
            $fp = $this->createprops($pd);
            $f = $pd['dbf'];
            
            //required fields
            $rv = array();
            //call formating function
            $dd = $this->formatPostSU($fp,$pd['data'],$rv);

            //connect to db
            $dbl=new DB();
            $cnn=$dbl->Connection();

            $d='';
            foreach($dd as $dt){
                if($dt !== 'NULL'){
                    $d = $d.$dt.',';
                }
            }

            $sql = "SELECT * FROM $f(".$d.$this->userid.")";error_log($sql);

            // //prepare and execute sql statement (adodb)
            $stmt=$cnn->PrepareSP($sql);
            $rc=$cnn->Execute($stmt);
            $sd=$rc->getarray();
            if($cnn)  $cnn->Close();
            if(count($sd)<1) throw new ErrorException("No record found",9,1);
            //$rec = array_shift($sd);
            return json_encode(array("success"=>"true","sd"=>$sd));
        }
        catch (ADODB_Exception $e) {
            if($cnn)  $cnn->Close();
			return ErrorHandler::InterpretADODB($e);
        }
        catch(Exception $e){
            if($cnn)  $cnn->Close();
            return ErrorHandler::Interpret($e);
        }
    }
}
?>
