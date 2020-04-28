<template>
  <div id="vote">
    <confirm-modal :choice="selection" :survey="survey" :staging="staging" @undoSelection="staging=false"/>
    <div class="row choices-wrapper">
      
        <div v-for="choice in choices" :key="choice.id" class="col-sm-6 col-md-4 col-lg-4 choice-content">
          <div class="card mb-3">
            <div class="card-body">
              <img :src="imageUrl(choice.image)" alt="">
              <div class="row footer">
                <div class="col-7">
                  <div class="name">{{ choice.name }}</div>
                  <a :href="choice.link_url">{{ choice.link_text }}</a>
                </div>
                <div class="col text-right">
                  <button
                    @click="selection=choice"
                    class="fab btn-vote" 
                    :class="{'btn-success':selection.id == choice.id}">
                    <i class="material-icons">check</i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      
    </div>
    
    <div class="bottom-app-bar">
      <div class="status">
        <div class="form-section-title mb-0">Your Selection</div>
        <span>{{ selection.name || "No candidate selected"  }}</span>
      </div>
      <button @click="(selection.id) ? staging=true : null" class="ml-auto btn btn-primary btn-submit" :class="{disabled: !(selection && selection.id)}">Confirm</button>
    </div>
    
  </div>
</template>

<script>
export default {
  props: ['survey'],
  name: 'Vote',
  data(){return{
    selection: {},
    staging: false
  }},
  computed:{
    choices(){
      return this.survey.choices
    }
  },
  methods:{
    imageUrl(image){
      return image ? image.replace('public/images', '/storage/thumbnails/500') : '';
    }
  }
}
</script>

<style lang="scss" scoped>
  .choices-wrapper {
    margin-bottom: 60px;
  }
  .choice-content img {
    max-width: 100%;
  }
  .choice-content .footer {
    padding-top: 15px;
  }
  .choice-content .name {
    font-family: "Roboto Condensed";
    font-size: 1.5em;
    font-weight: 600;
  }
  .choice-content .fab {
    box-shadow: none;
    border: 1px solid #efefef;
  }
  .choice-content .fab.btn-success {
    box-shadow: 0 1px 8px 1px rgba(0,0,0,.25);
    border: none;
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
