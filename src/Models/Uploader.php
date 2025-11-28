<?php

namespace Service\Models;

use Ramsey\Uuid\Uuid;

class Uploader
{
    private $permissoes = 0755;
    private $base_path;

    public function __construct()
    {
        // Caminho base: public/uploads
        $this->base_path = __DIR__ . '/../../public/uploads/';

        // Cria a pasta base se não existir
        if (!is_dir($this->base_path)) {
            mkdir($this->base_path, $this->permissoes, true);
        }
    }

    public function upload($id_user, $arquivo)
    {
        if (!isset($arquivo) || $arquivo['error'] !== 0) {
            // Você pode gerar um avatar aleatório aqui ou lançar exceção
            return false;
        }

        // Cria um ID único para o arquivo
        $id_file = Uuid::uuid7()->toString();
        $ext = pathinfo($arquivo['name'], PATHINFO_EXTENSION);

        // Caminho da pasta do usuário
        $user_path = $this->base_path . $id_user . '/';

        // Verifica se a pasta do usuário existe, se não cria
        if (!is_dir($user_path)) {
            mkdir($user_path, $this->permissoes, true);
        }

        // Caminho final do arquivo
        $final_path = $user_path . $id_file . '.' . $ext;

        // Caminho relativo para salvar no banco
        $relative_path = 'uploads/' . $id_user . '/' . $id_file . '.' . $ext;

        // Move o arquivo do tmp para a pasta do usuário
        if (move_uploaded_file($arquivo['tmp_name'], $final_path)) {
            return $relative_path;
        }

        return false;
    }
}
