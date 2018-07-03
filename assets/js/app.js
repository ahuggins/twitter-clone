import Vue from 'vue';
 
import Tweeter from './components/Tweeter'
import TweetList from './components/TweetList'
 
Vue.prototype.$eventBus = new Vue()

new Vue({
  el: '#app',
  components: {Tweeter, TweetList}
});