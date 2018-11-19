<template>
  <div>
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
        <label for="descriptionMasterGame">Description Game master</label>
        <textarea class="form-control" id="descriptionMasterGame" v-model="$v.game.descriptionMasterGame.$model" name="description game master"
         :class="{'is-invalid' : $v.game.descriptionMasterGame.$error }"
        ></textarea>
      </div>

      <div class="form-group">
        <label for="maxPlayer">Nombre maximum de joueurs</label>
        <input type="number" class="form-control" id="maxPlayer" name="maxPlayer" v-model.number="$v.game.maxPlayer.$model" placeholder="100"
         :class="{'is-invalid' : $v.game.maxPlayer.$error }"
        >
      </div>

      <h3>Game Master Name</h3>

      <div class="form-group">
        <label for="gameMaster">Name Game Master</label>
        <input type="text" class="form-control" id="gameMaster" name="gameMaster" v-model.number="$v.gameMaster.name.$model"
               :class="{'is-invalid' : $v.gameMaster.name.$error }"
        >
      </div>


      <button type="submit" v-on:click.prevent="createGame()" class="btn btn-primary" :disabled="submitStatus === 'PENDING'">Valider</button>
    </form>
  </div>
</template>

<script>

    import { required } from 'vuelidate/lib/validators'
    import Vue from 'vue'
    import VueCookies from 'vue-cookies'
    Vue.use(VueCookies);

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
                    this.submitStatus = 'ERROR';
                    return false
                }
                // CREATE GAME
                this.submitStatus = 'PENDING';
                this.axios.post('http://localhost:8000/api/games', this.game)
                .then((response) => {
                    // CREATE GAME MASTER
                    this.gameMaster.game = response.data['@id'];
                    this.axios.post('http://localhost:8000/api/players', this.gameMaster)
                        .then((response) => {
                            this.$cookies.set('token', response.data.token);
                        });
                  this.submitStatus = 'SUCCESS';
                  this.$router.push({name: 'Home'})
                })
                .catch((error) => {
                    this.submitStatus = 'ERROR';
                    console.log(error)
                })
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
                name: {}
            }
        }
    }
</script>

<style scoped>

</style>