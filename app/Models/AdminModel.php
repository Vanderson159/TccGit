<?php 
namespace App\Models;
use CodeIgniter\Model;

    class AdminModel extends Model{
        protected $table = 'admin'; //nome da tabela
        protected $primaryKey = 'id';
        protected $allowedFields = ['id','login', 'senha']; //compos permitidos para serem manipulados
        protected $returnType = 'object'; //como ele vai retornar as linhas da tabela
    }
?>