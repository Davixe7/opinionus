<template>
  <div id="vote">
    <sharer :message="survey.name" :link="link" :vertical="true"/>
    <transition enter-active-class="animated fadeIn" leave-active-class="animated fadeOut">
      <thanks v-if="voted" :slug="survey.slug" :choice="selection">
        <choice-content :choice="selection" :selected="true" :voted="true"/>
      </thanks>
      
      <div v-else>
        <div class="row choices-wrapper">
          <div v-for="(choice,i) in choices" :key="choice.id" class="col-sm-6 col-md-4 col-lg-4 choice-content">
            <choice-content :choice="choice" :selected="selection == choice" :number="i+1" @selected="selectChoice"/>
          </div>
        </div>
        
        <div class="action">
          <a :href="`/surveys/${survey.slug}/results`" class="btn btn-outlined-default mr-3">Just Show Results</a>
          <button
            @click="vote"
            class="btn btn-primary d-inline-flex align-items-center"
            :class="{disabled: !(selection && selection.id)}">
            <i v-if="voting" class="material-icons mr-3 preloader">sync</i>
            <i v-else class="material-icons mr-3">check</i>
            Confirm Your Vote
          </button>
        </div>
          
        <!-- <div class="bottom-app-bar">
          <div class="status">
            <div class="form-section-title mb-0">Your Selection</div>
            <span>{{ selection.name || "No candidate selected"  }}</span>
          </div>
          <button
            @click="(selection.id) ? staging=true : null"
            class="ml-auto btn btn-primary btn-submit"
            :class="{disabled: !(selection && selection.id)}">
            Confirm
          </button>
        </div> -->
      </div>
    </transition>
  
</div>
</template>

<script>
export default {
  props: ['survey'],
  name: 'Vote',
  data(){return{
    link: window.location.href,
    selection: {},
    staging: false,
    voted: false,
    voting: false
  }},
  computed:{
    choices(){
      return this.survey.choices
    }
  },
  methods:{
    vote(){
      this.voting = true
      let data = {'choice_id':this.selection.id}
      axios.post('/votes', data).then(response=>{
        this.voted = true
      })
    },
    selectChoice(choice){
      this.selection = choice
    }
  }
}
</script>

<style lang="scss" scoped>
.choices-wrapper {
  margin-bottom: 60px;
}
.btn-vote, .btn-vote:active {
  transition: all .5s;
  outline: none;
  cursor: pointer;
}
.bottom-app-bar {
  display: flex;
  padding: 10px 20px;
  border-top: 1px solid #efefef;
  position: fixed;
  width: 100%;
  left: 0;
  bottom: 0;
  background: #fff;
}
.btn-submit {
  font-size: 1.25em;
  text-transform: uppercase;
  background: blue;
  padding: 7px 25px;
}
</style>
