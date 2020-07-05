require('./bootstrap');
$(document).ready(function(){
  $('.navbar-nav-toggler').click(function(){
    let target = $(this).data('target')
    $(target).addClass('active')
  })
})

import Vue from 'vue'
import Toasted from 'vue-toasted'
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

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

const app = new Vue({
  el: '#app'
})