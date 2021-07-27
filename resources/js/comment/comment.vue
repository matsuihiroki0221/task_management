<template>
  <div class="container">
    <div class= "row justify-content-center">
        <div class="col-sm-9">
          <!-- コメント表示 -->
          <h1>{{ sumcomment }}件のコメント</h1>
          <div v-for="(comment, index) in comments" :key="index" v-on:click="getReplies(comment)">
            <div v-on:click="turnOn(comment)">
              <div style = "" class="">{{ comment.name}}さん</div>
                <h5 class="">{{comment.comment_body}}</h5>
            </div>
                <div>
                  <!-- コメント返信 -->
                  <button v-on:click="active(comment)" style="width:40px;height:20px ;font-size: 12px">返信</button>
                  <button v-on:click.prevent="deletecomment(comment.commentid)" style="width:40px;height:20px ;font-size: 12px">削除</button>
                  <div v-if="isActive && comment.commentid == targetIdforcomment">
                    <form v-on:submit.prevent="createreply(comment)">
                      <input type="text" class="col-sm-9 form-control" id="content" placeholder="コメントを入力してください" v-model="addreply.reply_body">
                      <button v-if="addreply.reply_body" type="submit" class="btn btn-primary">送信</button>
                    </form>
                  </div>
                </div>
                <!-- reply表示 -->
                <div v-if="comment.commentid == targetId && isActiveforreply">
                  <div class="mx-5">返信一覧</div>
                  <div class="mx-5" v-for="(reply,index) in replies" :key="index" style="">
                    <div style = "" class="">{{ reply.name}}さん</div>
                    <h5 class="">{{ reply.reply_body }}</h5>
                      <div>
                        <button v-on:click.prevent="deletereply(reply.replyid)" style="width:40px;height:20px ;font-size: 12px">削除</button>
                      </div>
                      <!-- reply for reply -->
                      <div>
                      </div>
                  </div>
                </div>
            <hr>
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
        isActive: false,
        addreply: {
          reply_body:"",
          reply_user_id:this.$store.state.user.id,
          reply_comment_parent:"",
        },
        targetId:"",
        targetIdforcomment:"",
        isActiveforreply:false,
      }
    },
    methods:{
      turnOn(comment) {
        this.targetId = comment.commentid;
      },
      getComment() {
        axios.get('/api/comments/' + this.taskId)
        .then((res) => {
          this.comments = res.data;
          console.log(res);
        })
      },
      getReplies(comment) {
        axios.get('/api/reply/' + comment.commentid)
        .then((res) => {
          this.replies = res.data;
          this.isActiveforreply = !this.isActiveforreply;
          console.log(res);
        })
        .catch((err) => {
            console.log(err);
          })
      },
      deletecomment(id) {
          axios.delete('/api/comments/delete/'+ id)
          .then((res) => {
           /* this.getTask(); */
          console.log(res);
          this.$router.go({path: this.$router.currentRoute.path, force:true})
          })
          .catch((err) => {
          console.log(err);
          });
          },
      deletereply(id) {
        axios.delete('/api/reply/'+ id)
          .then((res) => {
           /* this.getTask(); */
          console.log(res);
          this.$router.go({path: this.$router.currentRoute.path, force:true})
          })
          .catch((err) => {
          console.log(err);
          });
      },
      active(comment) {
        this.isActive = !this.isActive;
        this.targetIdforcomment = comment.commentid;
      },
      createreply(comment) {
          console.log(comment);
          /* this.addreply.reply_user_id = this.$store.state.user.id; */
          this.addreply.reply_comment_parent = comment.commentid;
          console.log(this.addreply);
          axios.post('/api/reply/store',this.addreply)
          .then((res) => {
            console.log(res.data);
          this.$router.go({path: this.$router.currentRoute.path, force:true});
          })
          .catch((err) => {
          console.log(err);
          });
      }
    },
    computed:{
      sumcomment() {
        return Object.keys(this.comments).length;
      },
    },
    mounted() {
      this.getComment();
    }
  }
</script>