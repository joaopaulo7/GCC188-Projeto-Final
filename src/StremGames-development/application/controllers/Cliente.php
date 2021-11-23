<?php defined('BASEPATH') or exit('No direct script access allowed');

class Cliente extends CI_Controller {
    private $categorias;

    public function __construct() {
        parent::__construct();
        $this->load->model('jogo_model', 'modelJogo');
        $this->load->model('categorias_model', 'modelCategorias');
        $this->load->model('console_model', 'modelConsole');
        $this->load->model('desenvolvedora_model', 'modelDesenvolvedora');
        $this->load->model('cliente_model', 'clienteModel');
    }
    
    public function form_cadastro() {
        $this->load->helper('text');
        $data_header['categorias'] = $this->modelCategorias->getCategorias();
        $data_header['consoles'] = $this->modelConsole->getConsoles();
        $data_header['desenvolvedoras'] = $this->modelDesenvolvedora->getDesenvolvedoras();
        
        $this->load->view('html-header');
        $this->load->view('header', $data_header);
        $this->load->view('cadastro');
        $this->load->view('footer');
        $this->load->view('html-footer');
    }

    private function enviar_email_confirmacao($dados) {
        $mensagem = $this->load->view('emails/confirmar_cadastro.php', $dados, TRUE);
        $this->load->library('email');
        $this->email->from("joaopaulo7testes@gmail.com", "Confirmação de cadastro");
        $this->email->to($dados['email']);
        $this->email->subject('STrem Games - confirmação de cadastro');
        $this->email->message($mensagem);
        if($this->email->send()) {
            $data_header['categorias'] = $this->modelCategorias->getCategorias();
            $data_header['consoles'] = $this->modelConsole->getConsoles();
            $data_header['desenvolvedoras'] = $this->modelDesenvolvedora->getDesenvolvedoras();
            $this->load->view('html-header');
            $this->load->view('header', $data_header);
            $this->load->view('cadastro_completo');
            $this->load->view('footer');
            $this->load->view('html-footer');
        } else {
            print_r($this->email->print_debugger());
        }
    }

    public function adicionar() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome', 'Nome', 'required|min_length[5]');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|is_unique[clientes.email]');
        if ($this->form_validation->run() == FALSE) {
            $this->form_cadastro();
        } else {
            $dados['nome'] = $this->input->post('nome');
            $dados['sobrenome'] = $this->input->post('sobrenome');
            $dados['data_nascimento'] = dataHTML_to_dataMySQL($this->input->post('data_nascimento'));
            $dados['email'] = $this->input->post('email');
            
            $num = rand();
            $dados['salt'] =  substr(sha1($num), 0, 10);
            
            $dados['senha'] = hash("sha256", $this->input->post('senha') . $dados['salt'] );
            if($this->clienteModel->adicionar($dados)) {
                $this->enviar_email_confirmacao($dados);
            } else {
                echo "Houve um erro ao processar seu cadastro";
            }
        }
    }
    
    public function confirmar($hashEmail) {
            $this->clienteModel->confirmar($hashEmail);
    }
    
}
