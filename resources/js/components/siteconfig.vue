<template>
  <div id="siteconfig">
    <form @submit.prevent="save" ref="siteConfigForm">
      <div class="form-section-title">Navbar</div>
      <div class="row mb-4">
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label for="landing-headline">Brand Name</label>
                <input type="text" class="form-control" v-model="brandname" required>
              </div>
              <div class="form-group">
                <label for="landing-headline">Catch phrase</label>
                <input type="text" class="form-control" v-model="catchphrase" required>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          Example
          <div class="pseudo-navbar">
            <div class="pseudo-navbar-brand">{{ brandname }}</div>
            <span>{{ catchphrase }}</span>
          </div>
        </div>
      </div>
      
      <div class="form-section-title">Landing page</div>
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label for="landing-headline">Headline</label>
                <input type="text" class="form-control" v-model="headline" required>
              </div>
              <div class="form-group">
                <label for="landing-headline">Description</label>
                <textarea rows="3" class="form-control" v-model="description" required>{{ description }}</textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <span class="headline">{{ headline }}</span>
          <span class="Description">
            {{ description }}
          </span>
        </div>
        <div class="form-group col-md-12 text-right">
          <button type="submit" class="btn btn-primary d-inline-flex align-items-center">
            <i v-show="saving" class="material-icons preloader">sync</i>
            <span>Save site configuration</span>
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
  export default {
    props: ['siteconfig'],
    data(){
      return {
        headline: 'PollyPolls',
        description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id, assumenda velit! Minus esse odit nisi officiis, ex facere ea repudiandae fuga quis adipisci eos, veritatis ipsum ullam aliquam. Tempore, natus.',
        brandname: 'PollyPolls',
        catchphrase: 'Awesome Catchphrase',
        
        saving: false,
        errors: {}
      }
    },
    methods:{
      save(){
        if( !this.$refs.siteConfigForm.reportValidity() ) return
        this.saving = true
        let data = {
          'siteconfig' : {
            'headline' : this.headline,
            'description' : this.description,
            'brandname' : this.brandname,
            'catchphrase' : this.catchphrase,
          }
        }
        axios.post('/admin/siteconfig', data).then(response =>{
          this.$toasted.show('Config saved successfully')
          this.saving = false
        })
      }
    },
    mounted(){
      this.headline = this.siteconfig.headline
      this.description = this.siteconfig.description
      this.brandname = this.siteconfig.brandname
      this.catchphrase = this.siteconfig.catchphrase
    }
  }
</script>

<style lang="scss" scoped>
  .pseudo-navbar {
    padding: 15px;
    border: 1px solid gray;
    border-radius: 3px;
  }
  .pseudo-navbar-brand {
    font-size: 1.15em;
    font-weight: 600;
  }
  .headline {
    display: block;
    font-weight: 600;
    font-size: 2.5em;
  }
  .description {
    display: block;
  }
</style>
