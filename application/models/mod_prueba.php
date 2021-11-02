<?php
class mod_prueba extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function lista()
    {
        return $this->db->query("SELECT *
                            FROM personal AS p
                            INNER JOIN usuario AS u ON p.id_perso = u.id_perso
                            INNER JOIN tipo_usr AS t ON u.id_tipo = t.id_tipo
                            ORDER BY u.id_perso ASC")->result();
        //Consulta a la base de datos para mostrar usuarios
    }

    function registrar($personal, $usuario)
    {
        $this->db->insert('personal', $personal); //se hace el insert a la tabla personal de los parametros recibidos en el array del controlador
        $perso_id = $this->db->insert_id(); //se almacena temporalmente el id del usuario para asignarlo al usuario

        $usuario['id_perso'] = $perso_id; //se toma el id del usuario asociandolo a la empresa
        $this->db->insert('usuario', $usuario); //se insertan los parametros del controlador a la tabla empresa

        return $this->db->insert_id(); //retornamos el ultimo id registrado para la validacion del registrod
    }

    function login($user, $pwd)
    {
        $respuesta = $this->db->query("SELECT * FROM usuario WHERE nick_name = '$user' and clave = '$pwd' and estado = 1");
        //se verifica que el usuario exista y ademas este activo

        if ($respuesta->num_rows() > 0) {
            return $respuesta->row();
            //si cumple con las condiciones retorna los datos del usuario para generar en el controlador las variables de sesion
        } else {
            return false;
        }
    }

    function eliminar_registro(int $id_peson, int $id_user)
    {
        $this->db->query("DELETE FROM usuario WHERE id_user = '$id_user'");
        //primero se elimina el registro en la tabla usuarios ya que existe una relacion entre las tablas
        return $this->db->query("DELETE FROM personal WHERE id_perso = '$id_peson'");
        //posteriormente se elimina el registro de la tabla personal para finalizar la eliminacion de la cuenta
    }

    function validar_usuario(int $id_user)
    {
        return $this->db->query("UPDATE usuario SET estado = 1 WHERE id_user = '$id_user'");
        //se actualiza el estado del usuario para darle acceso
    }
}
