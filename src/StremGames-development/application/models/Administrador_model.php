<?php defined('BASEPATH') or exit('No direct script access allowed');

class Administrador_model extends CI_Model {

    public function __construct() {
         parent::__construct();
    }    

    public function valida_login($input) {
        $this->db->where('email', $this->input->post('email'));
        $this->db->where('status', 7);
        $adm = $this->db->get('administracao')->result();
        
        if(count($adm) < 1)
            return FALSE;
        $adm = $adm[0];
        
        if( $adm->senha == hash("sha256", $input->post('senha') . $adm->salt))
        {
            $dadosSessao['administrador'] = $adm;
            $dadosSessao['logado'] = TRUE;
            $this->session->set_userdata($dadosSessao);
            return TRUE;
        }else{
            $dadosSessao['cliente'] = NULL;
            $dadosSessao['logado'] = FALSE;
            $this->session->set_userdata($dadosSessao);
            return FALSE;
        }
    }
    
    public function adicionar($dados){
        $dados['status'] = 7;
        return $this->db->insert('administracao', $dados);
    }
    
    public function excluir($input){
        $this->db->where('id', $this->input->post('id'));
        $this->db->where('email', $this->input->post('email'));
        $this->db->where('status', 7);
        return $this->db->delete('administracao');
    }
}
