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
        $data_header['categorias'] = $this->modelCategorias->listar_categorias();
        $data_header['consoles'] = $this->modelConsole->listar_consoles();
        $data_header['desenvolvedoras'] = $this->modelDesenvolvedora->listar_desenvolvedoras();
        
        $this->load->view('html-header');
        $this->load->view('header', $data_header);
        $this->load->view('jogos');
        $this->load->view('footer');
        $this->load->view('html-footer');
    }


    public function info($id) {
        $this->load->helper('text');
        $data_header['categorias'] = $this->modelCategorias->listar_categorias();
        $data_header['consoles'] = $this->modelConsole->listar_consoles();
        $data_header['desenvolvedoras'] = $this->modelDesenvolvedora->listar_desenvolvedoras();
        $data_body['jogo'] = $this->modelJogo->detalhes_jogo($id);
        
        $this->load->view('html-header');
        $this->load->view('header', $data_header);
        $this->load->view('jogo', $data_body);
        $this->load->view('footer');
        $this->load->view('html-footer');
    }
}
