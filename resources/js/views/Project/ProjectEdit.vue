 <template>
     <div class="container">
         <div class="row justify-content-center">
             <div class="col-sm-6">
                <validation-observer ref="observer" v-slot="{ invalid }">
                    <form v-on:submit.prevent="submit">                       
                        <validation-provider name="title" rules="required" v-slot="{ errors }">
                            <div class="form-group row">
                                    <label for="title" class="col-sm-3 col-form-label">Title</label>
                                    <input type="text" class="col-sm-9 form-control" id="title" v-model="project.title">       
                                    <span class="text-danger">{{ errors[0] }}</span>
                            </div>
                        </validation-provider>
                        
                        <validation-provider name="content" rules="required" v-slot="{ errors }">
                            <div class="form-group row">
                                <label for="content" class="col-sm-3 col-form-label">Content</label>
                                <input type="text" class="col-sm-9 form-control" id="content" v-model="project.content">
                                <span class="text-danger">{{ errors[0] }}</span>
                            </div>
                        </validation-provider>
                        <validation-provider name="time_limit" rules="required" v-slot="{ errors }">
                            <div class="form-group row">
                                <label for="time_limit" class="col-sm-3 col-form-label">Time limit</label>
                                <input type="date" class="col-sm-9 form-control" id="time_limit" v-model="project.time_limit">
                                <span class="text-danger">{{ errors[0] }}</span>
                            </div>

                        </validation-provider>
                        <validation-provider name="userId" rules="required"  v-slot="{ errors }">                                  
                            <div class="form-group row">
                                <label for="project_leader" class="col-sm-3 col-form-label">Project Leader</label>
                                <input type="text" class="col-sm-9 form-control" id="project_leader" v-model="project.project_leader">
                                <span class="text-danger"> {{ errors[0] }}</span>
                            </div>
                        </validation-provider>
                        <button type="submit" class="btn btn-primary" :disabled="invalid">Submit</button>
                    </form>
                 </validation-observer>
             </div>
         </div>
     </div>
 </template>
 
 <script>
     export default {
         props: {
             projectId:String
         },
         data:function () {
             return {
                 project:{}
             }
         },
         methods: {
             getProject() {
                 axios.get('/api/projects/'+this.projectId)
                 .then((res)=> {
                     this.project = res.data;
                     console.log(res);
                 });
             },
             submit() {
                 axios.put('/api/projects/'+this.projectId,this.project)
                 .then((res) => {
                     console.log(res);
                     this.$router.push({name:'Home'})
                 })
                 .catch(function (error) {
                    console.log(error);
                    });
             }
         },
         mounted() {
             this.getProject();
         }
     }
 </script>
