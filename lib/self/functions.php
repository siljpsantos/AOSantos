<?php

function XML2Array(SimpleXMLElement $parent) {
    $array = array();

    foreach ($parent as $name => $element) {
        ($node = & $array[$name])
            && (1 === count($node) ? $node = array($node) : 1)
            && $node = & $node[];

        $node = $element->count() ? XML2Array($element) : trim($element);
    }

    return $array;
}

function recur($array, $key='', &$retorno){

    if (is_array($array)){

        foreach($array as $key => $element){

            recur($element, $key, $retorno);   

        }

    } else {

        $retorno[0][] = $key;
        $retorno[1][] = $array;
    }

} 