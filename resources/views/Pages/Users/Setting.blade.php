@extends('Userlayout')

@section('title', 'Setting')

@section('contentUser')

<div class="container">
	<div class="col-12">
		<div class="card mb-3 w-100 p-5">
			<div class="mb-3 d-flex justify-content-between">
				<div class="form-check form-switch">
					<input class="form-check-input" type="checkbox" role="switch" id="notif">
					<label class="form-check-label" for="notif">Notification</label>
				</div>
			</div>
			<div class="mb-3 d-flex justify-content-between">
				<div class="form-check form-switch">
					<input class="form-check-input" type="checkbox" role="switch" id="lightmode">
					<label class="form-check-label" for="lightmode">Lighmode/DarkMode</label>
				</div>
			</div>
			<div class="mb-3 d-flex justify-content-between">
				<div class="form-check form-switch">
					<input class="form-check-input" type="checkbox" role="switch" id="access">
					<label class="form-check-label" for="access">Accessibility Mode</label>
				</div>
			</div>
			<div class="mb-3 d-flex justify-content-between">
				<select class="form-select form-select-lg mb-3" aria-label="Large select example">
					<option selected disabled hidden>Language</option>
					<option value="1">One</option>
					<option value="2">Two</option>
					<option value="3">Three</option>
				</select>
			</div>

		</div>
	</div>
</div>
@endsection