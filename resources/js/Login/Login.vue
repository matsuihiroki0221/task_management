<template>
    <form v-on:submit.prevent="doLogin">
      <label>User ID</label>
      <input type=" text" placeholder="your id" v-model="user.Id" >
      <label>Password</label>
      <input type="password" placeholder="password" v-model="user.password">
      <button type="submit"> Sign In</button>
    </form>
</template>
<script>
export default({
  data() {
    return {
      user: {}
    };
  },
    methods: {
      doLogin() {
        this.$store.dispatch("auth", {
          userId: this.user.userId,
          userToken: 'dummy token'
        });
        this.$router,push(this.$route.query.redirect);
      }
    }
  })
</script>
