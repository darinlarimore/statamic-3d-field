<script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.5.0/model-viewer.min.js"></script>

<div style="position: relative;">
	<model-viewer
		class="{{ $class }}"
		style="background-color: {{ $data['backgroundColor'] }}"
		src="{{ $data['threeDFile']['url'] }}"
		alt="{{ $data['threeDFile']['alt'] }}"
		touch-action="pan-y"
		disable-zoom

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

		@if ($data['usdzFile']['url'])
			ios-src="{{ $data['usdzFile']['url'] }}"
			ar
		@endif
	>
	</model-viewer>

	@if ($data['cameraControls'])
		<button
			type="button"
			aria-pressed="false"
			data-threed-toggle
			style="position: absolute; bottom: 1rem; left: 1rem; display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; border: 1px solid rgba(255, 255, 255, 0.4); border-radius: 9999px; background: rgba(0, 0, 0, 0.55); color: #fff; font-size: 0.875rem; line-height: 1.25rem; cursor: pointer; backdrop-filter: blur(4px);"
		>
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
				<path d="M21 12.79A9 9 0 1 1 11.21 3"></path>
				<polyline points="21 3 21 9 15 9"></polyline>
			</svg>
			<span data-threed-label>Interact in 3D</span>
		</button>
		<script>
			(function () {
				var wrapper = document.currentScript.parentElement;
				var viewer = wrapper.querySelector('model-viewer');
				var toggle = wrapper.querySelector('[data-threed-toggle]');
				var label = toggle.querySelector('[data-threed-label]');

				toggle.addEventListener('click', function () {
					var interactionEnabled = viewer.hasAttribute('camera-controls');

					if (interactionEnabled) {
						viewer.removeAttribute('camera-controls');
					} else {
						viewer.setAttribute('camera-controls', '');
					}

					toggle.setAttribute('aria-pressed', String(!interactionEnabled));
					label.textContent = interactionEnabled ? 'Interact in 3D' : 'Done';
				});
			})();
		</script>
	@endif
</div>
