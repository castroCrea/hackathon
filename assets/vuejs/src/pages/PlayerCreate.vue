<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col">
          <h2>Creer un joueur</h2>
          <form action="post" enctype="multipart/form-data" class="mb-3"
                @submit.prevent="createPlayer"
          >
            <div class="form-group">
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="playerGender-m" name="gender" value="m" v-model="$v.gender.$model" class="custom-control-input"
                       :class="{'is-invalid' : $v.gender.$error }"
                >
                <label class="custom-control-label" for="playerGender-m">Homme</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="playerGender-f" name="gender" value="f" v-model="$v.gender.$model" class="custom-control-input"
                       :class="{'is-invalid' : $v.gender.$error }"
                >
                <label class="custom-control-label" for="playerGender-f">Femme</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="playerGender-none" name="gender" value="none" v-model="$v.gender.$model" class="custom-control-input"
                       :class="{'is-invalid' : $v.gender.$error }"
                >
                <label class="custom-control-label" for="playerGender-none">¯\_(ツ)_/¯</label>
              </div>
            </div>
            <div class="form-group">
              <label for="playerName">Nom</label>
              <input type="text" id="playerName" name="name" v-model="$v.name.$model" class="form-control" placeholder="Nom"
                     :class="{'is-invalid' : $v.name.$error }"
              >
            </div>
            <div class="form-group">
              <label for="playerPicture">Photo</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="playerPicture" @change="imageToBase64String" name="picture" aria-describedby="Photo"
                       :class="{'is-invalid' : !this.picture }"
                 >
                <label class="custom-file-label" for="playerPicture">Inserer une image</label>
              </div>
              <img :src="picture" class="my-4 d-block border-primary border p-3" alt="" height="250" v-if="picture.trim()">

            </div>
            <div class="form-group">
              <label for="playerRace">Race</label>
              <input type="text" id="playerRace" class="form-control" name="player.race" v-model="$v.race.$model" placeholder="Race"
                     :class="{'is-invalid' : $v.race.$error }"
              >
            </div>
            <div class="form-group">
              <label for="playerJob">Metier</label>
              <input type="text" id="playerJob" class="form-control" name="job" v-model="$v.job.$model" placeholder="Metier"
                     :class="{'is-invalid' : $v.job.$error }"
              >
            </div>
            <div class="custom-control custom-checkbox custom-control-inline form-group">
              <input type="checkbox" id="playerIsGameMaster" name="playerGameMaster" value="false" class="custom-control-input">
              <label class="custom-control-label" for="playerIsGameMaster">Est il le game master ? <strong class="text-warning"><i>Pas utilisé pour le moment</i></strong></label>
            </div>
            <div class="d-flex flex-row-reverse">
              <button type="submit" class="btn btn-primary ml-auto" :disabled="submitStatus === 'PENDING'">Enregistrer</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

    import { required } from 'vuelidate/lib/validators'

    export default {
        name: "PlayerCreate",
        data(){
            return {
                game: "/api/game/",
                gender: "/api/gender/",
                name: "",
                picture: ' ',
                race: "/api/race/",
                job: "/api/job/",
                gameMaster: "false",
                submitStatus: null
            }
        },
        created() {
            this.game = this.game + this.$route.params.gameId
        },
        methods: {
            createPlayer(e) {
                this.$v.$touch()

                if (this.$v.$invalid) {
                    this.submitStatus = 'ERROR'
                    return false
                } else {

                  this.submitStatus = 'PENDING'
                  this.axios.post('http://localhost:8000/api/players', this.$data)
                      .then((response) => {
                          this.submitStatus = 'SUCCESS'
                          this.$router.push({name: 'Home'})
                          console.log(response);
                      })
                }

            },
            imageToBase64String(e) {
                const input = event.target;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.readAsDataURL(input.files[0])
                    reader.onload = (e) => {
                        this.picture = e.target.result
                    }
                }
            },
        },
        validations: {
            gender: {
                required
            },
            name: {
                required
            },
            race: {
                required
            },
            job: {
                required
            }
        }
    }
</script>

<style scoped>

</style>