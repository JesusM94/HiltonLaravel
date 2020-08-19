<template>
	<main class="main">
        <div class="container-fluid col-md-10">
        	<br>
            <div class="card" v-show="!detalle">
                <div class="card-header">
                    <h1><i class="fas fa-users"></i> Administracion de Agentes</h1>
                    <button type="button" data-toggle="modal" data-target="#ModalAgente" data-backdrop="static" data-keyboard="false" @click="abrirModal('agente','registrar')" class="btn btn-dark float-sm-right">
                    	<i class="fas fa-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                	<v-client-table :data="tableData" :columns="columns" :options="options">

                		<template slot="id" slot-scope="props">

                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-outline-primary btn-rounded waves-effect" data-toggle="modal" data-target="#ModalAgente" data-backdrop="static" data-keyboard="false" @click="abrirModal('agente','actualizar',props.row)">
                                    <i class="fas fa-edit fa-lg"></i>
                                </button>&nbsp;

                                <button type="button" v-if="props.row.estado == 1" class="btn btn-outline-danger btn-rounded waves-effect" data-toggle="modal" data-target="#ModalDanger" data-backdrop="static" data-keyboard="false" @click="eliminarAgente(0,props.row)">
                                    <i class="fas fa-trash fa-lg"></i>
                                </button>

                                <button type="button" v-if="props.row.estado == 0" class="btn btn-outline-success btn-rounded waves-effect" data-toggle="modal" data-target="#ModalDanger" data-backdrop="static" data-keyboard="false" @click="activarAgente(0,props.row)">
                                    <i class="fas fa-trash-restore fa-lg"></i>
                                </button>
                            </div>

                        </template>

                        <template slot="estado" slot-scope="props">
                            <template v-if="props.row.estado">
                                <span class=" badge-dark badge-pill bg-success">
                                    Activo
                                </span>
                            </template>
                            <template v-else>
                                <span class=" badge-dark badge-pill bg-danger">
                                    Inactivo
                                </span>
                            </template>
                        </template>

                	</v-client-table>
                </div>
            </div>
        </div>

        <!-- Modal Actualizacion/Registro de Datos-->
		<div class="modal fade" id="ModalAgente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    			<div class="modal-content">
    				<div class="modal-header">
        				<h5 class="modal-title" id="exampleModalCenterTitle" v-text="tituloModal"></h5>
        				<button type="button" class="close" aria-label="Close" @click="cerrarModal()">
         					<span aria-hidden="true">&times;</span>
        				</button>
    				</div>
    				<div class="modal-body">
    					<br>
    					<div class="alert alert-danger text-center" role="alert" v-show="error1">
							*Los campos marcados son obligatorios.
						</div>

    					<div class="row">
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">*Nombre de Usuario:</label>
								<input type="text" name="nombre_usuario" class="form-control" id="NameUser1" placeholder="Nombre de Usuario" :value="this.agentes.nombre_usuario" required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
							    <label for="exampleInputCelular1">*Contraseña:</label>
								<input type="text" name="password" class="form-control" id="Password1" placeholder="Contraseña" :value="this.agentes.contrasena" required>
							</div>
						</div>
						<br>

        				<div class="row">
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
							    <label for="exampleInputEmail1">*Nombre:</label>
								<input type="text" name="nombre" class="form-control" id="Name1" placeholder="Nombre" :value="this.agentes.nombre" required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
							    <label for="exampleInputEmail1">*Apellido Paterno:</label>
								<input type="text" name="app" class="form-control" id="Apellido1" placeholder="Apellido Paterno" :value="this.agentes.apellido_paterno" required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
							    <label for="exampleInputEmail1">*Apellido Materno:</label>
								<input type="text" name="apm" class="form-control" id="Apellido2" placeholder="Apellido Materno" :value="this.agentes.apellido_materno" required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
							    <label for="exampleInputLocal1">Fecha de Alta:</label>
								<!--<input type="text" name="fecha_alta" class="form-control" id="Fecha1" placeholder="Fecha de Alta" :value="this.agentes.fecha_alta" required>-->
								<input class="form-control" id="Fecha1" type="date" :value="this.agentes.fecha_alta" required="">
							</div>
						</div>
						<br>

						<div class="row">
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
							    <label for="exampleInputLocal1">Telefono Local:</label>
								<input type="text" name="tel_local" class="form-control" id="Local1" placeholder="Telefono Local" :value="this.agentes.telefono_local" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
							    <label for="exampleInputCelular1">Telefono Celular:</label>
								<input type="text" name="tel_cel" class="form-control" id="Celular1" placeholder="Telefono Celular" :value="this.agentes.telefono_celular" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
							    <label for="exampleInputNextel1">Nextel:</label>
								<input type="text" name="nextel" class="form-control" id="Nextel1" placeholder="Nextel" :value="this.agentes.nextel" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
							    <label for="exampleInputEmail1">*Email:</label>
								<input type="email" name="email" class="form-control" id="Email1" placeholder="Email" :value="this.agentes.email" required>
							</div>
						</div>
						<br>

    				</div>
    				<div class="modal-footer">
        				<button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
        				<button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="guardarAgente(1)"><i class="fas fa-save"></i>&nbsp;Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="guardarAgente(0)"><i class="fas fa-save"></i>&nbsp;Actualizar</button>
    				</div>
    			</div>
			</div>
		</div>
        <!-- Fin Modal -->

		<!-- Modal  Datos Actualizados/Registrados -->
        <div class="modal fade" id="ModalSuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
				<div class="modal-content">
					<div :class="bgModal">
						<h5 class="modal-title text-white" id="exampleModalCenterTitle" v-text="tituloModal2"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
        				<span class="font-weight-bold">{{ contenidoModal }}</span>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
					</div>
				</div>
			</div>
		</div>
        <!-- Fin Modal -->

        <!-- Modal  Desactivar/Activar Agente -->
        <div class="modal fade" id="ModalDanger" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div :class="bgModal2">
                        <h5 class="modal-title text-white" id="exampleModalCenterTitle" v-text="tituloModal3"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <span class="font-weight-bold">{{ contenidoModal2 }}</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="button" v-if="tipoAccion2==1" class="btn btn-primary" @click="eliminarAgente(1)">
                            Aceptar
                        </button>
                        <button type="button" v-if="tipoAccion2==2" class="btn btn-primary" @click="activarAgente(1)">
                            Aceptar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Modal -->

    </main>
