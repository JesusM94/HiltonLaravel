<template>
	<main class="main">
		<div class="container-fluid">
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	            <div class="modal-dialog modal-dialog-centered" role="document">
	                <div class="modal-content">
	      
	                    <!-- Modal Header -->
	                    <div class="modal-header">
	                        <h4 class="modal-title">Detalle de Perfume</h4>
	                        <button type="button" class="close" data-dismiss="modal">&times;</button>
	                    </div>
	        
	                    <!-- Modal body -->
	                    <div class="modal-body justify-content-center">

	                    	<img v-if="detalle_perfume['id_perfume'] != undefined" :src="'img/@articulos/' + detalle_perfume['id_perfume'] + '.jpg'" class="img-fluid rounded mx-auto d-block" alt="Responsive image" width="200" height="200">

	                        <p class="font-weight-bold text-center text-danger">
	                        	{{ detalle_perfume['nombre'] }} By {{ detalle_perfume['designer'] }}
	                        </p>

	                        <p class="font-weight-bold text-center">
	                        	Contenido: 
	                        	<code class="h5 text-danger">{{ detalle_perfume['contenido'] }}ml</code>
	                        </p>

	                        <p class="font-weight-bold text-center">
	                        	Precio (Dlls.): 
	                        	<code class="h5 text-primary">${{ detalle_perfume['precio_f'] }}</code>
	                        </p>

	                        <p class="font-weight-bold text-center">
	                        	Precio (M.N.): 
	                        	<code class="h5 text-primary">${{ precioMXN }}</code>
	                        </p>

	                        <p class="font-weight-bold text-center">
	                        	Precio imp. fronterizo: / Precio imp. al sur:
	                        	<router-link class="nav-link" :to="{name: 'l-contacto'}">
	                        		<button type="button" class="btn btn-link" data-dismiss="modal">
	                        			CONTACTANOS!
	                        		</button>
	                        	</router-link>
	                        </p>

	                    </div>
	        
	                    <!-- Modal footer -->
	                    <div class="modal-footer justify-content-center">
	                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	                    </div>
	        
	                </div>
	            </div>
	        </div>
		</div>
	</main>
</template>
<script>
var config = require('../components/Herramientas/config-vuetables-client').call(this);

export default {
	props: ['detalle_perfume', 'precioMXN'],
}
</script>