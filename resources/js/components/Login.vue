<template>
    <div class="container">
      <h1>Login</h1>
      <form @submit.prevent="loginUser" class="login-form">
        <div class="form-group">
          <label for="email">Email:</label>
          <input class="form-control" type="email" id="email" v-model="form.email" required>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input class="form-control" type="password" id="password" v-model="form.password" required>
        </div>
        <button class="btn btn-primary mt-3" type="submit">Login</button>
      </form>
    </div>
  </template>



  <script>

import axios from 'axios';
import { routes } from '@/routes'; // Import Vue Router instance

// Vue.use(VueRouter);

  export default {
    data() {
      return {
        form: {
          email: '',
          password: '',
        },
      };
    },
    methods: {
      loginUser() {
        axios.post('/login', this.form)
          .then(response => {
            console.log('Login successful!');
            routes.push('/tasks');
            // Redirect to the desired page or show a success message
          })
          .catch(error => {
            console.error('Login failed:', error.response?.data);
            console.error('Login failed:', error);
            // Handle login errors, e.g., display error messages
          });
      },
    },
  };
  </script>
