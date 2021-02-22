<template>
  <div class="survey-content">
    <div class="label-small">Survey name</div>
    <div class="poll-name">{{ survey.name }}</div>
    <ul class="poll-candidates">
      <li
        v-for="choice in survey.choices"
        :key="choice.id"
        :style="{'background-image': `url(${ imageUrl(choice.image) })`}"
        class="poll-canditate">
      </li>
    </ul>
    <div class="poll-footer">
      <div>
        <div class="label-small">votes</div>
        <div class="poll-content-number">{{ survey.votes_count }}</div>
      </div>
      <a :href="`${url}surveys/${survey.slug}/vote`" class="ml-auto btn btn-primary btn-sm">
        Take Survey
      </a>
    </div>
  </div>
</template>

<script>
export default {
  props: ['survey'],
  data(){return{
    url: process.env.MIX_APP_URL
  }},
  methods:{
    imageUrl( image ){
      return image ? image.replace('public/images', `${this.url}storage/thumbnails/70`) : ''
    }
  },
}
</script>

<style lang="scss" scoped>
  .survey-content {
    overflow: hidden;
  }
  .poll-name,.poll-content-number {
    font-size: 1.5em;
    line-height: 1em;
    font-weight: 700 !important;
    margin-bottom: 15px;
    color: #7f7f7f;
  }

  .poll-candidates {
    list-style-type: none;
    display: flex;
    justify-content: flex-start;
    padding: 0;
  }
  .poll-candidates li {
    margin-right: 5px;
    border-radius: 5%;
    height: 50px;
    width: 50px;
    border: 2px solid #fff;
    flex: 0 0 50px;
    background-size: cover;
  }
  .poll-footer {
    display: flex;
    align-items: center;
  }
  .label-small {
    font-size: .70em;
    font-weight: 400;
    text-transform: uppercase;
    margin-bottom: 0;
  }
</style>
