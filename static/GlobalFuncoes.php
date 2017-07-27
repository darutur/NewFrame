<?php

/**
 * Description of GlobalFuncoes
 * Classe onde se encontram os metodos estáticos de controle do sistema
 *
 * @author Eduardo
 */
class GlobalFuncoes {

    public static function UniMed($num) {
        switch ($num) {
            case '1':
                $nome = "Unidade";
                break;
            case '2':
                $nome = "Quilograma";
                break;
            case '3':
                $nome = "Litro";
                break;
        }
        return $nome;
    }
    
    public static function FormaPagamento($num) {
        switch ($num) {
            case '1':
                $nome = "Dinheiro";
                break;
            case '2':
                $nome = "Cartão de Crédito";
                break;
            case '3':
                $nome = "Cartão de Débito";
                break;
            case '4':
                $nome = "Desconto";
                break;
        }
        return $nome;
    }
    
    public static function MsgError($num) {
        $naoErro = 0;
        switch ($num) {
            case '1':
                $nome = "Não é possível realizar este procedimento, pois deixaria o estoque negativo!";
                break;
            case '2':
                $nome = "O código do Garçom não existe!";
                break;
            case '3':
                $nome = "O código da Mesa não existe!";
                break;
            case '4':
                $nome = "A mesa que informou já se encontra aberta! <br /> Volte a adicione um Pedido!";
                break;
            case '5':
                $nome = "A mesa que informou não se encontra aberta!";
                break;
            case '6':
                $nome = "A mesa que informou não existe!";
                break;
            case '7':
                $nome = "Ainda existe valor a ser pago!";
                break;
            case '8':
                $nome = "O sistema não conseguiu finalizar o atendimento, por favor tente novamente!<br/>Caso esta situação persista entre em contato com o suporte!";
                break;
            case '9':
                $nome = "O sistema não conseguiu fechar o caixa, por favor tente novamente!<br/>Caso esta situação persista entre em contato com o suporte!";
                break;
            default :
                $naoErro = 1;
        }
        
        if ($naoErro != 1) {
            echo '<div class="alert alert-danger alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" class="lead">×</span></button>
                  <h4>Ops! Ocorreu uma situação</h4>
                  <p>' . $nome . '</p>
              </div>';
        }
    }
    
    public static function MsgErrorArray($num, $array) {
        $naoErro = 0;
        switch ($num) {
            case '1':
                $nome = "A mesa foi aberta, mas os pedidos abaixo não foram incluídos!";
                break;
            case '2':
                $nome = "Não é possível fechar o caixa, pois existem mesas abertas! <br/> Segue abaixo a lista:";
                break;
            default :
                $naoErro = 1;
        }
        
        if ($naoErro != 1) {
            echo '<div class="alert alert-danger alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" class="lead">×</span></button>
                  <h4>Ops! Ocorreu uma situação</h4>
                  <p>
                    ' . $nome . '
                    <br/><br/>';
            foreach ($array as $numero) { echo "Mesa: <b>". $numero ."</b><br/>" ;}
            echo'
                  </p>
              </div>';
        }
    }
    
    public static function MsgSucesso($num) {
        $naoErro = 0;
        switch ($num) {
            case '1':
                $nome = "A mesa informada foi cancelada com Sucesso!";
                break;
            case '2':
                $nome = "Caixa fechado com Sucesso!";
                break;
            default :
                $naoErro = 1;
        }
        
        if ($naoErro != 1) {
            echo '<div class="alert alert-success alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" class="lead">×</span></button>
                  <h4>Ops! Ocorreu uma situação</h4>
                  <p>' . $nome . '</p>
              </div>';
        }
    }

}