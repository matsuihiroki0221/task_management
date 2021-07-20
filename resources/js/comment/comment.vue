<template>
  <div class="container">
    <div class= "row justify-content-center">
      <div class="col-sm-6">
        <form v-on:submit.prevent="submit">
          <div class="form-group row">
            <label for="content" class="col-sm-3 col-form-label">Content</label>
            <input type="text" class="col-sm-9 form-control" id="content">
          </div>
        </form>
        <h1>{{ commentnumber }}件のコメント</h1>
        <div class="media my-5">
          <div v-for="(comment, index) in comments" :key="index">
            <div style = "border: solid 3px #00" class="">{{ comment.user_id}}</div>
            <div class= "media-body">
              <h5 class="mt-0"> コメント</h5>
              {{comment.comment_body}}
              <div class="media-body" v-for="(reply,index) in replies" :key="index">
                <div style = "border: solid 3px #00" class="">{{ reply.reply_user_id}}</div>
                <h5 class="mt-0">返信</h5>
                {{ reply.replu_body }}
              </div>
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
        commentnumber:0,
      　comments:{},
        replies:{}
      }
    },
    methods:{
      getComment() {
        axios.get('/api/comments/' +this.taskId)
        .then((res) => {
          this.comment = res.data;
          console.log(res);
        })
      },
      getReplies() {
        axios.get('/api/replies/' + this.comment.id)
        .then((res) => {
          this.task = res.data;
          console.log(res);
        })
      }
    },
    computed:{},
    mounted() {
    }
  }
</script>