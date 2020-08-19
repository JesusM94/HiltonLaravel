<template>
	<main class="main">
		<div class="container-fluid col-md-10">
			<div class="justify-content-center text-center">
				<!-- COMPRA REGISTRADA -->
				<br>
	    		<div class="justify-content-center text-center" v-show="visible">

	        		<div class="col-lg-12 col-sm-12">
	            		<h4 class="font-weight-bold text-center text-danger">Confirmar Compra</h4>
	        		</div>

	        		<div class="hero-feature justify-content-center text-center">
	        			<h5>La orden de compra se registro correctamente. A continuacion se muestra el ID de la orden de compra para cualquier aclaracion al respecto.</h5>
	        			<br>
	        			<h4 class="font-weight-bold text-center text-danger">ID DE COMPRA: {{ ID_Compra }}</h4>
	        			<br>
	        			<h5>A la brevedad posible nos pondremos en contacto con usted para confirmar la compra y fijar el metodo de pago.</h5>
	        			<br>
	        			<h6 class="font-weight-bold text-center text-danger">MUCHAS GRACIAS POR SU COMPRA</h6>
	        		</div>
	        		<br>

	        		<button type="button" class="btn btn-outline-danger waves-effect">
						<router-link class="nav-link text-dark font-weight-bold" :to="{name: 'home'}">
							Volver al Catalogo
						</router-link>
					</button>

	        	</div>
	        	<br>
	        	<!-- COMPRA REGISTRADA -->

				<!-- Cart -->
	    		<div class="justify-content-center text-center" v-show="!visible">

	        		<div class="col-lg-12 col-sm-12">
	            		<h4 class="font-weight-bold text-center text-danger">Confirmar Compra</h4>
	        		</div>

	        		<div class="hero-feature justify-content-center text-center">

	            		<div class="table-responsive justify-content-center text-center">

	                		<table class="table table-bordered tbl-cart justify-content-center text-center table-sm">

			                    <thead class="text-white" style="background-color:#1C2331;">
			                        <tr>
			                            <td class="hidden-xs">Cantidad</td>
			                            <td>Descripcion</td>
			                            <td>Precio Unitario</td>
			                            <td>Importe</td>
			                        </tr>
			                    </thead>

	                    		<tbody>

			                        <tr v-for="(item,i) in confirm_bay">
			                            <td class="hidden-xs">
			                                {{ item.cantidad }}
			                            </td>
			                            <td>
			                            	{{ item.nombre }} By {{ item.designer }}
			                            </td>
			                            <td class="price">
			                            	{{ item.precio_unitarioUSD }} U.S.D.<br>
										    <p class="text-danger">( {{ item.precio_unitarioMN }} M.N. )</p>
			                            </td>
			                            <td>
			                            	{{ item.precio_usd }} U.S.D.<br>
										    <p class="text-danger">( {{ item.precio_mn }} M.N. )</p>
			                            </td>
			                        </tr>
			                        <tr>
			                            <td colspan="3" align="right">Sub-Total:</td>
			                            <td class="total" colspan="2">
			                            	<b>{{ taxes_cart[0]['subtotal_usd'] }} U.S.D.</b>
			                            	<p class="text-danger">( {{ taxes_cart[0]['subtotal_mn'] }} M.N. )</p>
			                            </td>
			                        </tr>
			                        <tr>
			                            <td colspan="3" align="right">I.V.A.:</td>
			                            <td class="total" colspan="2">
			                            	<b>{{ taxes_cart[0]['iva_usd'] }} U.S.D.</b>
			                            	<p class="text-danger">( {{ taxes_cart[0]['iva_mn'] }} M.N. )</p>
			                            </td>
			                        </tr>
			                        <tr>
			                            <td colspan="3" align="right">Total:</td>
			                            <td class="total" colspan="2">
			                            	<b>{{ taxes_cart[0]['total_usd'] }} U.S.D.</b>
			                            	<p class="text-danger">( {{ taxes_cart[0]['total_mn'] }} M.N. )</p>
			                            </td>
			                        </tr>

			                    </tbody>

	                		</table><br>

	                		<h5 class="font-weight-bold modal-title text-center">
								*Para costos de envio favor de ponerse en contacto con nosotros*
							</h5><br>

							<h4 class="font-weight-bold text-center text-danger">
								Informacion de Contacto
							</h4>
							<div class="justify-content-center text-center">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="exampleRadios" id="Rd_Membresia" @click="cargarMembresia()">
									<label class="form-check-label" for="exampleRadios1">
    									Utilizar datos registrados en membresia
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="exampleRadios"
									id="Rd_Otros" @click="cargarOtros()">
									<label class="form-check-label" for="exampleRadios2">
    									Especificar otros datos
									</label>
								</div>
							</div><br>

							<div class="justify-content-center text-center border border-danger rounded">

								<div class="alert alert-danger text-center" role="alert" v-show="error1">
									*Los campos marcados son obligatorios.
								</div>

								<br>
								<div class="container">

								  <div class="row justify-content-md-center">
								    <div class="col col-lg-3 text-left text-danger font-weight-bold">
								    	<label for="exampleInputEmail1">*Nombre:</label>
										<input type="text" name="nombre" class="form-control" id="Name1" placeholder="Nombre" :value="this.nombre" required>
								    </div>
								    <div class="col col-lg-3 text-left text-danger font-weight-bold">
								    	<label for="exampleInputEmail1">*Apellido Paterno:</label>
										<input type="text" name="app" class="form-control" id="Apellido1" placeholder="Apellido Paterno" :value="this.apellidop" required>
								    </div>
								    <div class="col col-lg-3 text-left text-danger font-weight-bold">
								    	<label for="exampleInputEmail1">*Apellido Materno:</label>
										<input type="text" name="apm" class="form-control" id="Apellido2" placeholder="Apellido Materno" :value="this.apellidom" required>
								    </div>
								  </div>
								  
								</div>
								<br>
								<div class="container">

								  <div class="row justify-content-md-center">
								    <div class="col col-lg-3 text-left text-danger font-weight-bold">
								    	<label for="exampleInputEmail1">Telefono:</label>
										<input type="text" name="telefono" class="form-control" id="Telefono1" placeholder="Telefono" :value="this.tel" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
								    </div>
								    <div class="col col-lg-3 text-left text-danger font-weight-bold">
								    	<label for="exampleInputEmail1">Celular:</label>
										<input type="text" name="celular" class="form-control" id="Celular1" placeholder="Celular" :value="this.cel" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
								    </div>
								    <div class="col col-lg-3 text-left text-danger font-weight-bold">
								    	<label for="exampleInputEmail1">Nextel:</label>
										<input type="text" name="nextel" class="form-control" id="Nextel1" placeholder="Nextel" :value="this.next" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
								    </div>
								  </div>
								  
								</div>
								<br>
								<div class="container">

									<div class="row justify-content-md-center">
								    	<div class="col col-lg-3 text-left text-danger font-weight-bold">
								    		<label for="exampleInputEmail1">Email:</label>
											<input type="text" name="email" class="form-control" id="Email1" placeholder="Email" :value="this.correo" required>
								    	</div>
								    	<div class="col col-lg-3">
								    		
								    	</div>
								    	
								    	<div class="col col-lg-3">
								    	
								    	</div>
									</div>
									<br>

									<button type="button" class="btn btn-outline-success btn-rounded waves-effect" @click="guardarCompra()">
										Registrar Compra
									</button>
								  
								</div><br>

							</div>

	            		</div>

	        		</div>

	    		</div>
	    		<!-- End Cart -->
	    		<br>

			</div>
		</div>
	</main>
