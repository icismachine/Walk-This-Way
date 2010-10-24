<html>
<head>
  <title>Frankendeal Trivia</title>
  <link rel="stylesheet" href="frankenstyle.css" type="text/css" media="screen"/>
</head>

<body>
<div class="centered">
  <div class="welcome">
    <div class="left_col">
	<p>
	<?php
		// Your twitter username; replace below; keep username in quotes
		$username = "frankenbrain";

		// Content you want to include before your tweet; I'm using this for a quick title
		$prefix = "";

		// Content you want to include after your tweet
		/*$suffix = "<br /><br />You should follow me on Twitter";*/

		$latest_tweet = "http://search.twitter.com/search.atom?q=from:" . $username . "&rpp=1";

		function parse_feed( $latest_tweet ) {
		    $tweet_array = explode( "<content type=\"html\">", $latest_tweet );
		    $tweet_array2 = explode( "</content>", $tweet_array[1] );

			$tweet = $tweet_array2[0];

			//No need for search engines to follow twitter links or tags; add no follow
			$tweet = str_replace( "&lt;a ", "&lt;a rel=\"nofollow\" ", $tweet );
		    $tweet = str_replace( "&lt;", "<", $tweet );
		    $tweet = str_replace( "&gt;", ">", $tweet );

		    //some extra tweet metadata you can use if you want
		    $tweet_extra = $tweet_array2[1];

		    return array ( $tweet, $tweet_extra );
		}		

		list ( $tweet, $tweet_extra ) = parse_feed( file_get_contents( $latest_tweet ) );

		echo stripslashes( $prefix ) . html_entity_decode( $tweet );

		// If you want to include more content after the tweet, use this instead
		/*echo stripslashes( $prefix ) . $tweet . stripslashes( $suffix );*/
	?>
    </p>
    <p class="smalltext">&mdash Frankie's latest tweet</p>
     
     <hr/>
     
    <p><a name="fb_share" type="button_count" href="http://www.facebook.com/sharer.php">Share</a><script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script></p>
          
    <p><a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="alissadesigns">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></p>
      </div>
  </div>





</div>


</body>
</html>
