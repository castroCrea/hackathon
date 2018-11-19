<template>
  <div>
    Description de la partie : WIP
  </div>
</template>

<script>

    export default {
        name: "GameDescription",
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