<template>
    <div class="app">

        <div class="text-center">
            <span class=" badge-dark badge-pill font-weight-bold" style="background-color:#CC0000;">
                Tipo De Cambio: ${{ tipo_cambio }}
            </span>
        </div>
        <div class="text-center">
            <button type="button" class="btn btn-outline-dark btn-rounded waves-effect" data-toggle="modal" data-target="#myContentCart" data-backdrop="static" data-keyboard="false" @click="abrirModal()">
                Carrito <i class="fas fa-shopping-cart fa-lg"></i>&nbsp;
                <span class="description">{{ cartAmount }}</span>&nbsp;
            </button>
            <span class=""></span>
        </div>

        <!-- Modal ContentCart -->
        <cartcontent @modify-to-cart="modifyToCart" @confirm-to-bay="confirmBay" v-show="mostrar" :mycartcontent="content_cart" :cambio="tipo_cambio" :confirmamount="confirm_amount" />
        <!-- Fin Modal ContentCart -->

    </div>
</template>
<script>
const ContentCart = r => require.ensure([], () => r(require('./ContentCartComponent.vue')), 'contentcart');

export default {
    props: ['tipo_cambio','cartAmount','confirm_amount','content_cart'],
    data (){
        return {
                
            mostrar: false,
        }
    },
    components: {
            'cartcontent' : ContentCart,
    },
    methods : {
        modifyToCart(position,data,validador){
            //console.log('addToCart2--->' + data);
            this.$emit('modify-to-cartB', position, data, validador);
        },
        confirmBay(data){
            //console.log('addToCart2--->' + data);
            this.$emit('confirm-to-bayB', data);
        },
        abrirModal(){
            this.mostrar = true;
        }
    },
}
</script>