<?php
define('STR_NULL', '');
define('STR_SPACE', ' ');
define('STR_GUION', '-');

class ServiceController extends Base
{
    
    public function generateUrl($title, $img = false){

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
        if($img):
            return $title;
        else:
            $this->ResponseJson($title);
        endif;
    }

    public function generateImg($name, $temp){
        $newname = $this->generateUrl($name, true);
        $name = $this->generateUrl($name, true).'.jpg';
        if($this->uploadimage($temp, $name)):
            $response = new stdClass();
            $response->base = 'http://api.bitsforcode.xyz/media/get-image/';
            $response->imgOriginal = $newname.'-0x0.jpg';
            $response->path = $newname;
            $this->ResponseJson($response);
        else:
            echo '404: ocurrio un error..';
        endif;
        
    }

    public function uploadimage($image, $name){

        $target = __DIR__.'/../../upload/'.basename($name);
        
        if (move_uploaded_file($image, $target)) {
            return true;
        }else{
            return false;
        }
    }

    public function imgCnd($url){

        #extraer parametros
        $exp = explode('-', $url);
        $cuenta = count($exp) - 1;
        $medida = $exp[$cuenta];

        #extraer medidas
        if(strpos($medida,'x')):
            $nueva_url = '';
            for( $i=0 ; $i < $cuenta ; $i++ ):
                $nueva_url = $nueva_url.$exp[$i].'-';
            endfor;
            $lenght = strlen($nueva_url);
            $nueva_url = substr($nueva_url,0,$lenght-1);

            $exp = explode('x', $medida);
            $width = $exp[0];
            $height = $exp[1];
            $size_origin = false;
            if($width == '0' || $height == '0'):
                $size_origin = true;
            endif;

            #buscamos imagen
            $file_image = __DIR__.'/../../upload/'.$nueva_url.'.jpg';

            #validamos si existe imagen
            if(file_exists($file_image)):

                if($size_origin):
                    header('Content-Type: image/png');
                    readfile($file_image);
                    exit;
                else:
                    list($x, $y) = getimagesize($file_image);
                    $thumb = imagecreatetruecolor($width,$height);
                    $origin = imagecreatefromjpeg($file_image);
                    imagecopyresized($thumb, $origin, 0,0,0,0, $width ,$height ,$x, $y);
                    header('Content-Type: image/png');
                    imagejpeg($thumb);
                    exit;
                endif;
                
            else:
                echo '404: No se encontro la imagen.';
                exit;
            endif;

        else:
            echo '404: No se encontro la medida de la imagen.';
        endif;
    }
}

?>