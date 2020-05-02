<template>
  <div class="time-picker">
    <input type="number" v-model="hours"   min="0" max="24" @change="emitValue">
    <input type="number" v-model="minutes" min="0" max="59" @change="emitValue">
    <input type="number" v-model="seconds" min="0" max="59" @change="emitValue">
  </div>
</template>

<script>
export default {
  props: ['selector'],
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
  .time-picker input {
    border: none;
    font-size: 1.5em;
    height: 2em;
    vertical-align: middle;
    width: 33%;
    flex: 1 1 33%;
    text-align: center;
  }
</style>
