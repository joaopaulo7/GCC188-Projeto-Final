<?php defined('BASEPATH') OR exit('No direct script access allowed');
    
class Console extends CI_Controller {
            
    public function __construct() {
        parent::__construct();
        $this->load->model('console_model', 'modelConsole');
    }
    
    public function index() {
        $this->load->helper('text');
        
        $this->load->model('jogo_model', 'modelJogo');
        
        $this->load->model('categorias_model', 'modelCategorias');
        $data_header['categorias']  = $this->modelCategorias->getCategorias();
        
        $data_header['consoles']  = $this->modelConsole->getConsoles();
        
        $this->load->model('desenvolvedora_model', 'modelDesenvolvedora');
        $data_header['desenvolvedoras'] = $this->modelDesenvolvedora->getDesenvolvedoras();
        
        
        $this->load->view('html-header');
        $this->load->view('header', $data_header);
        $this->load->view('console', $data_pagina);
        $this->load->view('footer');              
        $this->load->view('html-footer');
    }
    
    public function alterar() {
        if( $this->session->userdata('administrador')->status != 7){
            $this->session->sess_destroy();
            redirect(base_url("login"));
        }
        $dados['id_console'] = $this->input->post('numero');
        $dados['nome'] = $this->input->post('nome');
        $dados['descricao'] = $this->input->post('descricao');
        $this->modelConsole->alterar($dados);
        redirect(base_url('administrador/consoles/7'));
    }
    
    public function adicionar() {
        if( $this->session->userdata('administrador')->status != 7){
            $this->session->sess_destroy();
            redirect(base_url("login"));
        }
        $dados['nome'] = $this->input->post('nome');
        $dados['descricao'] = $this->input->post('descricao');
        $this->modelConsole->adiciona($dados);
        redirect(base_url('administrador/consoles/7'));
    }
    
    public function remover() {
        if( $this->session->userdata('administrador')->status != 7){
            $this->session->sess_destroy();
            redirect(base_url("login"));
        }
        
        $dados['id_console'] = $this->input->post('numero');
        if($this->modelConsole->remove($dados['id_console']))
            redirect(base_url('administrador/consoles/7'));
        else
            redirect(base_url('administrador/consoles/1'));
    }
}
