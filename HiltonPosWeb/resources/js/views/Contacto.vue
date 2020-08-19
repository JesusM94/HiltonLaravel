<template>
	<main class="main">
		<br>
		<div class="d-flex justify-content-center">

			<div class="col-md-10">

				<h4 class="font-weight-bold modal-title text-danger text-center">MAPA</h4>
				<img src="img/@imagenes/ph_mapa.jpg" class="img-fluid rounded mx-auto d-block" alt="Responsive image" width="500" height="500">
				
				<div class="modal-body justify-content-center">
					<p class="text-center font-weight-bold" style="color:#0d47a1;">
						Avenida 22 de Julio #2306 Colonia Hidalgo, Tijuana, B.C.<br>

						Tel:(664)379-1105 Nxtl: 152*142264*1
					</p>
				</div>

				<h4 class="font-weight-bold modal-title text-danger text-center">Forma de Contacto.</h4>

				<div class="d-flex justify-content-center ">
					<div class="modal-body justify-content-center col-md-8 border border-danger rounded">

						<div class="alert alert-success text-center" role="alert" v-show="success">
							Gracias por sus comentarios, serán leídos a la brevedad.
						</div>

						<h6 class="modal-title text-center text-danger" v-show="validarCampos">
							*Los campos marcados son obligatorios.
						</h6>
						<br>

						<div class="form-group">
							<label for="exampleInputEmail1">*Nombre:</label>
							<input type="text" name="nombre" class="form-control" id="Name1" placeholder="Enter name" required>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">E-mail:</label>
							<input type="email" name="correo" class="form-control" id="Email1" aria-describedby="emailHelp" placeholder="name@example.com" required>
						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">*Comentarios:</label>
							<textarea class="form-control" id="Comentario1" rows="3" required>
							</textarea>
						</div>
						<button class="btn btn-primary" type="submit" @click="guardarComentario(1)">Enviar</button>
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
                
            url: 'ContactoHilton',
            nombre:'',
            email:'',
            comentario:'',
            
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
        guardarComentario(nuevo)
        {
        	this.validarCampos = false;
        	this.success = false;

        	this.nombre = document.getElementById("Name1").value;
        	this.email = document.getElementById("Email1").value;
        	this.comentario = document.getElementById("Comentario1").value;

        	if (this.nombre != "" && this.comentario != "")
        	{
        		if (this.email == '') 
	        	{
	        		this.email = 'name@example.com';
	        	}

	        	let me=this;
	        	let post = {
				    nombre: this.nombre,
				    email: this.email,
				    comentario: this.comentario,
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