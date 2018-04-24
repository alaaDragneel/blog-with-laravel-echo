window.Vue = require('vue');

require('./bootstrap.js')


 window.Event = new class {

     constructor() {
         this.vue = new Vue();
     }


     fire (event, data = null) {
         this.vue.$emit(event, data);
     }


     listen (event, callback) {
         this.vue.$on(event, callback);
     }

 }

window.flash =  (message, level = 'success') => {
    Event.fire('flash', { message, level });
};

Vue.component('posts-component', require('./components/AllPosts.vue'));
Vue.component('comments-section', require('./components/CommentsSection.vue'));
Vue.component('search-form', require('./components/SearchForm.vue'));
Vue.component('flash', require('./components/Flash.vue'));

const app = new Vue({
    el: '#app'
});
