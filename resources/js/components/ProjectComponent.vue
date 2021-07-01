<template>
    <div class="container">
         <h1>Project List</h1>
         <table class="table table-hover">
             <thead class="thead-light">
             <tr>
                <th scope="col" style="width: 50%">Content</th>
                <th scope="col" style="wedth: 25%">Project Leader</th>
                <th scope="col" style="width: 25%">Time Limit</th>
            </tr>
             </thead>
             <tbody>             
                <tr v-for="(project, index) in projects" :key="index">
                     <router-link v-bind:to="{ name: 'project_detail',params: {projectId:project.id}}">
                     <td>{{ project.content }}</td>
                    </router-link>
                    <td>{{ project.project_leader }}</td>
                    <td>{{ project.time_limit }}</td>

                </tr>
             </tbody>
         </table>
     </div>
 </template>
 
 <script>
     export default {
         data: function () {
             return {
                 projects: []
             }
         },
         methods: {
             getProjects() {
                 axios.get('/api/projects')
                 .then((res)=> {
                     this.projects = res.data;
                     console.log(res)
                 })
                 .catch((err) =>{
                    console.log(err);
                 });
             }
         },
         mounted() {
             this.getProjects();
         }
     }
 </script>