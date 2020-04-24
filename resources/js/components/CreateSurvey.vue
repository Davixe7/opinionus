<template>
  <div id="surveys-form">
    <div class="col-md-4 p-0">
      <form>
        <div class="form-group">
          <label for="name">Survey name</label>
          <div class="input-group">
            <input v-model="name" type="text" class="form-control" :class="{'is-invalid':errors.name}" required minlength="3">
            <span class="invalid-feedback" v-if="errors.name">{{ errors.name[0] }}</span>
            <div class="input-group-append">
              <button v-if="surveyId" type="button" class="btn btn-primary">Update Survey</button>
              <button @click="storeSurvey"v-if="!(surveyId)" type="button" class="btn btn-primary">Save Survey</button>
            </div>
          </div>
        </div>
      </form>
    </div>
    
    <div class="row">
      <transition enter-active-class="animated slideInLeft" leave-active-class="animated slideOutLeft">
        <div class="col-md-3" v-show="creatingChoice">
          <span class="form-section-title">Add a new choice</span>
          <CreateChoice :choice="{}" :surveyId="surveyId" @choiceStored="addChoice">
            <a class="btn btn-link-danger" @click="creatingChoice=false">Close</a>
          </CreateChoice>
        </div>
      </transition>
      
      <div class="col col-choices-container">
        <span class="form-section-title">Choices</span>
        <div v-show="loading" class="text-center py-4">
          loading...
        </div>
        
        <div v-if="choices && choices.length" v-show="!loading">
          <div class="choices-container-wrap">
            <transition-group enter-active-class="animated zoomIn" leave-active-class="animated zoomOut">
            <div v-for="(choice,i) in choices" :key="choice.id" class="col-12 col-sm-4 col-lg-4 col-xl-3 mb-2">
              <div class="card">
                <div class="card-body">
                  <span class="number">{{ i+1 }}</span>
                  <CreateChoice :choice="choice" @choiceDeleted="removeChoice"/>
                </div>
              </div>
            </div>
            </transition-group>
          </div>
          
          <button @click="creatingChoice=!creatingChoice" class="btn btn-primary fab">
            <i class="material-icons">add</i>
          </button>
        </div>
        <div v-else-if="surveyId" class="col-md-4 p-0">
          <div class="alert alert-info d-flex align-items-center">
            <i class="material-icons mr-3">info</i> No choices added yet
            <button @click="creatingChoice=true" class="ml-auto btn btn-primary btn-sm">start now</button>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</template>

<script>
export default {
  name: 'CreateSurvey',
  props: {
    'survey':{
      type: Object,
      default: () => Object()
    }
  },
  watch:{
    surveyId(newVal){
      document.querySelector('h1').innerText = 'Update Survey #' + newVal
    }
  },
  computed:{
    editing: () => this.surveyId
  },
  data(){ return {
    surveyId: null,
    name: 'New survey #' + String( Math.random(0,99) ).substring(2,4),
    defaultChoice:{ name: 'Choice 0' + String( Math.random(0,99) ).substring(2,4), link_text: 'Click me!', link_url: 'http://localhost:8080/', image: null },
    choices: [],
    
    errors: {},
    loading: false,
    creatingChoice: false,
  }},
  methods:{
    removeChoice(id){
      this.choices = this.choices.filter(c => c.id != id)
    },
    addChoice(choice){
      this.choices.push( choice )
      this.newChoice = {name:'', link_text: '', link_url: ''}
    },
    storeSurvey(){
      let data = {name: this.name}
      axios.post('/surveys', data).then(response => {
        this.surveyId = response.data.data.id
        this.name    = response.data.data.name
      })
    },
    updateSurvey(){
      this.loading = true
      let data = {name: this.name, '_method':'PUT'}
      axios.post(`/surveys/${this.surveyId}`, data).then(response => {
        this.name  = response.data.data.name
      })
    },
    storeChoicesList(survey){
      this.loading = true
      let data = new FormData()
      let toStore = []
      data.append('surveyId', survey)
      this.choices.forEach((item, i) => {
        data.append('choices[]', JSON.stringify(item))
        data.append(`images_${i}`, item.newImage)
        toStore.push(item.id)
      })
      
      this.choices = this.choices.filter(c=>{ toStore.indexOf( c.id ) == -1 })
      
      axios.post('/choices/storeList', data).then(response=>{
        this.loading = false
        this.choices = response.data.data
      })
    }
  },
  mounted(){
    if( this.survey ){
      this.surveyId  = this.survey.id
      this.name       = this.survey.name
      this.choices    = this.survey.choices
    }
  }
}
</script>

<style lang="scss" scoped>
  .choices-container-wrap > span {
    display: flex;
    margin: 0 -15px;
    position: relative;
    flex-wrap: nowrap;
    overflow-x: auto;
    overflow-y: hidden;
    max-width: 100%;
    border-bottom: 1px solid #efefef;
  }
  .form-section-title {
    font-size: .9em;
    color: gray;
    display: block;
    margin-bottom: 10px;
  }
  .col-choices-container {
    overflow: hidden;
  }
  .number {
    display: block;
    text-align: center;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    color: #fff;
    background: #f2467f;
    font-size: 1em;
    line-height: 1.5em;
    vertical-align: middle;
    position: absolute;
    top: 5px;
    right: 5px;
    z-index: 30;
  }
  .fab {
    position: absolute;
    bottom: 20px;
    right: 10px;
    z-index: 100;
  }
  .bottom-app-bar {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 10px;
    border-top: 1px solid #efefef;
    background: #fff;
    display: none;
  }
</style>
