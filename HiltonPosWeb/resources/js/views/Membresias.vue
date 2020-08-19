<template>
	<main class="main">
		<br>
		<div class="d-flex justify-content-center">

			<div class="col-md-10">
				
				<div class="modal-body justify-content-center">
					<h4 class="text-center text-danger">
						Si deseas solicitar una membresia de mayorista con nosotros por favor llene<br>
						la siguiente solicitud y deposita $200.00 M.N. por el costo anual de la membresia.
					</h4>
					<h4 class="text-center text-danger">
						Depósito a número de cuenta Banamex: 440-7536377.
					</h4>
					<h4 class="text-center text-danger">
						Transferencia electrónica a CLABE Banamex: 002028044075363776.
					</h4>
				</div>

				<div class="d-flex justify-content-center ">
					<div class="modal-body justify-content-center col-md-8 border border-danger rounded">

						<div class="alert alert-success text-center" role="alert" v-show="success">
							La solicitud se registro correctamente. Gracias por su interes.
						</div>

						<h6 class="alert alert-danger text-center" role="alert" v-show="validarCampos">
							*Los campos marcados son obligatorios.
						</h6>
						<br>

						<div class="row">
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputEmail1">*Nombre de Usuario:</label>
								<input type="text" name="nombreuser" class="form-control" id="UserName1" placeholder="Enter User Name" required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputEmail1">*Contraseña:</label>
								<input type="text" name="password" class="form-control" id="Password1" placeholder="Enter Password" required>
							</div>
						</div>
						<br>

						<div class="row">
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputEmail1">*Nombre:</label>
								<input type="text" name="nombre" class="form-control" id="Name1" placeholder="Enter Name" required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputEmail1">*Apellido Paterno:</label>
								<input type="text" name="apellidop" class="form-control" id="ApellidoP1" placeholder="Apellido Paterno" required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputEmail1">*Apellido Materno:</label>
								<input type="text" name="apellidom" class="form-control" id="ApellidoM1" placeholder="Apellido Materno" required>
							</div>
						</div>
						<br>

						<div class="row">
							<div class="col col-lg-6 text-left text-danger font-weight-bold">
								<label for="exampleInputEmail1">*Empresa:</label>
								<input type="text" name="empresa" class="form-control" id="Empresa1" placeholder="Empresa" required>
							</div>
						</div>
						<br>

						<div class="row">
							<div class="col col-lg-6 text-left text-danger font-weight-bold">
								<label for="exampleInputEmail1">*Domicilio:</label>
								<input type="text" name="domicilio" class="form-control" id="Domicilio1" placeholder="Domicilio" required>
							</div>
						</div>
						<br>

						<div class="row">
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputEmail1">Telefono:</label>
								<input type="text" name="telefono" class="form-control" id="Telefono1" placeholder="Telefono" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputEmail1">*Celular:</label>
								<input type="text" name="celular" class="form-control" id="Celular1" placeholder="Celular" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputEmail1">Nextel:</label>
								<input type="text" name="nextel" class="form-control" id="Nextel1" placeholder="Nextel" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
							</div>
							<div class="col col-lg-3 text-left text-danger font-weight-bold">
								<label for="exampleInputEmail1">*RFC:</label>
								<input type="text" name="rfc" class="form-control" id="RFC1" placeholder="RFC" required>
							</div>
						</div>
						<br>

						<div class="row">
							<div class="col col-lg-6 text-left text-danger font-weight-bold">
								<label for="exampleInputEmail1">*Email:</label>
								<input type="text" name="email" class="form-control" id="Email1" placeholder="Email" required>
							</div>
						</div>
						<br>

						<button class="btn btn-primary" type="submit" @click="guardarMembresia(1)">Enviar</button>
					</div>
				</div>

			</div>
		</div><br>

	</main>
</template>

<script>

export default {
    data (){
        return {
                
            url: 'MembresiasSolicitud',
            username: '',
            password: '',
            nombre:'',
            apellidop: '',
            apellidom: '',
            empresa: '',
            domicilio: '',
            telefono: '',
            celular: '',
            nextel: '',
            rfc: '',
            email:'',
            
            validarCampos: false,
            success:false,
            countDown : 5,
        }
    },
    components: {
        //
    },
    methods : {
        clearDatos(){
        	$(':input').val('');
        	this.validarCampos = false;
        },
        countDownTimer() {
            if(this.countDown > 0) {
                setTimeout(() => {
                    this.countDown -= 1
                    this.countDownTimer()
                }, 1000)
            }
            else
            {
            	this.success = false;
            	this.countDown = 5;
            }
        },
        validaNumericos(event) {
		    if(event.charCode >= 48 && event.charCode <= 57){
		      return true;
		     }
		     return false;        
		},
        guardarMembresia(nuevo)
        {
        	this.validarCampos = false;
        	this.success = false;

        	this.username = document.getElementById("UserName1").value;
        	this.password = document.getElementById("Password1").value;
        	this.nombre = document.getElementById("Name1").value;
        	this.apellidop = document.getElementById("ApellidoP1").value;
        	this.apellidom = document.getElementById("ApellidoM1").value;
        	this.empresa = document.getElementById("Empresa1").value;
        	this.domicilio = document.getElementById("Domicilio1").value;
        	this.telefono = document.getElementById("Telefono1").value;
        	this.celular = document.getElementById("Celular1").value;
        	this.nextel = document.getElementById("Nextel1").value;
        	this.rfc = document.getElementById("RFC1").value;
        	this.email = document.getElementById("Email1").value;

        	if (this.username != "" && this.password != "" && this.nombre != "" && this.apellidop != "" && this.apellidom != "" && this.empresa != "" && this.domicilio != "" && this.celular != "" && this.rfc != "" && this.email != "")
        	{
	        	let me=this;
	        	let post = {
				    nombre_usuario: this.username,
			        contrasena: this.password,
			        nombre: this.nombre,
			        apellido_paterno: this.apellidop,
			        apellido_materno: this.apellidom,
			        empresa: this.empresa,
			        rfc: this.rfc,
			        domicilio: this.domicilio,
			        telefono_local: this.telefono,
			        telefono_celular: this.celular,
			    	nextel: this.nextel,
			        email: this.email
				};
				axios.post(me.url, post).then((result) => {

		        		if (result.data.status) 
		        		{
		        			this.success = true;
		        			this.clearDatos();
		        			this.countDownTimer();
		        		}

		        });
        	}
        	else
        	{
        		this.validarCampos = true;
        	}

        },
    },
    mounted() {
        //
    }
}
</script>