<template>
  <div class="time-picker">
    <div class="input-wrap">
      <input type="number" v-model="hours"   min="0" max="24" @change="emitValue">
      <span>hours</span>
    </div>
    <div class="input-wrap">
      <input type="number" v-model="minutes"   min="0" max="59" @change="emitValue">
      <span>mins</span>
    </div>
    <div class="input-wrap">
      <input type="number" v-model="seconds"   min="0" max="59" @change="emitValue">
      <span>secs</span>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    "selector":{
      type: String
    },
    "duration":{
      type: Number,
      default: 60
    }
  },
  data(){return {
    hours: 0,
    minutes: 0,
    seconds: 0
  }},
  methods:{
    emitValue(){
      document.querySelector(this.selector).value = this.total
    }
  },
  computed:{
    total(){
      return (this.hours * 3600) + (this.minutes * 60) + this.seconds
    }
  },
  mounted(){
    if( this.duration ){
      this.hours   = Math.floor(this.duration / 3600)
      this.minutes = Math.floor(this.duration / 60) % 60
      this.seconds = this.duration % 60
    }
  }
}
</script>

<style lang="scss" scoped>
  .time-picker {
    border: 1px solid #ced4da;
    border-radius: 3px;
    display: flex;
    flex-flow: row wrap;
    text-align: center;
  }
  .time-picker .input-wrap {
    flex: 1 1 33%;
    text-align: center;
    span {
      display: block;
      font-size: .75em;
      font-weight: 600;
      text-transform: uppercase;
      margin-bottom: 10px;
    }
  }
  .time-picker input {
    border: none;
    font-size: 1.5em;
    height: 2em;
    vertical-align: middle;
    width: 100%;
    text-align: center;
  }
</style>
