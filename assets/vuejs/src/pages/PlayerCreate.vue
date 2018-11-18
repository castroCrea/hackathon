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
              <label>Genre</label>
              <vue-bootstrap-typeahead
                v-if="$v.player.gender.$error"
                input-class="is-invalid"
                v-model="player.gender"
                :serializer="s => s.name"
                placeholder="Choisir un genre"
                :data="genders"
                @hit="player.gender = $event['@id']"
              />
              <vue-bootstrap-typeahead
                v-else
                v-model="player.gender"
                :serializer="s => s.name"
                placeholder="Choisir un genre"
                :data="genders"
                @hit="player.gender = $event['@id']"
              />
            </div>
            <div class="form-group">
              <label for="playerName">Nom</label>
              <input type="text" id="playerName" name="name" v-model="$v.player.name.$model" class="form-control" placeholder="Nom"
                     :class="{'is-invalid' : $v.player.name.$error }"
              >
            </div>
            <div class="form-group">
              <label for="playerPicture">Photo</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="playerPicture" @change="imageToBase64String" name="picture" aria-describedby="Photo"
                       :class="{'is-invalid' : (!this.player.picture && this.player.picture !== null) }"
                 >
                <label class="custom-file-label" for="playerPicture">Inserer une image</label>
              </div>
              <img :src="player.picture" class="my-4 d-block border-primary border p-3" alt="" height="250" v-if="player.picture">

            </div>
            <div class="form-group">
              <label for="playerRace">Race</label>
              <input type="text" id="playerRace" class="form-control" name="player.race" v-model="$v.player.race.$model" placeholder="Race"
                     :class="{'is-invalid' : $v.player.race.$error }"
              >
            </div>
            <div class="form-group">
              <label for="playerJob">Métier</label>
              <vue-bootstrap-typeahead
                v-if="$v.player.job.$error"
                input-class="is-invalid"
                v-model="$v.player.job.$model"
                :serializer="s => s.name"
                placeholder="Choisir un metier"
                :data="jobs"
                @hit="player.job = $event['@id']"
              />
              <vue-bootstrap-typeahead
                v-else
                v-model="$v.player.job.$model"
                :serializer="s => s.name"
                placeholder="Choisir un metier"
                :data="jobs"
                @hit="player.job = $event['@id']"
              />
            </div>
            <div class="custom-control custom-checkbox custom-control-inline form-group">
              <input type="checkbox" id="playerIsGameMaster" name="playerGameMaster" value="false" class="custom-control-input">
              <label class="custom-control-label" for="playerIsGameMaster">Est il le game master ? <strong class="text-warning"><i>Pas utilisé pour le moment</i></strong></label>
            </div>
            <div class="d-flex flex-row-reverse">
              <button type="submit" class="btn btn-primary ml-auto" :disabled="player.submitStatus === 'PENDING'">Enregistrer</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

    import { required } from 'vuelidate/lib/validators'
    import VueBootstrapTypeahead from 'vue-bootstrap-typeahead'


    export default {
        name: "PlayerCreate",
        components: {
            VueBootstrapTypeahead
        },
        data(){
            return {
                player: {
                    game: "/api/games/",
                    gender: "",
                    name: "",
                    picture: null,
                    race: "/api/races/1",
                    job: "",
                    gameMaster: "false",
                    submitStatus: null
                },
                genders: [],
                races: [],
                jobs: []
            }
        },
        created() {
            this.player.game = this.player.game + this.$route.params.gameId
            this.getGenders()
            // this.getRaces()
            this.getJobs()
        },
        methods: {
            createPlayer(e) {
                this.$v.$touch()

                if (!this.player.picture) {
                    this.player.picture = false
                    return false
                }

                if (this.$v.$invalid) {
                    this.player.submitStatus = 'ERROR'
                    return false
                } else {

                  this.player.submitStatus = 'PENDING'
                  this.axios.post('http://localhost:8000/api/players', this.player)
                      .then((response) => {
                          this.player.submitStatus = 'SUCCESS'
                          this.$router.push({name: 'Home'})
                          console.log(response);
                      })
                }

            },
            getGenders() {
                this.axios.get('http://localhost:8000/api/genders')
                  .then((response) => {
                      this.genders = response.data["hydra:member"]
                  })
            },
            getRaces() {
                this.axios.get('http://localhost:8000/api/races')
                  .then((response) => {
                      this.races = response.data["hydra:member"]
                  })
            },
            getJobs() {
                this.axios.get('http://localhost:8000/api/jobs')
                  .then((response) => {
                      this.jobs = response.data["hydra:member"]
                  })
            },
            imageToBase64String(e) {
                const input = event.target;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.readAsDataURL(input.files[0])
                    reader.onload = (e) => {
                        this.player.picture = e.target.result
                    }
                }
            },
        },
        validations: {
            player: {
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
    }
</script>

<style scoped>

</style>