<?php 
ob_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();
require "phpsdk/Facebook/autoload.php";	
$fb = new  Facebook\Facebook([
  "app_id" => "581182232057262",
  'app_secret' => '1a2b4471f511ae03a5feb33e89b66368',
  'default_graph_version' => 'v2.5',
]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sexy Drop Down Menu with CSS &amp; jQuery - Huong dan cua NhatQuang Informatics</title>

</head>

<body>
<?php 
$helper = $fb->getCanvasHelper();
$permissions = ['email','manage_pages', 'publish_pages']; // optionnal
  $accessToken = $helper->getAccessToken();//ki?m tra th? c? dang nh?p chua


if ($accessToken) {//dang nh?p r?u 
	 $_SESSION['facebook_access_token'] = (string) $accessToken;
  $fb->setDefaultAccessToken($_SESSION['facebook_access_token'] );
 

  $response = $fb->get('/me');
  $userNode = $response->getGraphUser();

echo 'B?n dã dang nh?p :  ' . $userNode->getName();// dang h?p r?u th? l?y ten ra 


//t?o 
$pages = $fb->get('/me/accounts');
	$pages = $pages->getGraphEdge()->asArray();
	$xuongdong="\r\n";
	foreach ($pages as $key) {
		if ($key['name'] == 'Lephanthienphu') {
			$post = $fb->post('/' . $key['id'] . '/album/', array('image' => $fb->fileToUpload(__DIR__.'/photo.jpg'),'message' => 'anh yeu em'.$xuongdong.'co xuong hang khong'), $key['access_token']);
			$post = $post->getGraphNode()->asArray();
			print_r($post);
		}
	}


}
 else {
	
	$helper = $fb->getRedirectLoginHelper();
	$loginUrl = $helper->getLoginUrl('https://apps.facebook.com/doanlephanthienhu/', $permissions);
	echo "<script>window.top.location.href='".$loginUrl."'</script>";
}

?>
tesst

</body>

</html>

