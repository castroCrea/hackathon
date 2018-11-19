<template>
  <div class="container">
    <div class="row">
      <div class="col">
        <h2 class="text-center">Créer une partie</h2>
        <form>

          <div class="form-group">
            <label for="title">Nom</label>
            <input type="text" class="form-control" id="title" v-model="$v.game.title.$model" name="title" placeholder="Kayviiiine"
                   :class="{'is-invalid' : $v.game.title.$error }"
            >
          </div>

          <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" v-model="$v.game.description.$model" name="description"
                      :class="{'is-invalid' : $v.game.description.$error }"
            ></textarea>
          </div>

          <div class="form-group">
            <label for="maxPlayer">Nombre maximum de joueurs</label>
            <input type="number" class="form-control" id="maxPlayer" name="maxPlayer" v-model.number="$v.game.maxPlayer.$model" placeholder="100"
                   :class="{'is-invalid' : $v.game.maxPlayer.$error }"
            >
          </div>

          <h3 class="mt-5">Game Master</h3>

          <div class="form-group">
            <label for="gameMaster">Nom du game master</label>
            <input type="text" class="form-control" id="gameMaster" name="gameMaster" v-model.number="$v.gameMaster.name.$model"
                   :class="{'is-invalid' : $v.gameMaster.name.$error }"
            >
          </div>

          <div class="form-group">
            <label for="descriptionMasterGame">Description</label>
            <textarea class="form-control" id="descriptionMasterGame" v-model="$v.game.descriptionMasterGame.$model" name="description game master"
                      :class="{'is-invalid' : $v.game.descriptionMasterGame.$error }"
            ></textarea>
          </div>


          <button type="submit" v-on:click.prevent="createGame()" class="btn btn-primary" :disabled="submitStatus === 'PENDING'">Valider</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>

    import { required } from 'vuelidate/lib/validators'

    export default {
        name: "GameCreate",
        data(){
            return {
                game: {
                    title: '',
                    description: '',
                    descriptionMasterGame: '',
                    maxPlayer: ''
                },
                gameMaster: {
                    name: '',
                    inUse: true,
                    game: ''
                },
                submitStatus: null
            }
        },
        methods: {
            createGame(e) {

                this.$v.$touch()

                if (this.$v.$invalid) {
                    this.submitStatus = 'ERROR'
                    return false
                }
                this.submitStatus = 'PENDING'
                this.axios.post('http://localhost:8000/api/games', this.game)
                .then((response) => {
                  this.gameMaster.game = response.data['@id']
                  this.createGameMaster()
                  this.$router.go(-1)
                })
                .catch((error) => {
                    this.submitStatus = 'ERROR'
                    console.log(error)
                })
            },
            createGameMaster() {
                this.axios.post('http://localhost:8000/api/players', this.gameMaster)
                    .then((response) => {
                        this.submitStatus = 'SUCCESS';
                        this.$cookies.set('token', this.gameMaster.game);
                    })
                    .catch(error => console.log(error))
            }
        },

        validations: {
            game: {
                title: {
                    required
                },
                description: {
                    required
                },
                descriptionMasterGame: {
                    required
                },
                maxPlayer: {
                    required
                }
            },
            gameMaster: {
                name: {
                    required
                }
            }
        }
    }
</script>

<style scoped>

</style>