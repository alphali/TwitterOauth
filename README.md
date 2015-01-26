# TwitterOauth
Twitter Oauth php-lib

use cases:

    0. You should get a developer account from apps.twitter.com.
    1. Get your keys and access tokens.
    2. Copy them to TwitterOauth to initialize TwitterOauth.
    3. Codes below is an example.

    $twitter = new TwitterOauth();
    $friends = $twitter->friends($count);
    $tweets  = $twitter->homeTimeLine($count);
    foreach($tweets as $tweet) {
        //to do 
    }
