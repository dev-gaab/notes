@extends('welcome')

@section('title', 'Notas')

@section('content')
	<h3>Notas</h3>

	<div class="row">
		<div class="col-sm-12 col-md-4 mt-4">

			<hr style="border-color: grey; border-width: 1px">

			<form id="add-nota">

				<input type="hidden" name="nota-id" id="nota-id" value="n">

				<div class="form-group">
					<label for="nombre">Nombre</label>
					<input 
						id="nombre" 
						type="text" 
						name="nombre" 
						class="form-control" 
						placeholder="Ingrese nombre de la nota"
						required 
					>
				</div>

				<div class="form-group">
					<label for="descripcion">Descripción</label>
					<input 
						id="descripcion" 
						type="text" 
						name="descripcion" 
						class="form-control" 
						placeholder="Ingrese descripcion"
						required
					>
				</div>

				<div class="form-group">
					<label for="descripcion">Fecha</label>
					<input 
						id="fecha" 
						type="date" 
						name="fecha" 
						class="form-control" 
						required
					>
				</div>

				<button type="submit" class="btn btn-primary">Guardar</button>
			</form>
		</div>

		<div class="col-md-8 mt-4">
			<div class="table-responsive">
			  <table class="table">
			    <thead>
			        <tr>
			          <th scope="col">Nombre</th>
			          <th scope="col">Descripcion</th>
			          <th scope="col">Fecha</th>
			          <th scope="col">Acciones</th>
			        </tr>
			    </thead>
			    <tbody id="body-table">
			    
			    </tbody>
			  </table>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function() {
			listNotas();

		 	$('#add-nota').on('submit', function (e) {
		 		e.preventDefault();

		 		var id = $('#nota-id').val();

		 		if(id == 'n') {
		 			addNota();
		 		} else {
		 			editNota();
		 		}
		 	}); 
		});

		function listNotas() {
			$.ajax({
				url: '/notas/all',
				success: function (res) {
					var rows = [];

					if (res.notas.length > 1) {

						res.notas.forEach(function(nota) {
							if(nota.is_active == true) {
								rows.push(`
									<tr>
										<td>${nota.nombre}</td>
										<td>${nota.descripcion}</td>
										<td>${nota.fecha}</td>
										<td>
											<button 
												class="btn btn-warning btn-sm" 
												onclick="findNotaEdit(${nota.id})"
											>
												<i class="material-icons">edit</i>
											</button>
											<button 
												class="btn btn-danger btn-sm" 
												onclick="deleteNota(${nota.id})"
											>
												<i class="material-icons">delete</i>
											</button>
										</td>
									</tr>
									`);
							}
						});

						$('#body-table').html(rows);

					} else if (res.notas.length == 1) {

						if(res.notas[0].is_active == true){
							rows.push(`
								<tr>
									<td>${res.notas[0].nombre}</td>
									<td>${res.notas[0].descripcion}</td>
									<td>${res.notas[0].fecha}</td>
									<td>
										<button 
											class="btn btn-warning btn-sm" 
											onclick="findNotaEdit(${res.notas[0].id})"
										>
											<i class="material-icons">edit</i>
										</button>
										<button 
											class="btn btn-danger btn-sm" 
											onclick="deleteNota(${res.notas[0].id})"
										>
											<i class="material-icons">delete</i>
										</button>
									</td>
								</tr>
								`);
						}

						$('#body-table').html(rows);
					}
				},
				error: function(error) {
					console.log(error);
				}
			})
		}

		function addNota() {

			var data = {
				nombre: $('#nombre').val(),
				descripcion: $('#descripcion').val(),
				fecha: $('#fecha').val()
			};

			$.ajax({
				url: '/notas/new',
				type: 'POST',
				data: data,
				headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success: function (res) {
					listNotas();

					$('#nombre').val('');
					$('#descripcion').val('');
					$('#fecha').val('');

				},
				error: function(error) {
					console.log(error);
				}
			})
		}

		function editNota() {
			
			var data = {
				nombre: $('#nombre').val(),
				descripcion: $('#descripcion').val(),
				fecha: $('#fecha').val()
			};

			var id = $('#nota-id').val();

			$.ajax({
				url: `/notas/edit/${id}`,
				type: 'PUT',
				data: data,
				headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success: function (res) {
					listNotas();
					$('#nota-id').val('n');
					$('#nombre').val('');
					$('#descripcion').val('');
					$('#fecha').val('');

				},
				error: function(error) {
					console.log(error);
				}
			})
		}

		function deleteNota(id) {

			$.ajax({
				url: `/notas/delete/${id}`,
				type: 'PUT',
				headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success: function (res) {
					listNotas();
				},
				error: function(error) {
					console.log(error);
				}
			})
		}

		function findNotaEdit(id) {
			$.ajax({
				url: `/notas/find/${id}`,
				success: function (res) {
					$('#nota-id').val(res.nota.id);
					$('#nombre').val(res.nota.nombre);
					$('#descripcion').val(res.nota.descripcion);
					$('#fecha').val(res.nota.fecha);
				},
				error: function(error) {
					console.log(error);
				}
			})
		}
	</script>
@endsection