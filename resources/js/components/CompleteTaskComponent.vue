<template>
    <div class="container">
        <h1>完了済タスク</h1>
        <h2>{{sort_key}}: {{ sort_asc ? '昇順' : '降順' }} </h2>
        <table class="table table-hover">
            <thead class="thead-light">
            <tr>
                <th scope="col" style="width: 20%" @click="sortBy('title')" :class="addClass('title')">タイトル</th>
                <th scope="col" style="width: 50%" @click="sortBy('content')" :class="addClass('content')">内容</th>
                <th scope="col" style="width: 15%" @click="sortBy('importance')" :class="addClass('importance')">重要度</th>
                <th scope="col" style="width: 15%" @click="sortBy('time_limit')" :class="addClass('time_limit')">期日</th>
            </tr>
            </thead>
            <tbody>
                <router-link v-bind:to="`taskdetail/${ task.id } /comment`" v-for="(task,index) in sort_tasks" :key="index" tag="tr">
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
</style>
<script>
    export default {
        props: {
        },
        data:function (){
            return {
                tasks:[],
                sort_key: "",
                sort_asc: true,
            }
        },
        methods: {
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
                axios.get('/api/completes/' + this.$store.state.user.id).then((res) => {
                    this.tasks = res.data;
                    console.log(res)
                })
                .catch((err) => {
                    console.log(err)
                });
            }
        },
        computed: {
            sort_tasks() {
                if (this.sort_key != "") {
                    let set = 1 ;
                    let desiredSort = ["小", "中", "大"];
                    this.sort_asc ? (set = 1) : (set = -1);
                        if (this.sort_key == "importance") {
                            this.tasks.sort((a,b) => {
                                console.log(this.tasks.importance);
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
        }
    }
</script>