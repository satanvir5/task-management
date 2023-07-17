<template>
    <div>
      <h1>Register</h1>
      <form @submit.prevent="registerUser">
        <div>
          <label for="name">Name:</label>
          <input type="text" id="name" v-model="form.name" required>
        </div>
        <div>
          <label for="email">Email:</label>
          <input type="email" id="email" v-model="form.email" required>
        </div>
        <div>
          <label for="password">Password:</label>
          <input type="password" id="password" v-model="form.password" required>
        </div>
        <div>
          <label for="password_confirmation">Confirm Password:</label>
          <input type="password" id="password_confirmation" v-model="form.password_confirmation" required>
        </div>
        <button type="submit">Register</button>
      </form>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        form: {
          name: '',
          email: '',
          password: '',
          password_confirmation: '',
        },
      };
    },
    methods: {
      registerUser() {
        axios.post('/register', this.form)
          .then(response => {
            console.log('Registration successful!');
            // Redirect to the desired page or show a success message
          })
          .catch(error => {
            console.error('Registration failed:', error.response.data);
            // Handle registration errors, e.g., display error messages
          });
      },
    },
  };
  </script>
