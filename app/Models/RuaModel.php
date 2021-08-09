<?php 
namespace App\Models;
use CodeIgniter\Model;

    class RuaModel extends Model{
        protected $table = 'ruasavenidas'; //nome da tabela
        protected $primaryKey = 'cep';
        protected $allowedFields = ['cep','nome']; //compos permitidos para serem manipulados
        protected $returnType = 'object'; //como ele vai retornar as linhas da tabela
    }
?>