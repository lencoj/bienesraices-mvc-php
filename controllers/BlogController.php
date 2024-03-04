<?php

namespace Controllers;
use MVC\Router;
use Model\Blog;
use Intervention\Image\ImageManagerStatic as Image;

class BlogController {
    public static function crear(Router $router) {

        // Arreglo con mensajes de errores
        $errores = Blog::getErrores();

        $blog = new Blog;

        // Método POST para Crear
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            /** Crea una nueva instancia */
            $blog = new Blog($_POST['blog']);
           
            /** SUBIDA DE ARCHIVOS */
     
            // Generar un nombre único
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";        
    
            // Setear la imagen
            // Realiza un resize a la imagen con intervention
            if($_FILES['blog']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['blog']['tmp_name']['imagen'])->fit(800,600);
                $blog->setImagen($nombreImagen);    
            }
       
            // Validar
            $errores = $blog->validar();        
    
            if(empty($errores)) {
    
                // Crear la carpeta para subir imagenes
                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
    
                // Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);
    
                // Guarda en la base de datos           
                $resultado = $blog->guardar();   

                if($resultado) {
                    header('Location: /admin?resultado=1');
                }
            }
        }
    

        $router->render('blogs/crear', [
            'errores' => $errores,
            'blog' => $blog
        ]);
    }

    public static function actualizar(Router $router) {
        
        $id = validarORedireccionar('/admin');

        // Obtener los datos del blog
        $blog = Blog::find($id);
        
        // Arreglo con mensaje de errores
        $errores = Blog::getErrores();

        // Método POST para Actualizar
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Asignar los atributos
            $args = $_POST['blog'];

            $blog->sincronizar($args);

            // Validación
            $errores = $blog->validar();
    
            // Subida de archivos
            // Generar un nombre único
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg"; 

            if($_FILES['blog']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['blog']['tmp_name']['imagen'])->fit(800,600);
                $blog->setImagen($nombreImagen);    
            }

            if(empty($errores)) {
                if($_FILES['blog']['tmp_name']['imagen']) {
                    // Almacenar la imagen
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                // Guarda en la base de datos
                $resultado = $blog->guardar();

                if($resultado) {
                    header('Location: /admin?resultado=2');                  
                }
            }
        }

        $router->render('/blogs/actualizar', [
            'blog' => $blog,
            'errores' => $errores            
        ]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Validar id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            if($id) {
                $tipo = $_POST['tipo'];
                if(validarTipoContenido($tipo)) {            
                    $blog = Blog::find($id);
                    // $blog->eliminar();
                    $resultado = $blog->eliminar();

                    // Redireccionar
                    if($resultado){
                        header('Location: /admin?resultado=3');
                    }
                } 
            }       
        }
    }
}