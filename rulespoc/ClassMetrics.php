<?php

// The Metrics object.
class Metrics {

    const DISCONNECTED = 0;
    const CONNECTED    = 1;

    public $group      = '1';
    public $points     = 1;
    protected $_status = 1;

    public $aName    = '';
    public $aBranch  = '';
    public $pctBal = array();  
    public $weightedVal = 0;
    public $weightedAvg = 0;
    public $pctClass1   = 0;
    public $pctClass2   = 0;
    public $pctClass3   = 0;
    public $pctClass4   = 0;

    public function getMaxPctArray(){
        if (sizeof($this->pctBal) == 0) {
            return 0;
        } else {
            $maxval_found=0;
            $maxkey_found='';
            foreach( $this->pctBal as $key => $value ){
                if($maxval_found < $value){
                    $maxval_found = $value;
                    $maxkey_found = $key;
                }
            }
            return $maxval_found;
        }
    }
    public function getPctInNFL(){       
        if (sizeof($this->pctPrincipleBalanceReceivables) == 0) {
            return 0;
        } else {
            if (!isset($this->pctPrincipleBalanceReceivables["NFL"])){
                return 0;
            } 
            return $this->pctPrincipleBalanceReceivables["NFL"];
        }
    }

}


?>
