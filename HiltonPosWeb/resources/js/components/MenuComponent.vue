<template>
    <div class="app">
        <header>

            <div class="col-md-12 col-sm-12 col-xs-12" style="background-color:#0d47a1;">
                <nav class="navbar navbar-expand-md shadow-sm navbar navbar-dark default-color">

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="container">
                    <div class="collapse navbar-collapse col-md-8" id="collapsibleNavbar">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item col-md-2">
                                
                            </li>
                            <li class="nav-item col-md-2">
                                <router-link class="nav-link" :to="{name: 'l-nuevo'}">Lo Nuevo</router-link>
                            </li>
                            <li class="nav-item col-md-2">
                                <router-link class="nav-link" :to="{name: 'l-dama'}">Dama</router-link>
                            </li>
                            <li class="nav-item col-md-2">
                                <router-link class="nav-link" :to="{name: 'l-caballero'}">Caballero</router-link>
                            </li>
                            <li class="nav-item col-md-2">
                                <router-link class="nav-link" :to="{name: 'l-nina'}">Niña</router-link>
                            </li>
                            <li class="nav-item col-md-2">
                                <router-link class="nav-link" :to="{name: 'l-nino'}">Niño</router-link>
                            </li>
                            <li class="nav-item col-md-2">
                                <router-link class="nav-link" :to="{name: 'l-diverso'}">Diversos</router-link>
                            </li>
                            <li class="nav-item col-md-2">
                                <router-link class="nav-link" :to="{name: 'l-contacto'}">Contacto</router-link>
                            </li>
                        </ul>
                    </div></div>

                </nav>
            </div>

            <admon-general  v-show="admin"></admon-general>

            <navbar v-show="!detalle" @modify-to-cartB="modifyToCartB" @confirm-to-bayB="confirmBayB" :tipo_cambio="TipoCambioValor" :cart-amount="cartAmount" :confirm_amount="confirmAmount" :content_cart="cart">
            </navbar>
            <!--<admon-general  v-show="admin"></admon-general>-->

        </header>

        <main role="main" class="inner cover">
            <!--<router-view></router-view>-->
            <router-view @add-to-cart="addToCart" :confirm_bay="confirmToBay" :taxes_cart="Impuestos" @clear-to-cart="clearToCart"></router-view>
            <br>
        </main>

    </div>
