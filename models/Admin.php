<?php

namespace Model;

class Admin extends ActiveRecord
{
    // Base de datos:
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar()
    {
        if (!$this->email) {
            self::$errores[] = "El correo no es válido";
        }
        if (!$this->password) {
            self::$errores[] = "La contraseña no es válida";
        }
        return self::$errores;
    }

    public function existeUsuario()
    {
        // Revisar si un usuario existe o no:
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '$this->email' LIMIT 1;";
        $resultado = self::$db->query($query);

        if (!$resultado->num_rows) {
            self::$errores[] = "El correo no está registrado";
            return;
        }
        return $resultado;
    }

    public function comprobarPassword($resultado) {
        $usuario = $resultado->fetch_object();
        $autenticado = password_verify($this->password, $usuario->password);
        if (!$autenticado) {
            self::$errores[] = 'La contraseña es incorrecta';
        }
        return $autenticado;
    }

    public function autenticarUsuario() {
        session_start();
        // Llenar la superglobal $_SESSION:
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: /admin');
    }

    
}
