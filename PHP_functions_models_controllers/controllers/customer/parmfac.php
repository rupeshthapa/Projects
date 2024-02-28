<?php 
if(isset($_GET['mfid'])){
$mfid = $_GET['mfid'];
$tmp =['mfid' => $mfid];

$custitle = "Clarie's Cars - Home";
$cuscontent = TempLoad('../../views/customer/parmfac-template.php',$tmp);
}
?>