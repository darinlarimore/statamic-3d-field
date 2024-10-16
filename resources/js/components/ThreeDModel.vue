<template>
	<div>
		<div v-if="!data.threeDFile.url">
			<p class="d-text-sm">Upload a .glb file</p>
			<assets-fieldtype
			class="assets-fieldtype"
			:value="threeDFileId"
			ref="assets"
			handle="assets"
			:config="config"
			:readOnly="readOnly"
			@input="updateThreeDFile"
			></assets-fieldtype>
		</div>

		<!-- else display a clear button  -->
		<div v-else>
			<div class="d-flex d-my-4 d-justify-between d-items-center d-p-4">
				<p class="d-text-sm">Selected 3D Model:</p>
				<div class="d-flex d-items-center d-gap-2">
					<p class="d-text-sm">{{data.threeDFile.fileName}}</p>
					<button @click="threeDFileClear" class=""> ×
					</button>
				</div>
			</div>
		</div>
		<div v-if="data.threeDFile.error" class="d-text-red-500">{{ data.threeDFile.error }}</div>


		<div v-if="this.data.threeDFile.url">
			<!-- full width model viewer -->
			<model-viewer
				class="d-w-full d-h-96"
				:src="data.threeDFile.url"
				:alt="data.threeDFile.alt"
				:auto-rotate="data.autoRotate"
				:camera-controls="data.cameraControls"
				:ios-src="data.usdzFile.url"
				:rotation-per-second="data.rotationPerSecond+ 'rad'"
				:poster="data.posterImage.url"
				:ar="data.usdzFile.url ? true : false"
				:skybox-image="data.skyBoxImage.url"
				:exposure="data.exposure"
				:style="'background-color:' + data.backgroundColor"
			>
			</model-viewer>


			<button @click="showOptions = !showOptions" class="d-flex d-my-4 d-items-center">Configuration Options
				<svg :class="showOptions ? 'd-rotate-180' : '' " xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 20 20"><path fill="currentColor" d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path></svg>
			</button>

			<div v-if="showOptions" class="d-grid d-mt-6 d-gap-4">

				<!-- Background Color Option -->
				<div>
					<label for="backgroundColor">Background Color (Hex)</label>
					<div class="d-flex d-mt-2 d-gap-2 d-items-center">
						<input type="color" v-model="data.backgroundColor" />
						<input type="text" class="input-text d-w-32" v-model="data.backgroundColor" />
						<button @click="data.backgroundColor = ''" class=""> × </button>
					</div>
				</div>

				<!-- autorotate Option -->
				<div>
					<p class="text-sm">Enable or disable auto rotate</p>
					<div class="d-flex d-gap-4 d-items-center ">
						<toggle-input v-model="data.autoRotate"/>
						<label for="autoRotate">Auto Rotate</label>
					</div>
				</div>

				<!-- rotation per second slider Option oply open if autorotate -->
				<div v-if="data.autoRotate">
					<label for="rotationPerSecond">Rotation Per Second</label>
					<div class="d-flex d-gap-4 d-items-center">
						<input type="range" v-model="data.rotationPerSecond" min="-2" max="2" step="0.1" />
						{{ data.rotationPerSecond }}rad
					</div>
				</div>

				<!-- camera controls Option -->
				<div>
					<p class="text-sm">Enable or disable camera controls</p>
					<div class="d-flex d-gap-4 d-items-center">
						<toggle-input v-model="data.cameraControls" />
						<label for="cameraControls">Camera Controls</label>
					</div>
				</div>

				<!-- AR Option -->
				<div>
					<p class="text-sm">Upload a .usdz file to enable AR</p>
					<assets-fieldtype
						v-if="!data.usdzFile.url"
						class="assets-fieldtype"
						:value="usdzFileId"
						ref="assets"
						handle="assets"
						:config="config"
						:readOnly="readOnly"
						@input="updateUSDZ"
					></assets-fieldtype>
					<div v-else>
						<div class="d-flex d-justify-between d-items-center d-p-4">
							<p class="d-text-sm">Selected .usdz file:</p>
							<div class="d-flex d-items-center d-gap-2">
								<p class="d-text-sm">{{data.usdzFile.fileName}}</p>
								<button @click="usdzClear" class=""> ×
								</button>
							</div>
						</div>
					</div>
					<div v-if="this.data.usdzFile.error" class="d-text-red-500">{{ data.usdzFile.error }}</div>
				</div>

				<!-- exposure slider option -->
				<div>
					<label for="exposure">Exposure</label>
					<div class="d-mt-2 d-flex d-gap-4">
						<input type="range" v-model="data.exposure" min="0" max="10" step="0.1" />
						{{ data.exposure }}
					</div>
				</div>

				<!-- Poster Image Option -->
				<div class="d-flex d-gap-2 d-flex-col">
					<p class="d-text-sm">Poster Image</p>
					<assets-fieldtype
						v-if="!data.posterImage.url"
						class="assets-fieldtype"
						:value="posterImageId"
						ref="assets"
						handle="assets"
						:config="config"
						:readOnly="readOnly"
						@input="updatePosterImage"
					></assets-fieldtype>
					<div v-else>
						<div class="d-flex d-justify-between d-items-center d-p-4">
							<p class="d-text-sm">Selected poster image file:</p>
							<div class="d-flex d-items-center d-gap-2">
								<p class="d-text-sm">{{data.posterImage.fileName}}</p>
								<button @click="posterImageClear" class=""> ×
								</button>
							</div>
						</div>
					</div>
					<div v-if="this.data.posterImage.error" class="d-text-red-500">{{ data.posterImage.error }}</div>
				</div>

				<!-- Skybox Image Option -->
				<div class="d-flex d-gap-2 d-flex-col">
					<p class="d-text-sm">Skybox Image</p>
					<assets-fieldtype
						v-if="!data.skyBoxImage.url"
						class="assets-fieldtype"
						:value="skyBoxImageId"
						ref="assets"
						handle="assets"
						:config="config"
						:readOnly="readOnly"
						@input="updateSkyBoxImage"
					></assets-fieldtype>
					<div v-else>
						<div class="d-flex d-justify-between d-items-center d-p-4">
							<p class="d-text-sm">Selected skybox image file:</p>
							<div class="d-flex d-items-center d-gap-2">
								<p class="d-text-sm">{{data.skyBoxImage.fileName}}</p>
								<button @click="skyBoxImageClear" class=""> ×
								</button>
							</div>
						</div>
					</div>
					<div v-if="this.data.skyBoxImage.error" class="d-text-red-500">{{ data.skyBoxImage.error }}</div>
				</div>

			</div>
		</div>
	</div>
