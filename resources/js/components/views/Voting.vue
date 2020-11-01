<template>
  <div id="voting">
    <article>
      <div style="display: flex; flex-flow: row nowrap; align-items: center; justify-content: space-between;">
        <h1>{{ survey.name }}</h1>
        <div>
          <a :href="`/reports/create/?survey_id=${survey.id}`">
            Report as inappropiated
          </a>
        </div>
      </div>
      <div class="vote-choices">
        <vote-choice v-for="(choice,i) in choices" :key="i"
        @selected="selectedIndex=i+1"
        :choice="choice"
        :number="i+1" :class="{'selected':selectedIndex == i+1}">
        </vote-choice>
      </div>
    </article>

    <div class="vote-page-actions">
      <a class="btn" :href="resultsURL">Just show results</a>
      <button class="btn btn-primary" :class="{'disabled':!selectedIndex}" @click="submitVote">
        <i class="op-icon checkmark"></i>
        Confirm your vote
      </button>
    </div>

    <form ref="voteForm" action="/votes" method="POST" v-if="selectedIndex">
      <input type="hidden" name="choice_id" :value="choices[selectedIndex-1].id">
    </form>
  </div>
</template>

<script>
export default {
  props: ['survey'],
  data(){return{
    selectedIndex: null,
    choices: []
  }},
  computed:{
    resultsURL(){ return '/surveys/'+this.survey.slug+'/results' }
  },
  methods:{
    submitVote(){
      if(this.selectedIndex){ this.$refs.voteForm.submit() }
    }
  },
  mounted(){ this.choices = [...this.survey.choices] }
}
</script>

<style lang="scss" scoped>
</style>
