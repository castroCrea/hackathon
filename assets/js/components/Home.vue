<template>
  <div id="app">
    <div class="container">
      <div class="row">
        <div class="col">
          <router-link to="/create-game" class="btn btn-primary">Nouvelle partie</router-link>
        </div>

      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col">
          <ul>
            <li v-for="game in games">{{game.title}}</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>


export default {
  name: 'home',
  components: {
  },
  data(){
    return {
        games: []
    }
  },
  mounted() {
      this.getGame()
  },
  methods: {
      getGame(e) {
          this.axios.get('http://localhost:8000/api/games')
          .then((response) => {
              this.games = response.data['hydra:member'];
          })
      }
  }
}

</script>