</template>
<script>
const NavBar = r => require.ensure([], () => r(require('./NavBarComponent.vue')), 'NavBar');
const AdministracionG = r => require.ensure([], () => r(require('./AdmonGeneral/AdmonGeneralComponent.vue')), 'AdminG');

    export default {
        data (){
            return {
                
                url: '/TipoCambio',
                TipoCambioValor: 0,
                detalle: false,
                admin: false,
                cart_perfume: [],
                contador: 0,
                ConfirmBay: [],
                Impuestos: [],
                cart: [],
                
            }
        },
        components: {
            'navbar' : NavBar,
            'admon-general' : AdministracionG,
        },
        computed: {
            cartAmount() {
                return this.contador;
            },
            confirmAmount() {
                var isVisible = false;
                if (this.contador == 0) {
                    return isVisible;
                }
                else{
                    isVisible = true;
                    return isVisible;
                }
            },
            confirmToBay() {
                this.Impuestos = [];

                const totalcart = {
                    subtotal_usd: 0,
                    subtotal_mn:0,
                    iva_usd: 0,
                    iva_mn: 0,
                    total_usd:0,
                    total_mn: 0
                }

                let subtotal_USD = 0
                this.cart.map((data)=>{
                  subtotal_USD = subtotal_USD + (data.cantidad * data.precio_unitarioUSD)
                });

                let subtotal_MN = 0
                this.cart.map((data)=>{
                  subtotal_MN = subtotal_MN + (data.cantidad * data.precio_unitarioMN)
                });

                let ivaUSD = 0;
                let ivaMN = 0;
                let totalUSD = 0;
                let totalMN = 0;

                ivaUSD =  Number.parseFloat(subtotal_USD * 0.11).toFixed(2);
                ivaMN =  Number.parseFloat(subtotal_MN * 0.11).toFixed(2);
                totalUSD =  Number.parseFloat(subtotal_USD * 1.11).toFixed(2);
                totalMN =  Number.parseFloat(subtotal_MN * 1.11).toFixed(2);

                totalcart.subtotal_usd = subtotal_USD;
                totalcart.subtotal_mn = subtotal_MN;
                totalcart.iva_usd = ivaUSD;
                totalcart.iva_mn = ivaMN;
                totalcart.total_usd = totalUSD;
                totalcart.total_mn = totalMN;

                this.Impuestos.push(totalcart);
                
                return this.ConfirmBay;
            },
        },
        methods : {
            getData() {
                
                let me=this;
                this.detalle = false;
                axios.get(me.url).then(response => {
                    this.TipoCambioValor = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
                /*******************************************/
                axios.get('/PerfumeEspeciales/1').then(response => {

                    if (response.data.admnistrador)
                    {
                        this.admin = true;
                    }
                    
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            confirmBayB(data) {
                this.ConfirmBay = data;
            },
            clearToCart(data) {
                if (data) {
                    this.contador = 0;
                    this.ConfirmBay = [];
                    this.Impuestos = [];
                    this.cart = [];
                }
            },
            modifyToCartB(position,data,validador) {
                if (validador) {

                    var oldAmount = parseInt(this.cart[position].cantidad);
                    var USD = this.cart[position].precio_unitarioUSD;
                    var newUSD = Number.parseFloat(USD * data).toFixed(2);
                    var newMN = Number.parseFloat(newUSD * this.TipoCambioValor).toFixed(2);

                    this.cart[position].cantidad = data;
                    this.cart[position].precio_usd = newUSD;
                    this.cart[position].precio_mn = newMN;

                    

                    if (oldAmount > data) {
                        var newAmount = parseInt(oldAmount - data);
                        
                        this.contador = this.contador - newAmount;
                    }
                    else{
                        var newAmount = parseInt(data - oldAmount);
                        
                        this.contador = this.contador + newAmount;
                    }

                    
                }

                else{
                    this.cart.splice(position,1)
                    this.contador = this.contador - data;
                    //console.log('isFalse---->>> ' + validador);
                }
                
            },
            addToCart(selectedProduct) {

                this.contador = this.contador + 1;

                var precioMN = Number.parseFloat(selectedProduct.precio_f * this.TipoCambioValor).toFixed(2);

                const itemcar = {
                    id : selectedProduct.id_perfume,
                    nombre : selectedProduct.nombre,
                    designer: selectedProduct.designer,
                    cantidad: 1,
                    precio_unitarioUSD: selectedProduct.precio_f,
                    precio_unitarioMN: precioMN,
                    precio_usd: selectedProduct.precio_f,
                    precio_mn: precioMN
                }

                if (this.cart.length != 0) {
                    var status = false;
                    var valor = 0;

                    for (var i = 0; i < this.cart.length; i++) {
                        
                        var x = this.cart[i] .id;
                        if (x == selectedProduct.id_perfume) {
                            valor = i;
                            status = true;
                        }

                    }
                    

                    if (status) {
                        
                        this.cart[valor].cantidad = parseInt(this.cart[valor].cantidad) + 1;
                        var nuevo_precio = Number.parseFloat(selectedProduct.precio_f * this.cart[valor].cantidad).toFixed(2);
                        this.cart[valor].precio_usd = nuevo_precio;
                        this.cart[valor].precio_mn = Number.parseFloat(nuevo_precio * this.TipoCambioValor).toFixed(2);
                        
                    }
                    else{
                        this.cart.push(itemcar);
                    }

                }
                else{
                    this.cart.push(itemcar);
                }
            
            },
        },
        mounted() {
            this.getData();
        }
    }
</script>