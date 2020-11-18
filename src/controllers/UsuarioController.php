<?php
namespace src\controllers;

use \core\Controller;
use \src\models\Usuario;

class UsuarioController extends Controller {

    public function add() {
     $this->render('add');
    }

    public function addAction() {
      $nome = filter_input(INPUT_POST, 'nome');
      $email = filter_input(INPUT_POST, 'email');

      if($nome && $email) {
        $data = Usuario::select()->where('email', $email)->execute();

        if(count($data) === 0) {

          Usuario::insert([
            'nome' => ucwords(trim($nome)),
            'email' => strtolower(trim($email))
          ])->execute();
         
            $this->redirect('/');
        }

      }

      $this->redirect('/novo');

     }

    public function edit($args) {
      
      $id = $args['id'];

      $usuario = Usuario::select()->find($args['id']);
        
      $this->render('editar', ['usuario' => $usuario]);
    }
    
    public function editAction($args) {
      $nome = filter_input(INPUT_POST, 'nome');
      $email = filter_input(INPUT_POST, 'email');
    
      if($nome && $email) {

        Usuario::update()
          ->set('nome', ucwords(trim($nome)))
          ->set('email', strtolower(trim($email)))
          ->where('id', $args['id'])
        ->execute();

        $this->redirect('/');
      }else {
        $this->redirect('/usuario/'.$args['id'].'/edit');
      }
    }

    public function delete($args) {

      Usuario::delete()->where('id', $args['id'])->execute();

      $this->redirect('/');

    }
     
}