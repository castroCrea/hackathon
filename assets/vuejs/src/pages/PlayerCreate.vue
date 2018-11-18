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
                <input type="file" class="custom-file-input" id="playerPicture" @change="imageToBase64String" name="picture" aria-describedby="Photo">
                <label class="custom-file-label" for="playerPicture">Inserer une image</label>
              </div>
              <img :src="picture" class="my-4 d-block border-primary border p-3" alt="" height="250" v-if="picture">

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
</template>

<script>


    export default {
        name: "PlayerCreate",
        data(){
            return {
                name: "",
                picture: false,
                game: "0",
                gameMaster: "false",
                race: "",
                job: "",
                gender: ""
            }
        },
        created() {
            this.game = '/api/games/' + this.$route.params.gameId
        },
        methods: {
            createPlayers(e) {
                this.axios.post('http://localhost:8000/api/players', this.user)
                .then((response) => {
                  this.$router.push({name: 'Home'})
                })
            },
            imageToBase64String(e) {
                var input = event.target;
                // Ensure that you have a file before attempting to read it
                if (input.files && input.files[0]) {
                    // create a new FileReader to read this image and convert to base64 format
                    var reader = new FileReader();
                    // Define a callback function to run, when FileReader finishes its job
                    reader.onload = (e) => {
                        // Note: arrow function used here, so that "this.imageData" refers to the imageData of Vue component
                        // Read image as base64 and set to imageData
                        this.picture = e.target.result;
                    }
                    // Start the reader job - read file as a data url (base64 format)
                    reader.readAsDataURL(input.files[0]);
                }
            }
        }
    }
</script>

<style scoped>

</style>