<template>
  <div>
    <router-view></router-view>
  </div>
</template>

<script>

    export default {
        name: "Game",
        data(){
            return {
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