<template>
	<main class="main">
        <div class="container-fluid col-md-10">
        	<br>
            <div class="card" v-show="!detalle">
                <div class="card-header">
                    <h1><i class="fas fa-hand-holding-usd"></i> Administracion de Ventas</h1>
                    <button type="button" data-toggle="modal" data-target="#ModalVentas" data-backdrop="static" data-keyboard="false" @click="abrirModal('ventas','registrar')" class="btn btn-dark float-sm-right">
                    	<i class="fas fa-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                	<v-client-table :data="tableData" :columns="columns" :options="options">

                		<template slot="id" slot-scope="props">

                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-outline-primary btn-rounded waves-effect" data-toggle="modal" data-target="#ModalVentas" data-backdrop="static" data-keyboard="false" @click="abrirModal('ventas','actualizar',props.row)">
                                    <i class="fas fa-edit fa-lg"></i>
                                </button>&nbsp;

                                <button type="button" class="btn btn-outline-dark btn-rounded waves-effect" v-if="props.row.estado == 1" data-toggle="modal" data-target="#ModalVentasDetalle" data-backdrop="static" data-keyboard="false" @click="abrirModalVentas(props.row.id)">
                                    <i class="fas fa-cart-plus fa-lg"></i>
                                </button>&nbsp;

                                <button type="button" class="btn btn-outline-dark btn-rounded waves-effect" v-if="props.row.estado != 1" data-toggle="modal" data-target="#ModalDetalles" data-backdrop="static" data-keyboard="false" @click="cargarDetalle(0,props.row.id)">
                                    <i class="far fa-eye fa-lg"></i>
                                </button>

                                <button type="button" class="btn btn-outline-success btn-rounded waves-effect" v-if="props.row.estado == 1" data-toggle="modal" data-target="#ModalDetalles" data-backdrop="static" data-keyboard="false" @click="cargarDetalle(1,props.row.id)">
                                    <i class="far fa-eye fa-lg"></i>
                                </button>
                            </div>

                        </template>

                        <template slot="estado" slot-scope="props">
                            <template v-if="props.row.estado">
                            	<div v-if="props.row.estado == 1">
                            		<span class=" badge-dark badge-pill bg-warning text-dark">
                                    	Pendiente
                                	</span>
                            	</div>
                                
                                <div v-if="props.row.estado == 2">
                            		<span class=" badge-dark badge-pill bg-success">
                                    	Procesada
                                	</span>
                            	</div>
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
		<div class="modal fade" id="ModalVentas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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

    					<h5 class="font-weight-bold">Datos de la membresia</h5><br>
    					<div class="row">
							<div class="col col-lg-4 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">ID Membresia:</label>
								<input type="text" name="idmembresia" class="form-control" id="Membresia1" placeholder="Membresia" :value="this.ventas.id_membresia" required>
							</div>
							<div class="col col-lg-4 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">Nombre de Usuario:</label>
								<input type="text" name="user_name" class="form-control" id="User1" placeholder="Nombre de Usuario" :disabled="this.idNuevo" :value="this.ventas.usuario" required>
							</div>
							<div class="col col-lg-4 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">Nombre Del Cliente:</label>
								<input type="text" name="nombre" class="form-control" id="Name1" placeholder="Nombre de Cliente" :disabled="this.idNuevo" :value="this.ventas.cliente" required>
							</div>
						</div>
						<br>

						<h5 class="font-weight-bold">Datos de la venta</h5><br>
						<div class="row">
							<div class="col col-lg-4 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">ID Venta:</label>
								<input type="text" name="idventa" class="form-control" id="Venta1" placeholder="Membresia" :disabled="this.idNuevo" :value="this.ventas.id" required>
							</div>
							<div class="col col-lg-4 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">Fecha:</label>
								<input class="form-control" id="Fecha1" type="date" :value="this.ventas.fecha" required="">
							</div>
							<div class="col col-lg-4 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">Impuesto:</label>
								<input type="text" name="impuesto" class="form-control" id="Impuesto1" placeholder="Nombre de Cliente" :value="this.ventas.impuesto" required>
							</div>
						</div>
						<br>

						<div class="row">
							<div class="col col-lg-6 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">Observaciones:</label>
								<textarea class="form-control" id="Observaciones1" :value="this.ventas.observaciones" rows="3"></textarea>
							</div>
						</div>
						<br>

    				</div>
    				<div class="modal-footer">
        				<button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
        				<button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="guardarVenta(1)"><i class="fas fa-save"></i>&nbsp;Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="guardarVenta(0)"><i class="fas fa-save"></i>&nbsp;Actualizar</button>
    				</div>
    			</div>
			</div>
		</div>
        <!-- Fin Modal -->

        <!-- Modal Detalles-->
		<div class="modal fade" id="ModalDetalles" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    			<div class="modal-content">
    				<div class="modal-header">
        				<h5 class="modal-title" id="exampleModalCenterTitle">Detalle de Venta</h5>
        				<button type="button" class="close" aria-label="Close" @click="cerrarModal2()">
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
    					<div class="row" v-if="registro == 1">
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
	        					<button type="button" class="btn btn-secondary" @click="cerrarModal2()">
	        						Cerrar
	        					</button>&nbsp;

	        					<button type="button" v-if="registro == 1" class="btn btn-success" @click="registrarVenta()">
	        						<i class="fas fa-save"></i>&nbsp;Registrar Compra
	        					</button>
	        				</div>
        				</div>
    				</div>
    			</div>
    		</div>
    	</div>
    	<!-- Fin Modal Detalles-->

    	<!-- Modal Venta Detalle -->
		<div class="modal fade" id="ModalVentasDetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    			<div class="modal-content">
    				<div class="modal-header">
        				<h5 class="modal-title" id="exampleModalCenterTitle">Agregar Articulo A Venta</h5>
        				<button type="button" class="close" aria-label="Close" @click="cerrarModal3()">
         					<span aria-hidden="true">&times;</span>
        				</button>
    				</div>
    				<div class="modal-body">
    					<br>
    					<div class="alert alert-danger text-center" role="alert" v-show="error2">
							*Los campos marcados son obligatorios.
						</div>
						<div class="alert alert-success text-center" role="alert" v-show="success">
							Articulo Registrado Correctamente
						</div>

    					<div class="row">
    						<div class="form-group mx-sm-3 mb-2 text-danger font-weight-bold">
    							<label for="inputPassword2" class="sr-only">Codigo:</label>
    							<input type="text" class="form-control" id="Codigo1" placeholder="Buscar por Codigo">
							</div>
							<button type="submit" class="btn btn-primary mb-2" @click="buscarCodigo(1)">
								Buscar
							</button>
						</div>
						<br>

						<div class="row">
							<div class="col col-lg-2 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">*Cantidad:</label>
								<input type="text" name="cantidad" class="form-control" id="Cantidad1" placeholder="Cantidad" required>
							</div>
							<div class="col col-lg-5 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">Articulo:</label>
								<input type="text" name="articulo" class="form-control" id="Articulo1" placeholder="Perfume" :value="this.nombre_perfume" disabled="true">
							</div>
							<div class="col col-lg-5 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">*Precio:</label>
								<select class="form-control" id="Precio1" name="precio">
                                    <option :value="this.precioA">Precio A: {{ this.precioA }}</option>
                                    <option :value="this.precioC">Precio C: {{ this.precioC }}</option>
                                </select>
							</div>
						</div>
						<br>

    				</div>
    				<div class="modal-footer">
        				<button type="button" class="btn btn-secondary" @click="cerrarModal3()">Cerrar</button>
        				<button type="button" class="btn btn-primary" @click="guardarArticulo()"><i class="fas fa-save"></i>&nbsp;Guardar</button>
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
                        <button type="button" v-if="tipoAccion2==1" class="btn btn-primary" @click="eliminarDesigner(1)">
                            Aceptar
                        </button>
                        <button type="button" v-if="tipoAccion2==2" class="btn btn-primary" @click="activarDesigner(1)">
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
            url: '/AdmonVentas',
            subtotal : 0,
            subtotalMN : 0,
            iva: 0,
            ivaMN: 0,
            total: 0,
            totalMN: 0,
            TipoCambioValor: 0,
            perfume: 0,
            nombre_perfume: '',
            precioA: 0,
            precioC: 0,
            idarticulo: 0,
            idventa: 0,
            registro:0,
            VentaDetalle: 0,

            detalle: false,

            bgModal: '',
            tituloModal : '',
            tituloModal2 : '',
            contenidoModal: '',
            tipoAccion: 0,
            error1: false,
            idNuevo:false,
            tableDetalle: [],
            listaPerfume: [],
            error2: false,
            success: false,

            tipoAccion2: 0,
            bgModal2: '',
            tituloModal3: '',
            contenidoModal2: '',

            ventas: {
                id: 0,
                id_membresia: 0,
                fecha: '',
                usuario: '',
                cliente: '',
                impuesto: 0,
                observaciones: '',
	            estado: 0,
            },
                
            isLoading: false,
            columns: ['id', 'id_venta','fecha','usuario','cliente','imp','observaciones','estado'],
            tableData: [],
            options: {
                headings: {
                	estado: 'Estado',
                	observaciones: 'Observaciones',
                	imp: 'Impuesto',
                	cliente: 'Cliente',
                	usuario: 'Usuario',
                    fecha: 'Fecha',
                    id_venta: 'ID Venta',
                    id: 'Opciones',
                },
                perPage: 10,
                perPageValues: [],
                skin: config.skin,
                sortIcon: config.sortIcon,
                sortable: ['estado', 'fecha','id_venta','usuario','cliente','observaciones'],
                filterable: ['estado', 'fecha','id_venta','usuario','cliente','observaciones'],
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
		registrarVenta(){
			let me=this;
	        axios.get('/AdmonVentasDetalle'+'/'+this.VentaDetalle+'/edit').then(response => {
	                this.cerrarModal2();
	                this.getData();
	        })
	        .catch(function (error) {
	            console.log(error);
	        });
	    },
		limpiarDatos(){
			$(':input').val('');
        	this.nombre_perfume = '';
        	this.precioA = 0;
        	this.precioC = 0;
        	this.idarticulo = 0;
        	this.success = false;
		},
		guardarArticulo(){
			this.error2 = false;
			this.success = false;
			let cantidad1 = document.getElementById("Cantidad1").value;
        	let precio1 = document.getElementById("Precio1").value;

        	if (cantidad1 != "" && precio1 != "")
        	{
        		let me = this;

        		axios({
                    method: 'POST',
                    url: '/AdmonVentasDetalle',
                    data: {
                    	'id_art': this.idarticulo,
                    	'id_vta': this.idventa,
                    	'costo': precio1,
                        'cant': cantidad1,
                        'id': 1
                    }
                }).then(function (response) {

                    if (response.data.status) {
                        me.limpiarDatos();
                        me.getData();
                        me.success = true;

                        //
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
        		this.error2 = true;
        	}
		},
		buscarCodigo(cod) {
			if (cod == 1) {
				let me=this;
	            let codigo = document.getElementById("Codigo1").value;
	            axios.get(me.url+'/'+codigo+'/edit').then(response => {
	                this.perfume = response.data.id;
	                this.nombre_perfume = response.data.nombre+' By '+response.data.designer;
	                this.precioA = response.data.precio_a;
	                this.precioC = response.data.precio_c;
	                this.idarticulo = response.data.id;
	            })
	            .catch(function (error) {
	                console.log(error);
	            });
			}
        },
        abrirModalVentas(id){
        	this.idventa = id;
        	/*Lista de Perfumes*/
        	let me=this;
            axios.get('/AdmonArticulos').then(response => {
                me.listaPerfume = response.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
		cargarDetalle(validar,idDetalle){
			if (validar == 1) {
				this.registro = 1;
				this.VentaDetalle = idDetalle;
			}
        	this.tableDetalle = [];

        	let me=this;

        	axios.get('/TipoCambio').then(response => {
                    this.TipoCambioValor = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });

            axios.get(me.url+'/'+idDetalle).then(response => {

                for (var i = 0; i < response.data.length; i++){

                	const ContentDetail = {
                		id_compra: response.data[i].id_vta,
                		id_articulo: response.data[i].id_art,
		                cantidad: response.data[i].cant,
		                nombre: response.data[i].perfume + ' By ' + response.data[i].designer + ' de ' + response.data[i].contenido,
		                precioU_USD: response.data[i].costo,
		                precioU_MN: Number.parseFloat(response.data[i].costo * this.TipoCambioValor).toFixed(2),
		                importeUSD: Number.parseFloat(response.data[i].costo * response.data[i].cant).toFixed(2),
		                importeMN:  Number.parseFloat((response.data[i].costo * response.data[i].cant)* this.TipoCambioValor).toFixed(2),
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
        guardarVenta(nuevo){

        	this.error1 = false;
        	let fecha1 = document.getElementById("Fecha1").value;
        	let membresia1 = document.getElementById("Membresia1").value;
        	let impuesto1 = document.getElementById("Impuesto1").value;
        	let observaciones1 = document.getElementById("Observaciones1").value;

        	if (fecha1 != "" && impuesto1 != "")
        	{
        		let me = this;

        		axios({
                    method: nuevo ? 'POST' : 'PUT',
                    url: nuevo ? me.url : me.url+'/'+this.ventas.id,
                    data: {
                    	'observaciones': observaciones1,
                    	'imp': impuesto1,
                    	'id_membresia': membresia1,
                        'fecha': fecha1,
                        'id': this.ventas.id
                    }
                }).then(function (response) {
                    me.isLoading = false;
                    if (response.data.status) {
                        me.cerrarModal();
                        me.getData();

                        if(!nuevo){
                        	me.tituloModal2 = 'Actualizacion de Datos';
                        	me.contenidoModal = 'Datos de Venta Actualizados Correctamente';
                            me.bgModal = 'modal-header bg-info';
                            me.activarModal();
                        }
                        else
                        {
                        	me.tituloModal2 = 'Registro de Datos';
                        	me.contenidoModal = 'Venta Registrada Correctamente';
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
        cerrarModal3(){
        	$(':input').val('');
        	this.nombre_perfume = '';
        	this.precioA = 0;
        	this.precioC = 0;
        	this.idarticulo = 0;
        	this.idventa = 0;
            $("#ModalVentasDetalle").modal('hide');//ocultamos el modal
			$('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
			$('.modal-backdrop').remove();//eliminamos el backdrop del modal
        },
        cerrarModal2(){
        	this.registro = 0;
        	this.tableDetalle = [];
        	this.subtotal = 0;
	        this.subtotalMN = 0;
	        this.iva = 0;
	        this.ivaMN = 0;
	        this.total = 0;
	        this.totalMN = 0;
            $("#ModalDetalles").modal('hide');//ocultamos el modal
			$('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
			$('.modal-backdrop').remove();//eliminamos el backdrop del modal
        },
        cerrarModal(){
        	this.VentaDetalle = 0;
        	this.tituloModal='';
        	this.tipoAccion = 0;
            this.bgModal = '';
            this.contenidoModal = '';
        	this.error1 = false;
        	this.error2 = false;
        	this.success = false;
            this.idNuevo = false;
            this.tituloModal2 = '';
            this.tituloModal3 = '';
            this.bgModal2 = '';
            this.tipoAccion2 = 0;
            this.contenidoModal2 = '';
            Utilerias.resetObject(this.ventas);
            $("#ModalVentas").modal('hide');//ocultamos el modal
			$('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
			$('.modal-backdrop').remove();//eliminamos el backdrop del modal
        },
        activarModal(){
        	$("#ModalSuccess").modal();//activamos el modal que valida actualizacion o registro
        	$('#ModalSuccess').modal({backdrop: 'static', keyboard: false});
        },
        abrirModal(modelo, accion, data = []){
            switch(modelo){
                case "ventas":
                {
                    switch(accion){
                        case 'registrar':
                        {
                            this.tituloModal = 'Registrar Venta';
                            Utilerias.resetObject(this.ventas);
                            this.idNuevo = true;
                            this.tipoAccion = 1;
                            break;
                        }
                        case 'actualizar':
                        {
                            this.tituloModal = 'Actualizar Datos de Venta';
                            this.tipoAccion = 2;
                            this.ventas.id = data['id'];
                            this.ventas.cliente = data['cliente'];
                            this.ventas.usuario = data['usuario'];
                            this.ventas.id_membresia = data['id_membresia'];
                            this.ventas.fecha = data['fecha'];
                            this.ventas.impuesto = data['imp'];
                            this.ventas.observaciones = data['observaciones'];
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