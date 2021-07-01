<template>
     <div class="container">
         <div class="row justify-content-center">
             <div class="col-sm-6">
                 <form>
                     <div class="form-group row border-bottom">
                        <label for="title" class="col-sm-3 col-form-label">Title</label>
                        <input type="text" class="col-sm-9 form-control-plaintext" readonly id="title"
                                v-model="task.title">
                     </div>
                     <div class="form-group row border-bottom">
                         <label for="content" class="col-sm-3 col-form-label">Content</label>
                         <input type="text" class="col-sm-9 form-control-plaintext" readonly id="content"
                                v-model="task.content">
                    </div>
                     <div class="form-group row border-bottom">
                        <label for="person-in-charge" class="col-sm-3 col-form-label">Time Limit</label>
                         <input type="text" class="col-sm-9 form-control-plaintext" readonly id="person-in-charge"
                               v-model="task.time_limit">
                     </div>
                 
                 <div>
                     <button v-if="task.done == 0" class="btn btn-primary" v-on:click="completeTask(task.id) ">Complete</button>
                      <router-link v-bind:to="{name: 'task_edit',  params: {taskId:taskId}}">
                        <button class="btn btn-success">Edit</button>
                      </router-link>
                      <button class="btn btn-danger" v-on:click="deleteTask(task.id)">Delete</button>
                 </div>
                 </form>
             </div>
         </div>
     </div>
 </template>
 
 <script>
     export default {
         props: ['taskId'],
         data: function () {
             return {
                 task: {}
             }
         },
         methods:{
             getTask() {    
                 axios.get('/api/tasks/' + this.$route.params.taskId)
                 .then((res) => {
                     this.task = res.data;
                     console.log(res); 
                 });
                },       
            deleteTask(id) {
                 axios.delete('/api/tasks/'+ id)
                  .then((res) => {
                    this.getTask();     
                    console.log(res);                    
                     });
                    this.$router.push({name:'Home'});
                 },
             completeTask(id) {
                this.task.done = 1;                
                 axios.put('/api/tasks/'+this.taskId,this.task)
                 .then((res) => {
                     console.log(res);
                 })
                 .catch(function (error) {
                    if (error.response) {
                    console.log(error.response.data);
                    console.log(error.response.status);
                    console.log(error.response.headers);
                    } 
                    else if (error.request) {
                    console.log(error.request);
                    } 
                    else {
                        console.log('Error', error.message);
                    }
                    console.log(error.config);
                    });  
                    this.$router.push({name:'Home'});
             }
         },
             mounted() {
                 this.getTask();
             }
         }    
     
 </script>