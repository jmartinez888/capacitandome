<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles; // Roles y Permisos

class Usuario extends Model
{
    use HasRoles;
    
    protected $table          = 'users';
    protected $primaryKey     = 'idusuario';
    protected $guard_name = 'web';
    // protected $fillable       = ['idrol', 'idpersona', 'usuario', 'password','estado'];
    protected $fillable       = ['idpersona', 'usuario', 'password','estado'];

    public function CursoDocenteUsuarios(){
        return $this->belongsToMany('App\Models\Curso', 'curso_docente_usuario', 'idusuario', 'idcurso');
    }

    public function Persona(){
        return $this->belongsTo('App\Models\Persona', 'idpersona', 'idpersona');
    }

    // public function Rol(){
    //     return $this->belongsTo('App\Models\Rol', 'idrol', 'idrol');
    // }

    public function Recursos(){
        return $this->hasMany('App\Models\Recurso', 'idusuario', 'idusuario');
    }

    public function Ventas(){
        return $this->hasMany('App\Models\Venta', 'idusuario', 'idusuario');
    }

    public function Certificados(){
        return $this->hasMany('App\Models\Certificado', 'idusuario', 'idusuario');
    }

    public function Respuestas(){
        return $this->hasMany('App\Models\Respuesta', 'idusuario', 'idusuario');
    }

    public function Comentarios(){
        return $this->hasMany('App\Models\Comentario', 'idusuario', 'idusuario');
    }
}