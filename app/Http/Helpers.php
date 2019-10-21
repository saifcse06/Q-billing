<?php
function managePagination($obj)
{
    $serial=1;
    if($obj->currentPage()>1)
    {
        $serial=(($obj->currentPage()-1)*$obj->perPage())+1;
    }
    return $serial;
}


function checkPhoneNumber($number)
{

    if(preg_match('/(^(\+88|0088|88)?(01){1}[56789]{1}(\d){8})$/',$number)){

        if (strlen($number)==11){
            return '88'.$number;
        }else{
            return $number;
        }
    }
    elseif (strlen($number)==10){
        return '880'.$number;
    }
    else{

        return  '88'.$number;


    }
}