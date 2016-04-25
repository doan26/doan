<?php 
ob_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();
require "phpsdk/Facebook/autoload.php";	
use Facebook\FacebookRequest;
use Facebook\GraphObject;
use Facebook\FacebookRequestException;
use Facebook\FacebookResponse;

$fb = new  Facebook\Facebook([
  "app_id" => "581182232057262",
  'app_secret' => '1a2b4471f511ae03a5feb33e89b66368',
  'default_graph_version' => 'v2.5',
]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lephanthienphu Quảng Cáo Sản Phẩm Công Nghệ Thông Tin</title>

</head>

<body>
<?php 
$helper = $fb->getCanvasHelper();// xác thực cái app facebook 
$permissions = ['email','manage_pages', 'publish_pages']; // optionnal
  $accessToken = $helper->getAccessToken();//mã xác nhận


if ($accessToken) {//dang nh?p r?u 

	 $_SESSION['facebook_access_token'] = (string) $accessToken; // lay token
  $fb->setDefaultAccessToken($_SESSION['facebook_access_token'] );
 
	//echo $_SESSION['facebook_access_token'];
  $response = $fb->get('/me?fields=gender,name,link');
  $userNode = $response->getGraphUser();

echo 'Nick Facebook :  ' . $userNode->getName();
echo ' giới tính : '. $userNode->getgender();// dang h?p r?u th? l?y ten ra 

echo "<img src='https://graph.facebook.com/".$userNode->getid()."/picture' width='50' height='50'  alt='".$userNode->getLink()."'/>";

 // $fb->setDefaultAccessToken("EAAIQlQh91a4BAMP35oLEKtqLez72bZBi41pB88pDFLWlWDjtWvluAOvZBxBWayH6CpncBwX6BVuIu0ZCk9HL1HLNFYSEnVZB5GAivSIegAxRUmLd7td3u31QSAlZBn7EzZC8kUMAWZBv5J0DhIqD6EJhPR5jYJel4qVTMuuWYsk2gZDZD");
//t?o 
/*
	$pages = $fb->get('/me/accounts');
	$pages = $pages->getGraphEdge()->asArray();
	$xuongdong="\r\n";
	$thongdiep='Họ và Tên : test xóa file'.$xuongdong.'Chuyên Ngành : Công nghệ thông tin'.$xuongdong.'Lớp : 54cntt';
	foreach ($pages as $key) {
		if ($key['name'] == 'Lephanthienphu') {
			echo $key['id'];
			$post = $fb->post('/' . $key['id'] . '/photos/', array('image' => $fb->fileToUpload(__DIR__.'/photo.jpg'),'message' => $thongdiep), $key['access_token']);
			$post = $post->getGraphNode()->asArray();
			print_r($post);
		

		}
	}
 */
	 $test="[id] => 259372484411684 [post_id] => 256977781317821_259372484411684";
	 $postid="256977781317821_259372484411684";
	 $pages = $fb->get('/me/accounts?fields=name,feed{object_id},access_token');
	 //$response = $fb->delete('/{node-id}', ['object' => '1234']);
	$pages = $pages->getGraphEdge()->asArray();
	foreach ($pages as $key) {
		if ($key['name'] == 'Lephanthienphu') {
		//$response = $fb->delete('/{node-id}', array('object_id' => '1234'));
			 
			//$info = ('/256977781317821_259372484411684?method=DELETE&access_token='.$key['access_token'].'');
			$res = $fb->delete('/256977781317821_259372484411684', array('object_id'=>'259372484411684'),$key['access_token'] );
			//xoas 
		echo "Http::post('graph.facebook.com/256977781317821_259372484411684?method=DELETE&access_token=".$key['access_token'];

		}
	}
	
	/* xóa face
	foreach ($pages as $key) {
		if ($key['name'] == 'Lephanthienphu') {
			header('Location:https://graph.facebook.com/256977781317821_257113621304237?method=DELETE&access_token='.$key['access_token']);


		}
	}
	*/
	
		
}
 else {
	
	$helper = $fb->getRedirectLoginHelper();
	$loginUrl = $helper->getLoginUrl('https://apps.facebook.com/doanlephanthienhu/', $permissions);
	echo "<script>window.top.location.href='".$loginUrl."'</script>";
}

?>
</body>

</html>

