<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Permission;
use App\Company;
use App\Shift;

class AddACLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      //Roles for Users
      $adminACL = Role::firstOrCreate(['name'=>'Admin'],
      [
        'description' => 'Funcao de Administrador',
      ]);
      $gerenteACL = Role::firstOrCreate(['name'=>'Gerente'],
      [
        'description' => 'Funcao de Gerente',
      ]);

      //Busca Usuario no Banco
      $userAdmin = User::find(1);
      $userGerente = User::find(2);

      //Relaciona Usuario com Papel
      $userAdmin->roles()->attach($adminACL);
      $userGerente->roles()->attach($gerenteACL);

      $listUser = Permission::firstOrCreate(['name'=>'list-users'],
      [
        'description' => 'Listar registros',
      ]);
      $createUser = Permission::firstOrCreate(['name'=>'create-users'],
      [
        'description' => 'Criar registros',
      ]);
      $editUser = Permission::firstOrCreate(['name'=>'edit-users'],
      [
        'description' => 'Editar registros',
      ]);
      $showUser = Permission::firstOrCreate(['name'=>'show-users'],
      [
        'description' => 'Visualizar registros',
      ]);
      $deleteUser = Permission::firstOrCreate(['name'=>'delete-users'],
      [
        'description' => 'Deletar registros',
      ]);

      //Roles for Permissions

      $listPermission = Permission::firstOrCreate(['name'=>'list-permissions'],
      [
        'description' => 'Listar registros',
      ]);
      $createPermission = Permission::firstOrCreate(['name'=>'create-permissions'],
      [
        'description' => 'Criar registros',
      ]);
      $editPermission = Permission::firstOrCreate(['name'=>'edit-permissions'],
      [
        'description' => 'Editar registros',
      ]);
      $showPermission = Permission::firstOrCreate(['name'=>'show-permissions'],
      [
        'description' => 'Visualizar registros',
      ]);
      $deletePermission = Permission::firstOrCreate(['name'=>'delete-permissions'],
      [
        'description' => 'Deletar registros',
      ]);

      //Roles for Roles

      $listRole = Permission::firstOrCreate(['name'=>'list-roles'],
      [
        'description' => 'Listar registros',
      ]);
      $createRole = Permission::firstOrCreate(['name'=>'create-roles'],
      [
        'description' => 'Criar registros',
      ]);
      $editRole = Permission::firstOrCreate(['name'=>'edit-roles'],
      [
        'description' => 'Editar registros',
      ]);
      $showRole = Permission::firstOrCreate(['name'=>'show-roles'],
      [
        'description' => 'Visualizar registros',
      ]);
      $deleteRole = Permission::firstOrCreate(['name'=>'delete-roles'],
      [
        'description' => 'Deletar registros',
      ]);

      //Roles for Companies

      $listCompany = Permission::firstOrCreate(['name'=>'list-companies'],
      [
        'description' => 'Listar registros',
      ]);
      $createCompany = Permission::firstOrCreate(['name'=>'create-companies'],
      [
        'description' => 'Criar registros',
      ]);
      $editCompany = Permission::firstOrCreate(['name'=>'edit-companies'],
      [
        'description' => 'Editar registros',
      ]);
      $showCompany = Permission::firstOrCreate(['name'=>'show-companies'],
      [
        'description' => 'Visualizar registros',
      ]);
      $deleteCompany = Permission::firstOrCreate(['name'=>'delete-companies'],
      [
        'description' => 'Deletar registros',
      ]);

      //Roles for Shifts

      $listShift = Permission::firstOrCreate(['name'=>'list-shifts'],
      [
        'description' => 'Listar registros',
      ]);
      $createShift = Permission::firstOrCreate(['name'=>'create-shifts'],
      [
        'description' => 'Criar registros',
      ]);
      $editShift = Permission::firstOrCreate(['name'=>'edit-shifts'],
      [
        'description' => 'Editar registros',
      ]);
      $showShift = Permission::firstOrCreate(['name'=>'show-shifts'],
      [
        'description' => 'Visualizar registros',
      ]);
      $deleteShift = Permission::firstOrCreate(['name'=>'delete-shifts'],
      [
        'description' => 'Deletar registros',
      ]);

      //Roles for Special Hours

      $listSpecialHour = Permission::firstOrCreate(['name'=>'list-specialHours'],
      [
        'description' => 'Listar registros',
      ]);
      $createSpecialHour = Permission::firstOrCreate(['name'=>'create-specialHours'],
      [
        'description' => 'Criar registros',
      ]);
      $editSpecialHour = Permission::firstOrCreate(['name'=>'edit-specialHours'],
      [
        'description' => 'Editar registros',
      ]);
      $showSpecialHour = Permission::firstOrCreate(['name'=>'show-specialHours'],
      [
        'description' => 'Visualizar registros',
      ]);
      $deleteSpecialHour = Permission::firstOrCreate(['name'=>'delete-specialHours'],
      [
        'description' => 'Deletar registros',
      ]);

      //Role for acl

      $ACLUser = Permission::firstOrCreate(['name'=>'acl'],
      [
        'description' => 'Controlar Acessos',
      ]);

      //Relaciona Papel com Permissao
      $gerenteACL->Permissions()->attach($listUser);
      $gerenteACL->Permissions()->attach($createUser);
      $gerenteACL->Permissions()->attach($editUser);
      $gerenteACL->Permissions()->attach($showUser);
      $gerenteACL->Permissions()->attach($deleteUser);

      $gerenteACL->Permissions()->attach($listRole);
      $gerenteACL->Permissions()->attach($createRole);
      $gerenteACL->Permissions()->attach($editRole);
      $gerenteACL->Permissions()->attach($showRole);
      $gerenteACL->Permissions()->attach($deleteRole);

      $gerenteACL->Permissions()->attach($listPermission);
      $gerenteACL->Permissions()->attach($createPermission);
      $gerenteACL->Permissions()->attach($editPermission);
      $gerenteACL->Permissions()->attach($showPermission);
      $gerenteACL->Permissions()->attach($deletePermission);

      $gerenteACL->Permissions()->attach($listCompany);
      $gerenteACL->Permissions()->attach($createCompany);
      $gerenteACL->Permissions()->attach($editCompany);
      $gerenteACL->Permissions()->attach($showCompany);
      $gerenteACL->Permissions()->attach($deleteCompany);

      $gerenteACL->Permissions()->attach($listShift);
      $gerenteACL->Permissions()->attach($createShift);
      $gerenteACL->Permissions()->attach($editShift);
      $gerenteACL->Permissions()->attach($showShift);
      $gerenteACL->Permissions()->attach($deleteShift);

      $gerenteACL->Permissions()->attach($listSpecialHour);
      $gerenteACL->Permissions()->attach($createSpecialHour);
      $gerenteACL->Permissions()->attach($editSpecialHour);
      $gerenteACL->Permissions()->attach($showSpecialHour);
      $gerenteACL->Permissions()->attach($deleteSpecialHour);


        echo "Registros de ACL Criados! \n";
    }
}
