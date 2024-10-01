<?php
session_start();


if (!isset($_SESSION['pacientes'])) {
    $_SESSION['pacientes'] = [];
}


function cadastrarPaciente($nome) {
    if (count($_SESSION['pacientes']) < 11) {
        $_SESSION['pacientes'][] = ['nome' => $nome, 'prioritario' => false];
        return "Paciente $nome cadastrado com sucesso.";
    } else {
        return "Fila cheia! Não é possível cadastrar mais pacientes.";
    }
}


function listarPacientes() {
    return $_SESSION['pacientes'];
}


function adicionarPrioritario($nome) {
    foreach ($_SESSION['pacientes'] as &$paciente) {
        if ($paciente['nome'] === $nome) {
            $paciente['prioritario'] = true;
            return "Paciente $nome adicionado como prioritário.";
        }
    }
    return "Paciente não encontrado.";
}


function atenderPaciente() {
    if (empty($_SESSION['pacientes'])) {
        return "Nenhum paciente na fila.";
    }


    foreach ($_SESSION['pacientes'] as $key => $paciente) {
        if ($paciente['prioritario']) {
            unset($_SESSION['pacientes'][$key]);
            return "Paciente $paciente[nome] atendido.";
        }
    }

    
    $pacienteAtendido = array_shift($_SESSION['pacientes']);
    return "Paciente $pacienteAtendido[nome] atendido.";
}
?>
