<template>
	<main class="main">
        <div class="container-fluid col-md-10">
        	<br>
            <div class="card" v-show="!detalle">
                <div class="card-header">
                    <h1><i class="fas fa-boxes"></i> Administracion de Articulos</h1>
                    <button type="button" data-toggle="modal" data-target="#ModalArticulo" data-backdrop="static" data-keyboard="false" @click="abrirModal('articulo','registrar')" class="btn btn-dark float-sm-right">
                    	<i class="fas fa-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                	<v-client-table :data="tableData" :columns="columns" :options="options">

                		<template slot="id" slot-scope="props">

                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-outline-primary btn-rounded waves-effect" data-toggle="modal" data-target="#ModalArticulo" data-backdrop="static" data-keyboard="false" @click="abrirModal('articulo','actualizar',props.row)">
                                    <i class="fas fa-edit fa-lg"></i>
                                </button>&nbsp;

                                <button type="button" v-if="props.row.estado != 0" class="btn btn-outline-danger btn-rounded waves-effect" data-toggle="modal" data-target="#ModalDanger" data-backdrop="static" data-keyboard="false" @click="eliminarArticulo(0,props.row)">
                                    <i class="fas fa-trash fa-lg"></i>
                                </button>

                                <button type="button" v-if="props.row.estado == 0" class="btn btn-outline-success btn-rounded waves-effect" data-toggle="modal" data-target="#ModalDanger" data-backdrop="static" data-keyboard="false" @click="activarArticulo(0,props.row)">
                                    <i class="fas fa-trash-restore fa-lg"></i>
                                </button>
                            </div>

                        </template>

                        <template slot="estado" slot-scope="props">
                            <template v-if="props.row.estado">
                            	<div v-if="props.row.estado == 1">
                            		<span class=" badge-dark badge-pill bg-warning text-dark">
                                    	Sin
                                	</span>
                                	<span class=" badge-dark badge-pill bg-warning text-dark">
                                    	Existencia
                                	</span>
                            	</div>
                                
                                <div v-if="props.row.estado == 2">
                            		<span class=" badge-dark badge-pill bg-success">
                                    	Con
                                	</span>
                                	<span class=" badge-dark badge-pill bg-success">
                                    	Existencia
                                	</span>
                            	</div>
                            </template>
                            <template v-else>
                                <span class=" badge-dark badge-pill bg-danger">
                                    Inactivo
                                </span>
                            </template>
                        </template>

                        <template slot="presentacion" slot-scope="props">
                            <template v-if="props.row.presentacion">
                            	Estuche
                            </template>
                            <template v-else>
                                Solo
                            </template>
                        </template>

                	</v-client-table>
                </div>
            </div>
        </div>

        <!-- Modal Actualizacion/Registro de Datos-->
		<div class="modal fade" id="ModalArticulo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
								<label for="exampleInputNameUser1">*Nombre:</label>
								<input type="text" name="nombre" class="form-control" id="Name1" placeholder="Nombre de Articulo" :value="this.articulos.nombre" required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
							    <label for="exampleInputCelular1">*Diseñador:</label>
								<select class="form-control" id="Desgigner1"  name="designer"  :value="this.articulos.id_designer">
                                    <option v-for="item in listaDesigner" :value="item.id" :key="item.id">{{ item.nombre }}</option>
                                </select>
							</div>
                            <div class="col col-lg-3 text-left text-danger font-weight-bold">
                                <label for="exampleInputNameUser1">*Existencia:</label>
                                <input type="text" name="cantidad" class="form-control" id="Cantidad1" placeholder="Cantidad" :value="this.articulos.existencia" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                            </div>
						</div>
						<br>

        				<div class="row">
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">*Sexo:</label>

                                <select class="form-control" id="Sexo1"  name="sexo"  :value="this.articulos.sexo">
                                    <option value="D">DIVERSO</option>
                                    <option value="H">HOMBRE</option>
                                    <option value="M">MUJER</option>
                                    <option value="O">NIÑO</option>
                                    <option value="A">NIÑA</option>
                                </select>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">Tipo:</label>
								<input type="text" name="tipo" class="form-control" id="Tipo1" placeholder="Tipo" :value="this.articulos.tipo" required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">*Contenido:</label>
								<input type="text" name="contenido" class="form-control" id="Contenido1" placeholder="Contenido ml" :value="this.articulos.contenido" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">Presentacion:</label>
                                
                                <select class="form-control" id="Presentacion1"  name="presentacion"  :value="this.articulos.presentacion">
                                    <option value="0">SOLO</option>
                                    <option value="1">ESTUCHE</option>
                                </select>
							</div>
						</div>
						<br>

						<div class="row">
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">*Precio A:</label>
								<input type="text" name="precio_a" class="form-control" id="PrecioA1" placeholder="Precio A" :value="this.articulos.precio_a" required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">Precio B:</label>
								<input type="text" name="precio_b" class="form-control" id="PrecioB1" placeholder="Precio B" :value="this.articulos.precio_b" required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">*Precio C:</label>
								<input type="text" name="precio_c" class="form-control" id="PrecioC1" placeholder="Precio C" :value="this.articulos.precio_c" required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">Precio P:</label>
								<input type="text" name="precio_p" class="form-control" id="PrecioP1" placeholder="Precio P" :value="this.articulos.precio_p" required>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">Descripcion:</label>
								<input type="text" name="descripcion" class="form-control" id="Descripcion1" placeholder="Descripcion" :value="this.articulos.descripcion" required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">Estante:</label>
								<input type="text" name="estante" class="form-control" id="Estante1" placeholder="Estante" :value="this.articulos.estante" required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">Codigo:</label>
								<input type="text" name="codigo" class="form-control" id="Codigo1" placeholder="Codigo de Articulo" :value="this.articulos.codigo" required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">Codigo A1:</label>
								<input type="text" name="codigoa1" class="form-control" id="CodigoA1" placeholder="Nombre de Articulo" :value="this.articulos.codigoa1" required>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">Codigo A2:</label>
								<input type="text" name="codigoa2" class="form-control" id="CodigoA2" placeholder="Codigo A2" :value="this.articulos.codigoa2" required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">Codigo A3:</label>
								<input type="text" name="codigoa3" class="form-control" id="CodigoA3" placeholder="Codigo A3" :value="this.articulos.codigoa3" required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">Codigo A4:</label>
								<input type="text" name="codigoa4" class="form-control" id="CodigoA4" placeholder="Codigo A4" :value="this.articulos.codigoa4" required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">Codigo A5:</label>
								<input type="text" name="codigoa5" class="form-control" id="CodigoA5" placeholder="Codigo A5" :value="this.articulos.codigoa5" required>
							</div>
						</div>
						<br>
                        <div class="row">
                            <div class="col col-lg-6 text-left text-danger font-weight-bold">
                                <label for="exampleInputNameUser1">Imagen:</label>
                                <input type="file" class="form-control-file" id="imagenfile" accept="image/*" @change="getImage">
                            </div>
                        </div>
                        <br>

    				</div>
    				<div class="modal-footer">
        				<button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
        				<button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="guardarArticulo(1)"><i class="fas fa-save"></i>&nbsp;Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="guardarArticulo(0)"><i class="fas fa-save"></i>&nbsp;Actualizar</button>
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

        <!-- Modal  Desactivar/Activar Articulo -->
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
                        <button type="button" v-if="tipoAccion2==1" class="btn btn-primary" @click="eliminarArticulo(1)">
                            Aceptar
                        </button>
                        <button type="button" v-if="tipoAccion2==2" class="btn btn-primary" @click="activarArticulo(1)">
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
            url: '/AdmonArticulos',
            designer: '',
            nombre : '',
            sexo: '',
            tipo: '',
            contenido: '',
            presentacion: 0,
            pca: '',
            precio_a: '',
            precio_b: '',
            precio_c: '',
            precio_p: '',
            descripcion: '',
            existencia: 0,
            estante: '',
            codigo: '',
            fecha_alta: '',
            estado: 0,
            imagen: null,

            detalle: false,
            listaDesigner: [],

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

            articulos: {
                id: 0,
                id_designer: 0,
                designer: '',
	            nombre : '',
	            sexo: '',
	            tipo: '',
	            contenido: '',
                existencia:0,
	            presentacion: 0,
	            pca: '',
	            precio_a: '',
	            precio_b: '',
	            precio_c: '',
	            precio_p: '',
	            descripcion: '',
	            existencia: 0,
	            estante: '',
	            codigo: '',
                codigoa1: '',
                codigoa2: '',
                codigoa3: '',
                codigoa4: '',
                codigoa5: '',
	            fecha_alta: '',
	            estado: 0,
            },
                
            isLoading: false,
            columns: ['id','designer', 'nombre', 'sexo', 'tipo', 'contenido', 'presentacion', 'precio_c', 'existencia', 'estado'],
            tableData: [],
            options: {
                headings: {
                	estado: 'Estado',
                	existencia: 'Cantidad en Existencia',
                	precio_c: '$ Precio USD',
                	presentacion: 'Presentacion',
                    contenido: 'Contenido ml',
                    tipo: 'Tipo',
                    sexo: 'Genero',
                    nombre: 'Nombre',
                    designer: 'Diseñador',
                    id: 'Opciones',
                },
                perPage: 10,
                perPageValues: [],
                skin: config.skin,
                sortIcon: config.sortIcon,
                sortable: ['estado','existencia','precio_c','presentacion','contenido', 'tipo', 'sexo', 'nombre','designer'],
                filterable: ['estado','existencia','precio_c','presentacion','contenido', 'tipo', 'sexo', 'nombre','designer'],
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
            /*Lista de Designers*/
            axios.get('/AdmonDesigners').then(response => {
                me.listaDesigner = response.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        getImage(event){
            //Asignamos la imagen a  nuestra data
            this.imagen = event.target.files[0];
        },
        validaNumericos(event) {
		    if(event.charCode >= 48 && event.charCode <= 57){
		      return true;
		     }
		     return false;        
		},
        eliminarArticulo(nuevo, data = []) {

            this.bgModal2 = 'modal-header bg-danger';
            this.tituloModal3 = 'Desactivacion';
            this.contenidoModal2 = '¿Desea Desactivar el Articulo?';
            this.tipoAccion2 = 1;

            if (nuevo == 1) {
                
                let me=this;
                axios.delete(me.url+'/'+this.idAgente).then(response => {
                    $("#ModalDanger").modal('hide');//ocultamos el modal
                    $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
                    $('.modal-backdrop').remove();//eliminamos el backdrop del modal

                    this.tituloModal2 = 'Desactivar';
                    this.contenidoModal = 'Articulo Desactivado Correctamente';
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
        activarArticulo(nuevo, data = []) {
            this.bgModal2 = 'modal-header bg-success';
            this.tituloModal3 = 'Reactivacion';
            this.contenidoModal2 = '¿Desea Re-Activar el Articulo?';
            this.tipoAccion2 = 2;

            if (nuevo == 1) {
                let me=this;
                axios.get(me.url+'/'+this.idAgente+'/edit').then(response => {
                    $("#ModalDanger").modal('hide');//ocultamos el modal
                    $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
                    $('.modal-backdrop').remove();//eliminamos el backdrop del modal

                    this.tituloModal2 = 'Re-Activar';
                    this.contenidoModal = 'Articulo Re-Activado Correctamente';
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
        guardarArticulo(nuevo){

        	this.error1 = false;
            let cantidad1 = document.getElementById("Cantidad1").value;
        	let designer1 = document.getElementById("Desgigner1").value;
        	let nombre1 = document.getElementById("Name1").value;
        	let sexo1 = document.getElementById("Sexo1").value;
        	let tipo1 = document.getElementById("Tipo1").value;
        	let contenido1 = document.getElementById("Contenido1").value;
        	let presentacion1 = document.getElementById("Presentacion1").value;
        	let precio_a1 = document.getElementById("PrecioA1").value;
        	let precio_b1 = document.getElementById("PrecioB1").value;
        	let precio_c1 = document.getElementById("PrecioC1").value;
        	let precio_p1 = document.getElementById("PrecioP1").value;
        	let descripcion1 = document.getElementById("Descripcion1").value;
        	let estante1 = document.getElementById("Estante1").value;
        	let codigo1 = document.getElementById("Codigo1").value;
            let codigoa1 = document.getElementById("CodigoA1").value;
            let codigoa2 = document.getElementById("CodigoA2").value;
            let codigoa3 = document.getElementById("CodigoA3").value;
            let codigoa4 = document.getElementById("CodigoA4").value;
            let codigoa5 = document.getElementById("CodigoA5").value;

        	if (nombre1 != "" && designer1 != "" && sexo1 != "" && contenido1 != "" && precio_a1 != "" && precio_c1 != "" && cantidad1 != "")
        	{
        		let me = this;
                let formData = new FormData();

                formData.append('metodo', nuevo);
                formData.append('imagen', this.imagen);
                formData.append('codigoa5', codigoa5);
                formData.append('codigoa4', codigoa4);
                formData.append('codigoa3', codigoa3);
                formData.append('codigoa2', codigoa2);
                formData.append('codigoa1', codigoa1);
                formData.append('codigo', codigo1);
                formData.append('estante', estante1);
                formData.append('descripcion', descripcion1);
                formData.append('precio_p', precio_p1);
                formData.append('precio_c', precio_c1);
                formData.append('precio_b', precio_b1);
                formData.append('precio_a', precio_a1);
                formData.append('presentacion', presentacion1);
                formData.append('existencia', cantidad1);
                formData.append('contenido', contenido1);
                formData.append('tipo', tipo1);
                formData.append('sexo', sexo1);
                formData.append('designer', designer1);
                formData.append('nombre', nombre1);
                formData.append('id_designer', this.articulos.id_designer);
                formData.append('id', this.articulos.id);

        		axios({
                    method: 'POST',
                    url: me.url,
                    data: formData
                }).then(function (response) {
                    me.isLoading = false;
                    if (response.data.status) {
                        console.log(response.data);
                        me.cerrarModal();
                        me.getData();

                        if(!nuevo){
                        	me.tituloModal2 = 'Actualizacion de Datos';
                        	me.contenidoModal = 'Datos del Articulo Actualizados Correctamente';
                            me.bgModal = 'modal-header bg-info';
                            me.activarModal();
                        }
                        else
                        {
                        	me.tituloModal2 = 'Registro de Datos';
                        	me.contenidoModal = 'Articulo Registrado Correctamente';
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
            this.imagen = null;
            Utilerias.resetObject(this.articulos);
            document.getElementById("imagenfile").value = null;
            $("#ModalArticulo").modal('hide');//ocultamos el modal
			$('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
			$('.modal-backdrop').remove();//eliminamos el backdrop del modal
        },
        activarModal(){
        	$("#ModalSuccess").modal();//activamos el modal que valida actualizacion o registro del articulo
        	$('#ModalSuccess').modal({backdrop: 'static', keyboard: false});
        },
        abrirModal(modelo, accion, data = []){
            switch(modelo){
                case "articulo":
                {
                    switch(accion){
                        case 'registrar':
                        {
                            this.tituloModal = 'Registrar Articulo';
                            Utilerias.resetObject(this.articulos);
                            this.tipoAccion = 1;
                            break;
                        }
                        case 'actualizar':
                        {
                        	
                            this.tituloModal = 'Actualizar Datos de Articulo';
                            this.tipoAccion = 2;
                            this.articulos.id = data['id'];
                            this.articulos.id_designer = data['id_designer'];
                            this.articulos.nombre = data['nombre'];
			                this.articulos.designer = data['designer'];
			                this.articulos.sexo = data['sexo'];
			                this.articulos.tipo = data['tipo'];
			                this.articulos.contenido = data['contenido'];
			                this.articulos.presentacion = data['presentacion'];
                            this.articulos.existencia = data['existencia'];
			                this.articulos.precio_a = data['precio_a'];
			                this.articulos.precio_b = data['precio_b'];
			                this.articulos.precio_c = data['precio_c'];
			                this.articulos.precio_p = data['precio_p'];
			                this.articulos.descripcion = data['descripcion'];
			                this.articulos.estante = data['estante'];
			                this.articulos.codigo = data['codigo'];
                            this.articulos.codigoa1 = data['codigoa1'];
                            this.articulos.codigoa2 = data['codigoa2'];
                            this.articulos.codigoa3 = data['codigoa3'];
                            this.articulos.codigoa4 = data['codigoa4'];
                            this.articulos.codigoa5 = data['codigoa5'];
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