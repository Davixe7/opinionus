<template>
  <div class="confirm-modal">
    
    <transition enter-active-class="animated fadeIn fast" leave-active-class="animated fadeOut">
      <div v-show="staging" class="overlay" @click="$emit('undoSelection')"></div>
    </transition>
    
    <transition enter-active-class="animated slideInRight fast" leave-active-class="animated slideOutRight fast">
      <div v-show="staging" class="content">
        <span class="supheading">Confirm your selection for</span>
        <span class="survey-name">{{ survey.name }}</span>
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 choice-picture">
                <img :src="imageUrl" alt="">
              </div>
              <div class="col-md-6 choice-detail">
                <span class="supheading">Your selection</span>
                <span class="choice-name">{{ choice.name }}</span>
                <span class="link-text">{{ choice.link_text }}</span>
              </div>
            </div>
          </div>
        </div>
        <div class="actions">
          <button @click="$emit('undoSelection')" class="btn btn-link btn-link-primary">Cancel</button>
          <button class="btn btn-primary">SUBMIT</button>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  props: ['choice', 'survey', 'staging'],
  data(){return{}},
  computed:{
    imageUrl(){
      return this.choice.image ? this.choice.image.replace('public/images', '/storage/thumbnails/500') : '';
    }
  }
}
</script>

<style lang="scss" scoped>
  .overlay {
    position: fixed;
    top: 0;
    right: 0;
    height: 100vh;
    width: 100vw;
    z-index: 100;
    background: rgba(0,0,0,.8);
    
  }
  .content {
    position: fixed;
    top: 0;
    right: 0;
    overflow: auto;
    z-index: 300;
    width: 100vw;
    height: 100vh;
    font-size: 9px;
    padding: 2.75em 4.28em 0;
    background: #fff;
    span {
      display: block;
    }
    .supheading, .link-text {
      font-weight: 300;
      font-size: 1.8571em;
      line-height: 1em;
      margin-bottom: 10px;
    }
    .survey-name {
      font-size: 2.95em;
      font-weight: 500;
      line-height: 1em;
      margin-bottom: 1.85rem;
    }
    .card-body {
      padding: 2.55em;
      img {
        max-width: 100%;
        margin-bottom: 20px;
      }
    }
    .choice-detail {
      display: flex;
      flex-flow: column nowrap;
      justify-content: center;
    }
    .choice-name {
      font-size: 2.95em;
      line-height: 1em;
      margin-bottom: .5em;
      font-weight: 500;
    }
    .actions {
      padding: 1.5em;
      text-align: right;
      .btn {
        font-size: 1.5em;
        font-weight: 600;
        padding: .5em 1em;
        text-transform: uppercase;
      }
      .btn.btn-primary {
        background: blue;
      }
    }
  }
  
  @media(min-width: 768px){
    .content {
      font-size: 12px;
      width: 70vw;
      overflow: hidden;
    }
    .supheading {
      margin-bottom: 1.4285rem;
    }
    .choice-detail {
      padding-left: 2em;
    }
    .survey-name {
      font-size: 3.7em;
    }
    img {
      margin-bottom: 0;
    }
  }
</style>
