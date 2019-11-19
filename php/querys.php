<?php


class SA_Encryption {

    const OPEN_SSL_METHOD = 'aes-256-cbc';
    // Generate a 256-bit encryption key
    const BASE64_ENCRYPTION_KEY = 'G1fM0aXhguJ5tVaqVMJOVHB+Jk6QFd99FgkfAcEgwjI'; //base64_encode(openssl_random_pseudo_bytes(32));
    const BASE64_IV = 'xIkaHuquZFjtP4SI4mIyOg'; //base64_encode(openssl_random_pseudo_bytes(openssl_cipher_iv_length(AES_256_CBC)));

    static private function base64_url_encode($input) {
        return strtr(base64_encode($input), '+/=', '-_,');
    }

    static private function base64_url_decode($input) {
        return base64_decode(strtr($input, '-_,', '+/='));
    }


    static function encrypt_to_url_param($message) {
        $encrypted = openssl_encrypt($message, self::OPEN_SSL_METHOD, base64_decode(self::BASE64_ENCRYPTION_KEY), 0, base64_decode(self::BASE64_IV));
        $base64_encrypted = self::base64_url_encode($encrypted);
        return $base64_encrypted;
    }

    static function decrypt_from_url_param($base64_encrypted) {
        $encrypted = self::base64_url_decode($base64_encrypted);
        $decrypted = openssl_decrypt($encrypted, self::OPEN_SSL_METHOD, base64_decode(self::BASE64_ENCRYPTION_KEY), 0, base64_decode(self::BASE64_IV));
        return $decrypted;
    }
}

class crud {

    private $mes;

