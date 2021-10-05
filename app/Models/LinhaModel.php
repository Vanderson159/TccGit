<?php 
namespace App\Models;
use CodeIgniter\Model;

    class LinhaModel extends Model{
        protected $table = 'linha'; //nome da tabela
        protected $primaryKey = 'id';
        protected $allowedFields = ['id','mapa','tempo','passagens', 'empresa_id']; //compos permitidos para serem manipulados
        protected $returnType = 'object'; //como ele vai retornar as linhas da tabela
    }
?>