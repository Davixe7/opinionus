<template>
  <div id="results">
    <h1>Survey Results</h1>
    <h3>{{ survey.name }}</h3>
    <div v-if="userchoice" class="user-choice-status">
      {{ userchoice.name }}
    </div>
    <table class="table table-results mb-3">
      <tr v-for="choice in choices" :key="choice.id">
        <td>
          <div class="img-wrap">
            <img :src="choice.image.replace('public/images', '/storage/thumbnails/70')" alt="">
          </div>
        </td>
        <td>
          <span class="choice-name">{{ choice.name }}</span>
          <div class="progress">
            <div class="progress-bar" :class="{'bg-success':topVoted.id == choice.id}" :style="{width: globalPercent(choice.votes_count) + '%'}" aria-valuemin="0" aria-valuemax="100">
              {{ globalPercent(choice.votes_count) + '%' }}
            </div>
          </div>
          <span class="choice-votes-count">{{ choice.votes_count }}</span>
        </td>
      </tr>
      <tr>
        <td style="font-size:11px; font-weight: 500; color: #828282;">Total Votes:</td>
        <td>
          <span class="choice-votes-count">
            {{survey.votes_count}}
          </span>
        </td>
      </tr>
      <tr>
        <td></td>
        <td>
          {{ survey.f_created_at }} Created
        </td>
        <td class="text-right">
          {{ survey.days_left }} Days Left
        </td>
      </tr>
    </table>
    
    <div class="results-summary">
      <sharer :message="survey.name" :link="url" class="ml-auto"/>
    </div>
    
  </div>
</template>

<script>
export default {
  props: ['choices', 'survey', 'userchoice'],
  name: 'results',
  data(){
    return { url: window.location.href }
  },
  computed:{
    topVoted(){
      let top = null
      this.choices.forEach(c=>{
        if( !top ){ top = c }
        else if( c.votes_count > top.votes_count){
          top = c
        }
      })
      return top
    }
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
#results h1 {
  font-size: 36px;
  font-weight: 700;
  color: #0060EF;
  margin-bottom: 30px;
}
#results h3 {
  font-size: 26px;
  font-weight: 700;
  color: #000;
  margin-bottom: 10px;
}

td:first-child {
  width: 80px;
  padding-left: 0;
}
td {
  border: none !important;
}
tr:last-child td {
  border-top: 1px solid #D4D4D4 !important;
  vertical-align: bottom;
}

.user-choice-status {
  display: block;
  font-size: 16px;
  font-weight: 700;
  color: #0060EF;
  margin-bottom: 40px;
  &:before {
    content: 'Your vote was:';
    display: block;
    font-size: 12px;
    font-weight: 500;
    color: #828282;
  }
}
table.table-results td {
  border-bottom: 1px solid #efefef;
}
.img-wrap {
  border: 2px solid #D4D4D4;
  border-radius: 10px;
  padding: 3px;
  display: inline-block;
}
img {
  border-radius: 7px;
}
.choice-name {
  display: block;
  font-size: 12px;
  font-weight: 700;
  color: #000;
  margin-bottom: 10px;
}
.progress {
  min-width: 150px;
  height: 1.5rem;
  font-size: 1rem;
  background: #cdcdcd !important;
}
.progress-bar {
  font-size: 12px;
  font-weight: 600;
}
.choice-votes-count {
  font-size: 14px;
  font-weight: 700;
  color: #0060EF;
  &:after {
    content: 'Votes';
    font-size: 12px;
    font-weight: 500;
    color: #828282;
    margin-left: 7px;
    display: inline-block;
  }
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
