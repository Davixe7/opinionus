<template>
  <div id="surveys">
    <div class="row">
      <div class="col-12 col-sm-6">
        <h1>Select a survey</h1>
        <span class="subheading">Showing results: {{ results.length }}</span>
      </div>
      <div class="col-12 col-sm-6 d-flex align-items-center">
        <SearchForm :collection="surveys" :attribute="'name'" v-model="results"/>
      </div>
    </div>
    
    <transition-group enter-active-class="animated zoomIn" leave-active-class="animated zoomOut" class="row">
      <div class="col-md-4 mb-4" v-for="survey in results" :key="survey.id">
          <div class="card">
            <div class="card-body">
              <survey-content :survey='survey'/>
            </div>
          </div>
      </div>
    </transition-group>
  </div>
</template>

<script>
export default {
  props: ['surveys'],
  data(){return{
    results: [...this.surveys]
  }},
  methods:{
    updateResults(results){
      this.results = results
    }
  }
}
</script>