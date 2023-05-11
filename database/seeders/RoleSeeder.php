<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Roles
        $admin = Role::create(['name' => 'Admin']);
        $docente = Role::create(['name' => 'Docente']);
        $estudiante = Role::create(['name' => 'Estudiante']);
        
        // Permisos para Usuarios
        Permission::create(['name'=>'admin_personas', 'description'=>'Ver listado de usuarios'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin_personas_create','description'=>'Crear nuevos usuarios'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin_personas_edit', 'description'=>'Editar usuarios'])->syncRoles([$admin, $docente]);
        //Permission::create(['name'=>'change_status_course', 'description'=>'Cambiar estado del curso'])->syncRoles([$admin, $docente]);

        // Route::get('admin/personas/delete/{id}', 'PersonaController@destroy')->name('admin_personas_delete')->middleware('auth');
        // /* ASIGNAR ALUMNO AL CURSO */
        // Route::get('/admin/asignar-alumno', 'PersonaController@indexAsignarAlumno')->name('admin_asignar_alumno')->middleware('auth');
        // Route::post('/admin/guardarasigalumno', 'PersonaController@guardarAsignarAlumno')->name('admin_guardar_asig')->middleware('auth');
        // Route::get('/admin/listasigalumno', 'PersonaController@listasigalumno')->name('admin_listasigalumno')->middleware('auth');
        // Route::get('/admin/mostrarasigalumno/{id}', 'PersonaController@mostrarasigalumno')->name('admin_mostrarasigalumno')->middleware('auth');

        // Permisos para los cursos
        Permission::create(['name'=>'admin_course_list', 'description'=>'Ver listado de cursos'])->syncRoles([$admin, $docente]);
        Permission::create(['name'=>'admin_course_nuevo','description'=>'Crear nuevos cursos'])->syncRoles([$admin, $docente]);
        Permission::create(['name'=>'admin_course_edit', 'description'=>'Editar cursos'])->syncRoles([$admin, $docente]);
        Permission::create(['name'=>'change_status_course', 'description'=>'Cambiar estado de los cursos'])->syncRoles([$admin, $docente]);

        // Permisos para los roles
        Permission::create(['name'=>'admin.listar.roles', 'description'=>'Ver listado de roles'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.crearEditar.roles','description'=>'Crear/Editar nuevos roles'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.cambiarEstado.roles', 'description'=>'Cambiar estado de los roles'])->syncRoles([$admin]);

        $administrador = User::find('1');
        $administrador->assignRole('Admin');
    }
}