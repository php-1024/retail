<template>
  <div id="app">
       <div class="page">
         <router-view/>
       </div>
  </div>
</template>

<script>
export default {
  name: 'App'
}
</script>

<style>
.page{
  overflow: auto;
}
</style>
