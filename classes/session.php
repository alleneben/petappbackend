<?php
class Session extends AppBase{
    private $props;
    public function __construct(){
        parent::__construct();

    }

    public function SessionCreate(){
        try
        {
            // $sql="SELECT * FROM $f(".$d."'".$sessid."')";
            // $stmt=$cnn->PrepareSP($sql);error_log('sql:'.$sql);
            // $rc=$cnn->Execute($stmt);
            // $sd=$rc->getarray();
            // if(!(is_numeric($sd[0]['rlt'])&&$sd[0]['rlt']>0)){
            //     throw new ADODB_Exception('POSTGRES','EXECUTE',$sd[0]['rlt'],$sd[0]['msg'],'','',$cnn);
            //     //exit;
            // }

            return json_encode(array('success' => 'true', 'sd' => $_SESSION['us']));
        }
        catch(ADODB_Exception $e)
        {
            if($cnn)  $cnn->Close();
            return ErrorHandler::InterpretADODB($e);
        }
        catch(Exception $e)
        {
            if($cnn)  $cnn->Close();
            return ErrorHandler::Interpret($e);
        }
    }
}
?>
