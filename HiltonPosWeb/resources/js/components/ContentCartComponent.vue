<template>
	<main class="main">
		<div id="myContentCart" class="modal fade" style="display: none;" aria-hidden="true">
			<div class="modal-dialog modal-login modal-lg modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header text-white bg-danger">			
						<h4 class="modal-title text-center">Carrito de Compra</h4>	
                		<button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true" @click="closeModal()">×</button>
					</div>
					<div class="modal-body">

						<h4 class="modal-title text-center text-danger" v-show="validar">
							*Cantidad Ingresada No Valida*
						</h4>

						<h4 class="modal-title text-center text-primary" v-show="!confirmamount">
							*No hay articulos en el carrito de compra.*
						</h4>

						<table class="table table-sm">
							
							<thead class="thead-dark">
							    <tr>
							    	<th scope="col" style="width: 16.66%">Acciones</th>
							    	<th scope="col" style="width: 16.66%">Nueva Cantidad</th>
							    	<th scope="col" style="width: 16.66%">Cantidad Actual</th>
							    	<th scope="col" class="text-center">Descripcion</th>
							    	<th scope="col" style="width: 16.66%">Precio Unitario</th>
							    	<th scope="col" style="width: 16.66%" class="text-center">Importe</th>
							    </tr>
							</thead>

							<tbody>

								<tr v-for="(item,i) in mycartcontent" :key="item.id_designer">
							    	<th scope="row" style="width: 16.66%">
							    		<button class="btn btn-md btn-success" type="button" @click="refresh(i,item.id)">
											<i class="fas fa-sync"></i>
										</button>&nbsp;
										<button class="btn btn-md btn-danger" type="button" @click="eliminar(i, item.id)">
											<i class="fas fa-trash-alt"></i>
										</button>
							    	</th>

							    	<td style="width: 16.66%" class="font-weight-bold text-center">
							    		<input type="text" :id="item.id" :value="item.cantidad" class="form-control font-weight-bold text-center" aria-label="Example text with two button addons" aria-describedby="MaterialButton-addon3" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
							    	</td>
							    	<td class="font-weight-bold text-center" style="width: 16.66%">
							    		{{ item.cantidad }}
							    	</td>
							    	<td class="font-weight-bold text-center" style="width: 16.66%">
							    		{{ item.nombre }} By {{ item.designer }}
							    	</td>
							    	<td class="font-weight-bold text-center" style="width: 16.66%">
							    		{{ item.precio_unitarioUSD }} U.S.D.<br>
							    		<p class="text-primary">( {{ item.precio_unitarioMN }} M.N. )</p>
							    	</td>
							    	<td class="font-weight-bold text-center" style="width: 16.66%">
							    		{{ item.precio_usd }} U.S.D.<br>
							    		<p class="text-primary">( {{ item.precio_mn }} M.N. )</p>
							    	</td>
							    </tr>

							</tbody>
						</table><br>

						<p class="font-weight-bold modal-title text-center">
							*Para costos de envio favor de ponerse en contacto con nosotros*
						</p><br>

						<div class="justify-content-center text-center">
							<button type="button" class="btn btn-outline-success waves-effect" @click="confirmarCompra()" v-show="confirmamount">
								<router-link class="nav-link text-dark font-weight-bold" :to="{name: 'l-confirmar'}">
									Confirmar Compra
								</router-link>
							</button>
						</div>
							
					</div>
					<div class="modal-footer">
						<p class="text-danger">© 2010 Perfumeria Hilton, Tijuana, B.C.</p>
					</div>

				</div>
			</div>
		</div>
	</main>
</template>
<script>
var config = require('../components/Herramientas/config-vuetables-client').call(this);
export default {
	props: ['mycartcontent','cambio','confirmamount'],
	data (){
        return {
                
            CartContent: [],
            confirmar: true,
            validar: false,

        }
    },
    computed: {
            confirmBay() {
                return this.mycartcontent;
            },
        },
    methods : {
        refresh(position,id_input){
        	this.validar = false;

        	var data = document.getElementById(id_input).value;

        	if (data == 0) {
        		this.validar = true;
        	}
        	else{
        		this.$emit('modify-to-cart', position, data, true);
        	}
        	
        },
        eliminar(position, id_input){
        	
        	var data = document.getElementById(id_input).value;
        	this.$emit('modify-to-cart', position, data, false);
        	
        },
        validaNumericos(event) {
		    if(event.charCode >= 48 && event.charCode <= 57){
		      return true;
		     }
		     return false;        
		},
		confirmarCompra(){
			if (this.mycartcontent[0] != undefined) {
				$("#myContentCart").modal('hide');//ocultamos el modal
				$('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
				$('.modal-backdrop').remove();//eliminamos el backdrop del modal

				this.$emit('confirm-to-bay', this.mycartcontent);
			}
			else{
				console.log(this.mycartcontent[0]);
			}
			
		},
        closeModal(){
        	this.validar = false;
        },
    },
    mounted() {
        //
    }
}
</script>