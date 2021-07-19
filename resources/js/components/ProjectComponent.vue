<template>
    <div class="container">
        <h1>Project List</h1>
        <h2>{{ sort_key }}:{{ sort_asc ?'昇順 ':'降順' }}</h2>
        <table class="table table-hover">
            <thead class="thead-light">
            <tr>
                <th scope="col" style="width: 50%" @click="sortBy('content')" :class="addClass('title')">Title</th>
                <th scope="col" style="wedth: 25%" @click="sortBy('project_leader')" :class="addClass('project_leader')">Project Leader</th>
                <th scope="col" style="width: 25%" @click="sortBy('time_limit')" :class="addClass('time_limit')">Time Limit</th>
            </tr>
            </thead>
            <tbody>
                    <router-link v-bind:to="`projectdetail/${ project.id } /taskforproject`" v-for="(project, index) in sort_projects" :key="index" tag="tr">
                    <td>{{ project.title }}</td>
                    <td>{{ project.project_leader }}</td>
                    <td>{{ project.time_limit }}</td>
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
        data: function () {
            return {
                projects: [],
                sort_key: "",
                sort_asc: true,
            }
        },
        methods: {
            sortBy(key) {
                this.sort_key === key
                    ? (this.sort_asc = !this.sort_asc)
                    :(this.sort_asc = true);
                    this.sort_key = key;
            },
            addClass(key) {
                return {
                    asc:this.sort_key === key && this.sort_asc,
                    desc: this.sort_key === key && !this.sort_asc,
                };
            },
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
        computed: {
            sort_projects() {
                if (this.sort_key != "") {
                    let set = 1 ;
                    this.sort_asc ? (set = 1) : (set = -1);
                        this.projects.sort((a,b) => {
                            if (a[this.sort_key] < b[this.sort_key]) return -1 * set;
                            if (a[this.sort_key] > b[this.sort_key]) return 1 * set;
                            return 0;
                        });
                        return this.projects;
                }else {
                    return this.projects;
                }
            },

        },
        mounted() {
            this.getProjects();
        }
    }
</script>