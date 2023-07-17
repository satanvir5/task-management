
import Login from './components/Login.vue'
import Register from './components/Register.vue'
import TaskCreate from './components/TaskCreate.vue'
import TaskList from './components/TaskList.vue'




export const routes = [
  { path: '/login',name:'login', component: Login },
  { path: '/register',name:'Register', component: Register },
  { path: '/tasks/create', name:'TaskCreate',component: TaskCreate },
  {
    path: '/tasks',
    name: 'tasks',
    component: TaskList, // Replace TasksComponent with your actual component for the tasks page
  },
]
