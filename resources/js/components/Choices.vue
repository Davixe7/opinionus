<template>
  <table class="table">
    <tbody>
      <tr v-for="c in choices">
        <td>{{ c.name }}</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  props: ['choices']
}
</script>

<style lang="css" scoped>
</style>
