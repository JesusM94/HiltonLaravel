<template>
    <div class="app">
        <!-- Footer -->
        <footer class="page-footer font-small indigo">

            <!-- Footer Links -->
            <div class="container">
                
                <!-- Grid column -->
                <div class="col-md-12 col-12 text-center font-weight-bold">
                    *TODOS LOS PRECIOS ESTAN SUJETOS A CAMBIO SIN PREVIO AVISO*
                </div>
                <!-- Grid column -->

                <!-- Grid row-->
                <div class="row text-center  justify-content-center" style="background-color:#CC0000;">

                    <!-- Grid column -->
                    <div class="col-md-3">
                        <router-link class="font-weight-bold text-white" :to="{name: 'home'}">Especiales de la semana</router-link>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2">
                        <router-link class="font-weight-bold text-white" :to="{name: 'l-membresia'}">Membresias</router-link>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3">
                        <router-link class="font-weight-bold text-white" :to="{name: 'l-pc'}">Pedidos y Cotizaciones</router-link>
                    </div>
                    <!-- Grid column -->

                </div>
                <!-- Grid row-->

                <!-- Grid column -->
                <div class="col-md-12 col-12 text-center text-danger">
                    Avenida 22 de Julio #2306 Colonia Hidalgo, Tijuana, B.C.<br>
                    Tel:(664)379-1105 Nxtl: 152*142264*1
                </div>
                <!-- Grid column -->


                <!-- Grid column -->
                <div class="col-md-12 col-12 text-center">
                    <router-link :to="{name: 'home'}">
                    <img src="img/ph_logo_s.png" alt="Smiley face">
                    </router-link>
                </div>
                <!-- Grid column -->

            </div>
            <!-- Footer Links -->

            <!-- Copyright -->
            <div class="footer-copyright text-center text-danger">
                <p>© 2010 Perfumeria Hilton, Tijuana, B.C.</p>
            </div>
            <!-- Copyright -->

        </footer>
        <!-- Footer -->
    </div>

</template>