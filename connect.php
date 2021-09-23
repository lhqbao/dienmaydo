<?php
	/*$Connect = mysqli_connect("localhost","root","","qlbh") or die("Lỗi".mysqli_error($Connect));
	
	mysqli_query($Connect,'SET NAMES "utf8"');
	//mysqli_close($Connect);*/
	$Connect = pg_connect("postgres://jikbwkykewlhre:f25c22c74d50b4981449c23f2c1687e7b13f365bd0accbf177ca9c9d12f83bcd@ec2-54-174-172-218.compute-1.amazonaws.com:5432/df4ielomdmnsv5");
     //$Connect = pg_connect("host=localhost port=5432 dbname=postgres");
	//$Connect = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=123456");
	
    if (!$Connect) {
        die("Connection failed");
    }
?>