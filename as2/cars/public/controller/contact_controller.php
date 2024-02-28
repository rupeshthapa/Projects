<?php

require_once '../model/contact_model.php';

if (isset($_POST['submit'])) {
    $contact = new Contact();
    $contact->setName($_POST['name']);
    $contact->setEmail($_POST['email']);
    $contact->setNumber($_POST['number']);
    $contact->setEnquiry($_POST['textarea']);
    $contact->save();
    header('Location:../contact.php');
}
?>
