<?php 
namespace App\Models;
use CodeIgniter\Model;

    class PontoModel extends Model{
        protected $table = 'ponto'; //nome da tabela
        protected $primaryKey = 'id';
        protected $allowedFields = ['endereco','localizacao','rua_cep']; //compos permitidos para serem manipulados
        protected $returnType = 'object'; //como ele vai retornar as linhas da tabela
    }
?>