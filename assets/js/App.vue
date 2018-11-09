<template>
  <div id="app">
    <div class="container">
      <div class="col">
        <h1 class="text-center">Jeux de role</h1>
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
  },
  methods: {
    signIn(e) {
        console.log('toto');
        e.preventDefault();
    }
  }
}

</script>