<?php 
namespace App\Models;
use CodeIgniter\Model;

    class OnibusModel extends Model{
        protected $table = 'onibus'; //nome da tabela
        protected $primaryKey = 'id';
        protected $allowedFields = ['id','nome', 'empresa_id', 'linha_id']; //compos permitidos para serem manipulados
        protected $returnType = 'object'; //como ele vai retornar as linhas da tabela
    }
?>