<?php

    class Administrador extends CI_Controller {

        private $categorias;
        private $jogos;
        private $consoles;
        private $desenvolvedoras;

        public function __construct() {
            parent::__construct();
            if( $this->session->userdata('administrador')->status != 7){
                $this->session->sess_destroy();
                redirect(base_url("login"));
            }
        }

        public function index() {
            $this->load->helper('text');
            $this->load->view('html-header');
            $this->load->view('headerAdm');
            $this->load->view('menuAdministracao');
            $this->load->view('footer');
            $this->load->view('html-footer');
        }

//#ALTERAÇÔES NOS CONSOLES#---------------------------------------------------------------------------
        public function consoles($resultado = 0){
            $this->load->model('console_model', 'modelConsole');
            $data_body['consoles'] = $this->modelConsole->getConsoles();
            $data_body['resultado'] = $resultado;
            $this->load->view('html-header');
            $this->load->view('headerAdm');
            $this->load->view('consoles', $data_body);
            $this->load->view('footer');
            $this->load->view('html-footer');
        }

        public function form_altera_console($id){
            $this->load->model('console_model', 'modelConsole');
            $data_body['console'] = $this->modelConsole->getConsole($id);
            $this->load->view('html-header');
            $this->load->view('headerAdm');
            $this->load->view('altera_console', $data_body);
            $this->load->view('footer');
            $this->load->view('html-footer');
        }

        public function form_add_console(){
            $this->load->view('html-header');
            $this->load->view('headerAdm');
            $this->load->view('cria_console');
            $this->load->view('footer');
            $this->load->view('html-footer');
        }

        public function remove_console($id){
            $this->load->model('console_model', 'modelConsole');
            $data_body['podeDel'] = $this->modelConsole->podeDel($id);
            $data_body['console'] = $this->modelConsole->getConsole($id);
            
            $this->load->view('html-header');
            $this->load->view('headerAdm');
            $this->load->view('remove_console', $data_body);
            $this->load->view('footer');
            $this->load->view('html-footer');
        }

//#ALTERAÇÔES NOS JOGOS#-----------------------------------------------------------------------------------

        public function jogos() {
            //busca no banco
            $this->load->model('jogo_model', 'modelJogo');
            $data_body['jogos'] = $this->modelJogo->getJogos();
            
            //carrega view
            $this->load->view('html-header');
            $this->load->view('headerAdm');
            $this->load->view('jogos', $data_body);
            $this->load->view('footer');
            $this->load->view('html-footer');
        }
        
        public function form_altera_jogo($id){
            //buscar no banco
            $this->load->model('jogo_model', 'modelJogo');
            $data_body['jogo'] = $this->modelJogo->detalhes_jogo($id);
            
            $this->load->model('console_model', 'modelConsole');
            $consoles = $this->modelConsole->getConsoles();
            
            $this->load->model('categorias_model', 'modelCategoria');
            $categorias = $this->modelCategoria->getCategorias();
            
            $this->load->model('desenvolvedora_model', 'modelDesenvolvedora');
            $desenvolvedoras = $this->modelDesenvolvedora->getDesenvolvedoras();
            
            //Fazer as listas de labels para os dpropdowns
            foreach($consoles as $console)
                $data_body['consoles'][$console->id_console] = $console->nome;
            
            foreach($categorias as $categoria)
                $data_body['categorias'][$categoria->id_categoria] = $categoria->titulo;
            
            foreach($desenvolvedoras as $desenvolvedora)
                $data_body['desenvolvedoras'][$desenvolvedora->id_desenvolvedora] = $desenvolvedora->nome;
            
            
            //carrega view
            $this->load->view('html-header');
            $this->load->view('headerAdm');
            $this->load->view('altera_jogo', $data_body);
            $this->load->view('footer');
            $this->load->view('html-footer');
        }

        public function form_add_jogo(){
            //buscar no banco
            $this->load->model('console_model', 'modelConsole');
            $consoles = $this->modelConsole->getConsoles();
            
            $this->load->model('categorias_model', 'modelCategoria');
            $categorias = $this->modelCategoria->getCategorias();
            
            $this->load->model('desenvolvedora_model', 'modelDesenvolvedora');
            $desenvolvedoras = $this->modelDesenvolvedora->getDesenvolvedoras();
            
            
            //Fazer as listas de labels para os dpropdowns
            foreach($consoles as $console)
                $data_body['consoles'][$console->id_console] = $console->nome;
            
            foreach($categorias as $categoria)
                $data_body['categorias'][$categoria->id_categoria] = $categoria->titulo;
            
            foreach($desenvolvedoras as $desenvolvedora)
                $data_body['desenvolvedoras'][$desenvolvedora->id_desenvolvedora] = $desenvolvedora->nome;
            
            
            //carrega view
            $this->load->view('html-header');
            $this->load->view('headerAdm');
            $this->load->view('cria_jogo', $data_body);
            $this->load->view('footer');
            $this->load->view('html-footer');
        }

        public function remove_jogo($id){
            //busca no banco
            $this->load->library('upload');
            $this->load->model('jogo_model', 'modelJogo');
            $data_body['podeDel'] = $this->modelConsole->podeDel($id);
            $data_body['jogo'] = $this->modelJogo->getJogo();
            
            
            //carrega view
            $this->load->view('html-header');
            $this->load->view('headerAdm');
            $this->load->view('remove_console', $data_body);
            $this->load->view('footer');
            $this->load->view('html-footer');
        }

    }
?>
