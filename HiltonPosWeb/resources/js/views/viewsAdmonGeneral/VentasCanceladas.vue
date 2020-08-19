<template>
	<main class="main">
        <div class="container-fluid col-md-10">
        	<br>
            <div class="card" v-show="!detalle">
                <div class="card-header">
                    <h1><i class="fas fa-industry"></i> Administracion de Ventas Canceladas</h1>
                </div>
                <div class="card-body">
                	<v-client-table :data="tableData" :columns="columns" :options="options">

                		<template slot="id" slot-scope="props">

                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-outline-primary btn-rounded waves-effect" data-toggle="modal" data-target="#ModalCanceladas" data-backdrop="static" data-keyboard="false" @click="abrirModal('canceladas','actualizar',props.row)">
                                    <i class="far fa-eye fa-lg"></i>
                                </button>&nbsp;

                                <button type="button" v-if="props.row.estado == 0" class="btn btn-outline-success btn-rounded waves-effect" data-toggle="modal" data-target="#ModalDanger" data-backdrop="static" data-keyboard="false" @click="activarPedido(0,props.row)">
                                    <i class="fas fa-trash-restore fa-lg"></i>
                                </button>
                            </div>

                        </template>

                        <template slot="estado" slot-scope="props">
                            <template v-if="props.row.estado">
                                <span class=" badge-dark badge-pill bg-success">
                                    Pendiente
                                </span>
                            </template>
                            <template v-else>
                                <span class=" badge-dark badge-pill bg-danger">
                                    Cancelada
                                </span>
                            </template>
                        </template>

                	</v-client-table>
                </div>
            </div>
        </div>

        <!-- Modal Detalle de Registro-->
		<div class="modal fade" id="ModalCanceladas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    			<div class="modal-content">
    				<div class="modal-header">
        				<h5 class="modal-title" id="exampleModalCenterTitle" v-text="tituloModal"></h5>
        				<button type="button" class="close" aria-label="Close" @click="cerrarModal()">
         					<span aria-hidden="true">&times;</span>
        				</button>
    				</div>
    				<div class="modal-body">
    					<table class="table table-bordered tbl-cart justify-content-center text-center table-sm">

			                <thead class="text-white" style="background-color:#1C2331;">
			                    <tr>
			                        <td class="hidden-xs">Cantidad</td>
			                        <td>Descripcion</td>
			                        <td>Precio Unitario</td>
			                        <td>Importe</td>
			                    </tr>
			                </thead>

			                <tbody>
			                	<tr v-for="(item,i) in tableDetalle">
			                		<td class="hidden-xs">
			                            {{ item.cantidad }}
			                        </td>
			                        <td>
			                            	{{ item.nombre }}
			                        </td>
			                        <td class="price">
			                            	${{ item.precioU_USD }} U.S.D.<br>
										    <p class="text-danger">
										    	( ${{ item.precioU_MN }} M.N. )
										    </p>
			                        </td>
			                        <td>
			                            	${{ item.importeUSD }} U.S.D.<br>
										    <p class="text-danger">
										    	( ${{ item.importeMN }} M.N. )
										    </p>
			                        </td>
			                	</tr>
			                </tbody>

			            </table>

    				</div>
    				<div class="modal-footer">
        				<div class="row">
    						<div class="col text-center">
    							<label>Sub-Total</label><br>
    							<b>${{ subtotal }} U.S.D.</b><br>
    							<label class="text-danger">(${{ subtotalMN }} M.N.)</label>
    						</div>
    						<div class="col text-center">
    							<label>I.V.A.</label><br>
    							<b>${{ iva }} U.S.D.</b><br>
    							<label class="text-danger">(${{ ivaMN }} M.N.)</label>
    						</div>
    						<div class="col text-center">
    							<label>Total</label><br>
    							<b>${{ total }} U.S.D.</b><br>
    							<label class="text-danger">(${{ totalMN }} M.N.)</label>
    						</div>
    					</div><br>
    					<div class="row">
    						<div class="col text-center">
	        					<button type="button" class="btn btn-secondary" @click="cerrarModal()">
	        						Cerrar
	        					</button>
	        				</div>
        				</div>
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

        <!-- Modal  Desactivar/Activar -->
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
                        <button type="button" v-if="tipoAccion2==2" class="btn btn-primary" @click="activarPedido(1)">
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
            url: '/AdmonVentasCanceladas',
            subtotal : 0,
            subtotalMN : 0,
            iva: 0,
            ivaMN: 0,
            total: 0,
            totalMN: 0,
            TipoCambioValor: 0,

            detalle: false,

            bgModal: '',
            tituloModal : '',
            tituloModal2 : '',
            contenidoModal: '',
            tipoAccion: 0,
            error1: false,
            idPedido:0,
            tableDetalle: [],

            tipoAccion2: 0,
            bgModal2: '',
            tituloModal3: '',
            contenidoModal2: '',

            designer: {
                id: 0,
                nombre: '',
	            estado: 0,
            },
                
            isLoading: false,
            columns: ['id','id_compra','fecha','nombre','estado'],
            tableData: [],
            options: {
                headings: {
                	estado: 'Estado',
                	nombre: 'Nombre',
                	fecha: 'Fecha Compra',
                    id_compra: 'ID Compra',
                    id: 'Opciones',
                },
                perPage: 10,
                perPageValues: [],
                skin: config.skin,
                sortIcon: config.sortIcon,
                sortable: ['id_compra','fecha','nombre','estado'],
                filterable: ['id_compra','fecha','nombre','estado'],
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
        activarPedido(nuevo, data = []) {
            this.bgModal2 = 'modal-header bg-success';
            this.tituloModal3 = 'Reactivacion';
            this.contenidoModal2 = '¿Desea Re-Activar el Pedido?';
            this.tipoAccion2 = 2;

            if (nuevo == 1) {
                let me=this;
                axios.get(me.url+'/'+this.idPedido+'/edit').then(response => {
                    $("#ModalDanger").modal('hide');//ocultamos el modal
                    $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
                    $('.modal-backdrop').remove();//eliminamos el backdrop del modal

                    this.tituloModal2 = 'Activacion';
                    this.contenidoModal = 'Pedido Activado Correctamente';
                    this.bgModal = 'modal-header bg-success';
                    this.activarModal();
                    this.getData();
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
            else{
                this.idPedido = data['id'];
            }
        },
        cerrarModal(){
        	this.tituloModal='';
        	this.tipoAccion = 0;
            this.bgModal = '';
            this.contenidoModal = '';
        	this.error1 = false;
            this.idPedido = 0;
            this.tituloModal2 = '';
            this.tituloModal3 = '';
            this.bgModal2 = '';
            this.tipoAccion2 = 0;
            this.contenidoModal2 = '';
            Utilerias.resetObject(this.designer);
            $("#ModalCanceladas").modal('hide');//ocultamos el modal
			$('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
			$('.modal-backdrop').remove();//eliminamos el backdrop del modal
        },
        activarModal(){
        	$("#ModalSuccess").modal();//activamos el modal que valida actualizacion o registro
        	$('#ModalSuccess').modal({backdrop: 'static', keyboard: false});
        },
        cargarDetalle(idDetalle){
        	this.tableDetalle = [];

        	let me=this;

        	axios.get('/TipoCambio').then(response => {
                    this.TipoCambioValor = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });

            axios.get(me.url+'/'+idDetalle).then(response => {
                //me.tableDetalle = response.data;
                for (var i = 0; i < response.data.length; i++){

                	const ContentDetail = {
                		id_compra: response.data[i].id_compra,
                		id_articulo: response.data[i].id_articulo,
		                cantidad: response.data[i].cantidad,
		                nombre: response.data[i].perfume + ' By ' + response.data[i].designer + ' de ' + response.data[i].contenido,
		                precioU_USD: response.data[i].precio_final,
		                precioU_MN: Number.parseFloat(response.data[i].precio_final * this.TipoCambioValor).toFixed(2),
		                importeUSD: Number.parseFloat(response.data[i].precio_final * response.data[i].cantidad).toFixed(2),
		                importeMN:  Number.parseFloat((response.data[i].precio_final * response.data[i].cantidad)* this.TipoCambioValor).toFixed(2),
		            }
		            me.tableDetalle.push(ContentDetail);

                }

                let subtotal_USD = 0
	            this.tableDetalle.map((data)=>{
	                subtotal_USD = subtotal_USD + (data.cantidad * data.precioU_USD)
	            });
	            this.subtotal = Number.parseFloat(subtotal_USD).toFixed(2);
	            this.subtotalMN = Number.parseFloat(subtotal_USD * this.TipoCambioValor).toFixed(2);
	            this.iva = Number.parseFloat(subtotal_USD * 0.11).toFixed(2);
	            this.ivaMN = Number.parseFloat(this.subtotalMN * 0.11).toFixed(2);
	            this.total = Number.parseFloat(subtotal_USD * 1.11).toFixed(2);
	            this.totalMN = Number.parseFloat(this.subtotalMN * 1.11).toFixed(2);

            })
            .catch(function (error) {
                console.log(error);
            });

        },
        abrirModal(modelo, accion, data = []){
            switch(modelo){
                case "canceladas":
                {
                    switch(accion){
                        case 'registrar':
                        {
                            this.tituloModal = 'Registrar Diseñador';
                            Utilerias.resetObject(this.designer);
                            this.tipoAccion = 1;
                            break;
                        }
                        case 'actualizar':
                        {
                            this.tituloModal = 'Detalle de Pedido';
                            this.tipoAccion = 2;
                            this.cargarDetalle(data['id']);
                            this.idPedido = data['id'];
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