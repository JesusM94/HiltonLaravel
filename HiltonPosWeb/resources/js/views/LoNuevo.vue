<template>
    <main class="main">
        <div class="container-fluid col-md-10">

            <br>
            <div class="card" v-show="!detalle">
                <div class="card-header">
                    <h1><i class="fas fa-box-open" style="color:black;"></i> Lo Nuevo</h1>
                </div>
                <div class="card-body">
                    <v-client-table :data="tableData" :columns="columns" :options="options">

                        <template slot="id" slot-scope="props">

                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-outline-primary btn-rounded waves-effect" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" @click="abrirModal(props.row)">
                                    <i class="fas fa-eye fa-lg"></i>
                                </button>&nbsp;
                                <button type="button" class="btn btn-outline-success btn-rounded waves-effect" data-toggle="modal" data-backdrop="static" data-keyboard="false" @click="addToCart(props.row)">
                                    <i class="fas fa-cart-plus fa-lg"></i>
                                </button>
                            </div>

                        </template>

                    </v-client-table>
                </div>
            </div>
        </div>

        <!-- Modal Detalle -->
        <detalleperfume :precioMXN="precio_pesos" :detalle_perfume="contenido_perfume" />
        <!-- Fin Modal Detalle -->

    </main>
</template>
<script>
var config = require('../components/Herramientas/config-vuetables-client').call(this);
const SolicitudDetallePerfume = r => require.ensure([], () => r(require('../components/DetallePerfumeComponent.vue')), 'perfumedetail');

export default {
    data (){
        return {
                
            url: '/PerfumeLoNuevo',
            nombre : '',
            designer: '',
            contenido: 0,
            sexo: 0,
            precio_f: '',
            detalle: false,
            contenido_perfume: [],
            precio_pesos: 0,
            TipoCambio: 0,

            Perfumes: {
                id: 0,
                nombre: '',
                designer: '',
                contenido: 0,
                sexo: 0,
                precio_f : '',
            },
                
            isLoading: false,
            columns: ['id', 'nombre', 'designer', 'contenido', 'sexo', 'precio_f'],
            tableData: [],
            options: {
                headings: {
                    precio_f: 'Precio USD ($)',
                    sexo: 'Género',
                    contenido: 'Presentación (ml)',
                    designer: 'Marca',
                    nombre: 'Nombre',
                    id: 'Opciones',
                },
                perPage: 10,
                perPageValues: [],
                skin: config.skin,
                sortIcon: config.sortIcon,
                sortable: ['precio_f', 'sexo', 'contenido', 'designer', 'nombre'],
                filterable: ['precio_f', 'sexo', 'contenido', 'designer', 'nombre'],
                filterByColumn: true,
                texts:config.texts
            },
        }
    },
    components: {
        'detalleperfume' : SolicitudDetallePerfume,
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
            /*----------------------------------------*/
            axios.get('/TipoCambio').then(response => {
                    this.TipoCambio = response.data;
            })
            .catch(function (error) {
                    console.log(error);
            });
        },
        addToCart(data = []) {
            this.$emit('add-to-cart', data);
        },
        abrirModal(data = []){
            this.contenido_perfume = data;
            this.precio_pesos = Number.parseFloat(data['precio_f'] * this.TipoCambio).toFixed(2);
        }
    },
    mounted() {
        this.getData();
    }
}
</script>