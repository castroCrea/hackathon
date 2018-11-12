<template>
  <div>
    <h2 class="text-center">Créer une partie</h2>
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


      <button type="submit" v-on:click.prevent="createGame()" class="btn btn-primary">Valider</button>
    </form>
  </div>
</template>

<script>

    export default {
        name: "GameCreate",
        data(){
            return {
                user: {
                    title: '',
                    description: '',
                    maxPlayer: ''
                }
            }
        },
        methods: {
            createGame(e) {
                this.axios.post('http://localhost:8000/api/games', this.user)
                .then((response) => {
                  this.$router.push({name: 'Home'})
                })
            }
        }
    }
</script>

<style scoped>

</style>