<template>
  <div id="results">
    <h1>Survey results</h1>
    <table class="table table-results mb-3">
      <tr v-for="choice in choices" :key="choice.id">
        <td>
          <span class="choice-name">{{ choice.name }}</span>
          <a :href="choice.link_url">{{ choice.link_text }}</a>
        </td>
        <td>
          <div class="progress">
            <div class="progress-bar" :style="{width: globalPercent(choice.votes_count) + '%'}" aria-valuemin="0" aria-valuemax="100">
              {{ globalPercent(choice.votes_count) + '%' }}
            </div>
          </div>
        </td>
      </tr>
    </table>
    
    <div class="results-summary">
      <div class="metter">
        <div class="supheading">opts</div>
        <div class="amount">{{ choices.length }}</div>
      </div>
      <div class="metter">
        <div class="supheading">votes</div>
        <div class="amount">{{ survey.votes_count }}</div>
      </div>
      <div class="ml-auto">
        <sharer :message="survey.name" :link="url" class="ml-auto"/>
      </div>
    </div>
    
  </div>
</template>

<script>

export default {
  props: ['choices', 'survey'],
  name: 'results',
  data(){
    return { url: window.location.href }
  },
  methods:{
    globalPercent(value){
      if( this.survey.votes_count ){
        return ( (value / this.survey.votes_count) * 100 ).toFixed(2)
      }
      return 0
    }
  }
}
</script>

<style lang="scss" scoped>
#results {
  padding-bottom: 40px;
  > .row {
    flex-direction: column-reverse;
    .col-md-3 {
      height: 100vh;
    }
  }
} 
table.table-results td {
  border-bottom: 1px solid #efefef;
}
.choice-name {
  display: block;
  font-weight: 600;
  color: gray;
  font-size: 1.35em;
}
.progress {
  min-width: 150px;
  height: 1.5rem;
  font-size: 1rem;
  background: #cdcdcd !important;
}

.metter {
  text-transform: uppercase;
  font-size: 1rem;
  .supheading {
    display: block;
    font-size: .8em;
    font-weight: 400;
    line-height: 1em;
    margin-bottom: 0;
  }
  .amount {
    font-weight: 600;
    font-size: 1.5em;
    display: block;
    line-height: 1.25em;
  }
}

.results-summary {
  display: flex;
  padding: 15px;
  margin: 0 0 10px 0;
  border-radius: 3px;
  background: #fff;
  .metter {
    margin-right: 10px;
  }
}
</style>
