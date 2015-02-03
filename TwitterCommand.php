<?php

class TwitterTest
{
    private $request_url = "http://twitter.com/oauth/request_token";

    private $consumer_key= '';
    private $consumer_secret= '';

    private $default_options = array(
        CURLOPT_TIMEOUT  => 3,
        CURLOPT_ENCODING => '', 
    );

    /*does not use lease*/
    public function actionSyncTwitter($args)
    {
        $src = 'twitter';
        TwitterCollector::get($src);
        sleep(30);
        TwitterCollector::get($src);
    }

    /*test command*/
    public function actionTl() {
        $tw = new twitteroauth($this->access_token, $this->access_secret);
        $timeline = $tw->homeTimeLine();
        echo $timeline;
        exit;
        $tw->friends(40);
        $tw->follow(null, 'alpha');exit;
        $response = $tw->post("https://api.twitter.com/1.1/friendships/create.json", $data);
        $create = json_encode($response);
        echo $create;exit;
        var_dump($response);exit;
    }

    /*login and link to twitter*/
    public function actionLink() {
        $token = $tw->getRequestToken();
        $url = $tw->getAuthorizeURL($token['oauth_token']);
        $tw->getPin($url, $token['oauth_token']);
        $tw = new twitteroauth($this->consumer_key, $this->consumer_secret, $this->access_token, $this->access_secret);

        $screen_name = 'Linus__Torvalds';
        $screen_name = 'omgubuntu';
        $user_id =1401881; 
        $post_data = array('user_id'=>$user_id);
        $post_response = $tw->post("https://api.twitter.com/1.1/friendships/create.json?screen_name=$screen_name");
        $twitter->login();
    }

    private function getCurl(){
        $curl = new AppCUrl;
        $curl->init();
        if (is_array($headers)){
            $curl->setOption(CURLOPT_HTTPHEADER, $headers);
        }
        $curl->setOptions($this->default_options);
        return $curl;
    }


}
