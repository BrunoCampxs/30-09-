<?php
include 'pacientes.php';


$nomes = [];
$idades = [];
$generos = [];
$prioritarios = [];


while (true) {
    echo "\nMenu:\n";
    echo "1. Cadastrar Paciente\n";
    echo "2. Listar Pacientes\n";
    echo "3. Adicionar Paciente Prioritário\n";
    echo "4. Atender Paciente\n";
    echo "Digite 'q' para sair.\n";
    $opcao = readline("Escolha uma opção: ");

    if ($opcao === 'q') {
        break;
    }

    switch ($opcao) {
        case 1:
            $nome = readline("Digite o nome do paciente: ");
            $idade = readline("Digite a idade do paciente: ");
            $genero = readline("Digite o gênero do paciente: ");
            
            $nomes[] = $nome;
            $idades[] = $idade;
            $generos[] = $genero;
            $prioritarios[] = false; 
     
            echo "Paciente cadastrado com sucesso.\n";
            break;
        case 2:
            if (empty($nomes)) {
                echo "Nenhum paciente na fila.\n";
            } else {
                for ($i = 0; $i < count($nomes); $i++) {
                    $tipo = $prioritarios[$i] ? "(Prioritário)" : "";
                    echo "Paciente: $nomes[$i] $tipo, Idade: $idades[$i], Gênero: $generos[$i]\n";
                }
            }
            break;
        case 3:
            $nome = readline("Digite o nome do paciente prioritário: ");
         
            $index = array_search($nome, $nomes);
            if ($index !== false) {
                $prioritarios[$index] = true; 
                echo "Paciente prioritário cadastrado.\n";
            } else {
                echo "Paciente não encontrado.\n";
            }
            break;
        case 4:
           
            if (empty($nomes)) {
                echo "Nenhum paciente para atender.\n";
            } else {
              
                $atendido = array_shift($nomes);
                array_shift($idades);
                array_shift($generos);
                array_shift($prioritarios);
                echo "Paciente atendido: $atendido\n";
            }
            break;
        default:
            echo "Opção inválida! Tente novamente.\n";
            break;
            case 5:
                $nomes = [];
                $idades = [];
                $generos = [];
                $prioritarios = [];
                
                echo "Fila de pacientes limpa com sucesso.\n";
                break;
            
    }
}

echo "Saindo do sistema...\n";
?>
