<?php
require_once ('vendor/autoload.php');
require_once ('ClassMetrics.php');

$ruler = new Hoa\Ruler\Ruler();

// New context.
$context         = new Hoa\Ruler\Context();

    // create a metrics object in the context
    $blueMetrics = new Metrics();

    // in prod code replace with actual db code
    $blueMetrics->aName    = 'Blue';
    $blueMetrics->aBranch  = 'Left';
    $blueMetrics->pctBal = array("NFL"=>10, "NBA"=>20, "MLB"=>5);   
    $blueMetrics->weightedVal = 110;
    $blueMetrics->weightedAvg = 520;
    $blueMetrics->pctClass1   = 4;
    $blueMetrics->pctClass2   = 40;
    $blueMetrics->pctClass3   = 400;
    $blueMetrics->pctClass4   = 4000;

    // populate the context

    $context['aName'] = $blueMetrics->aName;
    $context['aBranch'] = $blueMetrics->aBranch;
    $context['pctBal'] = $blueMetrics->pctBal;
    $context['weightedAvg'] = $blueMetrics->weightedAvg;
    $context['weightedVal'] = $blueMetrics->weightedVal;
    $context['pctClass1'] = $blueMetrics->pctClass1;
    $context['pctClass2'] = $blueMetrics->pctClass2;
    $context['pctClass3'] = $blueMetrics->pctClass3;
    $context['pctClass4'] = $blueMetrics->pctClass4;
    //$context['maxPct'] = $blueMetrics->getMaxPctArray();
    //$context['maxPctInNFL'] = $blueMetrics->getPctInNFL();


// We add operators.
$ruler->getDefaultAsserter()->setOperator('use', function ( blueMetrics $obj ) {

    return isset($obj);
});

$ruler->getDefaultAsserter()->setOperator('print', function ( $aValue ) {

    echo( $aValue );
    return true;
});


?>
