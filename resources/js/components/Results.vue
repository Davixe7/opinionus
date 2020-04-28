<template>
  <div id="results">
    <div class="row">
      
      <div class="col-md-6">
        
        <table class="table table-results mb-3">
          <tr v-for="choice in choices" :key="choice.id">
            <td>
              <span class="choice-name">{{ choice.name }}</span>
              <a :href="choice.link_url">{{ choice.link_text }}</a>
            </td>
            <td>
              <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">20%</div>
              </div>
            </td>
          </tr>
        </table>
        
        <div class="card mb-3">
          <div class="card-body">Lorem ipsum dolor sit amet</div>
        </div>
        
        <div class="share-section">
          <div class="form-section-title mb-3">Share results</div>
          
          <!-- Go to www.addthis.com/dashboard to customize your tools -->
          <div class="addthis_inline_share_toolbox"></div>
            
        </div>
        
      </div>
      
    </div>
  </div>
</template>

<script>

export default {
  props: ['choices'],
  name: 'results'
}
</script>

<style lang="scss" scoped>
  #results {
    padding-bottom: 40px;
  }
  table.table-results td {
    border-bottom: 1px solid #efefef;
  }
  .choice-name {
    display: block;
    font-weight: 600;
    color: gray;
    font-size: 1em;
  }
</style>
