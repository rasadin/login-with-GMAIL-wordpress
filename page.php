<?php
//this is gmail information//
$client_id = '661086014255-59fldjo3ob0svde43iqadisoejv08ob0.apps.googleusercontent.com';
$client_secret = 'O_VjDn8Y4Y8B1KtnVESDN8O0';
$redirect_url = 'http://localhost/eventbookings-website/';
$login_url = 'https://accounts.google.com/o/oauth2/v2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me') . '&redirect_uri=' . urlencode($redirect_url) . '&response_type=code&client_id=' . $client_id . '&access_type=online';


//this function for gamil login//
class GoogleLoginApi
{
	public function GetAccessToken($client_id, $redirect_uri, $client_secret, $code) {	
		$url = 'https://www.googleapis.com/oauth2/v4/token';			
		$curlPost = 'client_id=' . $client_id . '&redirect_uri=' . $redirect_uri . '&client_secret=' . $client_secret . '&code='. $code . '&grant_type=authorization_code';
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		
		curl_setopt($ch, CURLOPT_POST, 1);		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);	
		$data = json_decode(curl_exec($ch), true);
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
		if($http_code != 200) 
			throw new Exception('Error : Failed to receieve access token');
		return $data;
	}

	public function GetUserProfileInfo($access_token) {	
		$url = 'https://www.googleapis.com/plus/v1/people/me';			
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token));
		$data = json_decode(curl_exec($ch), true);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);		
		if($http_code != 200) 
			throw new Exception('Error : Failed to get user information');
		return $data;
	}
}
//end function for gamil login//



if( isset($_GET['code']) ) {
    try {
        $gapi = new GoogleLoginApi();

        //Get Access Token Data
        $data = $gapi->GetAccessToken($client_id, $redirect_url, $client_secret, $_GET['code']);

        // Get User Information
        $user_info = $gapi->GetUserProfileInfo($data['access_token']);
        echo '<pre>'; var_dump($user_info); echo '</pre>';
        echo $user_info->name;
    }
    catch(Exception $e) {
        echo $e->getMessage();
        exit();
    }
}
/// end gmail information////



 <!-- google sign up button -->
<?php if( !isset($_GET['code']) ) : ?>
<a href="<?php echo $login_url ?>">Login with Google</a>
<?php endif; ?>




......................>Admin SDK<............................
enable korte hbe.............



Authorized JavaScript origins: http://localhost	
Authorized redirect URIs: http://localhost/eventbookings-website/	



Authorized domains : webalive

Application Homepage link
https://www.webalive.com.au/about-us/

Application Privacy Policy link
https://www.webalive.com.au/portfolio/

Application Terms of Service link (Optional)
https://www.webalive.com.au/blog/

  




