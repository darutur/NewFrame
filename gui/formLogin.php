<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$user = new User();

$user->setCodAcesso("456");
$user->setNome("Eduardo");
$user->setSenha("123");

echo "<pre>";
print_r($user);
echo "</pre>";

echo "******************************************";
echo "<br>";
echo "inserir";
echo "<br>";

//echo $user->insert();
//
//foreach ($user->listAll("nome") as $value) {
//    $value instanceof User;
//
//
//    echo "<pre>";
//    print_r($value);
//    echo "</pre>";
//    
//    if ($value->getIdUsuario() == 128) {
//        echo $value->delete();
//    }
//}

echo "******************************************";
echo "<br>";

echo "<pre>";
print_r($user->listForID(130));
echo "</pre>";
?>
