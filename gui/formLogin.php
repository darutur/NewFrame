<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$user = new Usuario();

$user->setLogin("Eduardo");
$user->setSenha("123");

echo "<pre>";
print_r($user);
echo "</pre>";

echo "******************************************";
echo "<br>";
echo "inserir";
echo "<br>";

echo "******************************************";
echo "<br>";

echo "<pre>";
print_r($user->listarTodos());
echo "</pre>";

$user->setIdUsuario(5);

echo "<pre>";
print_r($user->listarPorId());
echo "</pre>";
?>
