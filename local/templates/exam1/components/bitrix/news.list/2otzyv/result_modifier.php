<?php

$newWidth = 39;
$newHeight = 39;
// $arResult['TEST'] = "Test";
//printToHiddenDiv(print_r($arResult));

// foreach ($arResult as $arItem) {
//     echo "<pre>", var_dump($arItem), "</pre>";
//     $arItem['RRR'] = "test item";
// }

function printToHiddenDiv($printstr){
    echo '<div class="hidden"><pre>', $printstr,'</pre></div>';
}