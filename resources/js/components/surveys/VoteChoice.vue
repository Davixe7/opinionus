<template>
  <div class="vote-choice" @click="$emit('selected')">
    <div class="card">
      <div class="name">{{ choice.name }}</div>
      <div class="picture-wrap">
        <img :src="choice.medium_picture" :alt="choice.name">
        <div class="selection-mark">
          <div class="circle">
            <img :src="`${url}check-mark.svg`" alt="">
          </div>
          <div>{{ voted ? 'Voted' : 'Selected'}}</div>
        </div>
      </div>
      <div class="choice-number">{{ number | twoDigits }}</div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['choice', 'selected', 'number', 'voted'],
  data(){return{
    url: process.env.MIX_APP_URL
  }}
}
</script>
