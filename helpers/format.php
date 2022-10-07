<?php
/**
* Format Class
*/
class Format{

 public function formatDate($date){
    return date('F j, Y, g:i a', strtotime($date)); //(May 4, 2017, 2:22 pm)
 }

 public function textShorten($text, $limit = 400){
    $text = $text. " ";
    $text = substr($text, 0, $limit);
    $text = substr($text, 0, strrpos($text, ' '));
    $text = $text.".....";
    return $text;
 }

 public function validation($data){ 
    $data = trim($data);                //(space)
    $data = stripcslashes($data);       //(\)
    $data = htmlspecialchars($data);    // (html: <,>)
    return $data;
 }

public function title(){ //format url view
    $path = $_SERVER['SCRIPT_FILENAME'];
    $title = basename($path, '.php');
    //$title = str_replace('_', ' ', $title);
    if ($title == 'index') {
     $title = 'home';
    }elseif ($title == 'contact') {
     $title = 'contact';
    }
    return $title = ucfirst($title); //(UpperCase)
   }
public function format_currency($n=0){ //money
        $n=(string)$n;
        $n=strrev($n); //reverse
        $res='';
        for($i=0;$i<strlen($n);$i++){
            if($i%3==0 && $i!=0){
                $res.='.';
            
            }
            $res.=$n[$i];
        }
        $res=strrev($res);
        return $res;
    
    
    }
}
 
?>
