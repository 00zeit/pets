<?php 
include('../../config>/database.php');
$fullname=$_POST['fname'];
$email=$_POST['email'];
$passwd=$_POST['passwd'];
$enc_pass=md5($passwd);

$sql = "INSERT INTO users (fullname, email, password) VALUES('$fullname', '$email','$enc_pass')";
$ans = pg_query($conn,$sql);
if($ans){
    echo"user has been created successfully";
}else{
    echo "error: ".preg_last_error();
}
//close conection
pg_close($conn)
?>