<template>
    <div>
        <p>名前: {{ user.name }}</p>
        <p>メールアドレス: {{ user.email }}</p>
        <button type="button" @click="logout">ログアウト</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: ""
        };
    },
    mounted() {
        axios.get("/api/user").then(response => {
            this.user = response.data;
        });
    },
    methods: {
        logout() {
            axios.post("api/logout")
                .then(response => {
                    console.log(response);
                    this.$store.commit('setuser' , {});
                    localStorage.removeItem("auth");
                    this.$router.push({ name: "login"});
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>