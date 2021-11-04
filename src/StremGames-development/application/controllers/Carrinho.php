<?php defined('BASEPATH') or exit('No direct script access allowed');

class Carrinho extends CI_Controller {

    private $categorias;

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
            
        //limitando a quantidade de jogos pra 1
        foreach($this->cart->contents() as $item)
        {
            if($item['qty'] > 1)
            {
                $data = array('rowid' => $item['rowid'], 'qty' => 1);
                $this->cart->update($data);
            }
        }
        $data_header['categorias'] = $this->modelCategorias->listar_categorias();
        $data_header['consoles'] = $this->modelConsole->listar_consoles();
        $data_header['desenvolvedoras'] = $this->modelDesenvolvedora->listar_desenvolvedoras();
        
        $this->load->view('html-header');        
        $this->load->view('header', $data_header);
        $this->load->view('carrinho');
        $this->load->view('footer');
        $this->load->view('html-footer');

    }

    public function adicionar() {
        $data = array(
                    'id' => $this->input->post('id_jogo'),
                    'qty' => 1,
                    'price' => $this->input->post('preco'),
                    'name' => limpa_nome($this->input->post('nome')),
                    'url' => $this->input->post('url'),
                    'image' => $this->input->post('image'));
        
        $this->cart->insert($data);
        echo $this->cart->total_items();
        redirect(base_url("carrinho"));
    }

    public function remover($rowid) {
        $data = array('rowid' => $rowid, 'qty' => 0);
        $this->cart->update($data);
        redirect(base_url('carrinho'));
    }

    public function finalizar_compra() {
        if(null != $this->session->userdata('logado')) {
            $sessao = $this->session->userdata();
            if ($this->input->post('tipo_pagamento') == 'cartao') {
                    
                    foreach ($this->cart->contents() as $item) {
                                $dados_item['item'] = $item['id'];
                                $dados_item['preco'] = $item['price'];
                    }
                    
                    $total_a_cobrar = (double)($this->cart->total());
                    if($this->input->post('parcelamento') == 1) {
                                $operacao = 'credito_a_vista';
                    } else {
                                $operacao = 'parcelado_loja';
                    }

                    $dados_header['categorias'] = $this->categorias;
                    $this->load->view('html-header');
                    $this->load->view('header', $dados_header);
                    $this->load->view('retorno_cartao', $dados_retorno);
                    $this->load->view('footer');
                    $this->load->view('html_footer');
                    $this->db->trans_complete();

            } 
        }
    }



    public function form_pagamento() {
        
        $data_header['categorias'] = $this->modelCategorias->listar_categorias();
        $data_header['consoles'] = $this->modelConsole->listar_consoles();
        $data_header['desenvolvedoras'] = $this->modelDesenvolvedora->listar_desenvolvedoras();
        
        $this->load->view('html-header');
        $this->load->view('header', $data_header);
        $this->load->view('carrinho-formulario-pagamento');
        $this->load->view('footer');
        $this->load->view('html-footer');


    }


    public function pagar() {
        $this->form_pagamento();
    }



}
