<?php
header('Content-type: text/xml');
header('Content-Disposition: attachment; filename="user_data.xml"');
require_once('db_connect.php');
  session_start();
  
if(isset($_SESSION['id'])){
$sql = "SELECT * FROM Users WHERE id = '".$_SESSION['id']."'";
$res = mysqli_query($dbc,$sql);

$xml = new XMLWriter();

$xml->openURI("php://output");
$xml->startDocument();
$xml->setIndent(true);

$xml->startElement('user');

while ($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
  $xml->writeElement("id",$row['id']);
  $xml->writeElement("name",$row['name']);
  $xml->writeElement("sex",$row['sex']);
  $xml->writeElement("dob",$row['dob']);
  $xml->writeElement("location",$row['location']);
  $xml->writeElement("date_joined",$row['date_joined']);
  $xml->writeElement("email",$row['email']);
  $xml->writeElement("password",$row['password']);
  $xml->writeElement("privacy",$row['privacy']);
  
  
}

$xml->endElement();
$xml->endDocument();   

$xml->flush();

}
?>