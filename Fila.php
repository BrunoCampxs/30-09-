<?php
session_start();

// Inicializa a sessão se não existir
if (!isset($_SESSION['pacientes'])) {
    $_SESSION['pacientes'] = [];
}

// Função para cadastrar um paciente
function cadastrarPaciente($nome) {
    if (count($_SESSION['pacientes']) < 11) {
        $_SESSION['pacientes'][] = ['nome' => $nome, 'prioritario' => false];
        return "Paciente $nome cadastrado com sucesso.";
    } else {
        return "Fila cheia! Não é possível cadastrar mais pacientes.";
    }
}

// Função para listar pacientes
function listarPacientes() {
    return $_SESSION['pacientes'];
}

// Função para adicionar um paciente prioritário
function adicionarPrioritario($nome) {
    foreach ($_SESSION['pacientes'] as &$paciente) {
        if ($paciente['nome'] === $nome) {
            $paciente['prioritario'] = true;
            return "Paciente $nome adicionado como prioritário.";
        }
    }
    return "Paciente não encontrado.";
}

// Função para atender um paciente
function atenderPaciente() {
    if (empty($_SESSION['pacientes'])) {
        return "Nenhum paciente na fila.";
    }

    // Atender paciente prioritário primeiro
    foreach ($_SESSION['pacientes'] as $key => $paciente) {
        if ($paciente['prioritario']) {
            unset($_SESSION['pacientes'][$key]);
            return "Paciente $paciente[nome] atendido.";
        }
    }

    // Se não houver prioritários, atender o primeiro da fila
    $pacienteAtendido = array_shift($_SESSION['pacientes']);
    return "Paciente $pacienteAtendido[nome] atendido.";
}
?>
