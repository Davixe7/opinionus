<template>
  <div class="choice-content">
    <div class="card mb-3">
      <div class="card-body">
        <img :src="imageUrl(choice.image)" alt="">
        <div class="row footer">
          <div class="col-7 text-left">
            <div class="name">{{ choice.name }}</div>
            <a :href="choice.link_url">{{ choice.link_text }}</a>
          </div>
          <div class="col text-right">
            <button
            @click="$emit('selected', choice)"
            class="fab btn-vote" 
            :class="{'btn-success': selected}">
            <i class="material-icons">check</i>
          </button>
        </div>
      </div>
    </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['choice', 'selected'],
  methods:{
    imageUrl(image){
      return image ? image.replace('public/images', '/storage/thumbnails/500') : '';
    }
  }
}
</script>

<style lang="scss" scoped>
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
</style>
