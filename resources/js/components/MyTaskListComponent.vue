<template>
    <div class="container">
        <h1>タスク一覧</h1>
        <h2>{{sort_key}}: {{ sort_asc ? '昇順' : '降順' }} </h2>
        <table class="table table-hover">
            <thead class="thead-light">
            <tr>
                <th scope="col" style="width: 20%" @click="sortBy('title')" :class="addClass('title') ">タイトル</th>
                <th scope="col" style="width: 50%" @click="sortBy('content')" :class="addClass('content')">内容</th>
                <th scope="col" style="width: 15%" @click="sortBy('importance')" :class="addClass('importance')">重要度</th>
                <th scope="col" style="width: 15%" @click="sortBy('time_limit')" :class="addClass('time_limit')">期日</th>
            </tr>
            </thead>
            <tbody>
                <router-link v-bind:to="{name: 'comment',params: {taskId:task.id}}" v-for="(task,index) in sort_tasks" :key="index"  v-bind:class="yellowcolor(task.time_limit)" tag="tr">
                    <td>{{  task.title }}</td>
                    <td>{{ task.content }}</td>
                    <td>{{ task.importance }}</td>
                    <td> {{ task.time_limit }}</td>
                </router-link>
            </tbody>
        </table>
    </div>
</template>
<style scoped>
    .asc::after {
        content:"↓";
    }
    .desc::after {
        content:"↑";
    }
    .bg-color {
        background-color: yellow;
    }
</style>
<script>
    export default {
        props: {},
        data:function (){
            return {
                tasks:[],
                sort_key: "",
                sort_asc: true,
                isBackground_color: false,
                today: "",
            }
        },
        methods: {
            yellowcolor(timelimit) {
                let newtimelimit = new Date(timelimit);
                if((newtimelimit- this.today)/86400000  < 7) {
                    return "bg-color";
                }
            },
            sortBy(key) {
                this.sort_key === key
                    ? (this.sort_asc = !this.sort_asc)
                    : (this.sort_asc = true);
                    this.sort_key = key;
            },
            addClass(key) {
                return {
                    asc:this.sort_key === key && this.sort_asc,
                    desc: this.sort_key === key && !this.sort_asc,
                };
            },
            getTasks() {
                axios.get('/api/tasks/list/' + this.$store.state.user.id)
                .then((res) => {
                    this.tasks = res.data;
                    console.log(res);
                    this.today = new Date();
                    /* console.log(this.today);
                    console.log(this.tasks); */
                    let Tasklist = this.tasks;
                    for (let Task of Tasklist) {
                        /*console.log(Task); */
                        let tasklimit = new Date(Task.time_limit);
                        /*console.log(tasklimit);*/
                        let daysleft = (tasklimit - this.today)/86400000;
                            if(daysleft < 7 ){
                            alert(`${Task.title}の期限が一週間を切っています`);
                            console.log(daysleft);
                            };
                };
                }
                )
                .catch((err) => {
                    console.log(err)
                });
            }
        },
        computed: {
            sort_tasks() {
                if (this.sort_key != "") {
                    let set = 1 ;
                    let desiredSort = ["小", "中","大"];
                    let importance = "importance"
                    this.sort_asc ? (set = 1) : (set = -1);
                        if (this.sort_key == importance) {
                            this.tasks.sort((a,b) => {
                                /* console.log(this.tasks.importance); */
                                if (desiredSort.indexOf(a[this.sort_key]) < desiredSort.indexOf(b[this.sort_key])) return -1 * set;
                                if (desiredSort.indexOf(a[this.sort_key]) > desiredSort.indexOf(b[this.sort_key])) return 1 * set;
                                return 0;
                            });
                            /* console.log(this.sort_key);
                            console.log(this.tasks) */
                            return this.tasks;
                        }else{
                        this.tasks.sort((a,b) => {
                            if (a[this.sort_key] < b[this.sort_key]) return -1 * set;
                            if (a[this.sort_key] > b[this.sort_key]) return 1 * set;
                            return 0;
                        });
                        return this.tasks;
                    }
                }else {
                    return this.tasks;
                }
            },
        },
        mounted() {
                this.getTasks();
                /* this.getUser(); */
        }
    }
</script>