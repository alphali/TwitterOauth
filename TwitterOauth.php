<?php
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
?>
