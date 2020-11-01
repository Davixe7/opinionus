<template>
  <div id="voting">
    <div class="sharer">
      <div class="title">Share</div>
      <a href="#"><i class="op-icon facebook"></i></a>
      <a href="#"><i class="op-icon twitter"></i></a>
    </div>
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
    resultsURL(){ return '/surveys/'+this.survey.slug+'/results'; }
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
  .sharer {
    text-align: center;
    border-radius: 0 10px 10px 0;
    background: #fff;
    padding: 10px;
    position: fixed;
    top: 50%;
    transform: translateY(-50%);
    left: 0;
    z-index: 1000;
    .title {
      font-size: 12px;
      font-weight: 700;
      color: #B5B5B5;
      margin-bottom: 18px;
    }
    a {
      display: block;
      margin-bottom: 18px;
    }
  }
</style>
