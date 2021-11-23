<?php defined('BASEPATH') OR exit('No direct script access allowed');
    
class Categoria extends CI_Controller {
            
    public function __construct() {
        parent::__construct();
        $this->load->model('jogo_model', 'modelJogo');
        
        $this->load->model('categorias_model', 'modelCategorias');
        $this->categorias = $this->modelCategorias->listar_categorias();
        
        $this->load->model('console_model', 'modelConsole');
        $this->consoles = $this->modelConsole->getConsoles();
        
        $this->load->model('desenvolvedora_model', 'modelDesenvolvedora');
        $this->desenvolvedoras = $this->modelDesenvolvedora->listar_desenvolvedoras();
    }
    
    public function index() {
        $this->load->helper('text');
        $data_header['categorias'] = $this->categorias;
        $data_header['consoles'] = $this->consoles;
        $data_header['desenvolvedoras'] = $this->desenvolvedoras;
        
        $data_header['categorias'] = $this->categorias;
        $data_pagina['categorias'] = $this->categorias;
        $this->load->view('html-header');
        $this->load->view('header', $data_header);
        $this->load->view('categorias', $data_pagina);
        $this->load->view('footer');              
        $this->load->view('html-footer');
    }
    
    public function categoria($id, $slug = null) {
        $this->load->helper('text');
        $data_header['categorias'] = $this->categorias;
        $data_pagina['categoria'] = $this->modelcategorias->listar_produtos_categoria($id);
        $this->load->view('html-header');
        $this->load->view('header', $data_header);
        $this->load->view('categoria', $data_pagina);
        $this->load->view('footer');
        $this->load->view('html-footer');
    }
}