    public function __construct() {

        $this->mes = date("m");

        $db = 'db_aosantos';
        $user = 'zrc';
        $pass = '123';
        $host = '192.168.1.68';

        try {
            $this->pdo = new PDO('mysql:host=' . $host . ';dbname=' . $db . '', $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function __call($name, $argument) {

        if (method_exists($this, $name)) {
            return call_user_func_array(array($this, $name), $argument);
        } else {
            throw new Exception("Método Não Acessível!", 1);
        }
    }

    // MÉTODO DE LOGIN
    // --------------------------------------------
    private function chk_login($info) {

        $info['senha'] = crypt($info['senha'], 'inforway');

        $select = $this->pdo->prepare("SELECT * FROM tb_usuario WHERE login_usuario = ? AND senha_usuario = ?");

        $select->bindParam(1, $info['login'], PDO::PARAM_INT);
        $select->bindParam(2, $info['senha'], PDO::PARAM_INT);

        $select->execute();

        return $select->fetchAll();
    }

    private function query_p($query) {

        $select = $this->pdo->query($query);
        return $select->fetchAll();
    }

    //MÉTODO DINÂMICO DE INSERÇÃO SQL
    //
    //$nome_tabela  : nome da tabela sem o 'tb_'
    //$info         : vetor ordenado de informações a serem inseridas
    //
    //obs.: os indices do vetor devem ser o nome do respectivo campo
    //      sem o '_tabela'
    //
    private function pdo_cadastro($nome_tabela, $info) {

        //montagem da query dinâmica
        $cont_param = 0;
        $sql = "INSERT INTO tb_$nome_tabela(";

        foreach ($info as $index => $key) {
            $sql .= $index . ", ";
            $cont_param += 1;
        }

        $sql = substr_replace($sql, "", -2);
        $sql .= ") VALUES (";

        for ($i = 0; $i < $cont_param; $i++) {
            $sql .= "?,";
        }

        $sql = substr_replace($sql, "", -1);
        $sql .= ")";

        //echo $sql;
        //---------------------------------
        //execução da query
        try {
            $prepara = $this->pdo->prepare($sql);

            $controle = 1;
            foreach ($info as $index => $key) {
                $prepara->bindParam($controle, $info[$index], PDO::PARAM_INT);
                $controle += 1;
            }

            $prepara->execute();
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    //MÉTODO DINÂMICO DE EDIÇÃO SQL
    //
    //$nome_tabela  : nome da tabela sem o 'tb_'
    //$info         : vetor ordenado de informações a serem inseridas
    //$campo_id     : nome do campo do código identificador
    //
    //obs.: os indices do vetor devem ser o nome do respectivo campo
    //      sem o '_tabela'
    //
    private function pdo_edit($nome_tabela, $info, $campo_id) {

        //montagem da query dinâmica
        $cont_param = 0;
        $sql = "UPDATE tb_$nome_tabela SET ";

        foreach ($info as $index => $key) {
            if ($index !== $campo_id) {
                $sql .= $index . " = ?, ";
                $cont_param += 1;
            }
        }

        $sql = substr_replace($sql, "", -2);
        $sql .= " WHERE " . $campo_id . " = ?";
        //---------------------------------

        try {
            $prepara = $this->pdo->prepare($sql);

            $controle = 1;
            foreach ($info as $index => $key) {
                if ($index !== $campo_id) {
                    $prepara->bindParam($controle, $info[$index], PDO::PARAM_INT);
                    $controle += 1;
                }
            }

            $prepara->bindParam($controle, $info[$campo_id], PDO::PARAM_INT);

            $prepara->execute();
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    //MÉTODO DINÂMICO DE SELEÇÃO SQL
    //
    //$nome_tabela  : nome da tabela sem o 'tb_'
    //$campo_id     : condição de pesquisa como 'WHERE id = 1'
    //
    private function pdo_src($nome_tabela, $condicao) {

        $select = $this->pdo->query("SELECT * FROM tb_$nome_tabela $condicao ");
        return $select->fetchAll();
    }

    //MÉTODO DINÂMICO DE REMOÇÃO SQL
    //
    //$nome_tabela  : nome da tabela sem o 'tb_'
    //$campo_id     : condição de pesquisa como 'WHERE id = 1'
    //
    private function pdo_delete($nome_tabela, $id) {

        $this->pdo->query("DELETE FROM tb_$nome_tabela WHERE id = $id ");

    }

    //MÉTODO DINÂMICO DE EXECUÇÃO SQL
    //
    //executa um comando SQL sem retorno de valores,
    //como INSERT, UPDATE, DELETE, ALTER
    //
    //$query     : expressão SQL a ser executada
    //
    private function query_void($query) {

        $select = $this->pdo->query($query);
    }

    //MÉTODO DINÂMICO DE EXECUÇÃO SQL
    //
    //executa um comando SQL com retorno de valores,
    //como SELECT
    //
    //$query     : expressão SQL a ser executada
    //
    private function query($query) {

        $select = $this->pdo->query($query);
        return $select->fetchAll();
    }

    private function edita_senha($id, $senha) {

        try {
            $prepara = $this->pdo->prepare("
			UPDATE tb_usuario
			SET
				senha_usuario = ?
			WHERE
				id_usuario = ?

			");

            $prepara->bindParam(1, $senha, PDO::PARAM_INT);
            $prepara->bindParam(2, $id, PDO::PARAM_INT);

            $prepara->execute();

        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

    }

    private function bloq_usuario($id, $status) {

        try {
            $remove = $this->pdo->query("
				UPDATE tb_usuario
				SET
					ativo_usuario = '".$status . "'
				WHERE
					id_usuario = '".$id . "'
			");

        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

    }

    private function edita_usuario($info) {

        try {
            $prepara = $this->pdo->prepare("
			UPDATE tb_usuario
			SET
                nome_usuario = ?,
				login_usuario = ?
			WHERE
				id_usuario = ?

			");

            $prepara->bindParam(1, $info['nome'], PDO::PARAM_INT);
            $prepara->bindParam(2, $info['login'], PDO::PARAM_INT);
            $prepara->bindParam(3, $info['id'], PDO::PARAM_INT);

            $prepara->execute();

        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

    }

    function cadastra_usuario($info) {

        try {
            $prepara = $this->pdo->prepare("
			INSERT INTO tb_usuario
			(
                nome_usuario,
				login_usuario,
				senha_usuario,
                nivel_usuario,
                ativo_usuario

			)
			VALUES
			(
				?,?,?,'usuario',1
			)

			");

            $prepara->bindParam(1, $info['nome'], PDO::PARAM_INT);
            $prepara->bindParam(2, $info['login'], PDO::PARAM_INT);
            $prepara->bindParam(3, $info['senha'], PDO::PARAM_INT);

            $prepara->execute();

        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

    }

}