</template>
<script>

import Utilerias from '../../components/Herramientas/utilerias.js';
var config = require('../../components/Herramientas/config-vuetables-client').call(this);

export default {
    data (){
        return {
            url: '/AdmonAgentes',
            nombre_usuario : '',
            contrasena: '',
            nombre_completo: '',
            telefono_local: '',
            telefono_celular: '',
            nextel: '',
            email: '',
            fecha_alta: '',
            estado: 0,
            nombreagente:'',

            detalle: false,

            bgModal: '',
            tituloModal : '',
            tituloModal2 : '',
            contenidoModal: '',
            tipoAccion: 0,
            error1: false,
            idAgente:0,

            tipoAccion2: 0,
            bgModal2: '',
            tituloModal3: '',
            contenidoModal2: '',

            agentes: {
                id: 0,
                nombre_usuario: '',
                contrasena: '',
                nombre_completo: '',
                nombre: '',
                apellido_paterno: '',
                apellido_materno: '',
                telefono_local: '',
                telefono_celular: '',
                nextel: '',
	            email: '',
	            fecha_alta: '',
	            estado: 0,
            },
                
            isLoading: false,
            columns: ['id', 'nombre_usuario', 'contrasena', 'nombre_completo', 'telefono_local', 'telefono_celular', 'nextel', 'email', 'fecha_alta', 'estado'],
            tableData: [],
            options: {
                headings: {
                	estado: 'Estado',
                	fecha_alta: 'Fecha de Alta',
                	email: 'Email',
                	nextel: 'Nextel',
                    telefono_celular: 'TEL. Celular',
                    telefono_local: 'TEL. local',
                    nombre_completo: 'Nombre Completo',
                    contrasena: 'Contraseña',
                    nombre_usuario: 'Nombre de Usuario',
                    id: 'Opciones',
                },
                perPage: 10,
                perPageValues: [],
                skin: config.skin,
                sortIcon: config.sortIcon,
                sortable: ['estado','fecha_alta','email','nextel','telefono_celular', 'telefono_local', 'nombre_completo', 'contrasena', 'nombre_usuario'],
                filterable: ['estado','fecha_alta','email','nextel','telefono_celular', 'telefono_local', 'nombre_completo', 'contrasena', 'nombre_usuario'],
                filterByColumn: true,
                texts:config.texts
            },
        }
    },
    components: {
        //
    },
    methods : {
        getData() {
            let me=this;
            axios.get(me.url).then(response => {
                me.tableData = response.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        validaNumericos(event) {
		    if(event.charCode >= 48 && event.charCode <= 57){
		      return true;
		     }
		     return false;        
		},
        eliminarAgente(nuevo, data = []) {

            this.bgModal2 = 'modal-header bg-danger';
            this.tituloModal3 = 'Desactivacion';
            this.contenidoModal2 = '¿Desea Desactivar Al Agente?';
            this.tipoAccion2 = 1;

            if (nuevo == 1) {

                let me=this;
                axios.delete(me.url+'/'+this.idAgente).then(response => {
                    $("#ModalDanger").modal('hide');//ocultamos el modal
                    $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
                    $('.modal-backdrop').remove();//eliminamos el backdrop del modal

                    this.tituloModal2 = 'Desactivar';
                    this.contenidoModal = 'Agente Desactivado Correctamente';
                    this.bgModal = 'modal-header bg-warning';
                    this.activarModal();
                    this.getData();
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
            else{
                this.idAgente = data['id'];
            }
        },
        activarAgente(nuevo, data = []) {
            this.bgModal2 = 'modal-header bg-success';
            this.tituloModal3 = 'Reactivacion';
            this.contenidoModal2 = '¿Desea Re-Activar Al Agente?';
            this.tipoAccion2 = 2;

            if (nuevo == 1) {
                let me=this;
                axios.get(me.url+'/'+this.idAgente+'/edit').then(response => {
                    $("#ModalDanger").modal('hide');//ocultamos el modal
                    $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
                    $('.modal-backdrop').remove();//eliminamos el backdrop del modal

                    this.tituloModal2 = 'Re-Activar';
                    this.contenidoModal = 'Agente Re-Activado Correctamente';
                    this.bgModal = 'modal-header bg-success';
                    this.activarModal();
                    this.getData();
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
            else{
                this.idAgente = data['id'];
            }
        },
        guardarAgente(nuevo){

        	this.error1 = false;
        	let nombre1 = document.getElementById("Name1").value;
        	let apellido1 = document.getElementById("Apellido1").value;
        	let apellido2 = document.getElementById("Apellido2").value;
        	let nombreusuario1 = document.getElementById("NameUser1").value;
        	let password1 = document.getElementById("Password1").value;
        	let email1 = document.getElementById("Email1").value;
        	let local1 = document.getElementById("Local1").value;
        	let celular1 = document.getElementById("Celular1").value;
        	let nextel1 = document.getElementById("Nextel1").value;
        	let fecha1 = document.getElementById("Fecha1").value;

        	if (nombre1 != "" && apellido1 != "" && apellido2 != "" && nombreusuario1 != "" && password1 != "" && email1 != "")
        	{
        		let me = this;

        		axios({
                    method: nuevo ? 'POST' : 'PUT',
                    url: nuevo ? me.url : me.url+'/'+this.agentes.id,
                    data: {
                    	'fecha_alta': fecha1,
                    	'contrasena': password1,
                    	'nombre_usuario': nombreusuario1,
                    	'email': email1,
                    	'nextel': nextel1,
                    	'telefono_celular': celular1,
                    	'telefono_local': local1,
                        'apellido_materno': apellido2,
                        'apellido_paterno': apellido1,
                        'nombre': nombre1,
                        'id': this.agentes.id
                    }
                }).then(function (response) {
                    me.isLoading = false;
                    if (response.data.status) {
                        me.cerrarModal();
                        me.getData();

                        if(!nuevo){
                        	me.tituloModal2 = 'Actualizacion de Datos';
                        	me.contenidoModal = 'Datos del Agente Actualizados Correctamente';
                            me.bgModal = 'modal-header bg-info';
                            me.activarModal();
                        }
                        else
                        {
                        	me.tituloModal2 = 'Registro de Datos';
                        	me.contenidoModal = 'Agente Registrado Correctamente';
                            me.bgModal = 'modal-header bg-primary';
                        	me.activarModal();

                        }
                    } else {
                        swal({
                            type: 'error',
                            html: response.data.errors.join('<br>'),
                        });
                    }
                }).catch(function (error) {
                    console.log(error);
                });

        	}
        	else
        	{
        		this.error1 = true;
        	}
        },
        cerrarModal(){
        	this.tituloModal='';
        	this.tipoAccion = 0;
            this.bgModal = '';
            this.contenidoModal = '';
        	this.error1 = false;
            this.idAgente = 0;
            this.tituloModal2 = '';
            this.tituloModal3 = '';
            this.bgModal2 = '';
            this.tipoAccion2 = 0;
            this.contenidoModal2 = '';
            Utilerias.resetObject(this.agentes);
            $("#ModalAgente").modal('hide');//ocultamos el modal
			$('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
			$('.modal-backdrop').remove();//eliminamos el backdrop del modal
        },
        activarModal(){
        	$("#ModalSuccess").modal();//activamos el modal que valida actualizacion o registro de agente
        	$('#ModalSuccess').modal({backdrop: 'static', keyboard: false});
        },
        abrirModal(modelo, accion, data = []){
            switch(modelo){
                case "agente":
                {
                    switch(accion){
                        case 'registrar':
                        {
                            this.tituloModal = 'Registrar Agente';
                            Utilerias.resetObject(this.accesorio);
                            this.tipoAccion = 1;
                            break;
                        }
                        case 'actualizar':
                        {
                            
                            this.tituloModal = 'Actualizar Datos Agente';
                            this.tipoAccion = 2;
                            this.agentes.id = data['id'];
                            this.agentes.nombre_usuario = data['nombre_usuario'];
			                this.agentes.contrasena = data['contrasena'];
			                this.agentes.nombre = data['nombre'];
			                this.agentes.apellido_paterno = data['apellido_paterno'];
			                this.agentes.apellido_materno = data['apellido_materno'];
			                this.agentes.telefono_local = data['telefono_local'];
			                this.agentes.telefono_celular = data['telefono_celular'];
			                this.agentes.nextel = data['nextel'];
				            this.agentes.email = data['email'];
				            this.agentes.fecha_alta = data['fecha_alta'];
                            break;
                        }
                    }
                }
            }
        }
    },
    mounted() {
        this.getData();
    }
}
</script>