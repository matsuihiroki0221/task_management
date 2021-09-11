<template>
    <div class="container">
        <div class="row justify-content-center" >
            <div class="col-sm-6">
                <validation-observer ref="observer" v-slot="{ invalid }">
                    <form v-on:submit.prevent="submit">
                        <validation-provider name="userId" rules="required|numeric"  v-slot="{ errors }">
                            <div class="form-group row" >
                                <label for="userId" class="col-sm-3 col-form-label">ユーザーId</label>
                                <input type="text" class="col-sm-9 form-control" id="userId" v-model="task.user_id" readonly>
                                <span class="text-danger">{{ errors[0] }}</span>
                            </div>
                        </validation-provider>
                        <validation-provider name="project_title" rules="required" v-slot="{ errors }">
                            <div class="form-group row" >
                                <label for="project_title" class="col-sm-3 col-form-label">プロジェクト<br>タイトル</label>
                                <select v-model="task.project_title" id="project_title" class="col-sm-9 form-control" >
                                    <option v-for="(project,key) of projects" v-bind:key="key">{{ project.title }}</option>
                                </select>
                                <p>{{ task.project_title }}</p>
                                <span class="text-danger">{{ errors[0] }}</span>
                            </div>
                        </validation-provider>
                        <validation-provider name="title" rules="required" v-slot="{ errors }">
                            <div class="form-group row">
                                <label for="title" class="col-sm-3 col-form-label">タイトル</label>
                                <input type="text" class="col-sm-9 form-control" id="title" v-model="task.title" placeholder="タスクのタイトルを入力">
                                <span class="text-danger">{{ errors[0] }}</span>
                            </div>
                        </validation-provider>
                        <validation-provider name="content" rules="required" v-slot="{ errors }">
                            <div class="form-group row">
                                <label for="content" class="col-sm-3 col-form-label">内容</label>
                                <input type="text" class="col-sm-9 form-control" id="content" v-model="task.content" placeholder="タスクの内容を入力">
                                <span class="text-danger">{{ errors[0] }}</span>
                            </div>
                        </validation-provider>
                        <validation-provider name="time_limit" rules="required" v-slot="{ errors }">
                            <div class="form-group row">
                                <label for="time_limit" class="col-sm-3 col-form-label">期日</label>
                                <input type="date" class="col-sm-9 form-control" id="time_limit" v-model="task.time_limit" placeholder="期限を選択してください">
                                <span class="text-danger">{{ errors[0] }}</span>
                            </div>
                        </validation-provider>
                        <validation-provider name="importance" rules="required" v-slot="{ errors }">
                            <div class="form-group row">
                                <label for="importance" class="col-sm-3 col-form-label">重要度</label>
                                <select v-model="task.importance" class="col-sm-9 form-control">
                                    <option>大</option>
                                    <option>中</option>
                                    <option>小</option>
                                </select>
                                <span class="text-danger"> {{ errors[0] }}</span>
                            </div>
                        </validation-provider>
                        <button type="submit" class="btn btn-primary" :disabled="invalid">タスク作成</button>
                    </form>
                </validation-observer>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data:function() {
            return {
                task: {
                    project_title:"",
                    project_id:"",
                    user_id:"",
                    title:"",
                    content: "",
                    time_limit:"",
                    importance: ""
                        },
                projects:{},
            }
            },
            methods:{
                getProjects() {
                    axios.get('/api/projects')
                    .then((res)=> {
                        this.projects = res.data;
                        this.task.user_id = this.$store.state.user.id;
                        console.log(res)
                    })
                    .catch((err) => {
                        console.log(err);
                    })
                },
                submit() {
                    let filtertask = this.task;
                    let targetproject = this.projects.find((v) => v.title == this.task.project_title);
                    console.log(targetproject);
                    this.task.project_id = targetproject.id;
                    console.log(this.task);
                    axios.post('/api/tasks/store',this.task)
                    .then((res)=> {
                        console.log(res);
                        this.$router.push({name:'Home'});
                    });
                }
            },
            mounted() {
                this.getProjects();
            }
    }
</script>