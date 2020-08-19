<template>
	<main class="main">
        <div class="container-fluid col-md-10">
        	<br>
            <div class="card" v-show="!detalle">
                <div class="card-header">
                    <h1><i class="fas fa-id-card"></i> Administracion de Membresias</h1>
                    <button type="button" data-toggle="modal" data-target="#ModalMembresia" data-backdrop="static" data-keyboard="false" @click="abrirModal('membresia','registrar')" class="btn btn-dark float-sm-right">
                    	<i class="fas fa-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                	<v-client-table :data="tableData" :columns="columns" :options="options">

                		<template slot="id" slot-scope="props">

                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-outline-primary btn-rounded waves-effect" data-toggle="modal" data-target="#ModalMembresia" data-backdrop="static" data-keyboard="false" @click="abrirModal('membresia','actualizar',props.row)">
                                    <i class="fas fa-edit fa-lg"></i>
                                </button>&nbsp;

                                <button type="button" v-if="props.row.estado != 0" class="btn btn-outline-danger btn-rounded waves-effect" data-toggle="modal" data-target="#ModalDanger" data-backdrop="static" data-keyboard="false" @click="eliminarMembresia(0,props.row)">
                                    <i class="fas fa-trash fa-lg"></i>
                                </button>

                                <button type="button" v-if="props.row.estado == 0" class="btn btn-outline-success btn-rounded waves-effect" data-toggle="modal" data-target="#ModalDanger" data-backdrop="static" data-keyboard="false" @click="activarMembresia(0,props.row)">
                                    <i class="fas fa-trash-restore fa-lg"></i>
                                </button>
                            </div>

                        </template>

                        <template slot="estado" slot-scope="props">
                            <template v-if="props.row.estado">
                            	<div v-if="props.row.estado == 1">
                            		<span class=" badge-dark badge-pill bg-warning text-dark">
                                    	Penidente
                                	</span>
                            	</div>
                                
                                <div v-if="props.row.estado == 2">
                            		<span class=" badge-dark badge-pill bg-success">
                                    	Activa
                                	</span>
                            	</div>
                            </template>
                            <template v-else>
                                <span class=" badge-dark badge-pill bg-danger">
                                    Baja
                                </span>
                            </template>
                        </template>

                	</v-client-table>
                </div>
            </div>
        </div>

        <!-- Modal Actualizacion/Registro de Datos-->
		<div class="modal fade" id="ModalMembresia" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
								<label for="exampleInputNameUser1">*Clase:</label>
								<select class="form-control" id="Clase1"  name="clase"  :value="this.membresia.clase">
                                    <option value="A">Membresia Tipo A</option>
                                    <option value="B">Membresia Tipo B</option>
                                    <option value="C">Membresia Tipo C</option>
                                    <option value="P">Membresia Tipo P</option>
                                    <option value="Z">Membresia Administrativa</option>
                                </select>
							</div>
						</div>
						<br>

    					<div class="row">
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">*Nombre de Usuario:</label>
								<input type="text" name="nombre_usuario" class="form-control" id="UserName1" placeholder="Nombre de Usuario" :value="this.membresia.nombre_usuario" required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">*Contraseña:</label>
								<input type="text" name="contrasena" class="form-control" id="Password1" placeholder="Nombre de Usuario" :value="this.membresia.contrasena" required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">*Empresa:</label>
								<input type="text" name="empresa" class="form-control" id="Empresa1" placeholder="Nombre de Usuario" :value="this.membresia.empresa" required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">*RFC:</label>
								<input type="text" name="rfc" class="form-control" id="RFC1" placeholder="Nombre de Usuario" :value="this.membresia.rfc" required>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">*Nombre:</label>
								<input type="text" name="nombre" class="form-control" id="Name1" placeholder="Nombre" :value="this.membresia.nombre" required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">*Apellido Paterno:</label>
								<input type="text" name="apellido_paterno" class="form-control" id="ApellidP1" placeholder="Nombre de Usuario" :value="this.membresia.apellido_paterno" required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">*Apellido Materno:</label>
								<input type="text" name="apellido_materno" class="form-control" id="ApellidM1" placeholder="Nombre de Usuario" :value="this.membresia.apellido_materno" required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">*Domicilio:</label>
								<input type="text" name="domicilio" class="form-control" id="Domicilio1" placeholder="Nombre de Usuario" :value="this.membresia.domicilio" required>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">*Tel. Local:</label>
								<input type="text" name="telefono_local" class="form-control" id="Local1" placeholder="Nombre de Usuario" :value="this.membresia.telefono_local" required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">*Tel. Celular:</label>
								<input type="text" name="telefono_celular" class="form-control" id="Celular1" placeholder="Nombre de Usuario" :value="this.membresia.telefono_celular" required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">*Nextel:</label>
								<input type="text" name="nextel" class="form-control" id="Nextel1" placeholder="Nombre de Usuario" :value="this.membresia.nextel" required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">*Email:</label>
								<input type="text" name="email" class="form-control" id="Email1" placeholder="Nombre de Usuario" :value="this.membresia.email" required>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">*Fecha de Alta:</label>
								<input class="form-control" id="Alta1" type="date" :value="this.membresia.fecha_alta" required="">
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">*Antiguedad:</label>
								<input class="form-control" id="Antiguedad1" type="date" :value="this.membresia.antiguedad" required="">
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">*Fecha de Vencimiento:</label>
								<input class="form-control" id="Vencimiento1" type="date" :value="this.membresia.vencimiento" required="">
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">*Estado:</label>
								<select class="form-control" id="Estado1"  name="estado"  :value="this.membresia.estado" :disabled="this.membresia.estado == 0">
                                    <option value="0">BAJA</option>
                                    <option value="1">PENDIENTE</option>
                                    <option value="2">ACTIVA</option>
                                </select>
							</div>
						</div>
						<br>

    				</div>
    				<div class="modal-footer">
        				<button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
        				<button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="guardarDesigner(1)"><i class="fas fa-save"></i>&nbsp;Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="guardarDesigner(0)"><i class="fas fa-save"></i>&nbsp;Actualizar</button>
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

        <!-- Modal  Desactivar/Activar Designer -->
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
                        <button type="button" v-if="tipoAccion2==1" class="btn btn-primary" @click="eliminarMembresia(1)">
                            Aceptar
                        </button>
                        <button type="button" v-if="tipoAccion2==2" class="btn btn-primary" @click="activarMembresia(1)">
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
            url: '/AdmonMembresias',
            clase : '',
            usuario: '',
            contrasena: '',
            nombre_completo:'',
            nombre: '',
            apellido_paterno: '',
            apellido_materno: '',
            empresa: '',
            rfc: '',
            domicilio: '',
            telefono_local: '',
            telefono_celular: '',
            nextel: '',
            email: '',
            fecha_alta: '',
            antiguedad: '',
            vencimiento: '',
            estado: 0,

            detalle: false,

            bgModal: '',
            tituloModal : '',
            tituloModal2 : '',
            contenidoModal: '',
            tipoAccion: 0,
            error1: false,
            idMembresia:0,

            tipoAccion2: 0,
            bgModal2: '',
            tituloModal3: '',
            contenidoModal2: '',

            membresia: {
                id: 0,
                clase : '',
	            nombre_usuario: '',
	            contrasena: '',
	            nombre_completo:'',
	            nombre: '',
	            apellido_paterno: '',
	            apellido_materno: '',
	            empresa: '',
	            rfc: '',
	            domicilio: '',
	            telefono_local: '',
	            telefono_celular: '',
	            nextel: '',
	            email: '',
	            fecha_alta: '',
	            antiguedad: '',
	            vencimiento: '',
	            estado: 0,
            },
                
            isLoading: false,
            columns: ['id','nombre_usuario','nombre_completo','empresa','rfc','domicilio','telefono_local','telefono_celular','nextel','email','fecha_alta','estado'],
            tableData: [],
            options: {
                headings: {
                	estado: 'Estado',
                	fecha_alta: 'Fecha Alta',
                	email: 'Email',
                	nextel: 'Nextel',
                	telefono_celular: 'Tel. Celular',
                	telefono_local: 'Tel. Local',
                	domicilio: 'Domicilio',
                	rfc: 'RFC',
                	empresa: 'Empresa',
                	nombre_completo: 'Nombre',
                	nombre_usuario: 'Usuario',
                    id: 'Opciones',
                },
                perPage: 10,
                perPageValues: [],
                skin: config.skin,
                sortIcon: config.sortIcon,
                sortable: ['nombre_usuario','nombre_completo','empresa','rfc','domicilio','telefono_local','telefono_celular','nextel','email','estado'],
                filterable: ['nombre_usuario','nombre_completo','empresa','rfc','domicilio','telefono_local','telefono_celular','nextel','email','estado'],
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
        eliminarMembresia(nuevo, data = []) {

            this.bgModal2 = 'modal-header bg-danger';
            this.tituloModal3 = 'Desactivacion';
            this.contenidoModal2 = '¿Desea Desactivar esta Membresia?';
            this.tipoAccion2 = 1;

            if (nuevo == 1) {
                let me=this;
                axios.delete(me.url+'/'+this.idMembresia).then(response => {
                    $("#ModalDanger").modal('hide');//ocultamos el modal
                    $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
                    $('.modal-backdrop').remove();//eliminamos el backdrop del modal

                    this.tituloModal2 = 'Desactivar';
                    this.contenidoModal = 'Membresia Desactivada Correctamente';
                    this.bgModal = 'modal-header bg-warning';
                    this.activarModal();
                    this.getData();
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
            else{
                this.idMembresia = data['id'];
            }
        },
        activarMembresia(nuevo, data = []) {
            this.bgModal2 = 'modal-header bg-success';
            this.tituloModal3 = 'Reactivacion';
            this.contenidoModal2 = '¿Desea Re-Activar la Membresia?';
            this.tipoAccion2 = 2;

            if (nuevo == 1) {
                let me=this;
                axios.get(me.url+'/'+this.idMembresia+'/edit').then(response => {
                    $("#ModalDanger").modal('hide');//ocultamos el modal
                    $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
                    $('.modal-backdrop').remove();//eliminamos el backdrop del modal

                    this.tituloModal2 = 'Re-Activar';
                    this.contenidoModal = 'Membresia Re-Activada Correctamente';
                    this.bgModal = 'modal-header bg-success';
                    this.activarModal();
                    this.getData();
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
            else{
                this.idMembresia = data['id'];
            }
        },
        guardarDesigner(nuevo){

        	this.error1 = false;
        	let clase1 = document.getElementById("Clase1").value;
        	let username1 = document.getElementById("UserName1").value;
        	let contrasena1 = document.getElementById("Password1").value;
        	let nombre1 = document.getElementById("Name1").value;
        	let apellido_paterno1 = document.getElementById("ApellidP1").value;
        	let apellido_materno1 = document.getElementById("ApellidM1").value;
        	let empresa1 = document.getElementById("Empresa1").value;
        	let rfc1 = document.getElementById("RFC1").value;
        	let domicilio1 = document.getElementById("Domicilio1").value;
        	let telefono_local1 = document.getElementById("Local1").value;
        	let telefono_celular1 = document.getElementById("Celular1").value;
        	let nextel1 = document.getElementById("Nextel1").value;
        	let fecha_alta1 = document.getElementById("Alta1").value;
        	let antiguedad1 = document.getElementById("Antiguedad1").value;
        	let vencimiento1 = document.getElementById("Vencimiento1").value;
        	let estado1 = document.getElementById("Estado1").value;
        	let email1 = document.getElementById("Email1").value;

        	if (nombre1 != "")
        	{
        		let me = this;

        		axios({
                    method: nuevo ? 'POST' : 'PUT',
                    url: nuevo ? me.url : me.url+'/'+this.membresia.id,
                    data: {
                    	'estado': estado1,
                    	'email': email1,
                    	'vencimiento': vencimiento1,
                    	'antiguedad': antiguedad1,
                    	'fecha_alta': fecha_alta1,
                    	'nextel': nextel1,
                    	'telefono_celular': telefono_celular1,
                    	'telefono_local': telefono_local1,
                    	'domicilio': domicilio1,
                    	'rfc': rfc1,
                    	'empresa': empresa1,
                    	'apellido_materno': apellido_materno1,
                    	'apellido_paterno': apellido_paterno1,
                    	'nombre': nombre1,
                    	'contrasena': contrasena1,
                    	'nombre_usuario': username1,
                        'clase': clase1,
                        'id': this.membresia.id
                    }
                }).then(function (response) {
                    me.isLoading = false;
                    if (response.data.status) {
                        me.cerrarModal();
                        me.getData();

                        if(!nuevo){
                        	me.tituloModal2 = 'Actualizacion de Datos';
                        	me.contenidoModal = 'Datos de Membresia Actualizados Correctamente';
                            me.bgModal = 'modal-header bg-info';
                            me.activarModal();
                        }
                        else
                        {
                        	me.tituloModal2 = 'Registro de Datos';
                        	me.contenidoModal = 'Membresia Registrada Correctamente';
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
            Utilerias.resetObject(this.membresia);
            $("#ModalMembresia").modal('hide');//ocultamos el modal
			$('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
			$('.modal-backdrop').remove();//eliminamos el backdrop del modal
        },
        activarModal(){
        	$("#ModalSuccess").modal();//activamos el modal que valida actualizacion o registro
        	$('#ModalSuccess').modal({backdrop: 'static', keyboard: false});
        },
        abrirModal(modelo, accion, data = []){
            switch(modelo){
                case "membresia":
                {
                    switch(accion){
                        case 'registrar':
                        {
                            this.tituloModal = 'Registrar Membresia';
                            Utilerias.resetObject(this.membresia);
                            this.tipoAccion = 1;
                            break;
                        }
                        case 'actualizar':
                        {
                            this.tituloModal = 'Actualizar Datos de Membresia';
                            this.tipoAccion = 2;
                            this.membresia.id = data['id'];
                            this.membresia.clase = data['clase'];
                            this.membresia.nombre_usuario = data['nombre_usuario'];
                            this.membresia.contrasena = data['contrasena'];
                            this.membresia.nombre = data['nombre'];
                            this.membresia.apellido_paterno = data['apellido_paterno'];
                            this.membresia.apellido_materno = data['apellido_materno'];
                            this.membresia.empresa = data['empresa'];
                            this.membresia.rfc = data['rfc'];
                            this.membresia.domicilio = data['domicilio'];
                            this.membresia.telefono_local = data['telefono_local'];
                            this.membresia.telefono_celular = data['telefono_celular'];
                            this.membresia.nextel = data['nextel'];
                            this.membresia.email = data['email'];
                            this.membresia.fecha_alta = data['fecha_alta'];
                            this.membresia.antiguedad = data['antiguedad'];
                            this.membresia.vencimiento = data['vencimiento'];
                            this.membresia.estado = data['estado'];
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