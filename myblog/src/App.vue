<template>
  <div id="app" :style="backgroundDiv">
    <router-view/>
  </div>
</template>

<script>
export default {
  name: 'App',
  data () {
    return {
      backgroundDiv: {
        backgroundImage: 'url(' + require('@/assets/img/bj.jpg') + ')',
        backgroundRepeat: 'no-repeat',
        backgroundSize: '100% 100%'
      }
    }
  }
}
</script>

<style>
body,p,ul,li,div,h1,h2,h3{margin: 0;padding: 0}
html,body{background: #ccee40;font-size: 14px;color: #111;}
</style>
