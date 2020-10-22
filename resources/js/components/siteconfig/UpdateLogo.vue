<template>
  <div id="update-logo-form">
    <form @submit.prevent="upload">
      <div style="text-align:center; margin-bottom: 15px;">
        <img v-show="logo" :src="logo" alt="">
      </div>
      <div class="form-group" style="border: 1px solid #9f9f9f; border-radius: 3px; background: lightgray;">
        <input type="file" @change="updateFile" ref="fileInput">
      </div>
      <div class="row align-items-center">
        <div class="col">
          Max file size <b>1MB</b>
        </div>
        <div class="col text-right">
          <button type="submit" class="btn btn-primary d-inline-flex align-items-center" >
            <i v-show="uploading" class="material-icons preloader">sync</i>
            <span>Upload logo</span>
          </button>
        </div>
      </div>
    </form>

    <div v-show="success" class="alert alert-success mt-2">Site brand logo updated successfully!</div>

  </div>
</template>

<script>
export default {
  props: ['logo'],
  data(){return{
    uploading: false,
    file: null,
    success: false
  }},
  methods:{
    updateFile(){
      this.file = this.$refs.fileInput.files[0]
    },
    upload(){
      axios.post('/admin/updateLogo', this.loadData()).then(response=>{
        console.log(response);
        this.success = true
        this.uploading = false
      },
      err=>{
        console.log(err.response.data);
      })
    },
    loadData(){
      let data = new FormData()
      data.append('logo', this.file)
      this.success   = false
      this.uploading = true
      return data
    }
  }
}
</script>

<style lang="css" scoped>
  #update-logo-form {
    overflow: hidden;
  }
</style>
