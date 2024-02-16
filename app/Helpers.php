<?php

function generate_cpf() {
    $cpf = [];

    // Gerar os 9 primeiros dígitos do CPF de forma aleatória
    for ($i = 0; $i < 9; $i++) {
        $cpf[] = rand(0, 9);
    }

    // Calcular o primeiro dígito verificador
    $soma = 0;
    for ($i = 0; $i < 9; $i++) {
        $soma += $cpf[$i] * (10 - $i);
    }
    $cpf[] = ($soma * 10) % 11 % 10;

    // Calcular o segundo dígito verificador
    $soma = 0;
    for ($i = 0; $i < 10; $i++) {
        $soma += $cpf[$i] * (11 - $i);
    }
    $cpf[] = ($soma * 10) % 11 % 10;

    return implode('', $cpf);
}