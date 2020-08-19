<template>
	<!--Modal con Sesion-->
    <div class="container" id="top">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12 col-xs-12 d-flex justify-content-center text-white badge-dark badge-pill" style="background-color:#1c2a48;">

                <div class="d-flex justify-content-end form-inline text-white">

                    <div class="d-flex justify-content-end form-inline text-white">
                        <router-link class="nav-link text-white" :to="{name: 'l-agentes'}">
                            <i class="fas fa-users"></i> Agentes
                        </router-link>
                    </div>

                    <div class="d-flex justify-content-end form-inline text-white">
                        <router-link class="nav-link text-white" :to="{name: 'l-articulos'}">
                            <i class="fas fa-boxes"></i> Articulos
                        </router-link>
                    </div>

                    <div class="d-flex justify-content-end form-inline text-white">
                        <router-link class="nav-link text-white" :to="{name: 'l-designers'}">
                            <i class="fas fa-industry"></i> Designers
                        </router-link>
                    </div>

                    <div class="d-flex justify-content-end form-inline text-white">
                        <router-link class="nav-link text-white" :to="{name: 'l-membresiasolicitud'}">
                            <i class="fas fa-id-card"></i> Membresias
                        </router-link>
                    </div>

                    <div class="d-flex justify-content-end form-inline text-white">
                        <router-link class="nav-link text-white" :to="{name: 'l-comentarios'}">
                            <i class="fas fa-comment-dots"></i> Comentarios
                        </router-link>
                    </div>

                    <div class="d-flex justify-content-end form-inline text-white">
                        <router-link class="nav-link text-white" :to="{name: 'l-especiales'}">
                            <i class="far fa-newspaper"></i> Especiales
                        </router-link>
                    </div>

                    <div class="d-flex justify-content-end form-inline text-white">
                        <router-link class="nav-link text-white" :to="{name: 'l-gastos'}">
                            <i class="fas fa-file-invoice-dollar"></i> Gastos
                        </router-link>
                    </div>

                </div>

            </div>
        </div> 
    </div>
    <!--Fin Modal con Sesion-->
</template>