<?php

use checkSessionUtente as GlobalCheckSessionUtente;

class checkSessionUtente
{
    // verifica se o utente fex login e a variavél de sessão criada,
    // e não esta vazia
    public function idUtente()
    {
        $idUtente = null;
        if (isset($_SESSION['idUtente'])) {
            $idUtente = $_SESSION['idUtente'];
        }
        return $idUtente;
    }

    public function checkSEssion()      // Verifica autorização
    {

        if ($this->idUtente() <= 0) :
            // redireciona para apágina inicial caso não tiver autorização
            header('location: ' . ROUTE . '?page=home');
        else :
            // preserva o ID do utente caso tiver autorização
            return $this->idUtente();
        endif;
    }
    
    public function checkRules()      // Verifica às regras de acesso às páginas
    {
        /******* REGRAS **************/

        # 1 - Só fará reserva se estiver autenticado;
        # 2 - Só acessa o perfil se estiver autenticado;
        # 3 - Só faz o login se estiver autorizado;
        # 4 - O nome do uetente no menu só aparece sele estiver autenticado
        # 5 - O botão reservar redireciona para a página de login sem ele estiver sem autenticação

        if ($this->idUtente() >= 1) : // verifica  a autenticação
            return $this->idUtente(); // retorna o ID do utente autenticado
        else :
            session_destroy(); // termina a sessão caso utente insistir em acessar algo não autorizado
            return 0;      // Inabalita o utente zombi
        endif;
    }

    public function checkAccess()   // verifica o acesso às página de login e registro
    {
        // verifica se o usuário já esta autentidado quando tenta aceder a 
        // página de login ou a página de registro

        if (!$this->idUtente() <= 0) :
            // redireciona para o perfil caso já estiver autenticcado
            header('location: ' . ROUTE . '?page=perfil-utente');
        else :
            // Permanece na pagina de login ou registro
            // caso não estiver autenticado
            return 0;
        endif;
    }
}

/* Istancia de clsass */

$auth = new GlobalCheckSessionUtente;
