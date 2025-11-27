<?php

namespace Service\Models;

use DateTime;
use DateTimeZone;
use Exception;
use Service\Models\Conexao;
use Ramsey\Uuid\Uuid;

class User
{
    private $con;
    private $uploader;

    public function __construct()
    {
        $this->con = (new Conexao())->getCon();
        $this->uploader = new Uploader();
    }

    public function create($username, $password, $avatar)
    {
        try {
            $id = Uuid::uuid7()->toString();
            $query = "INSERT INTO users (id, created, username, password, avatar) VALUES (?, ?, ?, ?, ?)";

            $path = $this->uploader->upload($id, $avatar);

            $stmt = $this->con->prepare($query);
            $stmt->execute([$id, (new DateTime('now', new DateTimeZone('UTC')))->format('Y-m-d H:i:s'), $username, $password, $path]);

            return $id;
        } catch (Exception $e) {
            echo "Erro na inserção do usuario: " . $e->getMessage();
        }
    }

    public function create_auto($results = 1, $gender = '', $nationalities = '')
    {
        try {
            $ids = [];
            $users = $this->get_auto_users($results, $gender, $nationalities)['results'];

            foreach ($users as $result => $info) {
                $id = Uuid::uuid7()->toString();
                $username = $info['name']['first'] . ' ' . $info['name']['last'];
                $password = password_hash($info['login']['password'], PASSWORD_DEFAULT);
                $avatar = $info['picture']['large'];

                $query = "INSERT INTO users (id, created, username, password, avatar) VALUES (?, ?, ?, ?, ?)";

                $stmt = $this->con->prepare($query);
                $stmt->execute([$id, (new DateTime('now', new DateTimeZone('UTC')))->format('Y-m-d H:i:s'), $username, $password, $avatar]);

                $ids[] = $id;
            }

            return $ids;
        } catch (Exception $e) {
            echo "Erro na inserção do usuario: " . $e->getMessage();
        }
    }

    private function get_auto_users($results = 1, $gender = '', $nationalities = '')
    {
        $url = "https://randomuser.me/api/?results=$results&gender=$gender&nat=$nationalities";

        // Inicializa cURL
        $ch = curl_init($url);

        // Configura para retornar a resposta como string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Executa a requisição
        $response = curl_exec($ch);

        // Fecha cURL
        curl_close($ch);

        // Converte JSON em array associativo
        return json_decode($response, true);
    }
}
