<template>
	<main class="main">
        <div class="container-fluid col-md-10">
        	<br>
            <div class="card" v-show="!detalle">
                <div class="card-header">
                    <h1><i class="far fa-newspaper"></i> Administracion de Especiales</h1>
                    <button type="button" data-toggle="modal" data-target="#ModalEspecial" data-backdrop="static" data-keyboard="false" @click="abrirModal('especial','registrar')" class="btn btn-dark float-sm-right">
                    	<i class="fas fa-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                	<v-client-table :data="tableData" :columns="columns" :options="options">

                		<template slot="id" slot-scope="props">

                            <div class="d-flex justify-content-center">
                                <button type="button" v-if="props.row.estado == 1" class="btn btn-outline-danger btn-rounded waves-effect" data-toggle="modal" data-target="#ModalDanger" data-backdrop="static" data-keyboard="false" @click="eliminarEspecial(0,props.row)">
                                    <i class="fas fa-trash fa-lg"></i>
                                </button>

                                <button type="button" v-if="props.row.estado == 0" class="btn btn-outline-success btn-rounded waves-effect" data-toggle="modal" data-target="#ModalDanger" data-backdrop="static" data-keyboard="false" @click="activarDesigner(0,props.row)">
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
                                    Baja
                                </span>
                            </template>
                        </template>

                	</v-client-table>
                </div>
            </div>
        </div>

        <!-- Modal Actualizacion/Registro de Datos-->
		<div class="modal fade" id="ModalEspecial" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
    						<div class="form-group mx-sm-3 mb-2 text-danger font-weight-bold">
    							<label for="inputPassword2" class="sr-only">Codigo:</label>
    							<input type="text" class="form-control" id="Codigo1" placeholder="Buscar por Codigo">
							</div>
							<button type="submit" class="btn btn-primary mb-2" @click="buscarCodigo()">
								Buscar
							</button>
						</div>
						<br>

    					<div class="row">
							<div class="col col-lg-5 text-left text-danger font-weight-bold">
							    <label for="exampleInputCelular1">*Perfume:</label>
								<select class="form-control" id="Perfume1"  name="nombre"  :value="this.especiales.id_perfume">
                                    <option v-for="item in listaPerfume" :value="item.id" :key="item.id">{{ item.nombre }}</option>
                                </select>
							</div>
							<div class="col col-lg-5 text-left text-danger font-weight-bold">
								<label for="exampleInputNameUser1">*Precio Especial:</label>
								<input type="text" name="especial" class="form-control" id="Especial1" placeholder="Precio" required>
							</div>
						</div>
						<br>

    				</div>
    				<div class="modal-footer">
        				<button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
        				<button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="guardarEspecial(1)"><i class="fas fa-save"></i>&nbsp;Guardar</button>
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
                        <button type="button" v-if="tipoAccion2==1" class="btn btn-primary" @click="eliminarEspecial(1)">
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
            url: '/AdmonEspeciales',

            detalle: false,

            bgModal: '',
            tituloModal : '',
            tituloModal2 : '',
            contenidoModal: '',
            tipoAccion: 0,
            error1: false,
            idEspecial:0,
            listaPerfume: [],

            tipoAccion2: 0,
            bgModal2: '',
            tituloModal3: '',
            contenidoModal2: '',

            especiales: {
                id: 0,
                id_designer: 0,
                id_perfume: 0,
	            estado: 0,
            },
                
            isLoading: false,
            columns: ['id','id_perfume','designer','nombre','sexo','contenido','presentacion','precio','existencia','estado'],
            tableData: [],
            options: {
                headings: {
                	estado: 'Estado',
                	existencia: 'Existencia',
                	precio: 'Precio Especial',
                	presentacion: 'Presentacion',
                	contenido: 'Contenido',
                	sexo: 'Genero',
                	nombre: 'Nombre',
                	designer: 'Diseñador',
                    id_perfume: 'ID Perfume',
                    id: 'Opciones',
                },
                perPage: 10,
                perPageValues: [],
                skin: config.skin,
                sortIcon: config.sortIcon,
                sortable: ['estado', 'nombre','id_perfume','designer'],
                filterable: ['estado', 'nombre','id_perfume','designer'],
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
            /*Lista de Perfumes*/
            axios.get('/AdmonArticulos').then(response => {
                me.listaPerfume = response.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        eliminarEspecial(nuevo, data = []) {

            this.bgModal2 = 'modal-header bg-danger';
            this.tituloModal3 = 'Desactivacion';
            this.contenidoModal2 = '¿Desea Desactivar este Especial?';
            this.tipoAccion2 = 1;

            if (nuevo == 1) {
                let me=this;
                axios.delete(me.url+'/'+this.idEspecial).then(response => {
                    $("#ModalDanger").modal('hide');//ocultamos el modal
                    $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
                    $('.modal-backdrop').remove();//eliminamos el backdrop del modal

                    this.tituloModal2 = 'Desactivar';
                    this.contenidoModal = 'Especial Desactivado Correctamente';
                    this.bgModal = 'modal-header bg-warning';
                    this.activarModal();
                    this.getData();
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
            else{
                this.idEspecial = data['id'];
            }
        },
        buscarCodigo() {
            let me=this;
            let codigo = document.getElementById("Codigo1").value;
            axios.get(me.url+'/'+codigo+'/edit').then(response => {
                this.especiales.id_perfume = response.data.id;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        guardarEspecial(nuevo){

        	this.error1 = false;
        	let idperfume = document.getElementById("Perfume1").value;
        	let precio = document.getElementById("Especial1").value;

        	if (precio != "" && idperfume != "")
        	{
        		let me = this;

        		axios({
                    method: 'POST',
                    url: me.url,
                    data: {
                    	'precio': precio,
                        'id_perfume': idperfume,
                        'id': this.especiales.id
                    }
                }).then(function (response) {
                    me.isLoading = false;
                    if (response.data.status) {
                        me.cerrarModal();
                        me.getData();

                        if(!nuevo){
                        	//
                        }
                        else
                        {
                        	me.tituloModal2 = 'Registro de Datos';
                        	me.contenidoModal = 'Especial Registrado Correctamente';
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
        	$(':input').val('');
        	this.tituloModal='';
        	this.tipoAccion = 0;
            this.bgModal = '';
            this.contenidoModal = '';
        	this.error1 = false;
            this.idEspecial = 0;
            this.tituloModal2 = '';
            this.tituloModal3 = '';
            this.bgModal2 = '';
            this.tipoAccion2 = 0;
            this.contenidoModal2 = '';
            Utilerias.resetObject(this.especiales);
            $("#ModalEspecial").modal('hide');//ocultamos el modal
			$('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
			$('.modal-backdrop').remove();//eliminamos el backdrop del modal
        },
        activarModal(){
        	$("#ModalSuccess").modal();//activamos el modal que valida actualizacion o registro
        	$('#ModalSuccess').modal({backdrop: 'static', keyboard: false});
        },
        abrirModal(modelo, accion, data = []){
            switch(modelo){
                case "especial":
                {
                    switch(accion){
                        case 'registrar':
                        {
                            this.tituloModal = 'Registrar Especial';
                            Utilerias.resetObject(this.especiales);
                            this.tipoAccion = 1;
                            break;
                        }
                        case 'actualizar':
                        {
                            //
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