<?php
$conn = pg_connect("host=localhost port=5432 dbname=yihaodian user=postgres password=123456");
if($conn){
    print "OK! Has connected" . "<br>";
}else{
    print "Error! Connect failure" . "<br>";
}
?>