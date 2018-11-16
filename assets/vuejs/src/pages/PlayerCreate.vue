<template>
  <div>
    Formulaire de création de joueurs : WIP
  </div>
  <form>

    <div class="form-group">
      <label for="title">Nom</label>
      <input type="text" class="form-control" id="title" v-model="user.title" name="title" placeholder="Kayviiiine">
    </div>

    <div class="form-group">
      <label for="description">Description</label>
      <textarea class="form-control" id="description" v-model="user.description" name="description"></textarea>
    </div>

    <div class="form-group">
      <label for="maxPlayer">Nombre maximum de joueurs</label>
      <input type="number" class="form-control" id="maxPlayer" name="maxPlayer" v-model.number="user.maxPlayer" placeholder="100">
    </div>

    <button type="submit" v-on:click.prevent="createPlayers()" class="btn btn-primary">Valider</button>
  </form>
</template>

<script>

    export default {
        name: "PlayerCreate",
        data(){
            return {
                user: {
                    title: '',
                    description: '',
                    maxPlayer: ''
                }
            }
        },
        mounted() {
            this.user.game = '/api/games/'+this.$router.params.gameId;
        },
        methods: {
            createPlayers(e) {
                this.axios.post('http://localhost:8000/api/players', this.user)
                .then((response) => {
                  this.$router.push({name: 'Home'})
                })
            }
        }
    }
</script>

<style scoped>

</style>