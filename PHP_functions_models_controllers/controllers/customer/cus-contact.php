<?php 
if(isset($_POST['enq'])){
	unset($_POST['enq']);
	$objenq = new DatabaseTable($pdo, 'question');
	$enq = $objenq->insert($_POST);
}
$custitle = "Clarie's Cars - Home";
$cuscontent = TempLoad('../../views/customer/cus-contact-template.php',[]);
?>