<template>
<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div><h1>プロジェクト詳細</h1></div>
                <form>
                    <div class="form-group row border-bottom">
                        <label for="title" class="col-sm-3 col-form-label">タイトル</label>
                        <input type="text" class="col-sm-9 form-control-plaintext" readonly id="title"
                                v-model="project.title">
                    </div>
                    <div class="form-group row border-bottom">
                        <label for="content" class="col-sm-3 col-form-label">内容</label>
                        <input type="text" class="col-sm-9 form-control-plaintext" readonly id="content"
                                v-model="project.content">
                    </div>
                    <div class="form-group row border-bottom">
                        <label for="leader" class="col-sm-3 col-form-label">リーダー</label>
                        <input type="text" class="col-sm-9 form-control-plaintext" readonly id="leader"
                                v-model="project.project_leader">
                    </div>
                    <div class="form-group row border-bottom">
                        <label for="time-limit" class="col-sm-3 col-form-label">期日</label>
                        <input type="text" class="col-sm-9 form-control-plaintext" readonly id="time-limit"
                                v-model="project.time_limit">
                    </div>
                    <div>
                        <button v-if="project.done == 1" class="btn btn-primary" v-on:click="completeProject(project.id)">編集する</button>
                        <router-link v-bind:to="{name: 'project_edit',params:{projectId:projectId} }">
                            <button class="btn btn-success">修正する</button>
                        </router-link>
                        <button class="btn btn-danger" v-on:click="deleteProject(project.id)">削除する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <router-view></router-view>
            </div>
        </div>
    </div>
</div>

</template>

<script>
    export default {
        props: ["projectId"],
        data:function (){
            return {
                project: {}
            }
        },
        methods: {
            getProject() {
                axios.get('/api/projects/'+ this.$route.params.projectId)
                .then((res) => {
                    this.project = res.data;
                    console.log(res);
                    console.log(this.project);
                });
            },
            deleteProject(id) {
                axios.delete('/api/projects/'+ id)
                .then((res) => {
                    this.getProject();
                    console.log(res);
                });
                this.$router.push({name:'Home'});
            },
            completeProject(id) {
                this.project.done = 1;
                axios.put('/api/projects/+this.projectId,this.task')
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
            this.getProject();
        }
    }
</script>