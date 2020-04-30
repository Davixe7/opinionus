<template>
  <div id="thankyou">
    
    <div class="circle"></div>
    <div class="circle small" style="top: 50px; left: 50px;"></div>
    
    <div class="main">
      <div class="header">
        <div class="w-100">
          <span class="supheading">Thank you!</span>
          <h2>Your vote was submit succesfully</h2>
        </div>
      </div>
      
      <slot></slot>
      
      <div class="actions row">
        <div class="col-md-6">
          <a :href="`/surveys/${surveyId}/results`" class="btn btn-danger w-100 bg-pink mb-2 order-sm-2">Go to results page</a>
        </div>
        <div class="col-md-6">
          <a href="/surveys" class="btn btn-danger w-100 bg-pink mb-2 order-sm-1">Vote in another poll</a>
        </div>
      </div>
      
    </div>
  </div>
</template>

<script>
export default {
  props: ['surveyId']
}
</script>

<style lang="scss" scoped>
  #thankyou {
    font-size: 14px;
    text-align: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    padding: 0;
    overflow: auto;
    background: #fff;
  }
  .main {
    position: relative;
    z-index: 200;
    padding: 0 15px;
    margin: 0 auto;
  }
  .header,.actions {
    display: flex;
    align-items: center;
    align-content: flex-start;
    height: 20vh;
  }
  .supheading {
    font-weight: 400;
    font-size: 1.1428em;
  }
  h2 {
    font-weight: 500;
    font-size: 1.7142em;
    white-space: nowrap;
  }
  @media(min-width: 768px){
    #thankyou .main {
      max-width: 70%;
    }
  }
  @media(min-width: 991px){
    #thankyou .main {
      max-width: 55%;
    }
  }
  @media(min-width: 1200px){
    #thankyou .main {
      max-width: 30%;
    }
    .actions {
      flex-direction: row-reverse;
    }
    .circle {
      width: 33vw;
      height: 33vw;
    }
  }
  
  .circle {
    z-index: 100;
    position: absolute;
    border-radius: 50%;
    background: #00b9eb;
    border: 25px solid #7fdff9;
    bottom: 100px;
    right: 10px;
    width: 70vw;
    height: 70vw;
    &.small {
      width: 30vw;
      height: 30vw;
      border-width: 10px;
    }
  }
</style>
