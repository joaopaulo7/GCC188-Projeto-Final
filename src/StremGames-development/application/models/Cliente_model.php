<?php defined('BASEPATH') or exit('No direct script access allowed');

class Cliente_model extends CI_Model {

    public function __construct() {
         parent::__construct();
    }    

    public function valida_login($input) {
		$this->db->where('email', $input->post('email'));
        $this->db->where('status', 1);
        $cliente = $this->db->get('clientes')->result();
        
        if(count($cliente) < 1)
            return FALSE;
        $cliente = $cliente[0];
        
        if( $cliente->senha == hash("sha256", $input->post('senha') . $cliente->salt))
        {
            $dadosSessao['cliente'] = $cliente;
            $dadosSessao['logado'] = TRUE;
            $this->session->set_userdata($dadosSessao);
            return TRUE;
        }
        else 
        {
            $dadosSessao['cliente'] = NULL;
            $dadosSessao['logado'] = FALSE;
            $this->session->set_userdata($dadosSessao);
            return FALSE;
        }
    }
    
    public function adicionar($dados){
        $dados['status'] = 0;
        return $this->db->insert('clientes', $dados);
    }
    
    public function confirmar($hashEmail) {
        $dados['status'] = 1;
        $this->db->where('salt', $hashEmail);
        if($this->db->update('clientes', $dados)) {
            redirect('/');
        } else {
            echo "Houve um erro ao confirmar seu cadastro";
        }
    }
}
