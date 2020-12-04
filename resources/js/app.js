require('./bootstrap');
import Vue from 'vue'
import Toasted from 'vue-toasted'
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'

Vue.use(Toasted, {
  position: 'top-right',
  type: 'default',
  icon: 'check',
  duration: 2500,
  action : {
    text : 'x',
    onClick : (e, toastObject) => {
      toastObject.goAway(0);
    }
  },
})

Vue.component('v-select', vSelect)

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.filter('twoDigits', function(value){
  return (value < 10) ? '0' + value : value
})

const app = new Vue({
  el: '#app'
})
