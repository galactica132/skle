<?php
function bb($message){
$from = array(
"/\n?\[code\](.*?)\[\/code\]/si",
"/\n?\[php\](.*?)\[\/php\]/sie",
'/(^|[ \n\r\t])((http(s?):\/\/)(www\.)?([a-z0-9_-]+(\.[a-z0-9_-]+)+)(:[0-9]+)?(\/[^\/ \)\(\n\r]*)*)/is',
"/\[img\](.*?)\[\/img\]/si",
"/\[i\](.*?)\[\/i\]/si",
"/\[b\](.*?)\[\/b\]/si",
"/\[u\](.*?)\[\/u\]/si",
"/\[s\](.*?)\[\/s\]/si",
"/\[center\](.*?)\[\/center\]/si",
"/\[left\](.*?)\[\/left\]/si",
"/\[justify\](.*?)\[\/justify\]/si",
"/\[right\](.*?)\[\/right\]/si",
"/([a-z_-][a-z0-9\._-]*@[a-z0-9_-]+(\.[a-z0-9_-]+)+)/is",
"/\[url\](.*?)\[\/url\]/si",
"/\[url=(.*?)\](.*?)\[\/url\]/si",
"/\n?\[quote\]\n*/i",
"/\[\/quote\]/i"
); 
$to = array(
"<TABLE BORDER=\"0\" ALIGN=\"CENTER\" CELLPADDING=\"0\" CELLSPACING=\"0\" WIDTH=\"80%\"><TR><TD CLASS=\"code\" ALIGN=\"LEFT\"><B>Code:</B><BR><HR>\\1<HR></TD></TR></TABLE>",
"'<TABLE BORDER=\"0\" ALIGN=\"CENTER\" CELLPADDING=\"0\" CELLSPACING=\"0\" WIDTH=\"80%\"><TR><TD CLASS=\"code\" ALIGN=\"LEFT\"><B>PHP:</B><BR><HR>'. strip_tags('\\1', '<') .'<HR></TD></TR></TABLE>'",
'\1[url=\2]\2[/url]',
"<IMG SRC=\"\\1\" BORDER=\"0\">",
"<I>\\1</I>",
"<B>\\1</B>",
"<U>\\1</U>",
"<S>\\1</S>",
"<center>\\1</center>",
"<div align='left'>\\1</div>",
"<div align='justify'>\\1</div>",
"<div align='right'>\\1</div>",
"[url=mailto:\\1]\\1[/url]",
"<A HREF=\"\\1\" TARGET=\"_blank\">\\1</A>",
"<A HREF=\"\\1\" TARGET=\"_blank\">\\2</A>",
"<TABLE BORDER=\"0\" ALIGN=\"CENTER\" CELLPADDING=\"0\" CELLSPACING=\"0\" WIDTH=\"80%\"><TR><TD CLASS=\"quote\" ALIGN=\"LEFT\"><B>Quote:</B><BR><HR>",
"<HR></TD></TR></TABLE>"
);
 
$message = preg_replace($from, $to, $message); 
return $message; }
?>