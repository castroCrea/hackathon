<template>
  <div>
    Formulaire de création de joueurs : WIP
  </div>
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