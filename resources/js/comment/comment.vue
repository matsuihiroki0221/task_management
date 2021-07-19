<template>
  <div class="container">
    <div class= "row justify-content-center">
      <div class="col-sm-6">
        <h1>{{ commentnumber }}件のコメント</h1>

      </div>
    </div>
  </div>
</template>

<script>
  export default {
    /* props:[taskId], */
    data: function () {
      return {
        commentnumber:0,
      　comment:{},
        replies:{}
      }
    },
    methods:{

    },
    computed:{},
    mounted() {
    }
  }
</script>