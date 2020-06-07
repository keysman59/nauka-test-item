<template>
  <div id="app">
    <Main></Main>
  </div>
</template>

<script>
import Main from './components/Main.vue'

export default {
  name: 'App',
  components: {
    Main
  }
}
</script>

<style>

* {
  margin: 0;
  padding: 0;
}

body {
  font-family: 'Oxygen', sans-serif;
}

</style>
