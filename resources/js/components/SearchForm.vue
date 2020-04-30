<template>
  <div class="search-form">
    <form autocomplete="off">
      <input autocomplete="none" type="search" v-model="query" placeholder="Search by name...">
    </form>
  </div>
</template>

<script>
export default {
  name: 'SearchForm',
  props: ['collection', 'attribute'],
  data(){
    return {
      query: ''
    }
  },
  watch:{
    results(){
      this.$emit('input', this.results)
    }
  },
  computed:{
    results(){
      if( this.collection.length && this.query ){
        let attribute = (this.attribute) ? this.attribute : 'name'
        
        return this.collection.filter( f => {
          if( f.hasOwnProperty( attribute ) ){
            return f[attribute].toLowerCase().includes( this.query.toLowerCase() )
          }
          if( typeof f === 'string' ){
            return f.toLowerCase().includes( this.query.toLowerCase() )
          }
          return false
        })
      }
      
      return [...this.collection]
    }
  }
}
</script>

<style lang="css" scoped>
  .search-form {
    margin-left: auto;
    width: 100%;
    margin-bottom: 20px;
  }
  .search-form input {
    font-size: 1em;
    border-radius: 20px;
    padding: 7px 20px;
    border: 1px solid #d4e2e6;
    box-shadow: none;
  }
  .search-form form, .search-form input[type=search] {
    width: 100%;
  }
  .search-form input[type=search] {
    flex: 1;
  }
</style>
