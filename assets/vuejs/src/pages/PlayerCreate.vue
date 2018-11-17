<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col">
          <h2>Creer un joueur</h2>
          <form action="post" enctype="multipart/form-data" class="mb-3">
            <div class="form-group">
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="playerGender-m" name="playerGender" value="m" v-model="gender" class="custom-control-input">
                <label class="custom-control-label" for="playerGender-m">Homme</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="playerGender-f" name="playerGender" value="f" v-model="gender" class="custom-control-input">
                <label class="custom-control-label" for="playerGender-f">Femme</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="playerGender-none" name="playerGender" value="none" v-model="gender" class="custom-control-input">
                <label class="custom-control-label" for="playerGender-none">¯\_(ツ)_/¯</label>
              </div>
            </div>
            <div class="form-group">
              <label for="playerName">Nom</label>
              <input type="text" id="playerName" name="name" v-model="name" class="form-control" placeholder="Nom">
            </div>
            <div class="form-group">
              <label for="playerPicture">Photo</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="playerPicture" @change="imageToBase64String($event)" name="picture" aria-describedby="Photo">
                <label class="custom-file-label" for="playerPicture">Inserer une image</label>
              </div>
            </div>
            <div class="form-group">
              <label for="playerRace">Race</label>
              <input type="text" id="playerRace" class="form-control" name="player.race" v-model="race" placeholder="Race">
            </div>
            <div class="form-group">
              <label for="playerJob">Metier</label>
              <input type="text" id="playerJob" class="form-control" name="job" v-model="job" placeholder="Metier">
            </div>
            <div class="custom-control custom-checkbox custom-control-inline form-group">
              <input type="checkbox" id="playerIsGameMaster" name="playerGameMaster" value="false" class="custom-control-input">
              <label class="custom-control-label" for="playerIsGameMaster">Est il le game master ? <strong class="text-warning"><i>Pas utilisé pour le moment</i></strong></label>
            </div>
            <div class="d-flex flex-row-reverse">
              <button type="submit" class="btn btn-primary ml-auto">Enregistrer</button>
            </div>
          </form>
        </div>
      </div>
    </div>
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
<!--TODO: Create Player Form -->
<script>

    const image2base64 = require('image-to-base64');

    export default {
        name: "PlayerCreate",
        data(){
            return {
                name: "",
                picture: "",
                game: "",
                gameMaster: "false",
                race: "",
                job: "",
                gender: ""
            }
        },
        beforeRouteUpdate() {
            // this.$set(this.game, 'game', this.$route.params.gameId)
        },
        methods: {
            createPlayer(e) {
                this.axios.post('http://localhost:8000/api/games', this.player)
                .then((response) => {
                  this.$router.push({name: 'Home'})
                })
            },
            imageToBase64String(e) {
                console.log(e)
                // image2base64("path/to/file.jpg") // you can also to use url
                //     .then(
                //         (response) => {
                //             console.log(response); //cGF0aC90by9maWxlLmpwZw==
                //         }
                //     )
                //     .catch(
                //         (error) => {
                //             console.log(error); //Exepection error....
                //         }
                //     )
            }
        }
    }
</script>

<style scoped>

</style>