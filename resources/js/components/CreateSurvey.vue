<template>
  <div id="surveys-form">
    <div class="row">
      <div class="col-md-5">
        <form>
          <div class="form-group">
            <label for="name">Survey name</label>
            <div class="input-group">
              <input v-model="name" type="text" class="form-control" :class="{'is-invalid':errors.name}" required minlength="3" :disabled="saving">
              <span class="invalid-feedback" v-if="errors.name">{{ errors.name[0] }}</span>
              <div class="input-group-append">
                <button @click="updateSurvey" v-if="surveyId" type="button" class="btn btn-danger btn-sender" :disabled="saving">
                  <i v-show="saving" class="material-icons small preloader">sync</i>
                  <span>Update</span>
                </button>
                <button @click="storeSurvey"  v-if="!(surveyId)" type="button" class="btn btn-danger btn-sender">
                  <i v-show="saving" class="material-icons preloader">sync</i>
                  <span>Save</span>
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="col-md-7 right-survey-menu">
        <transition enter-active-class="animated slideInRight">
          <div v-if="surveyId" class="card d-sm-inline-block">
            <div class="card-body">
              <div class="btn-group">
                <a href="/admin/surveys" title="go back">
                  <i class="material-icons">arrow_back</i>&nbsp;
                  <span>Go back</span>
                </a>
                <a v-if="choices.length >= 2" :href="`/surveys/${slug}/vote`" class="btn btn-link" title="vote">
                  <i class="material-icons">how_to_vote</i>&nbsp;
                  <span>Vote</span>
                </a>
                <a v-if="choices.length >= 2" :href="`/surveys/${slug}/results`" class="btn btn-link" title="results">
                  <i class="material-icons">ballot</i>&nbsp;
                  <span>Results</span>
                </a>
                <a href="#" @click="deleteSurvey()" class="btn btn-link" title="delete">
                  <i class="material-icons">delete</i>&nbsp;
                  <span>Delete</span>
                </a>
              </div>
            </div>
          </div>
        </transition>
      </div>
    </div>
    
    <div class="row py-3" style="overflow: hidden;">
      <!-- Create Choice Form -->
      <div class="col-md-3 create-choice-form" :class="{'slideout-enter-active':!creatingChoice}">
        <div class="card">
          <div class="card-body">
            <span class="form-section-title">Add a new choice</span>
            <CreateChoice :choice="{}" :surveyId="surveyId" @choiceStored="addChoice">
              <a class="btn btn-link-danger" @click="creatingChoice=false">Close</a>
            </CreateChoice>
          </div>
        </div>
      </div>
      
      <div class="col col-choices-container">
        <span class="form-section-title">Choices</span>
        
        <div class="choices-container-wrap" :class="{'choices-empty-state': !choices.length}">
          <span v-show="!choices.length" class="message">{{ surveyId ? 'No choices added yet' : 'Create a new survey to start adding choices' }}</span>
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
        
        <transition enter-active-class="animated zoomIn">
          <button v-if="surveyId" @click="creatingChoice=!creatingChoice" class="btn btn-danger fab fab-fixed">
            <i class="material-icons">add</i>
          </button>
        </transition>
        
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
      document.querySelector('h1').innerText = newVal ? 'Update Survey #' + newVal : 'Create a new survey'
    }
  },
  computed:{
    editing: () => this.surveyId
  },
  data(){ return {
    surveyId: null,
    slug: null,
    name: 'New survey #' + String( Math.random(0,99) ).substring(2,4),
    defaultChoice:{ name: 'Choice 0' + String( Math.random(0,99) ).substring(2,4), link_text: 'Click me!', link_url: 'http://localhost:8080/', image: null },
    choices: [],
    
    errors: {},
    saving: false,
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
      this.saving = true
      let data = {name: this.name}
      axios.post('/admin/surveys', data).then(response => {
        this.surveyId = response.data.data.id
        this.slug = response.data.data.slug
        this.name    = response.data.data.name
        this.$toasted.show('Survey created successfully')
        this.saving = false
      })
    },
    updateSurvey(){
      this.saving = true
      let data = {name: this.name, '_method':'PUT'}
      axios.post(`/admin/surveys/${this.surveyId}`, data).then(response => {
        this.name  = response.data.data.name
        this.saving = false
        this.$toasted.show('Survey updated successfully')
      })
    },
    deleteSurvey(){
      if( confirm('Are you sure you want to delete the survey?') ){
        axios.post(`/admin/surveys/${this.surveyId}`, {_method:'DELETE'}).then(response=>{
          this.surveyId = null
          this.$toasted.show('Survey deleted successfully')
        })
      }
    },
    storeChoicesList(survey){
      this.saving = true
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
        this.saving = false
        this.choices = response.data.data
      })
    }
  },
  mounted(){
    if( this.survey ){
      this.surveyId = this.survey.id
      this.name     = this.survey.name
      this.choices  = this.survey.choices
      this.slug     = this.survey.slug
    }
  }
}
</script>

<style lang="scss" scoped>
  .btn.btn-sender {
    display: inline-flex;
    align-items: center;
    i.material-icons {
      font-size: 1.25em;
      margin-right: 10px;
    }
  }
  .create-choice-form {
    margin-bottom: 20px;
    transition: all .5s;
    will-change: margin-left;
  }
  .create-choice-form .card {
    background: linear-gradient(45deg, #efefef, #fff) !important;
    border-radius: 5px;
    border: none;
    box-shadow: 0 1px 12px 1px rgba(0,0,0,.1);
  }
  .slideout-enter-active {
    margin-left: calc(-100vw + 30px);
  }
  @media(min-width: 991px){
    .slideout-enter-active {
      margin-left: calc(-25vw + 10px);
    }
  }
  .choices-container-wrap {
    transition: all .5s;
    background: transparent;
    min-height: 300px;
    margin: 0 -15px;
  }
  .choices-container-wrap > span {
    display: flex;
    position: relative;
    flex-wrap: nowrap;
    overflow-x: auto;
    overflow-y: hidden;
    max-width: 100%;
    border-bottom: 1px solid #efefef;
  }
  .col-choices-container {
    overflow: hidden;
  }
  .choices-empty-state {
    justify-content: center;
    align-items: center;
    background: lightgray;
    border-radius: 5px;
    flex-flow: column nowrap;
    max-height: 300px;
    overflow: hidden;
    .message {
      display: block;
      line-height: 300px;
      flex: 0 0 100%;
      font-size: 1.25em;
      font-weight: 500;
      color: rgba(0,0,0,.5);
      text-align: center;
    }
  }
  .right-survey-menu {
    text-align: right;
    .card-body {
      padding: 10px;
    }
    .btn-group {
      display: flex;
      justify-content: space-between;
    }
    a {
      display: inline-flex;
      align-items: center;
      text-decoration: none;
      &hover {
        text-decoration: none;
      }
      span {
        display: none;
      }
    }
  }
</style>