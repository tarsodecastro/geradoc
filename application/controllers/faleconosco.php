<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faleconosco extends CI_Controller {
		
	function mensagem ($url_de_retorno){
		
		$nome = $this->input->post('nome');
		$email = $this->input->post('email');
		$subject = $this->input->post('subject');
		$message = $this->input->post('message');
	
		$assunto = "Contato GeraDox - ". $subject;
	
		$mensagem = '<div style="font-size: 11pt">';
		$mensagem .= $nome . ' ('. $email .') enviou a seguinte mensagem: <br/><br/>Assunto: ' . $subject .' <br/><br/>' . $message .' <br/><br/>';
		$mensagem .= '</div>';
		$mensagem .= "GeraDox - Sistema Gerenciador de Documentos<br />";
	
		$this->load->library('email');
		$this->email->from($email, 'Contato GeraDox');
	
		$this->email->reply_to($email);
		$this->email->to('tarsodecastro@gmail.com');
		$this->email->subject($assunto);
		$this->email->message($mensagem);
	
		if ( ! $this->email->send() ){
			
			echo $this->email->print_debugger();
			
			return false;
			
		} else {

			redirect(site_url() . "/" . $url_de_retorno);
			
			return true;
			
		}
	
	}
}