<template>
	<main class="main">
        <div class="container-fluid col-md-10">
        	<br>
            <div class="card" v-show="!detalle">
                <div class="card-header">
                    <h1><i class="fas fa-shopping-bag"></i> Administracion de Compras</h1>
                </div>
                <div class="card-body">
                	<v-client-table :data="tableData" :columns="columns" :options="options">

                		<template slot="id" slot-scope="props">

                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-outline-primary btn-rounded waves-effect" data-toggle="modal" data-target="#ModalCompras" data-backdrop="static" data-keyboard="false" @click="abrirModal('compras','actualizar',props.row)">
                                    <i class="far fa-eye fa-lg"></i>
                                </button>&nbsp;

                                <button type="button" class="btn btn-outline-danger btn-rounded waves-effect" data-toggle="modal" data-target="#ModalDanger" data-backdrop="static" data-keyboard="false" @click="cancelarPedido(0,props.row)">
                                    <i class="far fa-window-close fa-lg"></i>
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

        <!-- Modal Actualizacion/Registro de Datos-->
		<div class="modal fade" id="ModalCompras" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
			                    	<td>Acciones</td>
			                        <td class="hidden-xs">Cantidad</td>
			                        <td>Modificar</td>
			                        <td>Descripcion</td>
			                        <td>Precio Unitario</td>
			                        <td>Importe</td>
			                    </tr>
			                </thead>

			                <tbody>
			                	<tr v-for="(item,i) in tableDetalle">
			                		<td scope="row" style="width: 16.66%">
							    		<button class="btn btn-md btn-success" type="button" @click="refresh(item.id_compra,item.id_articulo)">
											<i class="fas fa-sync"></i>
										</button>&nbsp;
										<button class="btn btn-md btn-danger" type="button" @click="eliminar(item.id_compra,item.id_articulo)">
											<i class="fas fa-trash-alt"></i>
										</button>
							    	</td>
			                		<td class="hidden-xs">
			                            {{ item.cantidad }}
			                        </td>
			                        <td style="width: 16.66%" class="font-weight-bold text-center">
			                        	<input type="text" :id="item.id_articulo" :value="item.cantidad" class="form-control font-weight-bold text-center" aria-label="Example text with two button addons" aria-describedby="MaterialButton-addon3" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
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
	        						Cancelar
	        					</button>&nbsp;
	        					<button type="button" class="btn btn-success" @click="registrarCompra()">
	        						<i class="fas fa-save"></i>&nbsp;Registrar Compra
	        					</button>
	        				</div>
        				</div>
    				</div>
    			</div>
    		</div>
    	</div>

        <!-- Modal  Response Status -->
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

        <!-- Modal  Cancelar -->
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
                        <button type="button" class="btn btn-primary" @click="cancelarPedido(1)">
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
            url: '/AdmonCompras',
            subtotal : 0,
            subtotalMN : 0,
            iva: 0,
            ivaMN: 0,
            total: 0,
            totalMN: 0,
            TipoCambioValor: 0,
            idCompra: 0,

            detalle: false,

            bgModal: '',
            tituloModal : '',
            tituloModal2 : '',
            contenidoModal: '',
            tipoAccion: 0,
            error1: false,
            idPedido:0,

            bgModal2: '',
            tituloModal3: '',
            contenidoModal2: '',
            tableDetalle: [],
                
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
        validaNumericos(event) {
		    if(event.charCode >= 48 && event.charCode <= 57){
		      return true;
		     }
		     return false;        
		},
		refresh(compra,articulo){
			let me = this;
			axios({
                method: 'PUT',
                url: me.url+'/'+compra,
                data: {
                	'cantidad': document.getElementById(articulo).value,
                    'articulo': articulo,
                    'id': compra
                }
            }).then(function (response) {
                    
                if (response.data.status) {
                    console.log('hecho');
                    me.getData();
                    me.cargarDetalle(compra);
                } else {
                    swal({
                        type: 'error',
                        html: response.data.errors.join('<br>'),
                    });
                }
            }).catch(function (error) {
                console.log(error);
            });
		},
		eliminar(compra,articulo){
			console.log(this.tableDetalle.length);
			if (this.tableDetalle.length == 1) {
				let me=this;
                axios.delete(me.url+'/'+compra).then(response => {
                    me.cerrarModal();
                    me.getData();
                })
                .catch(function (error) {
                    console.log(error);
                });
			}
			else
			{
				let me=this;
                axios.get(me.url+'/'+compra+'&'+articulo+'/edit').then(response => {
                    me.getData();
                    me.cargarDetalle(compra);
                })
                .catch(function (error) {
                    console.log(error);
                });
			}
		},
        cerrarModal(){
        	this.idCompra = 0;
        	this.tituloModal='';
        	this.tipoAccion = 0;
            this.bgModal = '';
            this.contenidoModal = '';
        	this.error1 = false;
            this.idPedido = 0;
            this.tituloModal2 = '';
            this.tituloModal3 = '';
            this.bgModal2 = '';
            this.contenidoModal2 = '';
            this.tableDetalle = [];
        	this.subtotal = 0;
	        this.subtotalMN = 0;
	        this.iva = 0;
	        this.ivaMN = 0;
	        this.total = 0;
	        this.totalMN = 0;
            Utilerias.resetObject(this.designer);
            $("#ModalCompras").modal('hide');//ocultamos el modal
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
        cancelarPedido(nuevo, data = []) {

            this.bgModal2 = 'modal-header bg-danger';
            this.tituloModal3 = 'Cancelar';
            this.contenidoModal2 = '¿Desea Cancelar Este Pedido?';
            this.tipoAccion2 = 1;

            if (nuevo == 1) {
                let me=this;
                axios.delete(me.url+'/'+this.idPedido).then(response => {
                    $("#ModalDanger").modal('hide');//ocultamos el modal
                    $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
                    $('.modal-backdrop').remove();//eliminamos el backdrop del modal

                    this.tituloModal2 = 'Cancelar';
                    this.contenidoModal = 'Pedido Cancelado';
                    this.bgModal = 'modal-header bg-warning';
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
        registrarCompra(){
        		let me = this;
        		let id_compra1 = 0;
        		let id_antiguo = 0;

        		axios({
                    method: 'POST',
                    url: me.url,
                    data: {
                    	'metodo': 1,
                        'id': this.idCompra
                    }
                }).then(function (response) {

                    if (response.data.status) {
                    	for (var i = 0; i < me.tableDetalle.length; i++) {

                    		id_compra1 = response.data.id_compra;
                    		id_antiguo = response.data.id_antiguo;

                    		let post = {
				        		metodo: 2,
				        		id_antiguo: id_antiguo,
				        		id_compra: id_compra1,
							    id_articulo: me.tableDetalle[i].id_articulo,
							    cantidad: document.getElementById(me.tableDetalle[i].id_articulo).value,
							    precio_lista: me.tableDetalle[i].precioU_USD,
							    precio_final: me.tableDetalle[i].precioU_USD,
							};

							axios.post(me.url, post).then((result) => {

				        		if (result.data.status) 
				        		{
				        			//
				        		}

				        	});
                    	}
                        me.cerrarModal();
                        me.getData();

                        me.tituloModal2 = 'Venta Registrada';
                        me.contenidoModal = 'La venta se Registro Correctamente';
                        me.bgModal = 'modal-header bg-info';
                        me.activarModal();

                    } else {
                        swal({
                            type: 'error',
                            html: response.data.errors.join('<br>'),
                        });
                    }
                }).catch(function (error) {
                    console.log(error);
                });
        },
        abrirModal(modelo, accion, data = []){
            switch(modelo){
                case "compras":
                {
                    switch(accion){
                        case 'registrar':
                        {
                            //
                            break;
                        }
                        case 'actualizar':
                        {
                            this.tituloModal = 'Detalle de Pedido';
                            this.tipoAccion = 2;
                            this.cargarDetalle(data['id']);
                            this.idCompra = data['id'];
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