<template>
  <div class="choice-content" :class="{selected}" @click="$emit('selected', choice)">
    <div class="card mb-3">
      <div class="card-body">
        <div class="name">{{ choice.name }}</div>
        <div class="action-wrap">
          <img :src="imageUrl(choice.image)" alt="">
          <div class="check-status">
            <span class="checked-icon-wrap">
              <span class="checked-icon"><i class="material-icons">check</i></span>
            </span>
            <span class="choice-checked-label">{{ voted ? 'Voted' : 'Selected' }}</span>
          </div>
        </div>
        <span class="status-text">
          <span class="choice-number">{{ ( number < 10 ) ? '0' + number : number }}</span>
          <span v-show="!voted">
            {{ selected ? 'Selected' : 'Tap to select this choice'  }}
          </span>
        </span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['choice', 'selected', 'number', 'voted'],
  methods:{
    imageUrl(image){
      return image ? image.replace('public/images', '/storage/thumbnails/500') : '';
    }
  }
}
</script>

<style lang="scss" scoped>
.choice-content {
  cursor: pointer;
}
.choice-content .card-body {
  padding: 18px 27px 10px;
}
.choice-content .name {
  font-size: 16px;
  font-weight: 700;
  color: #000;
  margin: 0 0 10px;
}
.choice-content .action-wrap {
  border: 3px solid #F3F3F3;
  border-radius: 10px;
  padding: 7px;
  position: relative;
  margin-bottom: 10px;
}
.choice-content img {
  max-width: 100%;
  border-radius: 5px;
}
.action-wrap .check-status {
  display: none;
  flex-flow: column nowrap;
  justify-content: center;
  position: absolute;
  bottom: 0;
  right: 0;
  padding: 20px 30px 20px;
}
.checked-icon-wrap {
  border: 2px solid #0060ef;
  border-radius: 50%;
  padding: 5px;
  display: inline-block;
}
.checked-icon {
  display: flex;
  justify-content: center;
  align-items: center;
  border: 4px solid #009d34;
  background: #fff;
  border-radius: 50%;
  width: 45px;
  height: 45px;
  text-align: center;
  i.material-icons {
    color: #009d34;
  }
}
.choice-checked-label {
  color: #0060ef;
  font-weight: 700;
  font-size: 12px;
  display: block;
  text-align: center;
}
.status-text {
  display: inline-flex;
  align-items: center;
  font-size: 10px;
  font-weight: 300;
  color: #B5B5B5;
  .choice-number {
    font-size: 18px;
    font-weight: 700;
    margin-right: 12px;
    color: #D4D4D4;
  }
}
.choice-content.selected {
  .action-wrap .check-status {
    display: inline-flex;
  }
  .status-text, .status-text .choice-number {
    color: #28A745;
  }
}
</style>
