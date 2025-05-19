import axios from 'axios'
window.axios = axios
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

import Alpine from 'alpinejs'
import * as Livewire from '../../vendor/livewire/livewire/dist/livewire.esm'

window.Alpine = Alpine
window.Livewire = Livewire

Livewire.start()
Alpine.start()
