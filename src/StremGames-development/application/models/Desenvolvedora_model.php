<?php defined('BASEPATH') OR exit('o direct script access allowed');

    class Desenvolvedora_model extends CI_Model {

        public $id;
        public $titulo;
        public $descricao;

        public function __construct() {
            parent::__construct();
        }

        public function getDesenvolvedoras() {
            $this->db->order_by('nome', 'ASC');
            return $this->db->get('desenvolvedora')->result();
        }

        public function detalhes_desenvolvedora($id) {
            $this->db->where('id_desenvolvedora', $id);
            return $this->db->get('desenvolvedora')->result();
        }

        public function listar_produtos_desenvolvedora($id) {
            $dados['detalhes'] = $this->detalhes_categoria($id);
            $this->db->select('*');
            $this->db->from('jogo');
            $this->db->join('produtos_categoria', 'produtos_categoria.produto = produtos.id AND produtos_categoria.categoria = '.$id);
            $dados['produtos'] = $this->db->get()->result();
            return $dados;
        }

        public function getCategoria( $id){
            $res = $this->db->get_where('desenvolvedora',' id_desenvolvedora = '.$id)->result()[0];
            if( $res == null)
                return null;
            else
                return $res;
        }

        public function addNovo( $dados){
            $this->db->insert('desenvolvedora',  array( 'titulo' =>$dados['titulo'], 'descricao' =>$dados['descricao']));
        }

        public function alterar( $dados){
            $this->db->where(' id_desenvolvedora', $dados["id"]);
            $this->db->update('desenvolvedora', array( 'titulo' =>$dados['titulo'], 'descricao' =>$dados['descricao']));
        }
        
        public function podeDel( $id){
			if( $this->db->get_where("jogo_has_desenvolvedora", "desenvolvedora_id_desenvolvedora =". $id)->result() != null)
				return false;
			else
				return true;
		}
		
		public function del( $id){
			$this->db->where(" id_desenvolvedora", $id);
			$this->db->delete("desenvolvedora");
		}
    }
