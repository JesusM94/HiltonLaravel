<template>
    <!--Modal con Sesion-->
    <div class="container" id="top">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center text-white badge-dark badge-pill" style="background-color:#1c2a48;">

                <div class="d-flex justify-content-end form-inline text-white">

                    <div class="d-flex justify-content-end form-inline text-white">
                        <router-link class="nav-link text-white" :to="{name: 'l-canceladas'}">
                            <i class="far fa-window-close"></i> Ventas Canceladas
                        </router-link>
                    </div>

                    <div class="d-flex justify-content-end form-inline text-white">
                        <router-link class="nav-link text-white" :to="{name: 'l-compras'}">
                            <i class="fas fa-shopping-bag"></i> Compras
                        </router-link>
                    </div>

                    <!--<div class="d-flex justify-content-end form-inline text-white">
                        <router-link class="nav-link text-white" :to="{name: 'l-inventarios'}">
                            <i class="far fa-clipboard"></i> Inventarios
                        </router-link>
                    </div>-->

                    <div class="d-flex justify-content-end form-inline text-white">
                        <router-link class="nav-link text-white" :to="{name: 'l-ventas'}">
                            <i class="fas fa-hand-holding-usd"></i> Ventas
                        </router-link>
                    </div>

                </div>

            </div>
        </div> 
    </div>
    <!--Fin Modal con Sesion-->
</template>