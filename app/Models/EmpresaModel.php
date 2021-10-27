<?php 
namespace App\Models;
use CodeIgniter\Model;

    class EmpresaModel extends Model{
        protected $table = 'empresa'; //nome da tabela
        protected $primaryKey = 'id';
        protected $allowedFields = ['id','login','senha','nome','numero']; //compos permitidos para serem manipulados
        protected $returnType = 'object'; //como ele vai retornar as linhas da tabela
    }
?>