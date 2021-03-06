<?php defined('BASEPATH') or exit('No direct script access allowed');

    class Login extends CI_Controller {

        public function __construct() {
            parent::__construct();
            
            $this->load->model('categorias_model', 'modelCategorias');
            $this->load->model('console_model', 'modelConsole');
            $this->load->model('desenvolvedora_model', 'modelDesenvolvedora');
            $this->load->model('cliente_model', 'clienteModel');
            $this->load->model('administrador_model', 'administradorModel');
        }

        public function index() {
            $this->load->helper('text');
            $data_header['categorias'] = $this->modelCategorias->getCategorias();
            $data_header['consoles'] = $this->modelConsole->getConsoles();
            $data_header['desenvolvedoras'] = $this->modelDesenvolvedora->getDesenvolvedoras();
            
            $data_header['categorias'] = $this->categorias;
            $this->load->view('html-header');
            $this->load->view('header', $data_header);
            $this->load->view('novo_cadastro');
            $this->load->view('footer');
            $this->load->view('html-footer');
        }

        public function esqueci_minha_senha() {
            $this->load->helper('text');
            $data_header['categorias'] = $this->modelCategorias->getCategorias();
            $data_header['consoles'] = $this->modelConsole->getConsoles();
            $data_header['desenvolvedoras'] = $this->modelDesenvolvedora->getDesenvolvedoras();
            
            $this->load->view('html-header');
            $this->load->view('header', $data_header);
            $this->load->view('form_recupera_login');
            $this->load->view('footer');
            $this->load->view('html-footer');
        }

        public function recuperar_login() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
        $this->form_validation->set_rules('cpf', 'CPF', 'required|min_length[14]');
        if($this->form_validation->run() == FALSE) {
            $this->esqueci_minha_senha();
        } else {
            $this->db->where('email', $this->input->post('email'));
            $this->db->where('cpf', $this->input->post('cpf'));
            $this->db->where('status', 1);
            $cliente = $this->db->get('clientes')->result();

            if(count($cliente)==1) {
                $dados = $cliente[0];
                $mensagem = $this->load->view('emails/recuperar_senha.php', $dados, TRUE);
                $this->load->library('email');
                $this->email->from("2info.cefetvarginha@gmail.com", "Loj??o do Terceir??o");
                $this->email->to($dados->email);
                $this->email->subject('Loj??o do Terceir??o - confirma????o de cadastro');
                $this->email->message($mensagem);

                if($this->email->send()) {
                    $this->load->helper('text');
                    $data_header['categorias'] = $this->modelCategorias->getCategorias();
                    $data_header['consoles'] = $this->modelConsole->getConsoles();
                    $data_header['desenvolvedoras'] = $this->modelDesenvolvedora->getDesenvolvedoras();
                    
                    $this->load->view('html-header');
                    $this->load->view('header', $data_header);
                    $this->load->view('senha_enviada');
                    $this->load->view('footer');
                    $this->load->view('html-footer');
                } else {
                    print_r($this->email->print_debugger());
                }
            } else {
                redirect(base_url("esqueci_minha_senha"));
            }
        }
    }

        public function form_login($erro = FALSE) {
            $this->load->helper('text');
            $data_header['categorias'] = $this->modelCategorias->getCategorias();
            $data_header['consoles'] = $this->modelConsole->getConsoles();
            $data_header['desenvolvedoras'] = $this->modelDesenvolvedora->getDesenvolvedoras();
            
            $data_login['erro'] = $erro;
            $this->load->view('html-header');
            $this->load->view('header', $data_header);
            $this->load->view('login', $data_login);
            $this->load->view('footer');
            $this->load->view('html-footer');
        }

        public function login() {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
            $this->form_validation->set_rules('senha', 'Senha', 'required');
            if($this->form_validation->run() == FALSE)
            {
                $this->form_login();
            } 
            else
            {
				if($this->clienteModel->valida_login($this->input))
					redirect(base_url("home"));
				else if($this->administradorModel->valida_login($this->input))
                    redirect(base_url("administrador"));
                else
					$this->form_login(TRUE);
            }
        }

        public function logout() {
            $this->session->sess_destroy();
            redirect(base_url("Home"));
        }

    }

