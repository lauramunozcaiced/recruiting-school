<?php
 function buildUrlVideo($url){
    if (str_contains($url, 'https://vimeo.com/') ){
        $videoCode = str_replace('https://vimeo.com/', '', $url);
        $codes =  explode("/",$videoCode);
        return ['https://player.vimeo.com/video/'.$codes[0].'?h='.$codes[1],true];
    }
    elseif (str_contains($url, 'youtu')) {
        $code;
        if(str_contains($url, 'youtu.be')){
            $code = str_replace('https://youtu.be/', '', $url);
        }else if(str_contains($url, 'youtube')){
            $code = str_replace('https://www.youtube.com/embed/', '', $url);
            $code = str_replace('https://www.youtube.com/watch?v=', '', $url);
        }
        return ['https://www.youtube.com/embed/'.$code,true];
    }
    else{
        return [$url,false];
    }        
 }

?>