<template>
  <div class="users-table table-responsive">
    <div class="thead">
      <div>id</div>
      <div>name</div>
      <div>email</div>
      <div>password</div>
      <div>action</div>
    </div>
    <div class="tbody">
      <update-user :user="newUser" @userStored="appendUser"/>
      <update-user v-for="user in results" :user="user" :key="user.id" @userDeleted="removeUser"/>
    </div>
  </div>
</template>

<script>
export default {
  props: ['data'],
  data(){return {
    results: [],
    newUser: {}
  }},
  methods:{
    appendUser(user){
      this.results.unshift(user)
      this.newUser = {}
    },
    editUser(user){
      return true
    },
    removeUser(user){
      this.results = this.results.filter( f => f.id != user.id )
    },
  },
  mounted(){
    if( this.data.data.length ){
      this.results = [...this.data.data]
    }
  }
}
</script>

<style lang="scss" scoped>
  .users-table {
    display: table;
  }
  .thead {
    display: table-row;
    padding-bottom: 10px;
    > div {
      text-transform: uppercase;
      padding-bottom: 10px;
      display: table-cell;
      font-size: .9em;
      font-weight: 600;
      color: gray;
    }
  }
  .tbody {
    display: table-row-group;
  }
</style>
