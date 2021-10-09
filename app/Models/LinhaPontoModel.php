<?php 
namespace App\Models;
use CodeIgniter\Model;

    class LinhaPontoModel extends Model{
        protected $table = 'linha_has_ponto'; //nome da tabela
        protected $primaryKey = ['linha_id','ponto_id'];
        protected $allowedFields = ['linha_id','ponto_id','manha','tarde']; //compos permitidos para serem manipulados
        protected $returnType = 'object'; //como ele vai retornar as linhas da tabela
    }
?>