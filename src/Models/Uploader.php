<?php

namespace Service\Models;

use Ramsey\Uuid\Uuid;

class Uploader
{
    private $permissoes = 0755;
    private $base_path = 'uploads/';

    public function __construct()
    {
        if (!is_dir($this->base_path)) {
            mkdir($this->base_path, $this->permissoes, true);
        }
    }

    /*
    ^ ANALISE
    public function upload()
    {
        //todo uploads/$id_user/$id_file/$ext
        $id_file = Uuid::uuid7()->toString();
        $temp = $this->avatar['tmp_name'];
        $path = $this->base_path . $this->id_user . $id_file;

        if (!isset($this->avatar)) {
            //todo Selecionar um avatar aleatorio
        }
    }
    */

    public function upload($id_user, $arquivo)
    {
        if (!isset($arquivo) || $arquivo['error'] !== 0) {
            // Selecionar avatar aleatório ou lançar exceção
            return false;
        }

        $id_file = Uuid::uuid7()->toString();
        $ext = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
        $user_path = $this->base_path . $id_user . '/';

        if (!is_dir($user_path)) {
            mkdir($user_path, $this->permissoes, true);
        }

        $final_path = $user_path . $id_file . '.' . $ext;
        $temp = $arquivo['tmp_name'];

        if (move_uploaded_file($temp, $final_path)) {
            return $final_path; // retorna o caminho final
        }

        return false;
    }
}
