<?php

function rupiah($angka){ 
    $hasil =  number_format($angka,2, ',' , '.'); 
    return $hasil; 
}