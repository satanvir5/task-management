<template>
    <div>
      <h1>Create Task</h1>
      <form @submit.prevent="submitForm">
        <div>
          <label for="title">Title:</label>
          <input type="text" id="title" v-model="form.title">
        </div>
        <div>
          <label for="description">Description:</label>
          <textarea id="description" v-model="form.description"></textarea>
        </div>
        <div>
          <label for="deadline">Deadline:</label>
          <input type="datetime-local" id="deadline" v-model="form.deadline">
        </div>
        <button type="submit">Create</button>
      </form>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        form: {
          title: '',
          description: '',
          deadline: '',
        },
      };
    },
    methods: {
      submitForm() {
        // Send an HTTP request to the server to store the task
        // You can use Axios or any other library for making the request
        axios.post('/tasks', this.form)
          .then(response => {
            // Handle the response, e.g., show success message or redirect
            console.log('Task created successfully!');
          })
          .catch(error => {
            // Handle the error, e.g., display validation errors
            console.error('Failed to create task:', error);
          });
      },
    },
  };
  </script>
