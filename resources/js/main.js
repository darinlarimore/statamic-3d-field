import '../css/main.css'
import Fieldtype from './components/ThreeDModel.vue'
import '@google/model-viewer'

Statamic.booting(() => {
	Statamic.$components.register('3d_model-fieldtype', Fieldtype)
})
