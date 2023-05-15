<?php 
//konekcija na bazu

$servername = "localhost";
$username = "root";
$password = "";
$schema = "midterm-2022";

$conn = new PDO("mysql:host=$servername;dbname=$schema", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
Flight::set("connection", $conn);

Flight::route('/test', function(){
    echo 'hello world!';
});

Flight::route('/investors',function(){
    $stmt = Flight :: get ("connection")->prepare("SELECT * FROM investors order by id desc " );
    $stmt->execute();
    Flight:: json ($stmt->fetchAll(PDO::FETCH_ASSOC));
  
});

Flight::route('/transferi',function(){
    $stmt = Flight :: get ("connection")->prepare("SELECT * FROM transfers " );
    $stmt->execute();
    Flight:: json ($stmt->fetchAll(PDO::FETCH_ASSOC));
  
});

Flight::route('/investors/@id',function($id){
    $stmt = Flight :: get ("connection")->prepare("SELECT * FROM investors WHERE id = :id");
    $stmt->execute(['id' =>  $id]);
    Flight:: json ($stmt->fetchAll(PDO::FETCH_ASSOC));
   
});

Flight::route('/transferi/@id',function($id){
    $stmt = Flight :: get ("connection")->prepare("SELECT * FROM transfers WHERE id= :id " );
    $stmt->execute(['id' =>  $id]);
    Flight:: json ($stmt->fetchAll(PDO::FETCH_ASSOC));
  
});



?>

