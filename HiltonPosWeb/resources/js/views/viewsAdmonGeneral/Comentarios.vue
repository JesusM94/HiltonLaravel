<template>
	<main class="main">
        <div class="container-fluid col-md-10">
        	<br>
            <div class="card" v-show="!detalle">
                <div class="card-header">
                    <h1><i class="fas fa-comment-dots"></i> Administracion de Comentarios</h1>
                </div>
                <div class="card-body">
                	<v-client-table :data="tableData" :columns="columns" :options="options">

                		<template slot="id" slot-scope="props">

                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-outline-primary btn-rounded waves-effect" data-toggle="modal" data-target="#ModalComentario" data-backdrop="static" data-keyboard="false" @click="abrirModal('comentarios','actualizar',props.row)">
                                    <i class="far fa-eye fa-lg"></i>
                                </button>
                            </div>

                        </template>

                        <template slot="estado" slot-scope="props">
                            <template v-if="props.row.estado">
                                <span class=" badge-dark badge-pill bg-success">
                                    Leido
                                </span>
                            </template>
                            <template v-else>
                                <span class=" badge-dark badge-pill bg-danger">
                                    Pendiente
                                </span>
                            </template>
                        </template>

                	</v-client-table>
                </div>
            </div>
        </div>

        <!-- Modal Actualizacion/Registro de Datos-->
		<div class="modal fade" id="ModalComentario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    			<div class="modal-content">
    				<div class="modal-header bg-info">
        				<h5 class="modal-title" id="exampleModalCenterTitle" v-text="tituloModal"></h5>
        				<button type="button" class="close" aria-label="Close" @click="cerrarModal()">
         					<span aria-hidden="true">&times;</span>
        				</button>
    				</div>
    				<div class="modal-body">
    					<h5>From:</h5>
    					<p class="font-weight-bold">{{ this.email }}</p>
    					<hr>
    					<h5>Comentario:</h5>
    					<p class="font-weight-bold">{{ this.comentario }}</p>
    					<hr>
    					<br>
    					<div class="row">
        					<div class="col-8 col-sm-6">
            					Fecha: {{ this.fecha }}
        					</div>
        					<div class="col-4 col-sm-6">
            					Nombre: {{ this.nombre }}
        					</div>
        				</div>

    				</div>
    				<div class="modal-footer">
        				<button type="button" class="btn btn-secondary" @click="cerrarModal()">
        					Cerrar
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
            url: '/AdmonComentarios',
            comentario : '',
            email: '',
            nombre: '',
            fecha: '',

            detalle: false,

            tituloModal : '',
   
            isLoading: false,
            columns: ['id','fecha','nombre','email','estado'],
            tableData: [],
            options: {
                headings: {
                	estado: 'Estado',
                	email: 'Email',
                    nombre: 'Nombre del Contacto',
                    fecha: 'Fecha',
                    id: 'Opciones',
                },
                perPage: 10,
                perPageValues: [],
                skin: config.skin,
                sortIcon: config.sortIcon,
                sortable: ['estado', 'nombre','email','fecha'],
                filterable: ['estado', 'nombre','email','fecha'],
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
        leido(idcomentario){
        	let me=this;
            axios.get(me.url+'/'+idcomentario+'/edit').then(response => {

                this.getData();
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        cerrarModal(){
        	this.tituloModal='';
            $("#ModalComentario").modal('hide');//ocultamos el modal
			$('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
			$('.modal-backdrop').remove();//eliminamos el backdrop del modal
        },
        abrirModal(modelo, accion, data = []){
            switch(modelo){
                case "comentarios":
                {
                    switch(accion){
                        case 'registrar':
                        {
                            //
                            break;
                        }
                        case 'actualizar':
                        {
                            this.tituloModal = 'Comentarios';
                            this.comentario = data['comentario'];
                            this.email = data['email'];
                            this.nombre = data['nombre'];
                            this.fecha = data['fecha'];
                            this.leido(data['id']);
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