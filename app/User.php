<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; // Roles y Permisos

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $table          = 'users';
    protected $primaryKey     = 'idusuario';
    //protected $guard_name = 'web';
    // protected $fillable = [
    //     'usuario', 'password', 'idrol', 'idpersona',
    // ];

    protected $fillable = [
        'usuario', 'password', 'idpersona',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function CursoDocenteUsuarios(){
        return $this->belongsToMany('App\Models\Curso', 'curso_docente_usuario', 'idusuario', 'idusuario');
    }

    public function Entregable()
    {
        return $this->hasMany('App\Models\Entregable', 'idusuario', 'idusuario');
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

    public function ResolverExamenes(){
        return $this->hasMany('App\Models\ResolverExamen', 'idusuario', 'idusuario');
    }
}