<?php 
date_default_timezone_set('Asia/Ho_Chi_Minh');
$now = getdate(); 
$ngaytao= $now["mday"] . $now["mon"]  . $now["year"]; 
// 50 bang nap 10 k
for($i=0;$i<20;$i++){
	$mann=substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'),0,5);
		if($i<	10)
	    echo "<br />INSERT INTO tenbangnaptien VALUES ('NAP10".$ngaytao.$mann."0".$i."','10')";
		else
		echo "<br />INSERT INTO tenbangnaptien VALUES ('NAP10".$ngaytao.$mann.$i."','10')";
}

?>