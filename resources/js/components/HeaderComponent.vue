<template>
    <div class="container-fluid bg-dark mb-3">
        <div class="container">
            <nav class="navbar navbar-dark">
                <router-link v-bind:to="{name: 'Home'}">
                    <span class="navbar-brand mb-0 h1">Your Task Management</span>
                </router-link>
                <div>
                    <router-link v-bind:to="{name: 'task_create'}">
                        <button class="btn btn-success"> Task Add</button>
                    </router-link>
                    <router-link v-bind:to="{name: 'project_create'}">
                        <button class="btn btn-success">Project ADD</button>
                    </router-link>
                    <router-link v-bind:to="{name: 'about'}">
                        <button class="btn btn-info">ログオフ</button>
                    </router-link>
                </div>
            </nav>
        </div>
    </div>
</template>

<script>
    export default {}
</script>