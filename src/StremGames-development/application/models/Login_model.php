<?php defined('BASEPATH') or exit('No direct script access allowed');

    class Login_model extends CI_Model {

        public function __construct() {
            parent::__construct();
        }    

        public function valida_login($input) {
			$this->db->where('email', $input->post('email'));
            $this->db->where('senha', $input->post('senha'));
            $this->db->where('status', 1);
            $cliente = $this->db->get('clientes')->result();
            if(count($cliente)==1) {
                $dadosSessao['cliente'] = $cliente[0];
                $dadosSessao['logado'] = TRUE;
                $this->session->set_userdata($dadosSessao);
                return 0;
            } else {
                $this->db->where('email', $this->input->post('email'));
                $this->db->where('senha', $this->input->post('senha'));
                $this->db->where('status', 1);
                $adm = $this->db->get('administracao')->result();
                if(count($adm)==1) {
                    $dadosSessao['cliente'] = $adm[0];
                    $dadosSessao['logado'] = TRUE;
                    $this->session->set_userdata($dadosSessao);
                    return 42;
                }else{
                    $dadosSessao['cliente'] = NULL;
                    $dadosSessao['logado'] = FALSE;
                    $this->session->set_userdata($dadosSessao);
                    return 1;
                }
			}
        }

	public function destaques_home($quantos = 3) {
		$this->db->limit($quantos);
		$this->db->order_by('id', 'random');
		return $this->db->get('produtos')->result();
	}

	public function busca($buscar) {
		$this->db->like('titulo', $buscar);
		$this->db->or_like('descricao', $buscar);
		return $this->db->get('produtos')->result();
	}

    }
