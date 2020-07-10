<template>
  <div id="thankyou">  
    <div class="row">
      <div class="col-md-5">
        <h1 class="d-sm-none">Thank You!</h1>
        <span class="status-text d-sm-none">
          Your vote was submit successfully For: <span class="choice-name">{{ choice.name }}</span>
        </span>
        <slot></slot>
        <div class="d-sm-none">
          <div class="voted">VOTED</div>
          <div class="action">
            <a href="/surveys" class="btn btn-outlined-default mr-3">Take another</a>
            <a :href="`/surveys/${slug}/results/?choice_id=${choice.id}`" class="btn btn-outlined-default">Show The Results</a>
          </div>
        </div>
      </div>
      <div class="col-md-7 d-none d-sm-block">
        <h1>Thank You!</h1>
        <span class="status-text">
          Your vote was submit successfully For: <span class="choice-name">{{ choice.name }}</span>
        </span>
        <div class="voted text-left">VOTED</div>
        <a href="/surveys" class="btn btn-outlined-default mr-3">Take another</a>
        <a :href="`/surveys/${slug}/results/?choice_id=${choice.id}`" class="btn btn-outlined-default">Show The Results</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['slug', 'choice']
}
</script>

<style lang="scss" scoped>
  #thankyou {
    min-height: 100vh;
    padding: 0;
  }
  h1 {
    font-size: 36px;
    font-weight: 700;
    color: #000;
    margin-bottom: 10px;
  }
  .status-text {
    display: block;
    font-size: 16px;
    color: #828282;
    margin-bottom: 20px;
    .choice-name {
      font-weight: 600;
      color: #0060EF;
      white-space: nowrap;
    }
  }
  .voted {
    display: block;
    font-size: 36px;
    font-weight: 700;
    color: #009D34;
    text-transform: uppercase;
    text-align: center;
    margin-bottom: 30px;
  }
  .action .btn {
    flex: 1 1 auto;
  }
</style>
