<?php

function rupiah($angka)
{
    $hasil = number_format($angka, 0, ',', '.');
    return $hasil;
}

function discountRp($discount, $price, $qty)
{
    $discount = $discount / 100;
    $discountRp = ($qty * $price) * $discount;

    return $discountRp;
}
