import './bootstrap';
import { createApp } from 'vue';
// import { Vue } from 'vue';
// import VueRouter from 'vue-router';
import { routes } from './routes';
import TaskCreate from './components/TaskCreate.vue';
import Login from './components/Login.vue';
import RegisterForm from './components/Register.vue';
import TaskList from './components/TaskList.vue';

// const router = VueRouter.createRouter({
//     // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
//     history: VueRouter.createWebHashHistory(),
//     routes, // short for `routes: routes`
//   })


  const router = new VueRouter({
    routes // short for `routes: routes`
  })

var app = createApp({

});


app.component('task-create', TaskCreate);
app.component('login', Login);
app.component('register-form', RegisterForm);
app.component('task-list', TaskList);

// app.use(router)

// app.mount('#app');


 app = new Vue({
    router
  }).$mount('#app')
