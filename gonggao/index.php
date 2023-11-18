<?php
    $referer = $_SERVER['HTTP_REFERER'];
    $isChinese = strpos($referer, 'en') === false;
    
    if($isChinese)
        $f_chr = file_get_contents("./GG.md");
    else
        $f_chr = file_get_contents("./GG_en.md");

    echo $f_chr;

?>