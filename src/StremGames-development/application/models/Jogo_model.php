<?php defined('BASEPATH') or exit('No direct script access allowed');

class Jogo_model extends CI_Model {
        
    public function __construct() {
        parent::__construct();
    }    

    public function detalhes_jogo($id) {
        $this->db->select('id_jogo, titulo, descricao, codigo, Console_id_console, preco, ativo')->get_compiled_select();
        $this->db->where('id_jogo', $id);
        $res = $this->db->get('jogo')->result()[0];
        
        $this->db->select('nome');
        $this->db->from('midias');
        $this->db->join('jogo_has_midias', 'midias_id_midias = midias.id_midias AND jogo_id_jogo = '.$res->id_jogo);
        $res->image = $this->db->get()->result()[0]->nome;
        
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

	public function destaques_home() {
		$this->db->order_by('id_jogo', 'random');
		$this->db->select('id_jogo, titulo, descricao')->get_compiled_select();
        $ress = $this->db->get('jogo')->result();
        foreach($ress as $res)
        {
            $this->db->select('nome');
            $this->db->from('midias');
            $this->db->join('jogo_has_midias', 'midias_id_midias = midias.id_midias AND jogo_id_jogo = '.$res->id_jogo);
            $obj = $this->db->get()->result();
            if($obj != null)
                $res->image = $obj[0]->nome;
            else
                $res->image = "not_found.png";
        }
        return $ress;
	}

	public function busca($buscar) {
        
        $this->db->select('id_jogo, titulo, descricao')->get_compiled_select();
		$this->db->like('titulo', $buscar);
		$this->db->or_like('descricao', $buscar);
        $ress = $this->db->get('jogo')->result();
        
        foreach($ress as $res)
        {
            $this->db->select('nome');
            $this->db->from('midias');
            $this->db->join('jogo_has_midias', 'midias_id_midias = midias.id_midias AND jogo_id_jogo = '.$res->id_jogo);
            $obj = $this->db->get()->result();
            if($obj != null)
                $res->image = $obj[0]->nome;
            else
                $res->image = "not_found.png";
        }
        return $ress;
	}

}
