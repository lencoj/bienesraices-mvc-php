<?php

namespace Model;

class Blog extends ActiveRecord {
    protected static $tabla = 'blogs';
    protected static $columnasDB = ['id', 'titulo', 'fecha', 'autor', 'detalles', 'imagen'];

    public $id;
    public $titulo;
    public $fecha;
    public $autor;
    public $detalles;    
    public $imagen;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->autor = $args['autor'] ?? '';
        $this->detalles = $args['detalles'] ?? '';
        $this->imagen = $args['imagen'] ?? '';

    }

    public function validar() {
        if(!$this->titulo) {
            self::$errores[] = "El Titulo es obligatorio";
        }

        if(!$this->fecha) {
            self::$errores[] = "La Fecha es obligatoria";
        }
        
        if(!$this->autor) {
            self::$errores[] = "El Autor es obligatorio";
        }
        
        if(!$this->detalles) {
            self::$errores[] = "La Descripción es obligatoria";
        }
        
        if(!$this->imagen) {
            self::$errores[] = "La Imagen para el Blog es obligatoria";
        }        

        return self::$errores;
    }

}