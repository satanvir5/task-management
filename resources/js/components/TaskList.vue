<template>
    <div>
      <h1 class="text-center">Task List</h1>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Description</th>
            <th>Deadline</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="task in tasks" :key="task.id">
            <td>{{ task.id }}</td>
            <td>{{ task.title }}</td>
            <td>{{ task.description }}</td>
            <td>{{ task.deadline }}</td>
            <td>
              <!-- Implement the actions buttons -->
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>

  <script>
  import axios from 'axios';

  export default {
    data() {
      return {
        tasks: [],
      };
    },
    mounted() {
      this.fetchTasks();
    },
    methods: {
      fetchTasks() {
        axios.get('/api/tasks')
          .then(response => {
            this.tasks = response.data;
          })
          .catch(error => {
            console.error('Error fetching tasks:', error);
          });
      },
    },
  };
  </script>
