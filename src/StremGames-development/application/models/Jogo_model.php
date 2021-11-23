<?php defined('BASEPATH') or exit('No direct script access allowed');

class Jogo_model extends CI_Model {
        
    public function __construct() {
        parent::__construct();
    }    

    public function detalhes_jogo($id) {
        $this->db->select('id_jogo, titulo, descricao, codigo, Console_id_console, preco, ativo')->get_compiled_select();
        $this->db->where('id_jogo', $id);
        $res = $this->db->get('jogo')->result()[0];
        
        $this->db->select('id_categoria, titulo');
        $this->db->from('categoria');
        $this->db->join('jogo_has_categoria', 'categoria_id_categoria = categoria.id_categoria AND jogo_id_jogo = '.$res->id_jogo);
        $res->categorias = $this->db->get()->result();
        
        $this->db->select('id_desenvolvedora, nome');
        $this->db->from('desenvolvedora');
        $this->db->join('jogo_has_desenvolvedora', 'desenvolvedora_id_desenvolvedora = desenvolvedora.id_desenvolvedora AND jogo_id_jogo = '.$res->id_jogo);
        $res->desenvolvedoras = $this->db->get()->result();
        
        $this->db->select('id_console, nome');
        $this->db->from('console');
        $this->db->where('id_console = '.$res->Console_id_console);
        $res->console = $this->db->get()->result()[0];
        
        return $res;
    }

    public function getJogos(){
		$this->db->select('id_jogo, titulo, Console_id_console')->get_compiled_select();
        $ress = $this->db->get('jogo')->result();
        foreach($ress as $res)
        {
            $this->db->select('nome');
            $this->db->from('console');
            $this->db->where('id_console = '.$res->Console_id_console);
            $obj = $this->db->get()->result();
            $res->console = $obj[0]->nome;
        }
        return $ress;
    }

	public function destaques_home() {
		$this->db->order_by('id_jogo', 'random');
		$this->db->select('id_jogo, codigo, titulo, descricao')->get_compiled_select();
        $ress = $this->db->get('jogo')->result();
        return $ress;
	}

	public function busca($buscar) {
        
        $this->db->select('id_jogo, titulo, descricao')->get_compiled_select();
		$this->db->like('titulo', $buscar);
		$this->db->or_like('descricao', $buscar);
        $ress = $this->db->get('jogo')->result();
        return $ress;
	}

    public function adicionar($dados){
        $this->load->helper('file');
        
        $categorias = $dados['categorias'];
        $desenvolvedoras = $dados['desenvolvedoras'];
        unset($dados['categorias']);
        unset($dados['desenvolvedoras']);
        
        $dados['Console_id_console'] = $dados['console'];
        unset($dados['console']);
        
        unset($dados['btn_cadastrar']);
        
        //Cria jogo
        $this->db->insert('jogo',  $dados);
        
        //pega id
        $this->db->select('id_jogo');
        $this->db->where($dados);
        $id = $this->db->get('jogo')->result()[0]->id_jogo;
        
        
        //Adiciona nas tabelas relacionais
        foreach($categorias as $categoria)
            $this->db->insert('jogo_has_categoria',  array('jogo_id_jogo'=>$id, 'jogo_Console_id_console' =>$dados['Console_id_console'], 'categoria_id_categoria'=>$categoria));
        
        foreach($desenvolvedoras as $desenvolvedora)
            $this->db->insert('jogo_has_desenvolvedora',  array('jogo_id_jogo'=>$id, 'jogo_Console_id_console' =>$dados['Console_id_console'], 'desenvolvedora_id_desenvolvedora'=>$desenvolvedora));
    }

    public function alterar($dados){
        $this->load->helper('file');
        
        $categorias = $dados['categorias'];
        $desenvolvedoras = $dados['desenvolvedoras'];
        $id = $dados['id_jogo'];
        unset($dados['categorias']);
        unset($dados['desenvolvedoras']);
    
        //disconsidera os que não podem ser alterados.
        unset($dados['console']);
        unset($dados['codigo']);
        unset($dados['btn_cadastrar']);
        
        //Cria jogo
        $this->db->where('id_jogo = '. $id);
        $this->db->update('jogo',  $dados);
        
        $this->db->select('Console_id_console, codigo');
        $this->db->where('id_jogo = '. $id);
        $res = $this->db->get('jogo')->result()[0];
        
        $dados['Console_id_console'] = $res->Console_id_console;
        $dados['codigo'] = $res->codigo;
        
        //Adiciona nas tabelas relacionais
        $this->db->where('jogo_id_jogo = '. $id);
        $this->db->delete('jogo_has_categoria');
        foreach($categorias as $categoria){
            $this->db->insert('jogo_has_categoria',  array('jogo_id_jogo'=>$id, 'jogo_Console_id_console' =>$dados['Console_id_console'], 'categoria_id_categoria'=>$categoria));
        }
        
        $this->db->where('jogo_id_jogo = '. $id);
        $this->db->delete('jogo_has_desenvolvedora');
        foreach($desenvolvedoras as $desenvolvedora){
            $this->db->insert('jogo_has_desenvolvedora',  array('jogo_id_jogo'=>$id, 'jogo_Console_id_console' =>$dados['Console_id_console'], 'desenvolvedora_id_desenvolvedora'=>$desenvolvedora));
        }
    }

}
