<template>
    <div class="container">
         <h1>Done Task List</h1>
         <table class="table table-hover">
             <thead class="thead-light">
             <tr>
                 <th scope="col" style="width: 10%">Title</th>
                 <th scope="col" style="width: 70%">Content</th>
                 <th scope="col" style="width: 20%">Time Limit</th>
            </tr>
             </thead>
             <tbody>             
               <tr v-for="(task,index) in tasks" :key="index">              
                   <td>{{  task.title }}</td>
                   <router-link v-bind:to="{ name: 'task_detail',params: {taskId:task.id}}">
                   <td>{{ task.content }}</td>
                    </router-link>
                   <td> {{ task.time_limit }}</td>                     
               
                </tr>
             </tbody>
         </table>
     </div>
 </template>
 
 <script>
     export default {
         props: {
             
         },
         data:function (){
             return {
                 tasks:[]
             }
         },
         methods: {
             getTasks() {
                 axios.get('/api/completes').then((res) => {
                     this.tasks = res.data;
                     console.log(res)
                 })
                 .catch((err) => {
                    console.log(err)
                 });
             }
         },
         mounted() {
             this.getTasks();
            
         }
     }
 </script>