<?php
	class Developer{}  
    $obj = new Developer();   
    if( $obj instanceof Developer)  
    {  
        echo "obj is an Object of developer class.<br>";  
    }else{     
        echo "obj is Not an Object of developer class.<br>";  
    }   
    var_dump($obj instanceof Developer);      
    var_dump($obj instanceof Programmer);  
?>
