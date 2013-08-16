var pics_count = ' pics_count=' + jQuery("input#pics_count").val();

if (pics_count == " pics_count=") {
  var pics_count_final='';
}
if (pics_count != " pics_count="){
 var pics_count_final = pics_count;
}

var final_instagram_shorcode = '[fts instagram' + instagram_id  + pics_count_final + ']'