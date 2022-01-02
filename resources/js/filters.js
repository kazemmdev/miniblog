import Vue from "vue";
import moment from "moment";


Vue.filter('timeago', value => moment(value).fromNow())
Vue.filter('longdate', value => moment(value).format("MMMM Do YYYY"))
