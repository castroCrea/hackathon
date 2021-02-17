<template>
  <div>
    <div class="container my-5">
      <div class="row">
        <div class="col align-baseline">
          <h2>{{ game.title }}</h2>
        </div>
        <div class="col mr-auto align-baseline">
          <a href="#" class="btn btn-success mx-2">Commencer !</a>
              <router-link :to="{name: 'PlayerCreate', params: { gameId: game.id }}" class="btn btn-primary mx-2">Ajouter un joueur</router-link>
        </div>
      </div>
    </div>

    <div class="container my-5">
      <div class="row col">
        <h2>Liste des joueurs</h2>
      </div>
    </div>
  </div>
</template>

<script>

    export default {
        name: "GameDescription",
        data(){
            return {
                game: {
                    title: ''
                }
            }
        },
        created() {
          this.getGame()
        },
        methods: {
            getGame() {
                this.axios.get(`http://localhost:8000/api/games/${this.$route.params.gameId}`, this.user)
                .then((response) => {
                    this.game = response.data
                })
            }
        }
    }
</script>

<style scoped>

</style>