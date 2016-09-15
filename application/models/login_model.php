<?php
class Login_model extends CI_Model {		  
    private $sistemaId    = 4; // Id do sistema de Boletins na tabela sso.tb_sistema
	
	public function __construct(){
		parent::__construct();
	}

	/*
    public function get_usuario($cpf, $senha){            
    	$sistemaId = $this->sistemaId; 
        $sql = "SELECT 
                        s.id as sistemaId, 
                        s.nome as sistemaNome, 
                        u.id as usuarioId, 
                        u.nome as usuarioNome,                        
                        u.nome_guerra as usuarioNomeGuerra,
                        u.funcao as usuarioFuncao,
                        u.cpf as usuarioCPF,
                        u.setor as usuarioSetorId,
                        n.id as nivelId,
                        n.nome as nivelNome,
                        r.*
                 FROM 
                 		tb_sistema as s,
                 		tb_usuario as u,
                 		tb_nivel as n,
                 		tb_relacao as r
                 WHERE 
                        s.id = '$sistemaId' and
                        u.cpf = '$cpf' and 
                        u.senha = '$senha' and
                        u.id = r.id_usuario and
                        r.id_sistema = '$sistemaId' and
                        n.id = r.id_nivel and
                   		r.id_nivel > 1";                              

    	return $this->db->query($sql)->row();
	}
	*/
	
	public function get_usuario($cpf, $senha){
		
		$this->db->where('cpf', $cpf);
		$this->db->where('senha',$senha);
		
		$this->db->from('usuario');
		
		return $this->db->get()->row();
	
	}
	
	public function get_usuario_mail($email, $senha){
	
		$this->db->where('email', $email);
		$this->db->where('senha',$senha);
	
		$this->db->from('usuario');
	
		return $this->db->get()->row();
	
	}
        
    public function get_usuario_sso($cpf){            
    	$sistemaId = $this->sistemaId; 
        $sql = "SELECT 
                	s.id as sistemaId, 
                    s.nome as sistemaNome, 
                    u.id as usuarioId, 
                    u.nome as usuarioNome,                         
                    u.nome_guerra as usuarioNomeGuerra,
                    u.funcao as usuarioFuncao,
                    u.cpf as usuarioCPF,
                    u.setor as usuarioSetorId,
                    n.id as nivelId,
                    n.nome as nivelNome,
                    r.*
                FROM 
                	tb_sistema as s,
                	tb_usuario as u, tb_nivel as n, tb_relacao as r
                WHERE 
                	s.id = '$sistemaId' and
                    u.cpf = '$cpf' and 
                    u.id = r.id_usuario and
                    r.id_sistema = '$sistemaId' and
                    n.id = r.id_nivel and
                    r.id_nivel > 1";
    	return $this->db->query($sql)->row();
	}

}
?>