</template>
<script>
export default {
	props: ['confirm_bay','taxes_cart'],
	data (){
        return {
                
            url: 'PedidosPerfume',
            visible: false,
            ID_Compra: 0,
            error1: false,
            membership1: false,
            membership2: false,
            membresia: 0,
            nombre: '',
            apellidop: '',
            apellidom: '',
            tel: '',
            cel: '',
            next: '',
            correo: '',
            datos: [],
        }
    },
    components: {
        //
    },
    methods : {
    	clearDatos(){
        	$(':input').val('');
        	this.error1 = false;
        	this.membresia = '';
            this.nombre = '';
            this.apellidop = '';
            this.apellidom = '';
            this.tel = '';
            this.cel = '';
            this.next = '';
            this.correo = '';
            this.datos = [];
        },
    	validaNumericos(event) {
		    if(event.charCode >= 48 && event.charCode <= 57){
		      return true;
		     }
		     return false;        
		},
		validaMembresia(){
			var control = document.getElementById("Rd_Membresia");
			var control2 = document.getElementById("Rd_Otros");

			axios.get('/PerfumeEspeciales/1').then(response => {

                if (response.data.status)
                {
                    control.checked= true;
                    this.datos = response.data;

                    this.membresia = response.data.id_usuario;
                    this.nombre = response.data.nombre;
                    this.apellidop = response.data.apellidop;
                    this.apellidom = response.data.apellidom;
                    this.tel = response.data.telefono;
                    this.cel = response.data.celular;
                    this.next = response.data.nextel;
                    this.correo = response.data.email;
                    //console.log(this.datos);
                }
                else
                {
            		document.getElementById("Rd_Membresia").disabled = true;
            		control2.checked= true;
                }
                    
            })
                .catch(function (error) {
                	console.log(error);
            });
		},
		cargarOtros(){
			$(':input').val('');
		},
		cargarMembresia(){
			//console.log(this.datos['nombre']);
			this.nombre = this.datos['nombre'];
        	this.apellidop = this.datos['apellidop'];
        	this.apellidom = this.datos['apellidom'];
        	this.tel = this.datos['telefono'];
        	this.cel = this.datos['celular'];
        	this.next = this.datos['nextel'];
        	this.correo = this.datos['email'];
		},
        guardarCompra()
        {
        	this.error1 = false;

        	let nombre1 = document.getElementById("Name1").value;
        	let apellido1 = document.getElementById("Apellido1").value;
        	let apellido2 = document.getElementById("Apellido2").value;
        	let telefono1 = document.getElementById("Telefono1").value;
        	let celular1 = document.getElementById("Celular1").value;
        	let nextel1 = document.getElementById("Nextel1").value;
        	let email1 = document.getElementById("Email1").value;
        	let id_compra1 = 0;

        	if (nombre1 != "" && apellido1 != "" && apellido2 != "")
        	{
        		var data = this.confirm_bay;
        		let me=this;

        		let postA = {
        			id_post: 0,
					id_membresia: this.membresia,
					nombre: nombre1.concat(' ',apellido1,' ',apellido2),
					telefono: telefono1,
					celular: celular1,
					nextel: nextel1,
					email: email1,
				};

				axios.post(me.url, postA).then((result) => {

		        	if (result.data.status) 
		        	{
		        		id_compra1 = result.data.id_compra;
		        		for (var i = 0; i < data.length; i++) {

				        	let post = {
				        		id_post: 1,
				        		id_compra: id_compra1,
							    id_articulo: data[i].id,
							    cantidad: data[i].cantidad,
							    precio_lista: data[i].precio_usd,
							    precio_final: data[i].precio_usd,
							};

							axios.post(me.url, post).then((result) => {

				        		if (result.data.status) 
				        		{
				        			this.ID_Compra = id_compra1;
				        			this.visible = true;
				        			this.$emit('clear-to-cart',true);
				        			this.clearDatos();
				        		}

				        	});
		        		}
		        	}

		        });

        	}

        	else{

        		this.error1 = true;
        	}

        },
    },
    mounted() {
        this.validaMembresia();
    }
}
</script>