<?php
class TwitterOAuth{

    function accessTokenURL()  { return 'https://api.twitter.com/oauth/access_token'; }
    function authenticateURL() { return 'https://api.twitter.com/oauth/authenticate'; }
    function authorizeURL()    { return 'https://api.twitter.com/oauth/authorize'; }
    function requestTokenURL() { return 'https://api.twitter.com/oauth/request_token'; }

    function follow($user_id=null, $user_name=null){
        $data = array('follow' => 'true');
        if($user_id){
            $data['user_id'] = $user_id;
        } 
        else {
            $data['screen_name'] = $user_name;
        }
        $res = $this->post('https://api.twitter.com/1.1/friendships/create.json', $data);
        if($res->errors){
            return false;
        }
        return $res;
    }

    function friends($count=20){
        return $friends_list = $this->get("https://api.twitter.com/1.1/friendships/list.json?count=$count");
    }
    function homeTimeLine($count=20, $since_id=0){
        if($since_id == 0){
            $timeline = $this-get("https://api.twitter.com/1.1/statuses/home_timeline.json?count=$count");
        }
        else {
            $timeline = $this-get("https://api.twitter.com/1.1/statuses/home_timeline.json?count=$count&since_id=$since_id");
        }
        if(!$timeline){
            return $this->errors;
        }
        return $timeline;
    }

    //get pin number to auto-login
    function getPin($url, $otoken=null){
        $parameters = array();
        $url = RequestProxy::getUrl($url);
        $resp= $this->http($url, 'GET', $data);
        //parse pin from html-page
        $ret = preg_match('@name="authenticity_token" type="hidden" value="(.*)"@', $resp, $match);
        $atoken = $match[1];
        $data = array(
            'authenticity_token' => $atoken,
            'oauth_token' => $otoken,
            'repost_after_login' => ' https://api.twitter.com/oauth/authorize',
            'session[password]' => 'your password',
            'session[username_or_email]' => 'your username',
        );

        $http = new Http();
        $cookie_file = 'your cookie file path' .'twitter.txt'; 
        $http->setOption(CURLOPT_COOKIEFILE, $cookie_file);
        $http->setOption(CURLOPT_FOLLOWLOCATION, TRUE);
        $http->setOption(CURLOPT_AUTOREFERER, TRUE);
        $http->setOption(CURLOPT_HTTPHEADER, array(
                "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
                "Content-Type:application/x-www-form-urlencoded",
                "Connection:keep-alive",
                "Host:twitter.com",
                "Referer:https://api.twitter.com/oauth/authenticate?oauth_token=$otoken",
                "User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0",
                ));
        $url = "https://twitter.com/intent/sessions";
        $url = RequestProxy::getUrl($url);
        $resp = $http->post($url, $data);
  }

}
?>
