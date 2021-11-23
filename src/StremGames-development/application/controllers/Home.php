<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
        
		$data_body['destaques'] = $this->modelJogo->destaques_home();
        $this->load->view('html-header');
        $this->load->view('header', $data_header);
        $this->load->view('home', $data_body);
        $this->load->view('footer');
        $this->load->view('html-footer');
    }

	public function buscar() {
        $this->load->helper('text');
		$data_header['categorias'] = $this->modelCategorias->getCategorias();
        $data_header['consoles'] = $this->modelConsole->getConsoles();
        $data_header['desenvolvedoras'] = $this->modelDesenvolvedora->getDesenvolvedoras();
		$busca = $this->input->post('txt_busca');
        
		$data_body['termo'] = $busca;
		$data_body['destaques'] = $this->modelJogo->busca($busca);
        
        $this->load->view('html-header');
        $this->load->view('header', $data_header);
        $this->load->view('busca', $data_body);
        $this->load->view('footer');
        $this->load->view('html-footer');
 		
	}

}