</template>

<script>
	export default {
		mixins: [Fieldtype],
		inject: ['storeName'],
		data() {
			return {
				showOptions: false,
				data: {
					exposure: this.value?.exposure || 1,
					autoRotate: this.value?.autoRotate || true,
					cameraControls: this.value?.cameraControls || true,
					rotationPerSecond: this.value?.rotationPerSecond || 0.25,
					backgroundColor: this.value?.backgroundColor || '',
					threeDFile: {
						url: this.value?.threeDFile.url || null,
						id: this.value?.threeDFile.id || null,
						fileName: this.value?.threeDFile.fileName || null,
						alt: this.value?.threeDFile.alt || null,
						error: this.value?.threeDFile.error || null,
					},
					usdzFile: {
						url: this.value?.usdzFile.url || null,
						id: this.value?.usdzFile.id || null,
						fileName: this.value?.usdzFile.fileName || null,
						alt: this.value?.usdzFile.alt || null,
						error: this.value?.usdzFile.error || null,
					},
					posterImage: {
						url: this.value?.posterImage.url || null,
						id: this.value?.posterImage.id || null,
						fileName: this.value?.posterImage.fileName || null,
						alt: this.value?.posterImage.alt || null,
						error: this.value?.posterImage.error || null,
					},
					skyBoxImage: {
						url: this.value?.skyBoxImage.url || null,
						id: this.value?.skyBoxImage.id || null,
						fileName: this.value?.skyBoxImage.fileName || null,
						alt: this.value?.skyBoxImage.alt || null,
						error: this.value?.skyBoxImage.error || null,
					},
				}
			};
		},

		mounted() {
			this.config.max_files = 1;
			this.config.min_files = 0;
			this.config.mode = 'list';
			// this.config.required = true;
			// this.config.validate = [
			// 	'mimes:glb,usdz'
			// ];
		},

		watch: {
			data: {
				deep: true,
				handler() {
					this.update(this.data);
				}
			}
		},

		computed: {
			threeDFileId() {
				return this.data.threeDFile.id ? [this.data.threeDFile.id] : [];
			},
			usdzFileId() {
				return this.data.usdzFile.id ? [this.data.usdzFile.id] : [];
			},
			posterImageId() {
				return this.data.posterImage.id ? [this.data.posterImage.id] : [];
			},
			skyBoxImageId() {
				return this.data.skyBoxImage.id ? [this.data.skyBoxImage.id] : [];
			},
		},
		methods: {
			updateThreeDFile(assets) {
				if (assets[0]) {
					this.getAsset(assets[0], 'threeDFile', ['glb']);
				}
			},

			updateUSDZ(assets) {
				if (assets[0]) {
					this.getAsset(assets[0], 'usdzFile', ['usdz']);
				}
			},

			updatePosterImage(assets) {
				if (assets[0]) {
					this.getAsset(assets[0], 'posterImage', ['jpg', 'jpeg', 'png']);
				}
			},

			updateSkyBoxImage(assets) {
				if (assets[0]) {
					this.getAsset(assets[0], 'skyBoxImage', ['jpg', 'jpeg', 'png']);
				}
			},

			threeDFileClear() {
				this.data.threeDFile = {
					url: null,
					id: null,
					fileName: null,
				};
			},

			usdzClear() {
				this.data.usdzFile = {
					url: null,
					id: null,
					fileName: null,
				};
			},

			posterImageClear() {
				this.data.posterImage = {
					url: null,
					id: null,
					fileName: null,
				};
			},

			skyBoxImageClear() {
				this.data.skyBoxImage = {
					url: null,
					id: null,
					fileName: null,
				};
			},

			getAsset(value, handle, fileTypes) {
				this.$axios
					.post(this.cpUrl("assets-fieldtype"), {
							assets:[ value ],
					})
					.then((response) => {
						if (fileTypes.includes(response.data[0].extension)) {
							this.data[handle] = {
								url: response.data[0].url,
								id: response.data[0].id,
								fileName: response.data[0].basename,
								alt: response.data[0].values.alt,
							};
						} else {
							this.data[handle] = {
								error: "Invalid file type",
							};
						}
					})
			},

			cpUrl(url) {
				url = Statamic.$config.get("cpUrl") + "/" + url;
				return url.replace(/([^:])(\/\/+)/g, "$1/");
			},
		}
	};
</script>

<style>
/* .asset-table-listing, .asset-grid-listing {
		display: none;
} */
</style>
