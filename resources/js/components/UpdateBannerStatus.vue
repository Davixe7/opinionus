<template>
  <div>
    <input v-show="!saving" type="checkbox" v-model="status" @change="update">
    <i v-show="saving" class="material-icons preloader">sync</i>
  </div>
</template>

<script>
export default {
  props: ['banner'],
  data(){
    return {
      saving: false,
      status: 0
    }
  },
  methods:{
    update(){
      this.saving = true
      console.log( Number( this.status ) );
      let data = {enabled: Number(this.status), _method:'PUT'}
      axios.post(`/admin/banners/${this.banner.id}`, data).then(response=>{
        console.log(response.data.data);
        this.$toasted.show('Updated successfully')
        this.saving = false
      })
    }
  },
  mounted(){
    this.status = this.banner.enabled
  }
}
</script>

<style lang="css" scoped>
</style>
