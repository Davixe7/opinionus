<template>
  <div class="choice-form">
    <img v-if="choice.image" :src="thumbUrl" alt="">
    <form v-show="!saving" ref="choiceForm">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" v-model="choice.name" placeholder="Name" required minlength="3" maxlength="50">
      </div>
      <div class="form-group">
        <label for="image">Image</label>
        <input type="file" @change="onFileInput" ref="fileInput" accept="image/*">
      </div>
      <div class="form-group">
        <label for="url">Link URL</label>
        <input type="url" class="form-control" v-model="choice.link_url" placeholder="Link URL ej: https://google.co" required minlength="11" maxlength="100">
      </div>
      <div class="form-group">
        <label for="url">Link Text</label>
        <input type="text" class="form-control" v-model="choice.link_text" placeholder="Link Text" required minlength="11" maxlength="100">
      </div>
      
      <div class="actions">
        <slot></slot>
        <a v-if="choice.id"  @click="deleteChoice" class="btn btn-link btn-link-danger">delete</a>
        <a v-if="choice.id"  @click="updateChoice" class="btn btn-link btn-link-danger">update</a>
        <a v-if="!choice.id" @click="storeChoice"  class="btn btn-link btn-link-danger">save</a>
      </div>
    </form>
    <div v-show="saving" class="text-center py-4">
      Saving...
    </div>
  </div>
</template>

<script>
export default {
  props:
  ['choice', 'surveyId'],
  data(){
    return {
      newImage: '',
      saving: false,
      url: process.env.MIX_APP_URL
    }
  },
  computed:{
    thumbUrl(){
      return this.choice.image ? this.choice.image.replace('public/images', `${this.url}storage/thumbnails/300`) : '';
    }
  },
  methods:{
    onFileInput(){
      this.choice.newImage = this.$refs.fileInput.files[0]
    },
    storeChoice(){
      if( !this.$refs.choiceForm.reportValidity() ) return
      this.saving = true
      axios.post(`${this.url}dashboard/choices`, this.loadData()).then(response=>{
        this.$emit('choiceStored', response.data.data)
        this.$refs.fileInput.value = ''
        this.saving = false
      })
    },
    updateChoice(){
      if( !this.$refs.choiceForm.reportValidity() ) return
      this.saving = true
      let data = this.loadData()
      data.append('_method', 'PUT')
      
      axios.post(`${this.url}dashboard/choices/${this.choice.id}`, data).then(response=>{
        let newChoice = response.data.data
        this.$refs.fileInput.value = ''
        this.choice.image = newChoice.image ? newChoice.image : this.choice.image
        this.saving = false
        this.$toasted.show('Choice updated succesfully')
        this.$emit('choiceUpdated', response.data.data)
      })
    },
    deleteChoice(){
      if( confirm('Are you sure you want to deleted the choice?') ){
        axios.delete(`${this.url}dashboard/choices/${this.choice.id}`).then(response=>{
          this.$emit('choiceDeleted', this.choice.id)
          this.$toasted.show('Choice deleted succesfully')
        })
      }
    },
    loadData(){
      let data = new FormData()
      data.append('image', this.choice.newImage)
      data.append('name', this.choice.name)
      data.append('link_text', this.choice.link_text)
      data.append('link_url', this.choice.link_url)
      data.append('survey_id', this.surveyId)
      return data
    }
  }
}
</script>

<style lang="scss">
  .choice-form {
    overflow: hidden;
    margin-bottom: 20px;
  }
  .choice-form img {
    width: 100%;
    position: relative;
    z-index: 10;
  }
  .choice-form label {
    display: none;
    font-size: .85em;
    font-weight: 600;
    color: #9f9f9f;
    margin-bottom: 0;
  }
  .choice-form .form-control {
    font-size: .9em;
  }
  .choice-form input[type=file]{
    font-size: .85em;
  }
  .choice-form .actions {
    text-align: center;
    margin-bottom: -10px;
  }
  .choice-form .actions a {
    font-size: .9em;
    text-transform: uppercase;
  }
  .choice-form img + form > .form-group:first-child {
    width: 80%;
    margin: -15px auto 20px;
    position: relative;
    z-index: 20;
  }
  .choice-form .form-group:last-child {
    margin-bottom: 10px;
  }
</style>
