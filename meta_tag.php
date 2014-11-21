<?php
function get_meta_data($url, $searchkey='') {
if ($data = @get_meta_tags($url)) {
$data = @get_meta_tags($url); // get the meta data in an array
foreach($data as $key => $value) {
if(mb_detect_encoding($value, 'UTF-8, ISO-8859-1', true) != 'ISO-8859-1') { // check whether the content is UTF-8 or ISO-8859-1
$value = utf8_decode($value); // if UTF-8 decode it
}
$value = strtr($value, get_html_translation_table(HTML_ENTITIES)); // mask the content
if($searchkey != '') { // if only one meta tag is in demand e.g. 'description'
if($key == $searchkey) {
$str = $value; // just return the value
}
} else { // all meta tags
$pattern = '/ ¦,/i'; // ' ' or ','
$array = preg_split($pattern, $value, -1, PREG_SPLIT_NO_EMPTY); // split it in an array, so we have the count of words
$str .= '<tr><th class=\'resultTable\'>' . $key . '(' . count($array) . ' words ¦ ' . strlen($value) . ' chars)</th></tr> <tr><td class=\'row1\'>' . $value . '</td></tr>'; // format data with count of words and chars
}
}
return $str;
    }else {
        // Catch error
echo 'Not display meta tags!';
    }
}
?>
