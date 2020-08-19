<template>
	<main class="main">
		<br>
		<div class="d-flex justify-content-center">

			<div class="col-md-8">

				<h4 class="font-weight-bold modal-title text-danger text-center">A la franja fronteriza</h4>
				
				<div class="modal-body justify-content-center">
					<p class="text-center">
						Los pedidos a la franja fronteriza se cotizan solamente a personas que cuentan con membresia (Socios) y no existe minimo de compra.
						Para enviar la mercancia, la compra minima es de 36 perfumes.
					</p>
				</div>

				<h4 class="font-weight-bold modal-title text-danger text-center">Al interior</h4>

				<div class="modal-body justify-content-center">
					<p class="text-center">
						Los pedidos al interior de la Republica se cotizan solamente a personas que cuentan con membresia (Socios) y deben de ser por un minimo de 36 perfumes.
						El motivo del minimo de compra es porque se debe realizar una importacion especial para el interior, la cual es mas cara que la importacion a la franja fronteriza.
					</p>
				</div>

				<h4 class="font-weight-bold modal-title text-danger text-center">
					Si tiene alguna duda contactenos por medio de la forma de
					<router-link class="nav-link" :to="{name: 'l-contacto'}">CONTACTO</router-link>
					y nosotros le responderemos a su correo electronico. Gracias.
				</h4>

				<div class="modal-body justify-content-center">
					<p class="text-center">
						Depósito a número de cuenta Banamex: 440-7536377.
						Transferencia electrónica a CLABE Banamex: 002028044075363776.
					</p>
				</div>

			</div>
		</div>
	</main>
</template>