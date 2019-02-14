@extends('welcome')

@section('title', 'Login')

@section('content')
	<div class="row login">
		<div class="col-sm-6 align-self-center offset-3">
			<form id="login">
				<div class="form-group">
					<label for="email">Email</label>
					<input 
						id="email" 
						type="email" 
						name="email" 
						class="form-control" 
						placeholder="Ingrese email"
						required 
					>
				</div>

				<div class="form-group">
					<label for="password">Contraseña</label>
					<input 
						id="password" 
						type="password" 
						name="password" 
						class="form-control" 
						placeholder="Ingrese email"
						required
					>
				</div>

				<button type="submit" class="btn btn-primary">Entrar</button>
			</form>
		</div>
	</div>
@endsection