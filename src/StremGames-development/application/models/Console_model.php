<?php defined('BASEPATH') OR exit('o direct script access allowed');

    class Console_model extends CI_Model {

        public $id;
        public $titulo;
        public $descricao;

        public function __construct() {
            parent::__construct();
        }

        public function listar_consoles() {
            $this->db->order_by('nome', 'ASC');
            return $this->db->get('console')->result();
        }

        public function detalhes_cconsole($id) {
            $this->db->where('id', $id);
            return $this->db->get('console')->result();
        }

        public function listar_produtos_categoria($id) {
            $dados['detalhes'] = $this->detalhes_categoria($id);
            $this->db->select('*');
            $this->db->from('produtos');
            $this->db->join('produtos_categoria', 'produtos_categoria.produto = produtos.id AND produtos_categoria.categoria = '.$id);
            $dados['produtos'] = $this->db->get()->result();
            return $dados;
        }

        public function getCategoria( $id){
            $res = $this->db->get_where('console',' id_console = '.$id)->result()[0];
            if( $res == null)
                return null;
            else
                return $res;
        }

        public function addNovo( $dados){
            $this->db->insert('console',  array( 'titulo' =>$dados['titulo'], 'descricao' =>$dados['descricao']));
        }

        public function alterar( $dados){
            $this->db->where(' id_console', $dados["id"]);
            $this->db->update('console', array( 'titulo' =>$dados['titulo'], 'descricao' =>$dados['descricao']));
        }
        
        public function podeDel( $id){
			if( $this->db->get_where('jogo', 'console ='. $id)->result() != null)
				return false;
			else
				return true;
		}
		
		public function del( $id){
			$this->db->where("id_console", $id);
			$this->db->delete("console");
		}
    }
