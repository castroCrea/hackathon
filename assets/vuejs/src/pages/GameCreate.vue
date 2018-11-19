<template>
  <div>
    <h2 class="text-center">Créer une partie</h2>
    <form>

      <div class="form-group">
        <label for="title">Nom</label>
        <input type="text" class="form-control" id="title" v-model="$v.user.title.$model" name="title" placeholder="Kayviiiine"
         :class="{'is-invalid' : $v.user.title.$error }"
        >
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" v-model="$v.user.description.$model" name="description"
         :class="{'is-invalid' : $v.user.description.$error }"
        ></textarea>
      </div>

      <div class="form-group">
        <label for="descriptionMasterGame">Description Game master</label>
        <textarea class="form-control" id="descriptionMasterGame" v-model="$v.user.descriptionMasterGame.$model" name="description game master"
         :class="{'is-invalid' : $v.user.descriptionMasterGame.$error }"
        ></textarea>
      </div>

      <div class="form-group">
        <label for="maxPlayer">Nombre maximum de joueurs</label>
        <input type="number" class="form-control" id="maxPlayer" name="maxPlayer" v-model.number="$v.user.maxPlayer.$model" placeholder="100"
         :class="{'is-invalid' : $v.user.maxPlayer.$error }"
        >
      </div>


      <button type="submit" v-on:click.prevent="createGame()" class="btn btn-primary" :disabled="submitStatus === 'PENDING'">Valider</button>
    </form>
  </div>
</template>

<script>

    import { required } from 'vuelidate/lib/validators'

    export default {
        name: "GameCreate",
        data(){
            return {
                user: {
                    title: '',
                    description: '',
                    descriptionMasterGame: '',
                    maxPlayer: ''
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
                this.axios.post('http://localhost:8000/api/games', this.user)
                .then((response) => {
                  this.submitStatus = 'SUCCESS'
                  this.$router.push({name: 'Home'})
                })
                .catch((error) => {
                    this.submitStatus = 'ERROR'
                    console.log(error)
                })
            }
        },

        validations: {
            user: {
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
            }
        }
    }
</script>

<style scoped>

</style>