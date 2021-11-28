<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Jogo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->model('jogo_model', 'modelJogo');
        $this->load->model('categorias_model', 'modelCategorias');
        $this->load->model('console_model', 'modelConsole');
        $this->load->model('desenvolvedora_model', 'modelDesenvolvedora');
    }

    public function index() {
        $this->load->helper('text');
        $data_header['categorias'] = $this->modelCategorias->getCategorias();
        $data_header['consoles'] = $this->modelConsole->getConsoles();
        $data_header['desenvolvedoras'] = $this->modelDesenvolvedora->getDesenvolvedoras();
        
        $this->load->view('html-header');
        $this->load->view('header', $data_header);
        $this->load->view('jogos');
        $this->load->view('footer');
        $this->load->view('html-footer');
    }


    public function info($id) {
        $this->load->helper('text');
        $data_header['categorias'] = $this->modelCategorias->getCategorias();
        $data_header['consoles'] = $this->modelConsole->getConsoles();
        $data_header['desenvolvedoras'] = $this->modelDesenvolvedora->getDesenvolvedoras();
        $data_body['jogo'] = $this->modelJogo->detalhes_jogo($id);
        
        $this->load->view('html-header');
        $this->load->view('header', $data_header);
        $this->load->view('jogo', $data_body);
        $this->load->view('footer');
        $this->load->view('html-footer');
    }
    
    public function adicionar(){
        if( $this->session->userdata('administrador')->status != 7){
            $this->session->sess_destroy();
            redirect(base_url("login"));
        }
        
        $dados = $this->input->post();
        $this->modelJogo->adicionar($dados);
         
        $config['upload_path']          = './assets/img/jogos';
        $config['allowed_types']        = 'jpg|jpeg';
        $config['max_size']             = 1000;
        $config['max_width']            = 1920;
        $config['max_height']           = 1080;
        $config['max_height']           = 1080;
        $config['overwrite']           = TRUE;
        $config['file_name']              = $dados['codigo'];
        $this->load->library('upload', $config);
        if( !$this->upload->do_upload('imagemCapa'))
            echo $this->upload->display_errors();
        
        unset($config);
        
        $config['upload_path']          = './assets/isos';
        $config['allowed_types']        = 'iso|cue|png';
        $config['max_size']             = 1000;
        $config['max_width']            = 1920;
        $config['max_height']           = 1080;
        $config['max_height']           = 1080;
        $config['overwrite']           = TRUE;
        $config['file_name']              = $dados['codigo'];
        $this->upload->initialize( $config, TRUE);
        if( !$this->upload->do_upload('imagem'))
            echo $this->upload->display_errors();
        
        redirect(base_url("administrador/jogos/7"));
    }
    
    public function alterar(){
        if( $this->session->userdata('administrador')->status != 7){
            $this->session->sess_destroy();
            redirect(base_url("login"));
        }
        
        $dados = $this->input->post();
        $this->modelJogo->alterar($dados);
         
        $config['upload_path']          = './assets/img/jogos';
        $config['allowed_types']        = 'jpg|jpeg';
        $config['max_size']             = 2000;
        $config['max_width']            = 1920;
        $config['max_height']           = 1080;
        $config['overwrite']           = TRUE;
        $config['file_name']              = removePonto($dados['codigo']);
        
        $this->load->library('upload', $config);
        $this->upload->initialize( $config, TRUE);
        if( !$this->upload->do_upload('imagemCapa'))
            echo $this->upload->display_errors();
        
        unset($config);
        $config['upload_path']          = './assets/isos';
        $config['allowed_types']        = 'iso|cue|png';
        $config['max_size']             = 2000;
        $config['max_width']            = 1920;
        $config['max_height']           = 1080;
        $config['overwrite']           = TRUE;
        $config['file_name']              = removePonto($dados['codigo']);
        
        $this->upload->initialize( $config, TRUE);
        if( !$this->upload->do_upload('imagem'))
            echo $this->upload->display_errors();
        
        redirect(base_url("administrador/jogos/7"));
    }
    
    public function remover(){
        if( $this->session->userdata('administrador')->status != 7){
            $this->session->sess_destroy();
            redirect(base_url("login"));
        }
        
        
        $id = $this->input->post('numero');
        
        if($this->modelJogo->podeDel($id))
            $this->modelJogo->remover($id);
        else
            $this->modelJogo->inativar($id);
        
        
        redirect(base_url("administrador/jogos/7"));
    }
    
}
