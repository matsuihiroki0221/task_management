<template>
  <div class="container">
    <div class= "row justify-content-center">
        <h1>{{ sumcomment }}件のコメント</h1>
        <div class="media my-5">
          <div v-for="(comment, index) in comments" :key="index">
            <div></div>
            <div style = "border: solid 3px #00" class="">{{ comment.user_id}}</div>
            <div class= "media-body">
              <h5 class="mt-0"> コメント</h5>
              {{comment.comment_body}}
              <div>
                <button class="btn btn-primary" v-on:click="(comment.id) ">返信する</button>
                <button class="btn btn-danger" v-on:click="deletecomment(comment.id)">削除する</button>
              </div>
              <div class="media-body" v-for="(reply,index) in replies" :key="index">
                <div style = "border: solid 3px #00" class="">{{ reply.reply_user_id}}</div>
                <h5 class="mt-0">返信</h5>
                {{ reply.reply_body }}
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</template>

<script>
  export default {
    props:["taskId"],
    data: function () {
      return {
        commentnumber:'',
        comments:{},
        replies:{},
      }
    },
    methods:{
      getComment() {
        axios.get('/api/comments/' + this.taskId)
        .then((res) => {
          this.comments = res.data;
          console.log(res);
        })
      },
      getReplies() {
        axios.get('/api/replies/' + this.comment.id)
        .then((res) => {
          this.task = res.data;
          console.log(res);
        })
      },
      deletecomment(id) {
                axios.delete('/api/comments/'+ id)
                .then((res) => {
                    this.getTask();
                    console.log(res);
                    });
                    this.$router.go({path: this.$router.currentRoute.path, force:true})
                },
    },
    computed:{
      sumcomment() {
        return Object.keys(this.comments).length;
      }
    },
    mounted() {
      this.getComment();
    }
  }
</script>