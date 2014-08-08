<?php

 /*
     * Classe Chat
     * Modo de utilizacao no controller:
     * $chat = new Chat();
     * $this->chat = $chat->constroeChat();
     * Carrega o resultado na varivel {TPL_chat} do layout default.php
     */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Chat {

    public function constroeChat() {

        $CI =& get_instance(); // pegando a intsancia do CI do controller em substituicao a vaiavel $this do controller.
        $CI->load->model('Chat_model', '', TRUE);
        $CI->load->library('session');

        $objetosChat = $CI->Chat_model->listOnLine()->result();

        $nomeGuerra = $CI->session->userdata('nomeGuerra');
        
        $linha = "";
        
        foreach ($objetosChat as $objChat) {

            $usr = $objChat->user_data;

            $usr = unserialize($usr);

            if ($usr['nomeGuerra'] != $nomeGuerra) { // retira o proprio usuario da lista do chat. (ele nao precisa falar com ele mesmo :)

                $usr['nomeGuerra'] = mb_convert_case($usr['nomeGuerra'], MB_CASE_TITLE, "UTF-8");

                $linha = $linha . '<li>' . "\n";
                
                if ($usr['funcao'] == '1'){ // caso seja NENHUM eh retirado o "1_" e fica so o nome de guerra do terceirizado
                    
                    $linha = $linha . '<a href="#" onclick="javascript:chatWith(\'' . $usr['nomeGuerra'] . '\')" class="online"> ' . $usr['nomeGuerra'] . '</a>' . "\n";
                    
                }else{
                
                    $linha = $linha . '<a href="#" onclick="javascript:chatWith(\'' . $usr['funcao'] . '_' . $usr['nomeGuerra'] . '\')" class="online">' . $usr['funcao'] . ' ' . $usr['nomeGuerra'] . '</a>' . "\n";
               
                }
                
                 $linha = $linha . '</li>' . "\n";
                
            }
             
        }

        return $linha;
    }

}

