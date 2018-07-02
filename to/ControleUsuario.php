<?php

/**
 * Description of ControleUsuario
 *
 * @author Eduardo
 */
class ControleUsuario implements IPrivateTO {

    public function home() {
        $v = new TGui("home");
        $v->renderizarInterno();
    }

}
