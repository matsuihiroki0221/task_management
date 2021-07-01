<template>
    <div class="container">
         <h1>Every Task List</h1>
         <table class="table table-hover">
             <thead class="thead-light">
             <tr>
                 <th scope="col" style="width: 10%">重要度</th>
                 <th scope="col" style="width: 10%">User</th>
                 <th scope="col" style="width: 80%">Content</th>
                 <th scope="col" style="width: 15%">Time Limit</th>
            </tr>
             </thead>
             <tbody>             
                <tr>                
                    <td>大</td>
                    <td><router-link v-bind:to="{name: 'task_detail',params: {projectId:projectId, userId:1,taskId:1}}">Content1</router-link></td>
                    <td>2021/6/6</td>                 
                  
                </tr>              
             <tr>
                 <td>大</td>
                 <td>Content1</td>
                 <td>Ichiro</td>
             </tr>
             <tr>
                 <td>大</td>
                 <td>Content1</td>
                 <td>Ichiro</td>
             </tr>
             </tbody>
         </table>
     </div>
 </template>
 
 <script>
     export default {
         props: ["projectId"]
         
     };
 </script>