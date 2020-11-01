<template>
  <div class="table-row">
    <div>
      {{ user.id || 'pending'}}
    </div>
    <div>
      <input type="text" class="form-control" placeholder="name" v-model="user.name">
    </div>
    <div>
      <input type="email" class="form-control" placeholder="email" v-model="user.email">
    </div>
    <div>
      <input type="password" class="form-control" placeholder="password" v-model="user.password">
    </div>
    <div>
      <div class="btn-group">
        <button v-if="user.id" @click="update()" class="btn btn-sm btn-link">
          <i v-show="saving" class="material-icons preloader">sync</i>
          <span><i class="material-icons">save</i></span>
        </button>
        <button v-else @click="store()" class="btn btn-sm btn-link" title="save">
          <i v-show="saving" class="material-icons preloader">sync</i>
          <span><i class="material-icons">save</i></span>
        </button>
        <button v-if="user.id" @click="deleteUser(user)" class="btn btn-sm btn-link" title="delete">
          <i v-show="saving" class="material-icons preloader">sync</i>
          <span><i class="material-icons">delete</i></span>
        </button>
        <a v-if="user.id" target="_blank" :href="`/admin/surveys/?user_id=${user.id}`" class="btn btn-sm btn-link" title="user polls">
          <span><i class="material-icons">poll</i></span>
        </a>
        <a v-if="user.id" target="_blank" :href="`/admin/users/${user.id}/banners`" class="btn btn-sm btn-link" title="user banners">
          <span><i class="material-icons">view_carousel</i></span>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['user'],
    data(){ return {
      saving: false
    }},
    methods:{
      update(){
        this.saving = true
        let data = this.loadData()
        data['_method'] = 'PUT'
        axios.post(`/admin/users/${this.user.id}`, data).then(response=>{
          this.$emit('userUpdated', response.data.data)
          this.$toasted.show('Updated successfully')
        }).then(()=>{
          this.saving = false
        });
      },
      store(){
        this.saving = true
        let data = this.loadData()
        console.log( data );
        axios.post(`/admin/users`, data).then(response=>{
          this.$emit('userStored', response.data.data)
          this.$toasted.show('Created successfully')
        }).then(()=>{
          this.saving = false
        });
      },
      deleteUser(user){
        if( confirm('Are you sure you want to delete the user?') ){
          this.saving = true
          let data = {
            '_method': 'DELETE'
          }
          axios.post(`/admin/users/${user.id}`, data).then(response=>{
            this.$emit('userDeleted', response.data.data)
            this.$toasted.show('Deleted successfully')
          }).then(()=>{
            this.saving = false
          });
        }
      },
      loadData(){
        let data = {
          email: this.user.email,
          name: this.user.name,
          password: this.user.password
        }
        return data
      }
    }
  }
</script>

<style lang="scss">
  .table-row, .table-head {
    display: table-row;
    > div {
      display: table-cell;
    }
  }
  .table-row > div {
    padding: 0 7px 5px 0;
  }
  .table-row {
    vertical-align: middle;
    div {
      vertical-align: middle;
    }
  }
</style>
