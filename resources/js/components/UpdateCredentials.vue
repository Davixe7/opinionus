<template>
  <div id="update-credentials">
    <form @submit.prevent="updateCredentials" ref="updateCredentialsForm">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" v-model="localEmail" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" v-model="password">
      </div>
      <div class="form-group text-right">
        <button type="submit" class="btn btn-primary" :class="{disabled:loading}">
          <i class="material-icons mr-3" v-show="loading">sync</i>
          {{ loading ? 'Updating' : 'Update credentials' }}
        </button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: 'update-credentials',
  props: ['email'],
  data(){return{
    localEmail: '',
    password: '',
    loading: false,
    errors: {}
  }},
  mounted(){
    this.localEmail = this.email
  },
  methods:{
    updateCredentials(){
      if( !this.$refs.updateCredentialsForm.reportValidity() ){
        return false
      }
      this.loading = true
      let data = {email:this.localEmail, password: this.password, '_method':'PUT'}
      axios.post('/admin/update-credentials', data)
      .then(response=>{
        this.$toasted.show('Credentials updated successfully')
      },error=>{
        this.errors = error.response.data.errors
      }).then(()=>{ this.loading = false })
    }
  }
}
</script>

<style lang="css" scoped>
</style>
