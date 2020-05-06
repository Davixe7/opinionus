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
    
    <div class="card mb-3">
      <div class="card-body">
        <div class="metter">
          <div class="supheading">votes</div>
          <div class="amount">{{ survey.votes_count }}</div>
        </div>
      </div>
    </div>
    
    <div class="share-section">
      <div class="form-section-title mb-3">Share results</div>
      <!-- Go to www.addthis.com/dashboard to customize your tools -->
      <div class="addthis_inline_share_toolbox"></div>
    </div>
  </div>
</template>

<script>

export default {
  props: ['choices', 'survey'],
  name: 'results',
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
  font-size: 1em;
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

.bounce {
  animation: bounce .5s infinite alternate linear;
  font-size: 2.5em;
}
@keyframes bounce {
  from {transform: translateY(-7px);}
  to {transform: translateY(7px);}
}
</style>
