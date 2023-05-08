<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;
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
        
        // Permisos
        Permission::create(['name'=>'admin_course_list', 'description'=>'Ver listado de cursos'])->syncRoles([$admin, $docente]);
        Permission::create(['name'=>'admin_course_nuevo','description'=>'Crear nuevo curso'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin_course_edit', 'description'=>'Editar curso'])->syncRoles([$admin, $docente]);
        Permission::create(['name'=>'change_status_course', 'description'=>'Cambiar estado del curso'])->syncRoles([$admin, $docente]);
    }
}