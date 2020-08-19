<template>
	<main class="main">
        <div class="container-fluid col-md-10">
        	<br>
            <div class="card" v-show="!detalle">
                <div class="card-header">
                    <h1><i class="fas fa-file-invoice-dollar"></i> Administracion de Gastos</h1>
                    <button type="button" data-toggle="modal" data-target="#ModalGastos" data-backdrop="static" data-keyboard="false" @click="abrirModal('gastos','registrar')" class="btn btn-dark float-sm-right">
                    	<i class="fas fa-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                	<v-client-table :data="tableData" :columns="columns" :options="options">

                		<template slot="id" slot-scope="props">

                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-outline-primary btn-rounded waves-effect" data-toggle="modal" data-target="#ModalGastos" data-backdrop="static" data-keyboard="false" @click="abrirModal('gastos','actualizar',props.row)">
                                    <i class="fas fa-edit fa-lg"></i>
                                </button>&nbsp;

                                <button type="button" v-if="props.row.estado == 1" class="btn btn-outline-danger btn-rounded waves-effect" data-toggle="modal" data-target="#ModalDanger" data-backdrop="static" data-keyboard="false" @click="eliminarGasto(0,props.row)">
                                    <i class="fas fa-trash fa-lg"></i>
                                </button>

                                <button type="button" v-if="props.row.estado == 0" class="btn btn-outline-success btn-rounded waves-effect" data-toggle="modal" data-target="#ModalDanger" data-backdrop="static" data-keyboard="false" @click="activarGasto(0,props.row)">
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
		<div class="modal fade" id="ModalGastos" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
								<label for="exampleInputNameUser1">*Fecha:</label>
								<input class="form-control" id="Fecha1" type="date" :value="this.gastos.fecha" required="">
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">*Total:</label>
								<input type="text" name="total" class="form-control" id="Total1" placeholder="Total" :value="this.gastos.total" required>
							</div>
						</div>
						<br>

						<div class="row">
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">*Descripcion:</label>
								<textarea class="form-control" id="Descripcion1" :value="this.gastos.descripcion" rows="3"></textarea>
							</div>
						</div>
						<br>

    				</div>
    				<div class="modal-footer">
        				<button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
        				<button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="guardarGasto(1)"><i class="fas fa-save"></i>&nbsp;Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="guardarGasto(0)"><i class="fas fa-save"></i>&nbsp;Actualizar</button>
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
                        <button type="button" v-if="tipoAccion2==1" class="btn btn-primary" @click="eliminarGasto(1)">
                            Aceptar
                        </button>
                        <button type="button" v-if="tipoAccion2==2" class="btn btn-primary" @click="activarGasto(1)">
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
            url: '/AdmonGastos',

            detalle: false,

            bgModal: '',
            tituloModal : '',
            tituloModal2 : '',
            contenidoModal: '',
            tipoAccion: 0,
            error1: false,
            idGasto:0,

            tipoAccion2: 0,
            bgModal2: '',
            tituloModal3: '',
            contenidoModal2: '',

            gastos: {
                id: 0,
                fecha: '',
                descripcion: '',
                total: 0,
	            estado: 0,
            },
                
            isLoading: false,
            columns: ['id', 'fecha','descripcion','total','estado'],
            tableData: [],
            options: {
                headings: {
                	estado: 'Estado',
                	total: 'Total',
                	descripcion: 'Descripcion',
                    fecha: 'Fecha',
                    id: 'Opciones',
                },
                perPage: 10,
                perPageValues: [],
                skin: config.skin,
                sortIcon: config.sortIcon,
                sortable: ['estado', 'fecha'],
                filterable: ['estado', 'fecha'],
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
        eliminarGasto(nuevo, data = []) {

            this.bgModal2 = 'modal-header bg-danger';
            this.tituloModal3 = 'Desactivacion';
            this.contenidoModal2 = '¿Desea Desactivar este Gasto?';
            this.tipoAccion2 = 1;

            if (nuevo == 1) {
                let me=this;
                axios.delete(me.url+'/'+this.idGasto).then(response => {
                    $("#ModalDanger").modal('hide');//ocultamos el modal
                    $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
                    $('.modal-backdrop').remove();//eliminamos el backdrop del modal

                    this.tituloModal2 = 'Desactivar';
                    this.contenidoModal = 'Gasto Desactivado Correctamente';
                    this.bgModal = 'modal-header bg-warning';
                    this.activarModal();
                    this.getData();
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
            else{
                this.idGasto = data['id'];
            }
        },
        activarGasto(nuevo, data = []) {
            this.bgModal2 = 'modal-header bg-success';
            this.tituloModal3 = 'Reactivacion';
            this.contenidoModal2 = '¿Desea Re-Activar este Gasto?';
            this.tipoAccion2 = 2;

            if (nuevo == 1) {
                let me=this;
                axios.get(me.url+'/'+this.idGasto+'/edit').then(response => {
                    $("#ModalDanger").modal('hide');//ocultamos el modal
                    $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
                    $('.modal-backdrop').remove();//eliminamos el backdrop del modal

                    this.tituloModal2 = 'Re-Activar';
                    this.contenidoModal = 'Gasto Re-Activado Correctamente';
                    this.bgModal = 'modal-header bg-success';
                    this.activarModal();
                    this.getData();
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
            else{
                this.idGasto = data['id'];
            }
        },
        guardarGasto(nuevo){

        	this.error1 = false;
        	let fecha1 = document.getElementById("Fecha1").value;
        	let total1 = document.getElementById("Total1").value;
        	let descripcion1 = document.getElementById("Descripcion1").value;

        	if (fecha1 != "" && total1 != "" && descripcion1 != "")
        	{
        		let me = this;

        		axios({
                    method: nuevo ? 'POST' : 'PUT',
                    url: nuevo ? me.url : me.url+'/'+this.gastos.id,
                    data: {
                    	'descripcion': descripcion1,
                    	'total': total1,
                        'fecha': fecha1,
                        'id': this.gastos.id
                    }
                }).then(function (response) {
                    me.isLoading = false;
                    if (response.data.status) {
                        me.cerrarModal();
                        me.getData();

                        if(!nuevo){
                        	me.tituloModal2 = 'Actualizacion de Datos';
                        	me.contenidoModal = 'Gasto Actualizado Correctamente';
                            me.bgModal = 'modal-header bg-info';
                            me.activarModal();
                        }
                        else
                        {
                        	me.tituloModal2 = 'Registro de Datos';
                        	me.contenidoModal = 'Gasto Registrado Correctamente';
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
            this.idGasto = 0;
            this.tituloModal2 = '';
            this.tituloModal3 = '';
            this.bgModal2 = '';
            this.tipoAccion2 = 0;
            this.contenidoModal2 = '';
            Utilerias.resetObject(this.gastos);
            $("#ModalGastos").modal('hide');//ocultamos el modal
			$('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
			$('.modal-backdrop').remove();//eliminamos el backdrop del modal
        },
        activarModal(){
        	$("#ModalSuccess").modal();//activamos el modal que valida actualizacion o registro
        	$('#ModalSuccess').modal({backdrop: 'static', keyboard: false});
        },
        abrirModal(modelo, accion, data = []){
            switch(modelo){
                case "gastos":
                {
                    switch(accion){
                        case 'registrar':
                        {
                            this.tituloModal = 'Registrar Gasto';
                            Utilerias.resetObject(this.gastos);
                            this.tipoAccion = 1;
                            break;
                        }
                        case 'actualizar':
                        {
                            this.tituloModal = 'Actualizar Datos de Gasto';
                            this.tipoAccion = 2;
                            this.gastos.id = data['id'];
                            this.gastos.fecha = data['fecha'];
                            this.gastos.descripcion = data['descripcion'];
                            this.gastos.total = data['total'];
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