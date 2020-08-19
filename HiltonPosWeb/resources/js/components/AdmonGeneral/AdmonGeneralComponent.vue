<template>
	<!--Modal-->
    <div class="container" id="top">
        <div class="row justify-content-center">
            <div class=" d-flex justify-content-center text-warning" style="background-color:#1c2a48;">

                <div class="d-flex justify-content-end form-inline text-warning">

                    <div class="d-flex justify-content-end form-inline text-warning">
                        <a class="btn btn-flat text-warning" @click="getData(0)">
                            <i class="fas fa-cash-register"></i> Punto de Venta
                        </a>
                    </div>

                    <div class="d-flex justify-content-end form-inline text-warning">
                        <a class="btn btn-flat text-warning" @click="getData(1)">
                            <i class="fas fa-cogs"></i> Administración
                        </a>
                    </div>

                </div>

            </div>
        </div>
        <adminhilton  v-show="admin"></adminhilton>
        <puntoventa  v-show="pdv"></puntoventa>
    </div>
    <!--Fin Modal-->
</template>
<script>
const AdmonH = r => require.ensure([], () => r(require('./AdmonHiltonComponent.vue')), 'Admon');
const PdvH = r => require.ensure([], () => r(require('./PuntoVentaHiltonComponent.vue')), 'Pdv');
export default {
        data (){
            return {
                
                admin: false,
                pdv: true,
                
            }
        },
        components: {
            'adminhilton' : AdmonH,
            'puntoventa' : PdvH,
        },
        computed: {
            //
        },
        methods : {
            getData(id) {
                
                let me=this;
                if (id == 0) {
                    this.admin = false;
                    this.pdv = true;
                }
                else{
                    this.admin = true;
                    this.pdv = false;
                }
            },
        },
        mounted() {
            //this.getData();
        }
    }
</script>