<template>
  <div>
    <h2 class="text-center">Inscription</h2>
    <form>
      <div class="form-group">
        <label for="sex">Race</label>
        <select class="form-control" id="sex">
          <option value="F">Femme</option>
          <option value="M">Homme</option>
        </select>
      </div>


      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="email">
      </div>

      <div class="form-group">
        <label for="pwd1">Mot de passe</label>
        <input type="password" class="form-control" id="pwd1" placeholder="mot de passe">
      </div>
      <div class="form-group">
        <label for="pwd2">Retapez le mot de passe</label>
        <input type="password" class="form-control" id="pwd2" placeholder="mot de passe">
      </div>

      <div class="form-group">
        <label for="job">Métier</label>
        <input type="text" class="form-control" id="job" name="job" placeholder="Dev front end">
      </div>

      <div class="form-group">
        <label for="userRace">Race</label>
        <select class="form-control" id="userRace">
          <option value="">1</option>
          <option value="">2</option>
        </select>
      </div>

      <div class="form-group">
        <label for="profilePhoto">Photo de profil</label>
        <input type="file" class="form-control-file" id="profilePhoto" aria-describedby="fileHelp">
      </div>

      <button type="submit" v-on:click="signIn" class="btn btn-primary">S'inscrire</button>
    </form>
  </div>
</template>

<script>
    export default {
        name: "NewGame",
        data(){
            return {
                user: {
                    email: '',
                    password: '',
                    retry_password: '',
                    job: '',
                    race: '',
                    photo: '',
                    sex: ''
                }
            }
        },
        methods: {
            signIn(e) {
                console.log('toto');
                e.preventDefault();
            }
        }
    }
</script>

<style scoped>

</style>