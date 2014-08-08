<?php
$CI = & get_instance();
$CI->load->library(array('session', 'datas'));
$nivel_id = $CI->session->userdata('nivelId');
?>
<div class="conteiner1">
	<div class="titulo3">
		Tarefas	
	</div>
	
	<ul id="submenu">
	  	<li>	  			
	  			<a href="<?php echo site_url('/atendimento/add');?>">&raquo; Registrar novo atendimento</a>	  			
	  		</li>
	  		<?php if ($nivel_id == 4){ ?>
	  		<li>	  			
	  			<a href="<?php echo site_url('/atendimento');?>">&raquo; Gerenciar atendimentos</a>	  			
	  		</li>
	  		<?php } ?>
	  		<li>
	  			<a href="<?php echo site_url('/atendimento/myatendimentos'); ?>">&raquo; Meus atendimentos</a>
	  		</li>
	  		<li>	  			
	  			<a href="<?php echo site_url('/usuario/altsenha');?>">&raquo; Alterar minha senha de acesso</a>	  			
	  		</li>
	  		<li>	  			
	  			<a href="<?php echo site_url('/login/logoff');?>">&raquo; Sair do sistema</a>	  			
	  		</li>	  					  	
	  </ul>

</div>