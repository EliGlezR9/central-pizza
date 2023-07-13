<?php

namespace Controllers;

use Classes\Email;
use Model\usuario;
use MVC\Router;

class LoginController{

    public static function login(Router $router){
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);
            //debuguear($auth);
            
            $alertas = $auth->validarLogin();

            if(empty($alertas)){
                //Comprobar que el usuario exite en la DB
                $usuario = Usuario::where('email', $auth->email);

                if($usuario){
                    //Verificar password
                    if($usuario->comprobarPasswordAndVerificado($auth->password)){
                        //Autenticar la sesion
                        session_start();

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;
                        //debuguear($_SESSION);

                        //Re-dirrecionamiento
                        if($usuario->admin === "1"){
                            $__SESSION['admin'] = $usuario->admin ?? null;  
                            header('Location: /admin');                      
                        }else{
                            header('Location: /main-menu');
                        }
                    }
                }else{
                    Usuario::setAlerta('error', 'Usuario no encontrado.');
                }
            }

        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/login', [
                'alertas' => $alertas
        ]);
    }

    public static function logout(){
        session_start();

        $_SESSION = [];

        header('Location: /');
    }

    public static function forgot(Router $router){
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();

            if(empty($alertas)){
                $usuario = Usuario::where('email', $auth->email);
                
                if($usuario && $usuario->confirmado === '1'){
                    $usuario->crearToken();
                    $usuario->guardar();

                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                    $email->enviarEmailRecuperacion();

                    Usuario::setAlerta('exito', 'Token de recuperación generado éxitosamente');
                    $alertas = Usuario::getAlertas();

                }else{
                    Usuario::setAlerta('error', 'El usuario no exiswte o no esta confirmado');
                    
                }

            }
            
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/forgot-password', [
            'alertas' => $alertas   
        ]);
    }

    public static function retrieve(Router $router){
        $alertas = [];
        $error = false;

        $token = s($_GET['token']);
        
        //buscar usuario por el token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)){
            Usuario::setAlerta('error', 'Token no válido');
            $error = true;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Leer nuevo password y guardarlo en DB
            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();

            if(empty($alertas)){
                //Eliminar antiguo password
                $usuario->password = null;
                //Guardar nuevo password
                $usuario->password = $password->password;
                //Hashear nuevo password
                $usuario->hashPassword();
                $usuario->token = null;

                $resultado = $usuario->guardar();
                if($resultado){
                    header('Location /');
                }                
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/retrieve-password', [
            'alertas' => $alertas,
            'error' => $error

        ]);
        
    }

    public static function create(Router $router){
        $usuario = new Usuario;

        $alertas = [];
       if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            //Revisar si alertas esta vacio
            if(empty($alertas)){
                $resultado = $usuario->existeUsuario();

                if($resultado-> num_rows){
                    $alertas = Usuario::getAlertas();
                }else{
                   //Hashear password:    
                   $usuario->hashPassword();
                  
                   //Generar token único              
                   $usuario->crearToken();
                   
                   //Enviar email de validacion

                   $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                   $email->enviarConfirmacion();
                   
                   //Creando usuario
                   $resultado = $usuario->guardar();
                   if($resultado){
                    header('Location: /message');
                   }


                }
            }
       } 

       $router->render('auth/create-account', [
            'usuario' => $usuario,
            'alertas' => $alertas
       ]);
    }
    public static function message(Router $router){
        $router->render('auth/message');
    }

    public static function confirm(Router $router){
        $alertas = [];

        $token = s($_GET['token']);

        $usuario = Usuario::where('token', $token);
       
        if(empty($usuario)){
            //Mostrar mensaje de error
            Usuario::setAlerta('error', 'El token no es valido.');
        }else{
            //Modificar usuario confirmado en DB
            $usuario->confirmado = "1";
            $usuario->token = null;
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta confirmada mediante token');
        }

        //Obtener alertas
        $alertas = usuario::getAlertas();

        //Renderizar la vista
        $router->render('auth/confirm-account', [
            'alertas' => $alertas
        ]);



    }
}
