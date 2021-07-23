<template>
    <div class="container">
        <div class="row justify-content-center">
                        <div class="col-sm-6">
                <validation-observer ref="observer" v-slot="{ invalid }">
                    <form v-on:submit.prevent="submit">
                        <validation-provider name="userId" rules="required|numeric"  v-slot="{ errors }">
                            <div class="form-group row">
                                <label for="id" class="col-sm-3 col-form-label">ID</label>
                                <input type="text" class="col-sm-9 form-control-plaintext" readonly id="id" v-model="task.user_id">
                                <span class="text-danger"> {{ errors[0] }}</span>
                            </div>
                        </validation-provider>
                        <validation-provider name="projectTitle" rules="required" v-slot="{ errors }">
                            <div class="form-group row">
                                <label for="projectTitle" class="col-sm-3 col-form-label">Project Title</label>
                                <select v-model="task.project_title" id="project_title" class="col-sm-9 form-control"  placeholder="プロジェクトを選択してください">
                                    <option v-for="(project,key) of projects" v-bind:key="key">{{ project.title }}</option>
                                </select>
                                <span class="text-danger">{{ errors[0] }}</span>
                            </div>
                        </validation-provider>
                        <validation-provider name="title" rules="required" v-slot="{ errors }">
                            <div class="form-group row">
                                    <label for="title" class="col-sm-3 col-form-label">Title</label>
                                    <input type="text" class="col-sm-9 form-control" id="title" v-model="task.title">
                                    <span class="text-danger">{{ errors[0] }}</span>
                            </div>
                        </validation-provider>
                        <validation-provider name="content" rules="required" v-slot="{ errors }">
                            <div class="form-group row">
                                <label for="content" class="col-sm-3 col-form-label">Content</label>
                                <input type="text" class="col-sm-9 form-control" id="content" v-model="task.content">
                                <span class="text-danger">{{ errors[0] }}</span>
                            </div>
                        </validation-provider>
                        <validation-provider name="time_limit" rules="required" v-slot="{ errors }">
                            <div class="form-group row">
                                <label for="time_limit" class="col-sm-3 col-form-label">Time limit</label>
                                <input type="date" class="col-sm-9 form-control" id="time_limit" v-model="task.time_limit">
                                <span class="text-danger">{{ errors[0] }}</span>
                            </div>

                        </validation-provider>
                        <validation-provider name="importance" rules="required" v-slot="{ errors }">
                            <div class="form-group row">
                                <label for="importance" class="col-sm-3 col-form-label">Importance</label>
                                <select v-model="task.importance" class="col-sm-9 form-control">
                                    <option>大</option>
                                    <option>中</option>
                                    <option>小</option>
                                </select>
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
            taskId:String
        },
        data:function () {
            return {
                task:{},
                projects:{}
            }
        },
        methods: {
            getTask() {
                axios.get('/api/tasks/'+this.taskId)
                .then((res)=> {
                    this.task = res.data;
                    console.log(res)
                });
            },
            getProjects() {
                    axios.get('/api/projects')
                    .then((res)=> {
                        this.projects = res.data;
                        console.log(res)
                    })
                    .catch((err) => {
                        console.log(err);
                    })
                },
            submit() {
                axios.put('/api/tasks/'+this.taskId,this.task)
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
            this.getTask();
            this.getProjects()
        }
    }
</script>