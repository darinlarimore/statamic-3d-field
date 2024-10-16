<script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.5.0/model-viewer.min.js"></script>

<model-viewer
	class="{{ $class }}"
	style="background-color: {{ $data['backgroundColor'] }}"
	src="{{ $data['threeDFile']['url'] }}"
	alt="{{ $data['threeDFile']['alt'] }}"

	{{-- exposure --}}
	@if ($data['exposure'])
		exposure="{{ $data['exposure'] }}"
	@endif

	@if ($data['skyBoxImage']['url'])
		skybox-image="{{ $data['skyBoxImage']['url'] }}"
	@endif

	@if ($data['posterImage']['url'])
		poster="{{ $data['posterImage']['url'] }}"
	@endif

	@if ($data['autoRotate'])
		auto-rotate="{{ $data['autoRotate'] }}"
		rotation-per-second="{{ $data['rotationPerSecond'] }} rad"
	@endif

	@if ($data['cameraControls'])
		camera-controls
	@endif

	@if ($data['usdzFile']['url'])
		ios-src="{{ $data['usdzFile']['url'] }}"
		ar
	@endif
>
</model-viewer>
