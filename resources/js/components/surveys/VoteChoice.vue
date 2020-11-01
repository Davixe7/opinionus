<template>
  <div class="vote-choice" @click="$emit('selected')">
    <div class="card">
      <div class="name">{{ choice.name }}</div>
      <div class="picture-wrap">
        <img :src="choice.picture" :alt="choice.name">
        <div class="selection-mark">
          <div class="circle">
            <img src="/check-mark.svg" alt="">
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
  props: ['choice', 'selected', 'number', 'voted']
}
</script>
