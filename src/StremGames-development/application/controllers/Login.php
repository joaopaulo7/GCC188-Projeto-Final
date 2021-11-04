<?php defined('BASEPATH') or exit('No direct script access allowed');

    class Login extends CI_Controller {

        public function __construct() {
            parent::__construct();
            
            $this->load->model('categorias_model', 'modelCategorias');
            $this->load->model('console_model', 'modelConsole');
            $this->load->model('desenvolvedora_model', 'modelDesenvolvedora');
        }

        public function index() {
            $this->load->helper('text');
            $data_header['categorias'] = $this->modelCategorias->listar_categorias();
            $data_header['consoles'] = $this->modelConsole->listar_consoles();
            $data_header['desenvolvedoras'] = $this->modelDesenvolvedora->listar_desenvolvedoras();
            
            $data_header['categorias'] = $this->categorias;
            $this->load->view('html-header');
            $this->load->view('header', $data_header);
            $this->load->view('novo_cadastro');
            $this->load->view('footer');
            $this->load->view('html-footer');
        }

        public function esqueci_minha_senha() {
            $this->load->helper('text');
            $data_header['categorias'] = $this->modelCategorias->listar_categorias();
            $data_header['consoles'] = $this->modelConsole->listar_consoles();
            $data_header['desenvolvedoras'] = $this->modelDesenvolvedora->listar_desenvolvedoras();
            
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
                $this->email->from("2info.cefetvarginha@gmail.com", "Lojão do Terceirão");
                $this->email->to($dados->email);
                $this->email->subject('Lojão do Terceirão - confirmação de cadastro');
                $this->email->message($mensagem);

                if($this->email->send()) {
                    $this->load->helper('text');
                    $data_header['categorias'] = $this->modelCategorias->listar_categorias();
                    $data_header['consoles'] = $this->modelConsole->listar_consoles();
                    $data_header['desenvolvedoras'] = $this->modelDesenvolvedora->listar_desenvolvedoras();
                    
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
            $data_header['categorias'] = $this->modelCategorias->listar_categorias();
            $data_header['consoles'] = $this->modelConsole->listar_consoles();
            $data_header['desenvolvedoras'] = $this->modelDesenvolvedora->listar_desenvolvedoras();
            
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
                    redirect(base_url("home"));
                else
					$this->form_login(TRUE);
            }
        }

        public function logout() {
            $dadosSessao['cliente'] = null;
            $dadosSessao['logado'] = FALSE;
            $this->session->set_userdata($dadosSessao);
            redirect(base_url("login"));
        }

    }

