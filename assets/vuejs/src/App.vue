<template>
  <div id="app">
    <div class="container">
      <div class="col">
        <h1 class="text-center"><router-link :to="{name: 'home'}">Jeux de role</router-link></h1>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col">
          <router-view></router-view>
        </div>
      </div>
    </div>
  </div>
</template>

<script>


export default {
  name: 'app',
  components: {
  },
  data(){
    return {}
    }
}

</script>

<style lang="scss">
  @import '../node_modules/bootstrap/scss/bootstrap.scss';
</style>