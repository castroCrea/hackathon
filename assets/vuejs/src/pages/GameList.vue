<template>
  <div id="app">
    <div class="container">
      <div class="row">
        <div class="col">
          <h2>Liste des parties</h2>
        </div>
        <div class="col ml-auto text-right">
          <router-link :to="{name: 'GameCreate'}" class="btn btn-primary">Nouvelle partie</router-link>
        </div>

      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Nom de la partie</th>
                <th scope="col">Informations</th>
                <th scope="col">Nombre de personages</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="game in games">
                <th class="align-middle" scope="row"><router-link :to="{name: 'GameDescription', params: { gameId: game.id }}">{{game.title}}</router-link></th>
                <td class="align-middle">{{game.description}}</td>
                <td class="align-middle">{{game.maxPlayer}}</td>
                <td><router-link :to="{name: 'PlayerCreate', params: { gameId: game.id }}" class="btn btn-outline-primary">Ajouter un personnage</router-link></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>


export default {
  name: 'GameList',
  components: {
  },
  data(){
    return {
        games: []
    }
  },
  created() {
      this.games = this.getGames()
  },
  methods: {
      getGames(e) {
          this.axios.get('http://localhost:8000/api/games')
          .then((response) => {
              let results = response.data['hydra:member'].reverse()
              const games = results.map( game => this.addIdFromURI(game) )
              this.games = games
              return games;
          })
      },
      addIdFromURI(game){
          const splitId = game['@id'].split('/');
          game.id = splitId[splitId.length - 1]
          return game
      }
  }
}

</script>