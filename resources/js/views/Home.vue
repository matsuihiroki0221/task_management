<template>
<div class="container-fluid">
  <div class="row">
    <div class=" overflow-auto col-md-6" style="height:400px ;" >
      <my-task-list-component></my-task-list-component>
    </div>
    <div class="  col-md-6 col-lg-6" style="height:400px;">
      <div class="overflow-auto">
        <project-component></project-component>
      </div>
      <div class="overflow-auto">
        <complete-task-component></complete-task-component>
      </div>
    </div>
  </div>
</div>

</template>

<script>
export default {
  props:{
    userId: String
  }

}
</script>


