<?php defined('BASEPATH') OR exit('o direct script access allowed');

    class Console_model extends CI_Model {

        public $id;
        public $titulo;
        public $descricao;

        public function __construct() {
            parent::__construct();
        }

        public function getConsoles() {
            $this->db->select('id_console, nome');
            return $this->db->get('console')->result();
        }

        public function getConsole($id) {
            $this->db->where('id_console', $id);
            return $this->db->get('console')->result()[0];
        }

        public function adiciona( $dados){
            $this->db->insert('console',  $dados);
        }

        public function alterar( $dados){
            $this->db->where(' id_console', $dados['id_console']);
            $this->db->update('console', $dados);
        }
        
        public function podeDel( $id){
			if( $this->db->get_where('jogo', 'Console_id_console ='. $id)->result() != null)
				return false;
			else
				return true;
		}
		
		public function remove( $id){
            if($this->podeDel($id))
            {
                $this->db->where("id_console", $id);
                $this->db->delete("console");
                return TRUE;
            }
            else
                return FALSE;
		}
    }
