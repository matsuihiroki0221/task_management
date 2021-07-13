<template>
    <div class="container">
        <div class="col-sm-6">
        <h2>Login</h2>
        <p class="mt-2 text-danger">{{ getUserMessage }}</p>
        <form @submit.prevent="login">
            <label><input v-model="email" placeholder="email"></label>
            <label><input v-model="pass" placeholder="password"></label>
            <br>
            <button type="submit">ログイン</button>
        </form>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            email: '',
            pass: '',
            error: false,
            getUserMessage: "",
            user:{}
        };
    },
    methods: {
        login() {
            axios.get('/sanctum/csrf-cookie')
                .then((res) => {
                    axios.post('/api/login', {
                        email: this.email,
                        password: this.pass,
                    })
                    .then((res) => {
                        if( res.data.status_code == 200 ) {
                            localStorage.setItem("auth", "ture");
                            axios.get('/api/user')
                            .then(res => {
                                this.user = res.data;
                                this.$store.commit('setuser' , this.user);
                                console.log(this.user)
                            })
                                .then(this.$router.push({ name: 'Home'}))
                        }
                        this.getUserMessage = 'ログインに失敗しました。'
                    })
                    .catch((err) => {
                        console.log(err);
                        this.getUserMessage = 'ログインに失敗しました。'
                    })
                })
                .catch((err) => {
                //
                })
        }
    }
};
</script>