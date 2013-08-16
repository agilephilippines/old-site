var tweets_count = ' tweets_count=' + jQuery("input#tweets_count").val();

if (tweets_count == " tweets_count=") {
  var tweets_count_final='';
}
if (tweets_count != " tweets_count="){
 var tweets_count_final = tweets_count;
}
	
var final_twitter_shorcode = '[fts twitter' + twitter_name  + tweets_count_final + ']'