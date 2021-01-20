<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Unidades
        Permission::create([
            'name' => 'Navegar unidades',
            'slug' => 'unidads.index',
            'description' => 'Lista y navega todos los unidades del sistema',
        ]);
        Permission::create([
            'name' => 'Creacion de unidades',
            'slug' => 'unidads.create',
            'description' => 'Crear un unidad al sistema',
        ]);
        Permission::create([
            'name' => 'Edicion de unidades',
            'slug' => 'unidads.edit',
            'description' => 'Editar cualquier dato de un unidad del sistema',
        ]);
        Permission::create([
            'name' => 'Eliminar unidad',
            'slug' => 'unidads.destroy',
            'description' => 'Eliminar cualquier unidad del sistema',
        ]);

        //Componente
        Permission::create([
            'name' => 'Navegar componentes',
            'slug' => 'componentes.index',
            'description' => 'Lista y navega todos los componentes del sistema',
        ]);
        Permission::create([
            'name' => 'Creacion de componentes',
            'slug' => 'componentes.create',
            'description' => 'Crear un componente al sistema',
        ]);
        Permission::create([
            'name' => 'Edicion de componentes',
            'slug' => 'componentes.edit',
            'description' => 'Editar cualquier dato de un componente del sistema',
        ]);
        Permission::create([
            'name' => 'Eliminar componente',
            'slug' => 'componentes.destroy',
            'description' => 'Eliminar cualquier componente del sistema',
        ]);

        //Diagnostico
        Permission::create([
            'name' => 'Navegar diagnosticos',
            'slug' => 'diagnosticos.index',
            'description' => 'Lista y navega todos los diagnosticos del sistema',
        ]);
        Permission::create([
            'name' => 'Creacion de diagnosticos',
            'slug' => 'diagnosticos.create',
            'description' => 'Crear un diagnostico al sistema',
        ]);
        Permission::create([
            'name' => 'Edicion de diagnosticos',
            'slug' => 'diagnosticos.edit',
            'description' => 'Editar cualquier dato de un diagnostico del sistema',
        ]);
        Permission::create([
            'name' => 'Eliminar diagnostico',
            'slug' => 'diagnosticos.destroy',
            'description' => 'Eliminar cualquier diagnostico del sistema',
        ]);

        //Servicio
        Permission::create([
            'name' => 'Navegar servicios',
            'slug' => 'servicios.index',
            'description' => 'Lista y navega todos los servicios del sistema',
        ]);
        Permission::create([
            'name' => 'Creacion de servicios',
            'slug' => 'servicios.create',
            'description' => 'Crear un servicio al sistema',
        ]);
        Permission::create([
            'name' => 'Edicion de servicios',
            'slug' => 'servicios.edit',
            'description' => 'Editar cualquier dato de un servicio del sistema',
        ]);
        Permission::create([
            'name' => 'Eliminar servicio',
            'slug' => 'servicios.destroy',
            'description' => 'Eliminar cualquier servicio del sistema',
        ]);

        //Usuario
        Permission::create([
            'name' => 'Navegar usuarios',
            'slug' => 'users.index',
            'description' => 'Lista y navega todos los usuarios del sistema',
        ]);
        Permission::create([
            'name' => 'Creacion de usuarios',
            'slug' => 'users.create',
            'description' => 'Crear un usuario al sistema',
        ]);
        Permission::create([
            'name' => 'Edicion de usuarios',
            'slug' => 'users.edit',
            'description' => 'Editar cualquier dato de un usuario del sistema',
        ]);
        Permission::create([
            'name' => 'Eliminar usuario',
            'slug' => 'users.destroy',
            'description' => 'Eliminar cualquier usuario del sistema',
        ]);
        Permission::create([
            'name' => 'Perfil del usuario',
            'slug' => 'users.perfil',
            'description' => 'Ve el perfil del usuario del sistema',
        ]);
        Permission::create([
            'name' => 'Cambiar password de usuario',
            'slug' => 'users.changepassword',
            'description' => 'Cambia el password del usuario del sistema',
        ]);

        //Role
        Permission::create([
            'name' => 'Navegar roles',
            'slug' => 'roles.index',
            'description' => 'Lista y navega todos los roles del sistema',
        ]);
        Permission::create([
            'name' => 'Creacion de roles',
            'slug' => 'roles.create',
            'description' => 'Crear un rol al sistema',
        ]);
        Permission::create([
            'name' => 'Edicion de roles',
            'slug' => 'roles.edit',
            'description' => 'Editar cualquier dato de un rol del sistema',
        ]);
        Permission::create([
            'name' => 'Eliminar rol',
            'slug' => 'roles.destroy',
            'description' => 'Eliminar cualquier rol del sistema',
        ]);

        //Tickets
        Permission::create([
            'name' => 'Navegar tickets',
            'slug' => 'tickets.index',
            'description' => 'Lista y navega todos los tickets del sistema',
        ]);
        Permission::create([
            'name' => 'Creacion de tickets',
            'slug' => 'tickets.create',
            'description' => 'Crear un ticket al sistema',
        ]);
        Permission::create([
            'name' => 'Edicion de tickets',
            'slug' => 'tickets.edit',
            'description' => 'Editar cualquier dato de un ticket del sistema',
        ]);
        Permission::create([
            'name' => 'Eliminar ticket',
            'slug' => 'tickets.destroy',
            'description' => 'Eliminar cualquier ticket del sistema',
        ]);
        Permission::create([
            'name' => 'Imprimir ticket',
            'slug' => 'tickets.imprimir',
            'description' => 'Imprime un ticket del sistema',
        ]);
        Permission::create([
            'name' => 'Asignar ticket',
            'slug' => 'tickets.asignar',
            'description' => 'Asigna un ticket del sistema a un tecnico',
        ]);
        Permission::create([
            'name' => 'Realizar Informe del ticket',
            'slug' => 'tickets.informe',
            'description' => 'Realizar el informe del ticket del sistema a un tecnico',
        ]);

         //Informe de Bajas
        Permission::create([
            'name' => 'Navegar Informes de bajas',
            'slug' => 'bajas.index',
            'description' => 'Lista y navega todos los informes tecnicos de bajas del sistema',
        ]);
        Permission::create([
            'name' => 'Creacion Informes de bajas',
            'slug' => 'bajas.create',
            'description' => 'Crear un informe tecnico de baja al sistema',
        ]);
        Permission::create([
            'name' => 'Edicion Informes de bajas',
            'slug' => 'bajas.edit',
            'description' => 'Editar cualquier dato de un informe tecnico de baja del sistema',
        ]);
        Permission::create([
            'name' => 'Eliminar Informe de baja',
            'slug' => 'bajas.destroy',
            'description' => 'Eliminar cualquier informe tecnico de baja del sistema',
        ]);
        Permission::create([
            'name' => 'Imprimir Informe de baja',
            'slug' => 'bajas.imprimir',
            'description' => 'Imprime un informe tecnico de baja del sistema',
        ]);

         //Informe de Reparacion
        Permission::create([
            'name' => 'Navegar Informes de reparaciones',
            'slug' => 'reparacions.index',
            'description' => 'Lista y navega todos los informes tecnicos de reparaciones del sistema',
        ]);
        Permission::create([
            'name' => 'Creacion Informes de reparaciones',
            'slug' => 'reparacions.create',
            'description' => 'Crear un informe tecnico de reparacion al sistema',
        ]);
        Permission::create([
            'name' => 'Edicion Informes de reparaciones',
            'slug' => 'reparacions.edit',
            'description' => 'Editar cualquier dato de un informe tecnico de reparacion del sistema',
        ]);
        Permission::create([
            'name' => 'Eliminar Informe de reparacion',
            'slug' => 'reparacions.destroy',
            'description' => 'Eliminar cualquier informe tecnico de reparacion del sistema',
        ]);
        Permission::create([
            'name' => 'Imprimir Informe de reparacion',
            'slug' => 'reparacions.imprimir',
            'description' => 'Imprime un informe tecnico de reparacion del sistema',
        ]);

        //Informe de Recepcion
        Permission::create([
            'name' => 'Navegar Informes de recepciones',
            'slug' => 'recepcions.index',
            'description' => 'Lista y navega todos los informes tecnicos de recepciones del sistema',
        ]);
        Permission::create([
            'name' => 'Creacion Informes de recepciones',
            'slug' => 'recepcions.create',
            'description' => 'Crear un informe tecnico de recepcion al sistema',
        ]);
        Permission::create([
            'name' => 'Edicion Informes de recepciones',
            'slug' => 'recepcions.edit',
            'description' => 'Editar cualquier dato de un informe tecnico de recepcion del sistema',
        ]);
        Permission::create([
            'name' => 'Eliminar Informe de recepcion',
            'slug' => 'recepcions.destroy',
            'description' => 'Eliminar cualquier informe tecnico de recepcion del sistema',
        ]);
        Permission::create([
            'name' => 'Imprimir Informe de recepcion',
            'slug' => 'recepcions.imprimir',
            'description' => 'Imprime un informe tecnico de recepcion del sistema',
        ]);

        //Informe de Reposicion
        Permission::create([
            'name' => 'Navegar Informes de reposiciones',
            'slug' => 'reposicions.index',
            'description' => 'Lista y navega todos los informes tecnicos de reposiciones del sistema',
        ]);
        Permission::create([
            'name' => 'Creacion Informes de reposiciones',
            'slug' => 'reposicions.create',
            'description' => 'Crear un informe tecnico de reposicion al sistema',
        ]);
        Permission::create([
            'name' => 'Edicion Informes de reposiciones',
            'slug' => 'reposicions.edit',
            'description' => 'Editar cualquier dato de un informe tecnico de reposicion del sistema',
        ]);
        Permission::create([
            'name' => 'Eliminar Informe de reposicion',
            'slug' => 'reposicions.destroy',
            'description' => 'Eliminar cualquier informe tecnico de reposicion del sistema',
        ]);
        Permission::create([
            'name' => 'Imprimir Informe de reposicion',
            'slug' => 'reposicions.imprimir',
            'description' => 'Imprime un informe tecnico de reposicion del sistema',
        ]);

        //Informe de Externo
        Permission::create([
            'name' => 'Navegar Informes de externos',
            'slug' => 'externos.index',
            'description' => 'Lista y navega todos los informes tecnicos de externos del sistema',
        ]);
        Permission::create([
            'name' => 'Creacion Informes de externos',
            'slug' => 'externos.create',
            'description' => 'Crear un informe tecnico de externo al sistema',
        ]);
        Permission::create([
            'name' => 'Edicion Informes de externos',
            'slug' => 'externos.edit',
            'description' => 'Editar cualquier dato de un informe tecnico de externo del sistema',
        ]);
        Permission::create([
            'name' => 'Eliminar Informe de externo',
            'slug' => 'externos.destroy',
            'description' => 'Eliminar cualquier informe tecnico de externo del sistema',
        ]);
        Permission::create([
            'name' => 'Imprimir Informe de externo',
            'slug' => 'externos.imprimir',
            'description' => 'Imprime un informe tecnico de externo del sistema',
        ]);
        
        //Direcciones
        Permission::create([
            'name' => 'Navegar direcciones ip',
            'slug' => 'direccions.index',
            'description' => 'Lista y navega todos los direcciones ip del sistema',
        ]);
        Permission::create([
            'name' => 'Creacion de direcciones ip',
            'slug' => 'direccions.create',
            'description' => 'Crear una direccion ip al sistema',
        ]);
        Permission::create([
            'name' => 'Edicion de direcciones ip',
            'slug' => 'direccions.edit',
            'description' => 'Editar cualquier dato de una direccion ip del sistema',
        ]);
        Permission::create([
            'name' => 'Eliminar direccion ip',
            'slug' => 'direccions.destroy',
            'description' => 'Eliminar cualquier direccion ip del sistema',
        ]);

        Permission::create([
            'name' => 'Observar direccion ip',
            'slug' => 'direccions.observado',
            'description' => 'Observa cualquier direccion ip del sistema',
        ]);
        Permission::create([
            'name' => 'Importar direcciones ip',
            'slug' => 'direccions.importar',
            'description' => 'Importa varias direcciones ip del sistema desde un archivo excel',
        ]);

        //Reportes
        Permission::create([
            'name' => 'Reportes Estadisticos',
            'slug' => 'reportes.index',
            'description' => 'Visualizar reportes estadisticos del sistema',
        ]);
        Permission::create([
            'name' => 'Imprimir reporte',
            'slug' => 'reportes.imprimir',
            'description' => 'Imprimir reportes de informes tecnicos del sistema',
        ]);
        Permission::create([
            'name' => 'Reportes Personalizados',
            'slug' => 'reportes.personalizado',
            'description' => 'Busquedas de reportes personalizados de los informes tecnicos',
        ]);
    }
}
