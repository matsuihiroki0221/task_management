<template>
  <div class="container">
      <div class="ruw justify-content-center">
        <h1>All Task List</h1>
        <ul class="list-group">
          <li v-for="task in tasks" :key="task.id">
            <router-link v-bind:to="`taskdetail/${ task.id } /comment`">
            {{task.title}}-{{task.time_limit}}-{{task.importance}}-{{task.name}}
            </router-link>
          </li>
        </ul>
    </div>
  </div>
</template>

<script>
export default {
  props:["projectId"],
  data: function () {
    return {
      tasks:{}
    }
  },
  methods: {
    getTasks() {
      axios.get('/api/tasks/allforproject/' + this.projectId)
      .then((res) => {
        this.tasks = res.data;
        /* this.tasks.user_name= ""; */
        console.log(res);
      })
      .catch((err) => {
        console.log(err)
      });
    }
  },
  mounted() {
    this.getTasks();
  },
}
</script>