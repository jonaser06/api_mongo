<?php
define('STR_NULL', '');
define('STR_SPACE', ' ');
define('STR_GUION', '-');

class ServiceController extends Base
{
    
    public function generateUrl($title){

        $ac2 = explode(',', 'ñ,Ñ,á,é,í,ó,ú,Á,É,Í,Ó,Ú,ä,ë,ï,ö,ü,Ä,Ë,Ï,Ö,Ü');
        $xc2 = explode(',', 'n,N,a,e,i,o,u,A,E,I,O,U,a,e,i,o,u,A,E,I,O,U');
        $title = strtolower(str_replace($ac2, $xc2, $title));
        $plb = '/\b(a|e|i|o|u|el|en|la|las|es|tras|del|pero|para|por|de|con| ' .
            '.|sera|haber|una|un|unos|los|debe|ser)\b/';
        $title = preg_replace($plb, STR_NULL, $title);
        $title = preg_replace('/[^a-z0-9 -]/', STR_NULL, $title);
        $title = preg_replace('/-/', STR_SPACE, $title);
        $title = trim(preg_replace('/[ ]{2,}/', STR_SPACE, $title));
        $title = str_replace(STR_SPACE, STR_GUION, $title);
        $title = trim($title);
        
        #response
        $this->ResponseJson($title);
    }
}

?>